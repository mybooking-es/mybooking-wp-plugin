<?php
if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Account profile resolver and feature-flag cache for MyBooking checkout.
 *
 * Provides:
 *   get_features()             public; delivery_slots/optional_external_driver (preserved)
 *   get_account_profile()      public; full multi-engine profile via fallback chain
 *   get_profile_preferences()  public; stored manual-override settings
 *   save_profile_preferences() public; persists manual-override settings
 *   get_engine_required()      public static; forced-required keys for active profile
 *   map_account_required_fields() public static; API key → Builder field key
 *   flush_cache()              public; clears all transients
 *
 * Profile fallback chain:
 *   1. wizard-info API         (fresh; normalizes module flags + booking_item_family)
 *   2. onboarding_business_info (cached WP option from plugin onboarding)
 *   3. plugin module selectors  (mybooking_plugin_settings_configuration)
 *   4. safe show-all fallback   (all engines + generic; never hides fields on error)
 *
 * Profile preferences (manual override) stored in separate WP option — never in form config.
 */
class MyBookingAccountSettings {

  const TRANSIENT_KEY      = 'mybooking_account_features';
  const TRANSIENT_PROFILE  = 'mybooking_account_profile';
  const TRANSIENT_SETTINGS = 'mybooking_account_settings_data';
  const TRANSIENT_REQUIRED = 'mybooking_account_required_fields';
  const CACHE_TTL          = HOUR_IN_SECONDS;
  const PROFILE_OPTION     = 'mybooking_checkout_form_profile_preferences';

  // ── Public API ────────────────────────────────────────────────────────────

  /**
   * Returns feature flags for legacy engine special field visibility.
   * Public API is preserved: same return shape as before P3.1.
   *
   * @return array { 'delivery_slots' => bool, 'optional_external_driver' => bool }
   */
  public static function get_features() {
    $cached = get_transient( self::TRANSIENT_KEY );
    if ( $cached !== false ) {
      return $cached;
    }

    $data = self::fetch_settings_api();
    $features = [
      'delivery_slots'           => ! empty( $data['delivery_slots'] ),
      'optional_external_driver' => ! empty( $data['optional_external_driver'] ),
    ];
    set_transient( self::TRANSIENT_KEY, $features, self::CACHE_TTL );
    return $features;
  }

  /**
   * Returns the normalized account profile.
   *
   * @return array {
   *   'source'                  => 'api'|'manual'|'onboarding_cache'|'plugin_settings'|'fallback',
   *   'engines'                 => string[],
   *   'renting_family_raw'      => string,
   *   'renting_business_line'   => 'vehicle'|'boat'|'accommodation'|'generic',
   *   'features'                => array,
   *   'account_required_fields' => string[],
   * }
   */
  public static function get_account_profile() {
    $cached = get_transient( self::TRANSIENT_PROFILE );
    if ( $cached !== false ) {
      return $cached;
    }

    $prefs = self::get_profile_preferences();

    if ( ! empty( $prefs['mode'] ) && $prefs['mode'] === 'manual' ) {
      // Always resolve auto profile first so features/account_required_fields are preserved.
      $auto_profile = self::resolve_api_profile();
      $profile = self::build_manual_profile( $prefs, $auto_profile );
    } else {
      $profile = self::resolve_api_profile();
    }

    set_transient( self::TRANSIENT_PROFILE, $profile, self::CACHE_TTL );
    return $profile;
  }

  /**
   * Returns stored profile preferences (mode + manual override values).
   *
   * @return array { 'mode' => 'auto'|'manual', 'engines' => [...], 'renting_business_line' => '...', 'show_all' => bool }
   */
  public static function get_profile_preferences() {
    $prefs = get_option( self::PROFILE_OPTION, [] );
    return is_array( $prefs ) ? $prefs : [];
  }

  /**
   * Saves profile preferences and flushes only the profile transient.
   * Preserves TRANSIENT_SETTINGS and TRANSIENT_REQUIRED (account facts that
   * have not changed — changing preferences does not change account settings
   * or account required fields).
   *
   * @param array $prefs
   */
  public static function save_profile_preferences( $prefs ) {
    update_option( self::PROFILE_OPTION, $prefs );
    self::flush_profile_only();
  }

