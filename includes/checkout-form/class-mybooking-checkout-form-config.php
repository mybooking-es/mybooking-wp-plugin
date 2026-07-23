<?php
if ( ! defined( 'ABSPATH' ) ) exit;

require_once __DIR__ . '/mybooking-checkout-form-fields.php';

/**
 * Reads, writes, and validates the checkout form configuration stored in wp_options.
 *
 * Storage key: mybooking_checkout_form_config
 * Format: serialized PHP array (WordPress default via update_option)
 *
 * Config structure:
 *   [
 *     'sections' => [
 *       [
 *         'id'       => string (UUID v4),
 *         'title'    => string,
 *         'subtitle' => string,
 *         'rows'     => [
 *           [
 *             'id'     => string (UUID v4),
 *             'layout' => '1col' | '2col',
 *             'fields' => string[]   // field keys from MYBOOKING_CHECKOUT_FORM_FIELDS
 *           ],
 *           ...
 *         ],
 *       ],
 *       ...
 *     ],
 *     'field_overrides' => [
 *       field_key => [
 *         'label'       => string,
 *         'placeholder' => string,
 *         'required'    => bool,
 *       ],
 *       ...
 *     ],
 *   ]
 */
class MyBookingCheckoutFormConfig {

  const OPTION_KEY = 'mybooking_checkout_form_config';

  /**
   * Returns the stored config, or the default if none is saved yet.
   */
  public static function get() {
    $stored = get_option( self::OPTION_KEY, null );
    if ( $stored === null ) {
      return self::get_default();
    }
    return $stored;
  }

  /**
   * Validates and persists $config.
   * Returns true on success, WP_Error on validation failure.
   */
  public static function save( $config ) {
    $error = self::validate( $config );
    if ( is_wp_error( $error ) ) {
      return $error;
    }
    update_option( self::OPTION_KEY, $config, false );
    return true;
  }

  /**
   * Resets the stored config to the default and persists it.
   */
  public static function reset() {
    update_option( self::OPTION_KEY, self::get_default(), false );
  }

  /**
   * Returns the default config: two core rows (name+surname, email+confirm).
   * Mirrors the current static form layout in mybooking-plugin-complete.php.
   */
  public static function get_default() {
    return [
      'sections' => [
        [
          'id'       => self::uuid(),
          'title'    => __( "Customer's details", 'mybooking-reservation-engine' ),
          'subtitle' => '',
          'rows'     => [
            [
              'id'     => self::uuid(),
              'layout' => '2col',
              'fields' => [ 'customer_name', 'customer_surname' ],
            ],
            [
              'id'     => self::uuid(),
              'layout' => '2col',
              'fields' => [ 'customer_email', 'customer_phone' ],
            ],
          ],
        ],
      ],
      'field_overrides' => [],
    ];
  }

