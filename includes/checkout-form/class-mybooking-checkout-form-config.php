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
 *             'fields' => string[]   // field keys from mybooking_checkout_form_fields(); null = empty slot
 *           ],
 *           ...
 *         ],
 *       ],
 *       ...
 *     ],
 *     'field_overrides' => [
 *       field_key => [
 *         'required' => bool,
 *         'by_lang'  => [
 *           locale => [ 'label' => string, 'placeholder' => string ],
 *           ...
 *         ],
 *       ],
 *       ...
 *     ],
 *   ]
 */
class MyBookingCheckoutFormConfig {

  const OPTION_KEY = 'mybooking_checkout_form_config';

  /**
   * Returns the stored config normalized, or the default if none is saved yet.
   * READ-ONLY: never writes to the database.
   *
   * - No stored option       → get_default()
   * - Valid stored option    → normalize()
   * - Corrupt/core-violating → get_default()
   */
  public static function get() {
    $stored = get_option( self::OPTION_KEY, null );
    if ( $stored === null ) {
      return self::get_default();
    }
    $normalized = self::normalize( $stored );
    if ( $normalized === null ) {
      return self::get_default();
    }
    return $normalized;
  }

  /**
   * Normalizes and persists $config.
   * Returns true on success, WP_Error on failure.
   */
  public static function save( $config ) {
    $normalized = self::normalize( $config );
    if ( $normalized === null ) {
      return new WP_Error( 'invalid_config', __( 'Invalid checkout form configuration.', 'mybooking-reservation-engine' ) );
    }
    update_option( self::OPTION_KEY, $normalized, false );
    return true;
  }

  /**
   * Resets the stored config to the default and persists it.
   */
  public static function reset() {
    update_option( self::OPTION_KEY, self::get_default(), false );
  }