  /**
   * Returns engine-forced required field keys for the given profile.
   * This is the engineForced layer of: core || accountRequired || engineForced || savedBuilderRequired.
   *
   * @param array $profile Result from get_account_profile()
   * @return string[]
   */
  public static function get_engine_required( $profile ) {
    $engines  = isset( $profile['engines'] ) ? (array) $profile['engines'] : [];
    $features = isset( $profile['features'] ) ? (array) $profile['features'] : [];
    $forced   = [];

    if ( in_array( 'renting', $engines, true ) ) {
      $forced = array_merge( $forced, self::renting_engine_required( $features ) );
    }
    if ( in_array( 'activities', $engines, true ) ) {
      $forced = array_merge( $forced, self::activities_engine_required( $features ) );
    }
    if ( in_array( 'transfers', $engines, true ) ) {
      $forced = array_merge( $forced, self::transfers_engine_required( $features ) );
    }

    return array_values( array_unique( $forced ) );
  }

  /**
   * Maps account required-field API keys to Builder field keys via the safe key map.
   * Keys with status unsupported_checkout_key or do_not_map_to_customer are silently dropped.
   *
   * @param string[] $api_keys
   * @return string[] Builder field keys
   */
  public static function map_account_required_fields( $api_keys ) {
    $map    = self::account_required_field_map();
    $result = [];
    foreach ( (array) $api_keys as $k ) {
      if ( isset( $map[ $k ] ) ) {
        $result[] = $map[ $k ];
      }
    }
    return array_values( array_unique( $result ) );
  }

  /**
   * Clears all profile, settings, features and required-fields transients.
   */
  public static function flush_cache() {
    delete_transient( self::TRANSIENT_KEY );
    self::flush_profile_cache();
  }

  // ── Private: profile resolution ──────────────────────────────────────────

  /** Deletes only the active-profile transient (preferences changed; account facts preserved). */
  private static function flush_profile_only() {
    delete_transient( self::TRANSIENT_PROFILE );
  }

  /** Deletes profile + settings + required-fields transients (full cache reset via refresh). */
  private static function flush_profile_cache() {
    delete_transient( self::TRANSIENT_PROFILE );
    delete_transient( self::TRANSIENT_SETTINGS );
    delete_transient( self::TRANSIENT_REQUIRED );
  }

  private static function resolve_api_profile() {
    $api_key  = self::get_api_key();
    $base_url = self::get_api_url();

    // Level 1: wizard-info API (fresh)
    if ( ! empty( $api_key ) && ! empty( $base_url ) ) {
      $wizard = self::fetch_wizard_info( $api_key, $base_url );
      if ( $wizard !== null ) {
        $settings   = self::fetch_settings_api_raw( $api_key, $base_url );
        $req_fields = self::fetch_required_fields( $api_key, $base_url );
        return self::build_api_profile( $wizard, $settings, $req_fields );
      }
    }

    // Level 2: cached onboarding option
    $onboarding = get_option( 'mybooking_plugin_onboarding_business_info', [] );
    if ( is_array( $onboarding ) && ! empty( $onboarding ) ) {
      return self::build_onboarding_profile( $onboarding );
    }

    // Level 3: plugin module selector options
    $config = get_option( 'mybooking_plugin_settings_configuration', [] );
    if ( is_array( $config ) && ! empty( $config ) ) {
      return self::build_plugin_settings_profile( $config );
    }

    // Level 4: safe show-all fallback — never hide all fields on error
    return [
      'source'                  => 'fallback',
      'engines'                 => [ 'renting', 'activities', 'transfers' ],
      'renting_family_raw'      => '',
      'renting_business_line'   => 'generic',
      'features'                => [],
      'account_required_fields' => [],
    ];
  }

