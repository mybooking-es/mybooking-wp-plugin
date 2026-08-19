<?php
if ( ! defined( 'ABSPATH' ) ) exit;

require_once __DIR__ . '/mybooking-checkout-form-fields.php';
require_once __DIR__ . '/mybooking-checkout-form-section-title-presets.php';
require_once __DIR__ . '/class-mybooking-checkout-form-config.php';
require_once __DIR__ . '/class-mybooking-account-settings.php';

/**
 * Frontend renderer for the unified configurable checkout fields.
 *
 * P4R established the visual/DOM contract against Renting Complete. P4A adds
 * the Activities adapter without changing that vocabulary: each engine filters
 * the same normalized Builder configuration and renders only its proven ordinary
 * fields using the historical mb-* rows, columns, labels and controls.
 */
class MyBookingCheckoutFormRenderer {

  const ENGINE = 'renting';
  const ENGINE_ACTIVITIES = 'activities';

  /** Six fields that make up the legacy/static customer block. */
  private static $legacy_customer_fields = [
    'customer_name',
    'customer_surname',
    'customer_email',
    'confirm_customer_email',
    'customer_phone',
    'customer_mobile_phone',
  ];

  /** Engine specials that require hidden DOM fallbacks even when not placed. */
  private static $engine_specials = [
    'slot_time_from',
    'with_optional_external_driver',
  ];