  /**
   * Returns the default config: one section, three rows covering the six legacy fields.
   * Mirrors the current static form layout in mybooking-plugin-complete.php.
   *
   * Row 1: customer_name   + customer_surname
   * Row 2: customer_email  + confirm_customer_email
   * Row 3: customer_phone  + customer_mobile_phone
   */
  public static function get_default() {
    return [
      'sections' => [
        [
          'id'       => self::uuid(),
          'title'    => _x( "Customer's details", 'renting_complete', 'mybooking-reservation-engine' ),
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
              'fields' => [ 'customer_email', 'confirm_customer_email' ],
            ],
            [
              'id'     => self::uuid(),
              'layout' => '2col',
              'fields' => [ 'customer_phone', 'customer_mobile_phone' ],
            ],
          ],
        ],
      ],
      'field_overrides' => [],
    ];
  }

  /**
   * Normalizes a config array into a clean, safe, contract-compliant structure.
   *
   * Guarantees:
   *  - Only known top-level keys: sections, field_overrides.
   *  - Five core fields always present (added if missing).
   *  - Core fields required=true enforced in overrides.
   *  - Unknown fields rejected (slot becomes null).
   *  - Duplicate field keys deduplicated (first occurrence wins).
   *  - 1col rows have exactly 1 slot; 2col rows have exactly 2 slots.
   *  - null is the only valid empty-slot value.
   *  - Overrides: only known types (required, by_lang); strings sanitized.
   *  - Section and row IDs: alphanumeric+dashes, max 100 chars; regenerated if invalid.
   *  - No arbitrary extra data.
   *
   * Returns null for fundamentally broken input (not an array, missing sections key).
   *
   * @param  mixed $config  Raw config from DB or form submission.
   * @return array|null     Normalized config, or null on fatal error.
   */
  public static function normalize( $config ) {
    if ( ! is_array( $config ) ) {
      return null;
    }
    if ( ! array_key_exists( 'sections', $config ) || ! is_array( $config['sections'] ) ) {
      return null;
    }

    $catalog     = mybooking_checkout_form_fields();
    $known_keys  = array_keys( $catalog );
    $core_fields = [];
    foreach ( $catalog as $k => $f ) {
      if ( isset( $f['removable'] ) && $f['removable'] === false ) {
        $core_fields[] = $k;
      }
    }

    $seen_keys    = [];
    $sections_out = [];

    foreach ( $config['sections'] as $section ) {
      if ( ! is_array( $section ) ) {
        continue;
      }

      $rows_out = [];
      $raw_rows = isset( $section['rows'] ) && is_array( $section['rows'] ) ? $section['rows'] : [];

      foreach ( $raw_rows as $row ) {
        if ( ! is_array( $row ) ) {
          continue;
        }

        $layout = isset( $row['layout'] ) && in_array( $row['layout'], [ '1col', '2col' ], true )
          ? $row['layout'] : null;
        if ( $layout === null ) {
          continue;
        }

        $slot_count = ( $layout === '2col' ) ? 2 : 1;
        $raw_fields = isset( $row['fields'] ) && is_array( $row['fields'] )
          ? array_values( $row['fields'] ) : [];

        $slots = [];
        for ( $i = 0; $i < $slot_count; $i++ ) {
          $key = isset( $raw_fields[ $i ] ) ? $raw_fields[ $i ] : null;

          if ( $key === null ) {
            $slots[] = null;
            continue;
          }

          if ( ! is_string( $key ) || ! in_array( $key, $known_keys, true ) ) {
            $slots[] = null;
            continue;
          }

          if ( in_array( $key, $seen_keys, true ) ) {
            $slots[] = null;
            continue;
          }

          $seen_keys[] = $key;
          $slots[]     = $key;
        }

        $row_id = isset( $row['id'] ) && is_string( $row['id'] )
          && preg_match( '/^[a-zA-Z0-9_\-]{1,100}$/', $row['id'] )
          ? $row['id'] : self::uuid();

        $rows_out[] = [
          'id'     => $row_id,
          'layout' => $layout,
          'fields' => $slots,
        ];
      }

      $sec_id   = isset( $section['id'] ) && is_string( $section['id'] )
        && preg_match( '/^[a-zA-Z0-9_\-]{1,100}$/', $section['id'] )
        ? $section['id'] : self::uuid();
      $title    = isset( $section['title'] )    && is_string( $section['title'] )
        ? sanitize_text_field( $section['title'] )    : '';
      $subtitle = isset( $section['subtitle'] ) && is_string( $section['subtitle'] )
        ? sanitize_text_field( $section['subtitle'] ) : '';

      $sections_out[] = [
        'id'       => $sec_id,
        'title'    => $title,
        'subtitle' => $subtitle,
        'rows'     => $rows_out,
      ];
    }

    // Ensure all core fields are present in the form.
    $missing_core = [];
    foreach ( $core_fields as $cf ) {
      if ( ! in_array( $cf, $seen_keys, true ) ) {
        $missing_core[] = $cf;
      }
    }

    if ( ! empty( $missing_core ) ) {
      if ( empty( $sections_out ) ) {
        $sections_out[] = [
          'id'       => self::uuid(),
          'title'    => '',
          'subtitle' => '',
          'rows'     => [],
        ];
      }

      foreach ( $missing_core as $cf ) {
        $placed = false;

        // First pass: fill an empty slot in an existing row.
        foreach ( $sections_out as &$sec ) {
          foreach ( $sec['rows'] as &$row ) {
            foreach ( $row['fields'] as &$slot ) {
              if ( $slot === null ) {
                $slot   = $cf;
                $placed = true;
                break 3;
              }
            }
          }
        }
        unset( $sec, $row, $slot );

        if ( ! $placed ) {
          $sections_out[0]['rows'][] = [
            'id'     => self::uuid(),
            'layout' => '1col',
            'fields' => [ $cf ],
          ];
        }
      }
    }

    // Normalize field_overrides.
    $raw_overrides = isset( $config['field_overrides'] ) && is_array( $config['field_overrides'] )
      ? $config['field_overrides'] : [];
    $overrides_out = [];

    foreach ( $raw_overrides as $key => $override ) {
      if ( ! is_string( $key ) || ! in_array( $key, $known_keys, true ) ) {
        continue;
      }
      if ( ! is_array( $override ) ) {
        continue;
      }

      $ov_out = [];

      if ( array_key_exists( 'required', $override ) ) {
        $req_val = (bool) $override['required'];
        if ( in_array( $key, $core_fields, true ) ) {
          $req_val = true;
        }
        $ov_out['required'] = $req_val;
      }

      if ( isset( $override['by_lang'] ) && is_array( $override['by_lang'] ) ) {
        $by_lang_out = [];
        foreach ( $override['by_lang'] as $lang => $lang_data ) {
          if ( ! is_string( $lang ) || $lang === '' ) {
            continue;
          }
          if ( ! is_array( $lang_data ) ) {
            continue;
          }
          $entry = [];
          if ( isset( $lang_data['label'] ) && is_string( $lang_data['label'] ) ) {
            $entry['label'] = sanitize_text_field( $lang_data['label'] );
          }
          if ( isset( $lang_data['placeholder'] ) && is_string( $lang_data['placeholder'] ) ) {
            $entry['placeholder'] = sanitize_text_field( $lang_data['placeholder'] );
          }
          if ( ! empty( $entry ) ) {
            $by_lang_out[ $lang ] = $entry;
          }
        }
        $ov_out['by_lang'] = $by_lang_out;
      }

      if ( ! empty( $ov_out ) ) {
        $overrides_out[ $key ] = $ov_out;
      }
    }

    return [
      'sections'        => $sections_out,
      'field_overrides' => $overrides_out,
    ];
  }

  /**
   * Validates a config array.
   * Returns null on success, WP_Error on failure.
   *
   * @deprecated Use normalize() which both validates and sanitizes.
   */
  public static function validate( $config ) {
    if ( ! is_array( $config ) ) {
      return new WP_Error( 'invalid_config', __( 'Config must be an array.', 'mybooking-reservation-engine' ) );
    }

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
        continue;
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
            continue;
          }
          if ( ! in_array( $field_key, $known_fields, true ) ) {
            return new WP_Error( 'unknown_field', sprintf( __( 'Unknown field: %s', 'mybooking-reservation-engine' ), $field_key ) );
          }
          $fields_in_form[] = $field_key;
        }
      }
    }

    foreach ( $locked_fields as $locked ) {
      if ( ! in_array( $locked, $fields_in_form, true ) ) {
        return new WP_Error(
          'missing_required_field',
          sprintf( __( 'Required field "%s" must be present in the form.', 'mybooking-reservation-engine' ), $locked )
        );
      }
    }

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