  private static function build_api_profile( $wizard, $settings, $req_fields ) {
    $engines = [];
    if ( ! empty( $wizard['module_rental'] ) )     { $engines[] = 'renting';    }
    if ( ! empty( $wizard['module_activities'] ) ) { $engines[] = 'activities'; }
    if ( ! empty( $wizard['module_transfer'] ) )   { $engines[] = 'transfers';  }
    if ( empty( $engines ) )                       { $engines   = [ 'renting' ]; }

    $family_raw    = isset( $wizard['booking_item_family'] ) ? (string) $wizard['booking_item_family'] : '';
    $business_line = self::map_renting_family( $family_raw );
    $features      = is_array( $settings ) ? $settings : [];

    return [
      'source'                  => 'api',
      'engines'                 => $engines,
      'renting_family_raw'      => $family_raw,
      'renting_business_line'   => $business_line,
      'features'                => $features,
      'account_required_fields' => self::map_account_required_fields( is_array( $req_fields ) ? $req_fields : [] ),
    ];
  }

  private static function build_onboarding_profile( $onboarding ) {
    $engines = [];
    if ( ! empty( $onboarding['module_rental'] ) )     { $engines[] = 'renting';    }
    if ( ! empty( $onboarding['module_activities'] ) ) { $engines[] = 'activities'; }
    if ( ! empty( $onboarding['module_transfer'] ) )   { $engines[] = 'transfers';  }
    if ( empty( $engines ) )                           { $engines   = [ 'renting' ]; }

    $family_raw = isset( $onboarding['booking_item_family'] ) ? (string) $onboarding['booking_item_family'] : '';

    return [
      'source'                  => 'onboarding_cache',
      'engines'                 => $engines,
      'renting_family_raw'      => $family_raw,
      'renting_business_line'   => self::map_renting_family( $family_raw ),
      'features'                => [],
      'account_required_fields' => [],
    ];
  }

  private static function build_plugin_settings_profile( $config ) {
    $engines = [];
    if ( ! empty( $config['mybooking_plugin_settings_configuration_module_rent'] ) )       { $engines[] = 'renting';    }
    if ( ! empty( $config['mybooking_plugin_settings_configuration_module_activities'] ) ) { $engines[] = 'activities'; }
    if ( ! empty( $config['mybooking_plugin_settings_configuration_module_transfer'] ) )   { $engines[] = 'transfers';  }
    if ( empty( $engines ) ) {
      $engines = [ 'renting', 'activities', 'transfers' ];
    }

    return [
      'source'                  => 'plugin_settings',
      'engines'                 => $engines,
      'renting_family_raw'      => '',
      'renting_business_line'   => 'generic',
      'features'                => [],
      'account_required_fields' => [],
    ];
  }

  private static function build_manual_profile( $prefs, $auto_profile = [] ) {
    $valid   = [ 'renting', 'activities', 'transfers' ];
    $engines = [];
    if ( ! empty( $prefs['engines'] ) && is_array( $prefs['engines'] ) ) {
      foreach ( $prefs['engines'] as $e ) {
        if ( in_array( $e, $valid, true ) ) {
          $engines[] = $e;
        }
      }
    }
    if ( empty( $engines ) ) {
      $engines = [ 'renting', 'activities', 'transfers' ];
    }

    // Canonical key renting_business_line is already mapped — use directly.
    // Legacy key renting_family is a raw API value — must pass through map_renting_family().
    if ( isset( $prefs['renting_business_line'] ) ) {
      $family_raw    = (string) $prefs['renting_business_line'];
      $canonical     = in_array( $family_raw, [ 'vehicle', 'boat', 'accommodation', 'generic' ], true )
        ? $family_raw : 'generic';
    } elseif ( isset( $prefs['renting_family'] ) ) {
      $family_raw = (string) $prefs['renting_family'];
      $canonical  = self::map_renting_family( $family_raw );
    } else {
      $family_raw = '';
      $canonical  = 'generic';
    }

    $business_line = in_array( 'renting', $engines, true ) ? $canonical : 'generic';

    // Preserve detected features and account_required_fields from auto profile.
    $features                = isset( $auto_profile['features'] )                ? $auto_profile['features']                : [];
    $account_required_fields = isset( $auto_profile['account_required_fields'] ) ? $auto_profile['account_required_fields'] : [];

    return [
      'source'                  => 'manual',
      'engines'                 => $engines,
      'renting_family_raw'      => $family_raw,
      'renting_business_line'   => $business_line,
      'features'                => $features,
      'account_required_fields' => $account_required_fields,
    ];
  }