  /**
   * Echo the Renting configurable block into form[name=reservation_form].
   */
  public static function render_renting() {
    echo self::get_renting_html(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- renderer escapes leaf values.
  }

  /**
   * Echo the Activities configurable block inside script_reservation_form.
   */
  public static function render_activities() {
    echo self::get_activities_html(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- renderer escapes leaf values.
  }

  /**
   * Build Renting checkout HTML. Optional args exist to make the renderer
   * deterministic and snapshot-testable without changing production behavior.
   */
  public static function get_renting_html( $config = null, $profile = null, $locale = null ) {
    return self::get_engine_html( self::ENGINE, $config, $profile, $locale );
  }

  /**
   * Build Activities checkout HTML from the same normalized Builder config.
   */
  public static function get_activities_html( $config = null, $profile = null, $locale = null ) {
    return self::get_engine_html( self::ENGINE_ACTIVITIES, $config, $profile, $locale );
  }

  /**
   * Engine-neutral renderer core used by the proven P4 adapters.
   */
  private static function get_engine_html( $engine, $config = null, $profile = null, $locale = null ) {
    $config  = is_array( $config ) ? $config : MyBookingCheckoutFormConfig::get();
    $profile = is_array( $profile ) ? $profile : MyBookingAccountSettings::get_account_profile();
    $locale  = is_string( $locale ) && $locale !== '' ? $locale : get_locale();

    $catalog = mybooking_checkout_form_fields();
    $prepared = self::prepare_sections( $config, $profile, $catalog, $engine );
    $visible_keys = $prepared['visible_keys'];
    $engine_required = self::engine_required( $profile, $engine );

    $html = '';
    $rendered_section_count = 0;

    foreach ( $prepared['sections'] as $prepared_section ) {
      $section = $prepared_section['section'];
      $rows    = $prepared_section['rows'];
      $had_configured_rows = ! empty( $section['rows'] );

      // A section that became empty only because the active engine adapter
      // filtered unsupported/out-of-profile fields is not an intentional
      // title-only section.
      if ( $had_configured_rows && empty( $rows ) ) {
        continue;
      }

      $title    = self::resolve_section_title( isset( $section['title'] ) ? $section['title'] : [], $locale );
      $subtitle = MyBookingCheckoutFormConfig::resolve_localized_text(
        isset( $section['subtitle'] ) ? $section['subtitle'] : [],
        $locale
      );

      if ( empty( $rows ) && $title === '' && $subtitle === '' ) {
        continue;
      }

      if ( $rendered_section_count > 0 ) {
        if ( $engine === self::ENGINE ) {
          $html .= "\n            <br/>\n\n";
        } else {
          $html .= "\n";
        }
      }

      $legacy_customer_section = self::is_legacy_customer_section( $rows );

      if ( $title !== '' ) {
        $heading_classes = 'mb-section_title complete-section-title';
        if ( $legacy_customer_section ) {
          $heading_classes .= ' customer_component';
        }
        $html .= '            <h3 class="' . esc_attr( $heading_classes ) . '">' . "\n";
        $html .= '              ' . esc_html( $title ) . "\n";
        $html .= "            </h3>\n";
      }

      // Subtitle is configuration-driven content; no new CSS class or wrapper is
      // introduced so the existing theme/form structure remains untouched.
      if ( $subtitle !== '' ) {
        $html .= '            <p>' . esc_html( $subtitle ) . "</p>\n";
      }

      if ( ( $title !== '' || $subtitle !== '' ) && ! empty( $rows ) ) {
        $html .= "\n";
      }

      foreach ( $rows as $row_index => $row ) {
        if ( $row_index > 0 ) {
          $html .= "\n";
        }
        $html .= self::render_row(
          $row,
          $config,
          $profile,
          $catalog,
          $locale,
          $engine_required,
          $visible_keys,
          $engine
        );
      }

      $rendered_section_count++;
    }

    // Renting has two existing Engine-owned specials that require hidden DOM
    // fallbacks. Other adapters have no ordinary-field fallback infrastructure.
    if ( $engine === self::ENGINE ) {
      $fallbacks = [];
      foreach ( self::$engine_specials as $special_key ) {
        if ( empty( $prepared['rendered_specials'][ $special_key ] ) ) {
          $fallbacks[] = $special_key;
        }
      }
      if ( ! empty( $fallbacks ) ) {
        if ( $rendered_section_count > 0 ) {
          $html .= "\n";
        }
        $html .= self::render_special_fallbacks(
          $fallbacks,
          $catalog,
          $config,
          $profile,
          $locale,
          $engine_required
        );
      }
    }

    return $html;
  }

  /**
   * Resolve exact Builder title semantics:
   * by_lang[current] -> customized fallback -> preset gettext -> empty.
   */
  public static function resolve_section_title( $title, $locale ) {
    if ( ! is_array( $title ) ) {
      return is_string( $title ) ? $title : '';
    }

    $localized = MyBookingCheckoutFormConfig::resolve_localized_text( $title, $locale );
    if ( $localized !== '' ) {
      return $localized;
    }

    $preset = isset( $title['preset'] ) ? (string) $title['preset'] : 'custom';
    if ( $preset !== '' && $preset !== 'custom' ) {
      $presets = mybooking_checkout_form_section_title_presets();
      if ( isset( $presets[ $preset ] ) ) {
        return $presets[ $preset ];
      }
    }

    return '';
  }

  /**
   * Filter the engine-neutral saved config for the Renting frontend adapter,
   * while preserving configured row geometry (including null slots).
   */
  private static function prepare_sections( $config, $profile, $catalog, $engine ) {
    $sections_out = [];
    $visible_keys = [];
    $rendered_specials = [];
    $sections = isset( $config['sections'] ) && is_array( $config['sections'] ) ? $config['sections'] : [];

    foreach ( $sections as $section ) {
      if ( ! is_array( $section ) ) {
        continue;
      }
      $rows_out = [];
      $rows = isset( $section['rows'] ) && is_array( $section['rows'] ) ? $section['rows'] : [];

      foreach ( $rows as $row ) {
        if ( ! is_array( $row ) ) {
          continue;
        }
        $layout = isset( $row['layout'] ) && $row['layout'] === '1col' ? '1col' : '2col';
        $slot_count = $layout === '1col' ? 1 : 2;
        $raw_fields = isset( $row['fields'] ) && is_array( $row['fields'] ) ? $row['fields'] : [];
        $fields = [];
        $has_visible = false;

        for ( $i = 0; $i < $slot_count; $i++ ) {
          $key = array_key_exists( $i, $raw_fields ) ? $raw_fields[ $i ] : null;
          if ( is_string( $key ) && isset( $catalog[ $key ] ) && self::is_field_supported_for_engine( $key, $catalog[ $key ], $profile, $engine ) ) {
            $fields[] = $key;
            $visible_keys[ $key ] = true;
            if ( $engine === self::ENGINE && in_array( $key, self::$engine_specials, true ) ) {
              $rendered_specials[ $key ] = true;
            }
            $has_visible = true;
          } else {
            $fields[] = null;
          }
        }

        if ( $has_visible ) {
          $rows_out[] = [
            'id'     => isset( $row['id'] ) ? $row['id'] : '',
            'layout' => $layout,
            'fields' => $fields,
          ];
        }
      }

      $sections_out[] = [ 'section' => $section, 'rows' => $rows_out ];
    }

    return [
      'sections'          => $sections_out,
      'visible_keys'      => $visible_keys,
      'rendered_specials' => $rendered_specials,
    ];
  }

  /**
   * Backward-compatible public P4R support gate.
   */
  public static function is_field_supported( $key, $field, $profile ) {
    return self::is_field_supported_for_engine( $key, $field, $profile, self::ENGINE );
  }

  /**
   * Engine adapter support gate: target + business/profile family + runtime guard.
   * Admin show-all never overrides frontend support.
   */
  public static function is_field_supported_for_engine( $key, $field, $profile, $engine ) {
    $targets = isset( $field['engine_targets'] ) ? (array) $field['engine_targets'] : [];
    if ( ! empty( $targets ) && ! in_array( $engine, $targets, true ) ) {
      return false;
    }

    $business_lines = isset( $field['business_lines'] ) ? (array) $field['business_lines'] : [];
    if ( $engine === self::ENGINE ) {
      $business_line = isset( $profile['renting_business_line'] ) ? (string) $profile['renting_business_line'] : 'generic';
      if ( $business_line !== 'generic'
        && ! empty( $business_lines )
        && ! in_array( 'common', $business_lines, true )
        && ! in_array( $business_line, $business_lines, true ) ) {
        return false;
      }
    } elseif ( ! empty( $business_lines )
      && ! in_array( 'common', $business_lines, true )
      && ! in_array( $engine, $business_lines, true ) ) {
      return false;
    }

    $features = isset( $profile['features'] ) && is_array( $profile['features'] ) ? $profile['features'] : [];

    if ( $engine === self::ENGINE ) {
      if ( $key === 'slot_time_from' && empty( $features['delivery_slots'] ) ) {
        return false;
      }
      if ( $key === 'with_optional_external_driver' && empty( $features['optional_external_driver'] ) ) {
        return false;
      }
    }

    $guard = isset( $field['runtime_guard'] ) ? (string) $field['runtime_guard'] : '';
    if ( $guard !== '' && ! self::feature_enabled( $features, $guard ) ) {
      return false;
    }

    return true;
  }

  /**
   * frontend/settings is snake_case while Engine configuration exposes selected
   * guards in camelCase. Accept both representations without changing catalog
   * contracts or inventing feature values.
   */
  private static function feature_enabled( $features, $guard ) {
    if ( ! empty( $features[ $guard ] ) ) {
      return true;
    }
    $snake = strtolower( preg_replace( '/(?<!^)[A-Z]/', '_$0', (string) $guard ) );
    return $snake !== $guard && ! empty( $features[ $snake ] );
  }

  private static function engine_required( $profile, $engine ) {
    $engine_profile = is_array( $profile ) ? $profile : [];
    $engine_profile['engines'] = [ $engine ];
    return MyBookingAccountSettings::get_engine_required( $engine_profile );
  }

  private static function effective_required( $key, $field, $config, $profile, $engine_required ) {
    $saved_required = ! empty( $field['required'] );
    if ( isset( $config['field_overrides'][ $key ] )
      && is_array( $config['field_overrides'][ $key ] )
      && array_key_exists( 'required', $config['field_overrides'][ $key ] ) ) {
      $saved_required = (bool) $config['field_overrides'][ $key ]['required'];
    }

    $core_required = isset( $field['removable'] ) && $field['removable'] === false;
    $account_required = isset( $profile['account_required_fields'] )
      && in_array( $key, (array) $profile['account_required_fields'], true );
    $forced_by_engine = in_array( $key, $engine_required, true );

    return $core_required || $account_required || $forced_by_engine || $saved_required;
  }

  private static function localized_field_text( $key, $prop, $field, $config, $locale, $engine, $profile ) {
    if ( isset( $config['field_overrides'][ $key ]['by_lang'][ $locale ][ $prop ] ) ) {
      $value = (string) $config['field_overrides'][ $key ]['by_lang'][ $locale ][ $prop ];
      if ( $value !== '' ) {
        return $value;
      }
    }

    // number_of_adults remains the inherited runtime/API contract. For vehicle
    // renting only, present that same field as "Number of people".
    if ( $engine === self::ENGINE
      && $key === 'number_of_adults'
      && ( $prop === 'label' || $prop === 'placeholder' )
      && isset( $profile['renting_business_line'] )
      && (string) $profile['renting_business_line'] === 'vehicle' ) {
      return _x( 'Number of people', 'renting_complete', 'mybooking-reservation-engine' );
    }
    // The Builder's generic special labels are admin taxonomy. Renting Complete
    // has two long-standing frontend labels; keep those exact defaults so P4R
    // changes field selection, never the existing checkout wording/appearance.
    if ( $engine === self::ENGINE && $prop === 'label' && $key === 'slot_time_from' ) {
      return _x( 'Select the schedule that suits your needs', 'renting_complete', 'mybooking-reservation-engine' );
    }
    if ( $engine === self::ENGINE && $prop === 'label' && $key === 'with_optional_external_driver' ) {
      return _x( 'Will you need a skipper?', 'renting_complete', 'mybooking-reservation-engine' );
    }

    // Activities historically translates the customer-vehicle controls in the
    // activity_shopping_cart context. Reuse that exact frontend context instead
    // of the Builder catalog context so existing translations remain byte-for-
    // wording compatible with the legacy microtemplate.
    if ( $engine === self::ENGINE_ACTIVITIES && self::is_activity_vehicle_field( $key ) ) {
      $activity_vehicle_text = [
        'customer_stock_brand' => 'Brand',
        'customer_stock_model' => 'Model',
        'customer_stock_plate' => 'Stock plate',
        'customer_stock_color' => 'Color',
      ];
      if ( isset( $activity_vehicle_text[ $key ] ) && ( $prop === 'label' || $prop === 'placeholder' ) ) {
        return _x( $activity_vehicle_text[ $key ], 'activity_shopping_cart', 'mybooking-reservation-engine' );
      }
    }

    return isset( $field[ $prop ] ) ? (string) $field[ $prop ] : '';
  }

  private static function runtime_name( $key, $field, $engine ) {
    if ( isset( $field['runtime_name_by_engine'][ $engine ] )
      && (string) $field['runtime_name_by_engine'][ $engine ] !== '' ) {
      return (string) $field['runtime_name_by_engine'][ $engine ];
    }
    if ( isset( $field['runtime_name'] ) && (string) $field['runtime_name'] !== '' ) {
      return (string) $field['runtime_name'];
    }
    return $key;
  }

  private static function render_row( $row, $config, $profile, $catalog, $locale, $engine_required, $visible_keys, $engine ) {
    $layout = $row['layout'] === '1col' ? '1col' : '2col';
    $fields = $row['fields'];
    $row_keys = array_values( array_filter( $fields, 'is_string' ) );
    $row_is_legacy_customer = ! empty( $row_keys ) && count( array_diff( $row_keys, self::$legacy_customer_fields ) ) === 0;
    $special_keys = $engine === self::ENGINE ? array_values( array_intersect( $row_keys, self::$engine_specials ) ) : [];
    $has_special = ! empty( $special_keys );
    $only_special = $has_special && count( array_diff( $row_keys, self::$engine_specials ) ) === 0;
    $both_special = count( $special_keys ) === 2;
    $address_scope = self::address_scope_for_keys( $row_keys );

    if ( $layout === '1col' ) {
      $key = isset( $fields[0] ) ? $fields[0] : null;
      if ( ! is_string( $key ) || ! isset( $catalog[ $key ] ) ) {
        return '';
      }

      $classes = [ 'mb-form-group' ];
      if ( in_array( $key, self::$legacy_customer_fields, true ) ) {
        $classes[] = 'customer_component';
      }
      if ( $engine === self::ENGINE && ( $key === 'slot_time_from' || $key === 'with_optional_external_driver' ) ) {
        $classes[] = $key === 'slot_time_from' ? 'js-mb-delivery-slot' : 'js-mb-optional-external-driver';
      }
      if ( $engine === self::ENGINE && self::is_company_field( $key ) && ! empty( $visible_keys['customer_type'] ) ) {
        $classes[] = 'mybooking_customer_legal_entity';
      }
      if ( isset( $catalog[ $key ]['type'] ) && $catalog[ $key ]['type'] === 'date' ) {
        $classes[] = 'js-date-select-control';
      }
      if ( $address_scope !== '' ) {
        $classes[] = 'js-mb-ses-address';
      }

      $attrs = '';
      if ( $address_scope !== '' ) {
        $attrs .= ' data-mb-address-scope="' . esc_attr( $address_scope ) . '"';
      }
      if ( isset( $catalog[ $key ]['type'] ) && $catalog[ $key ]['type'] === 'date'
        && isset( $catalog[ $key ]['date_direction'] ) && $catalog[ $key ]['date_direction'] === 'future' ) {
        $attrs .= ' data-date-select-control-direction="future"';
      }
      if ( $has_special ) {
        $attrs .= ' style="display: none"';
      }

      $html = '            <div class="' . esc_attr( implode( ' ', $classes ) ) . '"' . $attrs . ">\n";
      $html .= self::render_field_control( $key, $catalog[ $key ], $config, $profile, $locale, $engine_required, $visible_keys, 14, $engine );
      $html .= "            </div>\n";
      return $html;
    }

    $row_classes = [ 'mb-form-group', 'mb-form-row' ];
    if ( $row_is_legacy_customer ) {
      $row_classes[] = 'customer_component';
    }
    if ( $both_special ) {
      $row_classes[] = 'js-mb-delivery-slot-skipper-container';
    } elseif ( $only_special && count( $special_keys ) === 1 ) {
      $row_classes[] = $special_keys[0] === 'slot_time_from' ? 'js-mb-delivery-slot' : 'js-mb-optional-external-driver';
    }
    $row_attrs = '';
    if ( $only_special ) {
      $row_attrs .= ' style="display: none"';
    }

    $html = '            <div class="' . esc_attr( implode( ' ', $row_classes ) ) . '"' . $row_attrs . ">\n";

    for ( $i = 0; $i < 2; $i++ ) {
      $key = isset( $fields[ $i ] ) ? $fields[ $i ] : null;
      $classes = [ 'mb-col-md-6', 'mb-col-sm-12' ];
      $attrs = '';

      if ( is_string( $key ) ) {
        if ( ! $row_is_legacy_customer && in_array( $key, self::$legacy_customer_fields, true ) ) {
          $classes[] = 'customer_component';
        }
        if ( $engine === self::ENGINE && self::is_company_field( $key ) && ! empty( $visible_keys['customer_type'] ) ) {
          $classes[] = 'mybooking_customer_legal_entity';
        }
        if ( isset( $catalog[ $key ]['type'] ) && $catalog[ $key ]['type'] === 'date' ) {
          $classes[] = 'js-date-select-control';
          if ( isset( $catalog[ $key ]['date_direction'] ) && $catalog[ $key ]['date_direction'] === 'future' ) {
            $attrs .= ' data-date-select-control-direction="future"';
          }
        }
        $field_address_scope = self::address_scope_for_key( $key );
        if ( $field_address_scope !== '' ) {
          $classes[] = 'js-mb-ses-address';
          $attrs .= ' data-mb-address-scope="' . esc_attr( $field_address_scope ) . '"';
        }
        if ( $engine === self::ENGINE && $key === 'slot_time_from' ) {
          $classes[] = 'js-mb-delivery-slot';
          $attrs .= ' style="display: none"';
        } elseif ( $engine === self::ENGINE && $key === 'with_optional_external_driver' ) {
          $classes[] = 'js-mb-optional-external-driver';
          $attrs .= ' style="display: none"';
        }
      }

      $html .= '              <div class="' . esc_attr( implode( ' ', $classes ) ) . '"' . $attrs . ">\n";
      if ( is_string( $key ) && isset( $catalog[ $key ] ) ) {
        $html .= self::render_field_control( $key, $catalog[ $key ], $config, $profile, $locale, $engine_required, $visible_keys, 16, $engine );
      }
      $html .= "              </div>\n";
    }

    $html .= "            </div>\n";
    return $html;
  }

  private static function render_field_control( $key, $field, $config, $profile, $locale, $engine_required, $visible_keys, $indent, $engine ) {
    $pad = str_repeat( ' ', $indent );
    $name = self::runtime_name( $key, $field, $engine );
    $id = $key;
    $required = self::effective_required( $key, $field, $config, $profile, $engine_required );
    $label = self::localized_field_text( $key, 'label', $field, $config, $locale, $engine, $profile );
    $placeholder = self::localized_field_text( $key, 'placeholder', $field, $config, $locale, $engine, $profile );
    $label_for = $id;
    if ( $key === 'confirm_customer_email' || $key === 'with_optional_external_driver' ) {
      // Preserve the two historical Complete label-for quirks byte-for-DOM compatible.
      $label_for = 'customer_email';
      if ( $engine === self::ENGINE && $key === 'with_optional_external_driver' ) {
        $label_for = 'slot_time_from';
      }
    }

    $html = $pad . '<label for="' . esc_attr( $label_for ) . '">' . esc_html( $label );
    if ( $required && ! in_array( $key, self::$engine_specials, true ) ) {
      $html .= '*';
    }
    $html .= "</label>\n";

    if ( $engine === self::ENGINE && $key === 'slot_time_from' ) {
      $html .= $pad . '<select class="mb-form-control" id="slot_time_from" name="slot_time_from"></select>' . "\n";
      return $html;
    }

    if ( $engine === self::ENGINE && $key === 'with_optional_external_driver' ) {
      $html .= $pad . '<select class="mb-form-control" id="with_optional_external_driver" name="with_optional_external_driver">' . "\n";
      $html .= $pad . '  <option value=""></option>' . "\n";
      $html .= $pad . '  <option value="false">' . esc_html_x( 'No', 'renting_complete', 'mybooking-reservation-engine' ) . '</option>' . "\n";
      $html .= $pad . '  <option value="true">' . esc_html_x( 'Yes', 'renting_complete', 'mybooking-reservation-engine' ) . '</option>' . "\n";
      $html .= $pad . '</select>' . "\n";
      return $html;
    }

    if ( isset( $field['type'] ) && $field['type'] === 'date' ) {
      // Replace the label already emitted: date wrapper class belongs to the field
      // container, so the control itself only needs the exact composite interior.
      return self::render_date_after_label( $html, $key, $name, $field, $required, $pad );
    }

    if ( isset( $field['type'] ) && $field['type'] === 'textarea' ) {
      $html .= $pad . '<textarea class="mb-form-control" name="' . esc_attr( $name ) . '" id="' . esc_attr( $id ) . '"';
      if ( $placeholder !== '' ) {
        $html .= ' placeholder="' . esc_attr( $placeholder ) . '"';
      }
      if ( $required && ! self::legacy_core_owns_required( $key ) ) {
        $html .= ' required';
      }
      $html .= '></textarea>' . "\n";
      return $html;
    }

    if ( isset( $field['type'] ) && $field['type'] === 'select' ) {
      $html .= $pad . '<select class="mb-form-control" id="' . esc_attr( $id ) . '" name="' . esc_attr( $name ) . '"';
      if ( $required && ! self::engine_forced_select_owns_required( $key, $engine ) ) {
        $html .= ' required';
      }
      $html .= '></select>' . "\n";
      return $html;
    }

    $type = isset( $field['type'] ) && $field['type'] === 'number' ? 'number' : 'text';
    // Existing Complete/My Reservation email and phone controls are text inputs;
    // preserve that exact markup contract while Engine owns email/tel behavior.
    if ( isset( $field['type'] ) && $field['type'] === 'time' ) {
      $type = 'time';
    }

    $html .= $pad . '<input class="mb-form-control" type="' . esc_attr( $type ) . '" name="' . esc_attr( $name ) . '" id="' . esc_attr( $id ) . '"';

    if ( self::needs_autocomplete_off( $key, $field ) ) {
      $html .= ' autocomplete="off"';
    }

    if ( $placeholder !== '' ) {
      $ph = $placeholder;
      if ( in_array( $key, self::$legacy_customer_fields, true ) ) {
        $ph .= ':' . ( $required ? '*' : '' );
      } elseif ( $engine === self::ENGINE_ACTIVITIES && self::is_activity_vehicle_field( $key ) && $required ) {
        // Existing Activities vehicle placeholders include the visible required
        // star (Brand*, Model*, Stock plate*). Keep that wording in configured
        // layouts as well; Color gains it only when the Builder makes it required.
        $ph .= '*';
      }
      $html .= ' placeholder="' . esc_attr( $ph ) . '"';
    }

    if ( ! empty( $field['maxlength'] ) ) {
      $html .= ' maxlength="' . esc_attr( (string) $field['maxlength'] ) . '"';
    }

    if ( $required && ! self::legacy_core_owns_required( $key ) && ! self::hardcoded_engine_required_owns_required( $key, $engine ) ) {
      $html .= ' required';
    }

    // Non-visual bridge for Complete's historical airport-only required policy.
    // This avoids adding/restructuring DOM containers and does not change legacy
    // overrides that continue to use #airport-form-section.
    if ( $engine === self::ENGINE && $required && self::is_airport_conditional_field( $key ) ) {
      $html .= ' data-mb-runtime-required="airport"';
    }

    $html .= '>' . "\n";

    if ( ( $key === 'state' || $key === 'driver_address_state' ) && self::has_ses_state_prerequisites( $key, $visible_keys ) ) {
      $html .= self::render_ses_code_select( $key, 'state', $pad );
    }
    if ( ( $key === 'city' || $key === 'driver_address_city' ) && self::has_ses_city_prerequisites( $key, $visible_keys ) ) {
      $html .= self::render_ses_code_select( $key, 'city', $pad );
    }

    return $html;
  }

  private static function render_date_after_label( $label_html, $key, $name, $field, $required, $pad ) {
    // DATE wrapper uses the existing field container; append the generic Engine
    // marker to that container through a small marker element is not sufficient.
    // The actual container class is added by render_row() below via key detection.
    $html = $label_html;
    $html .= $pad . '<div class="mb-form-row mb-custom-date-form">' . "\n";
    foreach ( [ 'day', 'month', 'year' ] as $part ) {
      $html .= $pad . '  <div class="mb-custom-date-item">' . "\n";
      $html .= $pad . '    <select name="' . esc_attr( $name . '_' . $part ) . '" id="' . esc_attr( $key . '_' . $part ) . '" class="mb-form-control"></select>' . "\n";
      $html .= $pad . '  </div>' . "\n";
    }
    $html .= $pad . '</div>' . "\n";
    $html .= $pad . '<input type="hidden" name="' . esc_attr( $name ) . '" id="' . esc_attr( $key ) . '"';
    if ( $required ) {
      $html .= ' required';
    }
    $html .= '>' . "\n";
    return $html;
  }

  private static function render_ses_code_select( $key, $kind, $pad ) {
    $class = $kind === 'state' ? 'js-mb-ses-state-code' : 'js-mb-ses-city-code';
    return $pad . '<select class="mb-form-control ' . esc_attr( $class ) . '" id="' . esc_attr( $key . '_code' ) . '" style="display: none" disabled></select>' . "\n";
  }

  private static function has_ses_state_prerequisites( $key, $visible_keys ) {
    if ( $key === 'state' ) {
      return ! empty( $visible_keys['country'] ) && ! empty( $visible_keys['state'] );
    }
    return ! empty( $visible_keys['driver_address_country'] ) && ! empty( $visible_keys['driver_address_state'] );
  }

  private static function has_ses_city_prerequisites( $key, $visible_keys ) {
    if ( $key === 'city' ) {
      return ! empty( $visible_keys['country'] ) && ! empty( $visible_keys['state'] ) && ! empty( $visible_keys['city'] );
    }
    return ! empty( $visible_keys['driver_address_country'] ) && ! empty( $visible_keys['driver_address_state'] ) && ! empty( $visible_keys['driver_address_city'] );
  }

  private static function address_scope_for_key( $key ) {
    if ( $key === 'state' || $key === 'city' ) {
      return 'customer';
    }
    if ( $key === 'driver_address_state' || $key === 'driver_address_city' ) {
      return 'driver';
    }
    return '';
  }

  private static function address_scope_for_keys( $keys ) {
    foreach ( $keys as $key ) {
      if ( $key === 'state' || $key === 'city' ) {
        return 'customer';
      }
      if ( $key === 'driver_address_state' || $key === 'driver_address_city' ) {
        return 'driver';
      }
    }
    return '';
  }

  private static function is_legacy_customer_section( $rows ) {
    $keys = [];
    foreach ( $rows as $row ) {
      foreach ( $row['fields'] as $key ) {
        if ( is_string( $key ) ) {
          $keys[] = $key;
        }
      }
    }
    return ! empty( $keys ) && count( array_diff( $keys, self::$legacy_customer_fields ) ) === 0;
  }

  private static function is_activity_vehicle_field( $key ) {
    return in_array( $key, [
      'customer_stock_brand',
      'customer_stock_model',
      'customer_stock_plate',
      'customer_stock_color',
    ], true );
  }

  private static function is_company_field( $key ) {
    return in_array( $key, [
      'customer_company_name',
      'customer_company_contact_name',
      'customer_company_document_id',
    ], true );
  }

  private static function legacy_core_owns_required( $key ) {
    return in_array( $key, [
      'customer_name',
      'customer_surname',
      'customer_email',
      'confirm_customer_email',
      'customer_phone',
    ], true );
  }

  private static function is_airport_conditional_field( $key ) {
    return in_array( $key, [ 'flight_company', 'flight_number', 'flight_time' ], true );
  }

  private static function hardcoded_engine_required_owns_required( $key, $engine ) {
    if ( $engine !== self::ENGINE ) {
      return false;
    }
    return in_array( $key, [
      'customer_company_name',
      'customer_company_contact_name',
      'number_of_adults',
    ], true );
  }

  private static function engine_forced_select_owns_required( $key, $engine ) {
    return $engine === self::ENGINE && in_array( $key, [ 'customer_type', 'customer_classifier_id' ], true );
  }

  private static function needs_autocomplete_off( $key, $field ) {
    if ( in_array( $key, self::$legacy_customer_fields, true ) ) {
      return true;
    }
    $type = isset( $field['type'] ) ? (string) $field['type'] : '';
    return $type === 'email' || $type === 'tel';
  }

  /**
   * Render missing Engine-special controls in the same hidden two-column
   * infrastructure row used by the historical static Complete template.
   * Existing configured instances are never duplicated.
   */
  private static function render_special_fallbacks( $missing_keys, $catalog, $config, $profile, $locale, $engine_required ) {
    $missing = array_values( array_unique( array_intersect( self::$engine_specials, (array) $missing_keys ) ) );
    if ( empty( $missing ) ) {
      return '';
    }

    // When both are absent, preserve the exact historical paired fallback row.
    // Engine may reveal either/both columns and existing theme CSS keeps working.
    if ( count( $missing ) === 2 ) {
      $missing_map = array_fill_keys( $missing, true );
      $html = '            <div class="mb-form-group mb-form-row js-mb-delivery-slot-skipper-container" style="display: none">' . "\n";
      foreach ( self::$engine_specials as $key ) {
        $classes = [ 'mb-col-md-6', 'mb-col-sm-12', $key === 'slot_time_from' ? 'js-mb-delivery-slot' : 'js-mb-optional-external-driver' ];
        $html .= '              <div class="' . esc_attr( implode( ' ', $classes ) ) . '" style="display: none">' . "\n";
        if ( isset( $missing_map[ $key ] ) && isset( $catalog[ $key ] ) ) {
          $html .= self::render_field_control( $key, $catalog[ $key ], $config, $profile, $locale, $engine_required, [], 16, self::ENGINE );
        }
        $html .= "              </div>\n";
      }
      $html .= "            </div>\n";
      return $html;
    }

    // If only one special is missing, do NOT emit the shared historical parent
    // hook. Complete.js shows every `.js-mb-delivery-slot-skipper-container`
    // when either feature activates; a half-empty paired fallback would then
    // become a visible blank row. A standalone hidden fallback is functionally
    // equivalent for the missing control and has no empty-row side effect.
    $key = $missing[0];
    if ( ! isset( $catalog[ $key ] ) ) {
      return '';
    }
    $special_class = $key === 'slot_time_from' ? 'js-mb-delivery-slot' : 'js-mb-optional-external-driver';
    $html = '            <div class="mb-form-group ' . esc_attr( $special_class ) . '" style="display: none">' . "\n";
    $html .= self::render_field_control( $key, $catalog[ $key ], $config, $profile, $locale, $engine_required, [], 14, self::ENGINE );
    $html .= "            </div>\n";
    return $html;
  }
}