  /**
   * Validates a config array.
   * Returns null on success, WP_Error on failure.
   */
  public static function validate( $config ) {
    if ( ! is_array( $config ) ) {
      return new WP_Error( 'invalid_config', __( 'Config must be an array.', 'mybooking-reservation-engine' ) );
    }

    // sections is required
    if ( ! isset( $config['sections'] ) || ! is_array( $config['sections'] ) ) {
      return new WP_Error( 'missing_sections', __( 'Config must contain a sections array.', 'mybooking-reservation-engine' ) );
    }

    $known_fields   = array_keys( mybooking_checkout_form_fields() );
    $locked_fields  = self::get_locked_fields();
    $fields_in_form = [];

    foreach ( $config['sections'] as $si => $section ) {
      if ( ! is_array( $section ) ) {
        return new WP_Error( 'invalid_section', sprintf( __( 'Section %d is not an array.', 'mybooking-reservation-engine' ), $si ) );
      }
      if ( empty( $section['rows'] ) || ! is_array( $section['rows'] ) ) {
        continue; // empty section allowed
      }
      foreach ( $section['rows'] as $ri => $row ) {
        if ( ! is_array( $row ) ) {
          return new WP_Error( 'invalid_row', sprintf( __( 'Row %d in section %d is not an array.', 'mybooking-reservation-engine' ), $ri, $si ) );
        }
        if ( ! isset( $row['layout'] ) || ! in_array( $row['layout'], [ '1col', '2col' ], true ) ) {
          return new WP_Error( 'invalid_layout', sprintf( __( 'Row %d in section %d has an invalid layout.', 'mybooking-reservation-engine' ), $ri, $si ) );
        }
        if ( ! isset( $row['fields'] ) || ! is_array( $row['fields'] ) ) {
          return new WP_Error( 'missing_fields', sprintf( __( 'Row %d in section %d has no fields array.', 'mybooking-reservation-engine' ), $ri, $si ) );
        }
        foreach ( $row['fields'] as $field_key ) {
          if ( $field_key === null ) {
            continue; // empty slot — allowed
          }
          if ( ! in_array( $field_key, $known_fields, true ) ) {
            return new WP_Error( 'unknown_field', sprintf( __( 'Unknown field: %s', 'mybooking-reservation-engine' ), $field_key ) );
          }
          $fields_in_form[] = $field_key;
        }
      }
    }

    // All locked (non-removable) fields must appear somewhere in the form.
    foreach ( $locked_fields as $locked ) {
      if ( ! in_array( $locked, $fields_in_form, true ) ) {
        return new WP_Error(
          'missing_required_field',
          sprintf( __( 'Required field "%s" must be present in the form.', 'mybooking-reservation-engine' ), $locked )
        );
      }
    }

    // field_overrides: optional; validate keys if present
    if ( isset( $config['field_overrides'] ) ) {
      if ( ! is_array( $config['field_overrides'] ) ) {
        return new WP_Error( 'invalid_overrides', __( 'field_overrides must be an array.', 'mybooking-reservation-engine' ) );
      }
      foreach ( $config['field_overrides'] as $key => $override ) {
        if ( ! in_array( $key, $known_fields, true ) ) {
          return new WP_Error( 'unknown_override_field', sprintf( __( 'Unknown field in overrides: %s', 'mybooking-reservation-engine' ), $key ) );
        }
        if ( ! is_array( $override ) ) {
          return new WP_Error( 'invalid_override', sprintf( __( 'Override for field "%s" must be an array.', 'mybooking-reservation-engine' ), $key ) );
        }
        if ( isset( $override['by_lang'] ) && ! is_array( $override['by_lang'] ) ) {
          return new WP_Error( 'invalid_override_by_lang', sprintf( __( 'Override by_lang for field "%s" must be an array.', 'mybooking-reservation-engine' ), $key ) );
        }
      }
    }

    return null;
  }

  /**
   * Returns field keys that are not removable (must stay in the form).
   */
  public static function get_locked_fields() {
    $locked = [];
    foreach ( mybooking_checkout_form_fields() as $key => $field ) {
      if ( isset( $field['removable'] ) && $field['removable'] === false ) {
        $locked[] = $key;
      }
    }
    return $locked;
  }

  /**
   * Returns all field keys that should be shown in the admin constructor.
   * Optionally filters out special fields if account features are not enabled.
   *
   * @param array $account_features  Output from MyBookingAccountSettings::get_features()
   */
  public static function get_available_fields( $account_features = [] ) {
    $available = [];
    foreach ( mybooking_checkout_form_fields() as $key => $field ) {
      if ( $field['special'] === 'delivery_slot' && empty( $account_features['delivery_slots'] ) ) {
        continue;
      }
      if ( $field['special'] === 'external_driver' && empty( $account_features['optional_external_driver'] ) ) {
        continue;
      }
      $available[ $key ] = $field;
    }
    return $available;
  }

  /**
   * Generates a UUID v4.
   * Uses openssl_random_pseudo_bytes when available, otherwise mt_rand fallback.
   */
  public static function uuid() {
    if ( function_exists( 'com_create_guid' ) ) {
      return strtolower( trim( com_create_guid(), '{}' ) );
    }
    if ( function_exists( 'openssl_random_pseudo_bytes' ) ) {
      $data    = openssl_random_pseudo_bytes( 16 );
      $data[6] = chr( ord( $data[6] ) & 0x0f | 0x40 );
      $data[8] = chr( ord( $data[8] ) & 0x3f | 0x80 );
      return vsprintf( '%s%s-%s-%s-%s-%s%s%s', str_split( bin2hex( $data ), 4 ) );
    }
    // Fallback (not cryptographically secure, fine for non-sensitive identifiers)
    return sprintf(
      '%04x%04x-%04x-%04x-%04x-%04x%04x%04x',
      mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff ),
      mt_rand( 0, 0xffff ),
      mt_rand( 0, 0x0fff ) | 0x4000,
      mt_rand( 0, 0x3fff ) | 0x8000,
      mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff )
    );
  }

}