  // ── Private: renting family ───────────────────────────────────────────────

  private static function map_renting_family( $raw ) {
    static $vehicle      = [ 'car', 'car_vehicle', 'camper', 'camper_group' ];
    static $boat         = [ 'boat', 'boat_charter' ];
    static $accommodation = [ 'property', 'property_resource', 'room', 'hotel', 'hostel' ];

    if ( in_array( $raw, $vehicle, true ) )       { return 'vehicle';        }
    if ( in_array( $raw, $boat, true ) )          { return 'boat';           }
    if ( in_array( $raw, $accommodation, true ) ) { return 'accommodation';  }
    return 'generic';
  }

  // ── Private: engine required policies ────────────────────────────────────

  private static function renting_engine_required( $features ) {
    $fields = [
      'customer_name', 'customer_surname', 'customer_email',
      'confirm_customer_email', 'customer_phone',
      'customer_classifier_id', 'customer_type',
      'customer_company_name', 'customer_company_contact_name',
      'number_of_adults',
    ];
    if ( ! empty( $features['delivery_slots'] ) ) {
      $fields[] = 'slot_time_from';
    }
    if ( ! empty( $features['optional_external_driver'] ) ) {
      $fields[] = 'with_optional_external_driver';
    }
    return $fields;
  }

  private static function activities_engine_required( $features ) {
    $fields = [
      'customer_name', 'customer_surname', 'customer_email',
      'confirm_customer_email', 'customer_phone',
    ];
    if ( ! empty( $features['activity_customer_vehicle'] ) ) {
      $fields[] = 'customer_stock_brand';
      $fields[] = 'customer_stock_model';
      $fields[] = 'customer_stock_plate';
    }
    return $fields;
  }

  private static function transfers_engine_required( $features ) {
    $fields = [
      'customer_name', 'customer_surname', 'customer_email',
      'confirm_customer_email', 'customer_phone',
      'detailed_origin_address',            'detailed_origin_flight_number',
      'detailed_origin_flight_estimated_time',
      'detailed_destination_address',       'detailed_destination_flight_number',
      'detailed_destination_flight_estimated_time',
      'detailed_return_origin_address',     'detailed_return_origin_flight_number',
      'detailed_return_origin_flight_estimated_time',
      'detailed_return_destination_address', 'detailed_return_destination_flight_number',
      'detailed_return_destination_flight_estimated_time',
    ];
    if ( ! empty( $features['transfer_form_fill_billing_address'] ) ) {
      $fields[] = 'street';
      $fields[] = 'city';
      $fields[] = 'state';
      $fields[] = 'country';
      $fields[] = 'zip';
    }
    return $fields;
  }

  // ── Private: account required field map ──────────────────────────────────

  private static function account_required_field_map() {
    return [
      'name'                => 'customer_name',
      'surname'             => 'customer_surname',
      'email'               => 'customer_email',
      'phone_number'        => 'customer_phone',
      'date_of_birth'       => 'customer_date_of_birth',
      'nacionality'         => 'customer_nacionality',
      'document_id_type_id' => 'customer_document_id_type_id',
      'document_id'         => 'customer_document_id',
      'origin_country'      => 'customer_origin_country',
      'address[street]'     => 'street',
      'address[number]'     => 'number',
      'address[complement]' => 'complement',
      'address[city]'       => 'city',
      'address[state]'      => 'state',
      'address[country]'    => 'country',
      'address[zip]'        => 'zip',
    ];
  }

  // ── Private: API fetchers ─────────────────────────────────────────────────

