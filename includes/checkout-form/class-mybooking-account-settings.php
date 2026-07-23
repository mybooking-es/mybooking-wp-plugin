<?php
if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Queries the Mybooking API for account-level feature flags.
 *
 * Caches the result in a WordPress transient for 1 hour to avoid
 * hitting the API on every admin page load.
 *
 * Feature flags returned:
 *   'delivery_slots'           => bool
 *   'optional_external_driver' => bool
 */
class MyBookingAccountSettings {

  const TRANSIENT_KEY = 'mybooking_account_features';
  const CACHE_TTL     = HOUR_IN_SECONDS;

  /**
   * Returns the feature flags array, fetching from the API if not cached.
   *
   * On any error (no API key, network failure, unexpected response),
   * returns an array with all flags set to false — safe fallback.
   *
   * @return array { 'delivery_slots' => bool, 'optional_external_driver' => bool }
   */
  public static function get_features() {
    $cached = get_transient( self::TRANSIENT_KEY );
    if ( $cached !== false ) {
      return $cached;
    }

    $features = self::fetch_from_api();
    set_transient( self::TRANSIENT_KEY, $features, self::CACHE_TTL );
    return $features;
  }

  /**
   * Clears the cached features, forcing a fresh API call on next access.
   */
  public static function flush_cache() {
    delete_transient( self::TRANSIENT_KEY );
  }

  // ── Private ───────────────────────────────────────────────────────────────

  private static function fetch_from_api() {
    $default = [
      'delivery_slots'           => false,
      'optional_external_driver' => false,
    ];

    $api_key = self::get_api_key();
    if ( empty( $api_key ) ) {
      return $default;
    }

    $base_url = self::get_api_url();
    if ( empty( $base_url ) ) {
      return $default;
    }

    $url = trailingslashit( $base_url ) . 'api/booking/frontend/settings?' . http_build_query( [
      'api_key'      => $api_key,
      'product_type' => 'rent',
    ] );

    $response = wp_remote_get( $url, [
      'timeout'   => 10,
      'sslverify' => true,
    ] );

    if ( is_wp_error( $response ) ) {
      return $default;
    }

    $code = wp_remote_retrieve_response_code( $response );
    if ( $code !== 200 ) {
      return $default;
    }

    $body = wp_remote_retrieve_body( $response );
    $data = json_decode( $body, true );
    if ( ! is_array( $data ) ) {
      return $default;
    }

    return [
      'delivery_slots'           => ! empty( $data['delivery_slots'] ),
      'optional_external_driver' => ! empty( $data['optional_external_driver'] ),
    ];
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