  private static function fetch_wizard_info( $api_key, $base_url ) {
    $url = trailingslashit( $base_url ) . 'api/booking/frontend/wizard-info?' . http_build_query( [
      'api_key' => $api_key,
    ] );

    $response = wp_remote_get( $url, [ 'timeout' => 10, 'sslverify' => true ] );
    if ( is_wp_error( $response ) ) {
      return null;
    }
    if ( wp_remote_retrieve_response_code( $response ) !== 200 ) {
      return null;
    }
    $data = json_decode( wp_remote_retrieve_body( $response ), true );
    return is_array( $data ) ? $data : null;
  }

  /**
   * Fetches frontend/settings WITHOUT product_type (bug fix from P3.1).
   * Caches raw response and keeps the features transient in sync.
   */
  private static function fetch_settings_api_raw( $api_key, $base_url ) {
    $cached = get_transient( self::TRANSIENT_SETTINGS );
    if ( $cached !== false ) {
      return $cached;
    }

    $url = trailingslashit( $base_url ) . 'api/booking/frontend/settings?' . http_build_query( [
      'api_key' => $api_key,
    ] );

    $response = wp_remote_get( $url, [ 'timeout' => 10, 'sslverify' => true ] );
    if ( is_wp_error( $response ) ) {
      return null;
    }
    if ( wp_remote_retrieve_response_code( $response ) !== 200 ) {
      return null;
    }
    $data = json_decode( wp_remote_retrieve_body( $response ), true );
    if ( ! is_array( $data ) ) {
      return null;
    }

    set_transient( self::TRANSIENT_SETTINGS, $data, self::CACHE_TTL );

    // Keep features transient in sync so get_features() can benefit from this call.
    $features = [
      'delivery_slots'           => ! empty( $data['delivery_slots'] ),
      'optional_external_driver' => ! empty( $data['optional_external_driver'] ),
    ];
    set_transient( self::TRANSIENT_KEY, $features, self::CACHE_TTL );

    return $data;
  }

  /**
   * Wrapper used by get_features() when the settings data isn't pre-fetched by the profile resolver.
   */
  private static function fetch_settings_api() {
    $api_key  = self::get_api_key();
    $base_url = self::get_api_url();
    if ( empty( $api_key ) || empty( $base_url ) ) {
      return [];
    }
    $data = self::fetch_settings_api_raw( $api_key, $base_url );
    return is_array( $data ) ? $data : [];
  }

  private static function fetch_required_fields( $api_key, $base_url ) {
    $cached = get_transient( self::TRANSIENT_REQUIRED );
    if ( $cached !== false ) {
      return $cached;
    }

    $url = trailingslashit( $base_url ) . 'api/v1/customers/frontend/required-fields?' . http_build_query( [
      'api_key' => $api_key,
      'lang'    => get_locale(),
    ] );

    $response = wp_remote_get( $url, [ 'timeout' => 10, 'sslverify' => true ] );
    if ( is_wp_error( $response ) ) {
      return [];
    }
    if ( wp_remote_retrieve_response_code( $response ) !== 200 ) {
      return [];
    }
    $data = json_decode( wp_remote_retrieve_body( $response ), true );
    $keys = [];
    if ( is_array( $data ) ) {
      if ( isset( $data['required_fields'] ) && is_array( $data['required_fields'] ) ) {
        $keys = $data['required_fields'];
      } elseif ( array_values( $data ) === $data ) {
        $keys = $data;
      }
    }
    set_transient( self::TRANSIENT_REQUIRED, $keys, self::CACHE_TTL );
    return $keys;
  }

  private static function get_api_key() {
    $connection = get_option( 'mybooking_plugin_settings_connection', [] );
    return isset( $connection['mybooking_plugin_settings_api_key'] )
      ? sanitize_text_field( $connection['mybooking_plugin_settings_api_key'] )
      : '';
  }

  private static function get_api_url() {
    $connection = get_option( 'mybooking_plugin_settings_connection', [] );
    return isset( $connection['mybooking_plugin_settings_api_service_url'] )
      ? esc_url_raw( $connection['mybooking_plugin_settings_api_service_url'] )
      : '';
  }

}
