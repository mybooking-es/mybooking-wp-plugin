<?php
if ( ! defined( 'ABSPATH' ) ) exit;
  /**
   * Enqueue css and js resources
   */
  class MybookingEngineEnqueue {

    private $version = null;

    public function __construct($version) {
      $this->version = $version;
      $this->wp_init();
    }

    /**
     * Initialize hooks
     */
    private function wp_init() {

      // Enqueue CSS
      add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_admin_css' ) ); 
      add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_public_css' ) );   

      // Enqueue JS
      add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_admin_js') );
      add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_public_js' ) );

    }
    
    /**
     * Enqueue admin CSS
     */
    public function enqueue_admin_css() {
      
      $screen = get_current_screen();
    
      // Make sure they are only loaded on onboard process
      if ( in_array( $screen->id, array( "mybooking_page_mybooking-onboarding",
                                         "admin_page_mybooking-onboarding-login",
                                         "admin_page_mybooking-onboarding-generate",
                                         "admin_page_mybooking-onboarding-resume",
                                         "admin_page_mybooking-onboarding-error",
                                         "mybooking_page_mybooking-onboarding-pages",
                                         "mybooking_page_mybooking-onboarding-components"  ) ) ) {      
        // Admin CSS Styles
        wp_enqueue_style( 'mybooking_wp_admin_css',
                          plugins_url('/admin-assets/styles/mybooking-plugin-onboarding.css', dirname( __DIR__ ) ) );
      }

      if ( $screen->id == "toplevel_page_mybooking-plugin-configuration") {
        wp_enqueue_style( 'mybooking_wp_admin_css',
                          plugins_url('/admin-assets/styles/mybooking-plugin-setting.css', dirname( __DIR__ ) ) );
      }

    }

    /**
     * Enqueue admin JS
     */
    public function enqueue_admin_js() {

      $screen = get_current_screen();

      // Settings
      if ( $screen->id == "toplevel_page_mybooking-plugin-configuration") {
        wp_register_script('mybooking_wp_admin_settings',
                          plugins_url( 'admin-assets/js/mybooking-plugin-settings.js', dirname(__DIR__) ),
                          array( 'jquery', 'wp-i18n' ),
                          $this->version,
                          true);
        wp_enqueue_script('mybooking_wp_admin_settings');
        wp_set_script_translations('mybooking_wp_admin_settings',
                                   'mybooking-reservation-engine',
                                   MYBOOKING_RESERVATION_ENGINE_SCRIPTS_LANGUAGES_FOLDER);

        // Checkout form builder
        wp_register_script('mybooking_wp_admin_checkout_form_builder',
                           plugins_url( 'admin-assets/js/checkout-form-builder.js', dirname(__DIR__) ),
                           array( 'jquery', 'jquery-ui-sortable', 'wp-i18n' ),
                           $this->version,
                           true);
        wp_enqueue_script('mybooking_wp_admin_checkout_form_builder');
        wp_localize_script('mybooking_wp_admin_checkout_form_builder', 'mybookingCheckoutFormStrings', array(
          'new_section'           => _x( 'New section',                                             'checkout_form_builder', 'mybooking-reservation-engine' ),
          'add_section'           => _x( '+ Add section',                                           'checkout_form_builder', 'mybooking-reservation-engine' ),
          'add_row_1col'          => _x( '+ Row (1 column)',                                        'checkout_form_builder', 'mybooking-reservation-engine' ),
          'add_row_2col'          => _x( '+ Row (2 columns)',                                       'checkout_form_builder', 'mybooking-reservation-engine' ),
          'section_title_ph'      => _x( 'Section title',                                           'checkout_form_builder', 'mybooking-reservation-engine' ),
          'section_subtitle_ph'   => _x( 'Subtitle (optional)',                                     'checkout_form_builder', 'mybooking-reservation-engine' ),
          'remove_section'        => _x( 'Remove section',                                          'checkout_form_builder', 'mybooking-reservation-engine' ),
          'remove_row'            => _x( 'Remove row',                                              'checkout_form_builder', 'mybooking-reservation-engine' ),
          'remove_field'          => _x( 'Remove',                                                  'checkout_form_builder', 'mybooking-reservation-engine' ),
          'field_required'        => _x( 'Required',                                                'checkout_form_builder', 'mybooking-reservation-engine' ),
          'drag_reorder'          => _x( 'Drag to reorder',                                         'checkout_form_builder', 'mybooking-reservation-engine' ),
          'drop_here'             => _x( 'Drop field here',                                         'checkout_form_builder', 'mybooking-reservation-engine' ),
          'available_fields'      => _x( 'Available fields',                                        'checkout_form_builder', 'mybooking-reservation-engine' ),
          'all_placed'            => _x( 'All fields are placed in the form.',                      'checkout_form_builder', 'mybooking-reservation-engine' ),
          'no_data'               => _x( 'Error: builder data not found.',                          'checkout_form_builder', 'mybooking-reservation-engine' ),
          'cannot_remove_section' => _x( 'This section contains required fields and cannot be removed.', 'checkout_form_builder', 'mybooking-reservation-engine' ),
          'cannot_remove_row'     => _x( 'This row contains required fields and cannot be removed.',     'checkout_form_builder', 'mybooking-reservation-engine' ),
          'cannot_remove_field'   => _x( 'This field is required and cannot be removed.',                'checkout_form_builder', 'mybooking-reservation-engine' ),
          'cannot_replace_locked' => _x( 'Cannot replace a required field.',                            'checkout_form_builder', 'mybooking-reservation-engine' ),
          'field_label'           => _x( 'Label',                                                       'checkout_form_builder', 'mybooking-reservation-engine' ),
          'field_placeholder'     => _x( 'Placeholder',                                                 'checkout_form_builder', 'mybooking-reservation-engine' ),
          'field_required_label'  => _x( 'Required field',                                              'checkout_form_builder', 'mybooking-reservation-engine' ),
          'field_settings'        => _x( 'Field settings',                                              'checkout_form_builder', 'mybooking-reservation-engine' ),
          'field_settings_done'   => _x( '&#10003; Done',                                               'checkout_form_builder', 'mybooking-reservation-engine' ),
          'tag_label'             => _x( 'Label',                                                       'checkout_form_builder', 'mybooking-reservation-engine' ),
          'tag_placeholder'       => _x( 'PH',                                                          'checkout_form_builder', 'mybooking-reservation-engine' ),
          'tag_required'          => _x( 'Req.',                                                        'checkout_form_builder', 'mybooking-reservation-engine' ),
          'group_customer'            => _x( 'Customer',            'checkout_form_builder', 'mybooking-reservation-engine' ),
          'group_address'             => _x( 'Address',             'checkout_form_builder', 'mybooking-reservation-engine' ),
          'group_flight_arrival'      => _x( 'Flight (arrival)',    'checkout_form_builder', 'mybooking-reservation-engine' ),
          'group_flight_departure'    => _x( 'Flight (departure)',  'checkout_form_builder', 'mybooking-reservation-engine' ),
          'group_driver'              => _x( 'Driver',              'checkout_form_builder', 'mybooking-reservation-engine' ),
          'group_additional_driver_1' => _x( 'Additional driver 1', 'checkout_form_builder', 'mybooking-reservation-engine' ),
          'group_additional_driver_2' => _x( 'Additional driver 2', 'checkout_form_builder', 'mybooking-reservation-engine' ),
          'group_engine'              => _x( 'Engine fields',       'checkout_form_builder', 'mybooking-reservation-engine' ),
          'badge_date'                => _x( 'date',                'checkout_form_builder', 'mybooking-reservation-engine' ),
          'badge_tel'                 => _x( 'tel',                 'checkout_form_builder', 'mybooking-reservation-engine' ),
          'builder_error'             => _x( 'Builder error:',      'checkout_form_builder', 'mybooking-reservation-engine' ),
          // P2B: section title UI
          'section_titles'            => _x( 'Section titles',      'checkout_form_builder', 'mybooking-reservation-engine' ),
          'custom_title'              => _x( 'Custom title',         'checkout_form_builder', 'mybooking-reservation-engine' ),
          'edit_section_title'        => _x( 'Edit section title',  'checkout_form_builder', 'mybooking-reservation-engine' ),
          'section_title_label'       => _x( 'Title',               'checkout_form_builder', 'mybooking-reservation-engine' ),
          // P2B: preset names resolved for admin locale
          'preset_customer_details'       => _x( "Customer's details",    'checkout_form_section_title', 'mybooking-reservation-engine' ),
          'preset_customer_address'       => _x( 'Customer address',       'checkout_form_section_title', 'mybooking-reservation-engine' ),
          'preset_arrival_flight'         => _x( 'Arrival flight',         'checkout_form_section_title', 'mybooking-reservation-engine' ),
          'preset_departure_flight'       => _x( 'Departure flight',       'checkout_form_section_title', 'mybooking-reservation-engine' ),
          'preset_driver_details'         => _x( 'Driver details',         'checkout_form_section_title', 'mybooking-reservation-engine' ),
          'preset_additional_driver_1'    => _x( 'Additional driver 1',   'checkout_form_section_title', 'mybooking-reservation-engine' ),
          'preset_additional_driver_2'    => _x( 'Additional driver 2',   'checkout_form_section_title', 'mybooking-reservation-engine' ),
          'preset_additional_information' => _x( 'Additional information','checkout_form_section_title', 'mybooking-reservation-engine' ),
          // P2C reset strings (added ahead; compiled once)
          'reset_default'  => _x( 'Reset to default',                                                                              'checkout_form_builder', 'mybooking-reservation-engine' ),
          'reset_confirm'  => _x( 'Restore the default checkout form? Unsaved builder changes will be replaced.',                  'checkout_form_builder', 'mybooking-reservation-engine' ),
          'reset_notice'   => _x( 'Default form restored in the editor. Save changes to apply.',                                   'checkout_form_builder', 'mybooking-reservation-engine' ),
        ) );
      }
      
      // Make sure they are only loaded on onboard process
      if ( in_array( $screen->id, array( "mybooking_page_mybooking-onboarding",
                                         "admin_page_mybooking-onboarding-login",
                                         "admin_page_mybooking-onboarding-generate",
                                         "admin_page_mybooking-onboarding-resume",
                                         "admin_page_mybooking-onboarding-error",
                                         "mybooking_page_mybooking-onboarding-pages",
                                         "mybooking_page_mybooking-onboarding-components"  ) ) ) {

        // == External resources                                  

        // JQuery validate
        wp_register_script('mybooking_wp_admin_jquery_validate',
                    plugins_url( '/admin-assets/js/jquery.validate.min.js', dirname(__DIR__) ),
                                  array( 'jquery' ), $this->version, true);
        wp_enqueue_script('mybooking_wp_admin_jquery_validate');

        // Internal resources                                  

        // Onboarding login
        if ( $screen->id == "admin_page_mybooking-onboarding-login") {
          wp_enqueue_script('mybooking_wp_admin_onboarding_login',
                            plugins_url( 'admin-assets/js/mybooking-plugin-onboarding-login.js', dirname(__DIR__) ),
                            array( 'jquery', 'wp-i18n' ), 
                            $this->version, 
                            true);
          wp_set_script_translations('mybooking_wp_admin_onboarding_login', 
                                     'mybooking-reservation-engine',
                                     MYBOOKING_RESERVATION_ENGINE_SCRIPTS_LANGUAGES_FOLDER);
        }

        // Onboarding utils
        if (  $screen->id == "admin_page_mybooking-onboarding-resume" || $screen->id == "mybooking_page_mybooking-onboarding-pages" || $screen->id == "mybooking_page_mybooking-onboarding-components") {
          wp_register_script('mybooking_wp_admin_onboarding_utils',
                            plugins_url( 'admin-assets/js/mybooking-plugin-onboarding-utils.js', dirname(__DIR__) ),
                            array( 'jquery', 'wp-i18n' ), 
                            $this->version, 
                            true);
          wp_enqueue_script('mybooking_wp_admin_onboarding_utils');
          wp_set_script_translations('mybooking_wp_admin_onboarding_utils', 
                                     'mybooking-reservation-engine',
                                     MYBOOKING_RESERVATION_ENGINE_SCRIPTS_LANGUAGES_FOLDER);
        }

        // Onboarding gallery
        wp_register_script('mybooking_wp_admin_onboarding_gallery',
                           plugins_url( 'admin-assets/js/mybooking-plugin-onboarding-gallery.js', dirname(__DIR__) ),
                           array( 'jquery', 'wp-i18n' ), 
                           $this->version, 
                           true);
        wp_enqueue_script('mybooking_wp_admin_onboarding_gallery');
        wp_set_script_translations('mybooking_wp_admin_onboarding_gallery', 
                                   'mybooking-reservation-engine',
                                   MYBOOKING_RESERVATION_ENGINE_SCRIPTS_LANGUAGES_FOLDER);

        // Onboarding video
        wp_register_script('mybooking_wp_admin_onboarding_video',
                           plugins_url( 'admin-assets/js/mybooking-plugin-onboarding-video.js', dirname(__DIR__) ),
                           array( 'wp-i18n' ), $this->version, true);
        wp_enqueue_script('mybooking_wp_admin_onboarding_video');
      }

    }

    /**
     * Enqueue public css
     */
    public function enqueue_public_css() {

      // Get the registry information
      $registry = Mybooking_Registry::getInstance();

      // Add Dashicons in WordPress frontend
      wp_enqueue_style( 'dashicons' );

      // Enqueue Phone resources
      wp_enqueue_style( 'mybooking_wp_css_phone',
                        plugins_url('/assets/styles/intlTelInput.min.css', dirname( __DIR__ ) ) );

      // Enqueue select2 + select2 bootstrap CSS
      wp_enqueue_style( 'mybooking_wp_css_components_select2',
                      plugins_url('/assets/styles/select2-4.0.1.css', dirname( __DIR__ ) ) );

      // Slick JS CSS
      if ( $registry->mybooking_rent_plugin_js_slickjs ) {
        // Load Slick
        wp_enqueue_style( 'mybooking_wp_css_slick',
                        plugins_url('/assets/styles/slick.css', dirname( __DIR__ ) ) );
        wp_enqueue_style( 'mybooking_wp_css_slick-theme',
                        plugins_url('/assets/styles/slick-theme.css', dirname( __DIR__ ) ) );
      }

      // CSS Components

      // Load JQUERY UI Boostrap like Style
      wp_enqueue_style( 'mybooking_wp_css_components_jqueryui',
                      plugins_url('/assets/styles/jquery-ui-1.10.0.custom.css', dirname( __DIR__ ) ) );
      // Load JQUERY Date Range
      wp_enqueue_style( 'mybooking_wp_css_components_jquery_date_range',
                      plugins_url('/assets/styles/daterangepicker-0.20.0.min.css', dirname( __DIR__ ) ) );
      // Mybooking styles
      wp_enqueue_style( 'mybooking_wp_css_components_mybooking-engine',
                      plugins_url('/assets/styles/mybooking-engine.css', dirname( __DIR__ ) ),
                      array(), $this->version );
      // Mybooking Helpers
      wp_enqueue_style( 'mybooking_wp_css_components_mybooking-engine-helpers',
                      plugins_url('/assets/styles/mybooking-engine-helpers.css', dirname( __DIR__ ) ),
                      array(), $this->version );
      // Mybooking Selector
      wp_enqueue_style( 'mybooking_wp_css_components_mybooking-engine-selector',
                      plugins_url('/assets/styles/mybooking-engine-selector.css', dirname( __DIR__ ) ),
                      array(), $this->version );
      // Mybooking Wizard Selector
      wp_enqueue_style( 'mybooking_wp_css_components_mybooking-engine-selector-wizard',
                      plugins_url('/assets/styles/mybooking-engine-selector-wizard.css', dirname( __DIR__ ) ),
                      array(), $this->version );
      // Mybooking Transfer Selector
      wp_enqueue_style( 'mybooking_wp_css_components_mybooking-engine-selector-trasfer',
                      plugins_url('/assets/styles/mybooking-engine-selector-transfer.css', dirname( __DIR__ ) ),
                      array(), $this->version );
      // Mybooking Components
      wp_enqueue_style( 'mybooking_wp_css_components_mybooking-engine-components',
                      plugins_url('/assets/styles/mybooking-engine-components.css', dirname( __DIR__ ) ),
                      array(), $this->version );
      // Mybooking Filter
      wp_enqueue_style( 'mybooking_wp_css_components_mybooking-engine-choose-product-filter',
                      plugins_url('/assets/styles/mybooking-engine-choose-product-filter.css', dirname( __DIR__ ) ),
                      array(), $this->version );
      // Mybooking Product
      wp_enqueue_style( 'mybooking_wp_css_components_mybooking-engine-product',
                      plugins_url('/assets/styles/mybooking-engine-product.css', dirname( __DIR__ ) ),
                      array(), $this->version );
      // Mybooking Product List
      wp_enqueue_style( 'mybooking_wp_css_components_mybooking-engine-product-list',
                      plugins_url('/assets/styles/mybooking-engine-product-list.css', dirname( __DIR__ ) ),
                      array(), $this->version );
      // Mybooking Product Reduce List
      wp_enqueue_style( 'mybooking_wp_css_components_mybooking-engine-product-reduce-list',
                      plugins_url('/assets/styles/mybooking-engine-product-reduce-list.css', dirname( __DIR__ ) ),
                      array(), $this->version );
      // Mybooking Product Multiple rate list
      wp_enqueue_style( 'mybooking_wp_css_components_mybooking-engine-product-multiple-rate-list',
                      plugins_url('/assets/styles/mybooking-engine-product-multiple-rate-list.css', dirname( __DIR__ ) ),
                      array(), $this->version );
      // Mybooking Modals
      wp_enqueue_style( 'mybooking_wp_css_components_jquerymodal',
                      plugins_url('/assets/styles/mybooking-engine-modals.css', dirname( __DIR__ ) ),
                      array(), $this->version );
      // == Load Customizer front-end
      $customizer_css = MyBookingPluginCustomizer::getInstance()->customize_enqueue( 'front-end' );
      if ( !empty($customizer_css) ) {
          wp_register_style( 'mybooking_wp_engine_customizer', false );
          wp_enqueue_style( 'mybooking_wp_engine_customizer' );
          wp_add_inline_style( 'mybooking_wp_engine_customizer', $customizer_css );
      }


      $content = mybooking_engine_page_current_page_content();
      
      if ( has_shortcode( $content, 'mybooking_rent_engine_planning') ||
           has_shortcode( $content, 'mybooking_rent_engine_product_week_planning') ) {
        // Mybooking Planning
        wp_enqueue_style( 'mybooking_wp_css_components_mybooking-engine-planning',
                          plugins_url('/assets/styles/mybooking-engine-planning.css', dirname( __DIR__ ) ),
                          array(), $this->version );
        
        // Mybooking Product Week Planning
        wp_enqueue_style( 'mybooking_wp_css_components_mybooking-engine-product-week-planning',
                          plugins_url('/assets/styles/mybooking-engine-product-week-planning.css', dirname( __DIR__ ) ),
                          array(), $this->version );
      }

      if ( has_shortcode( $content, 'mybooking_rent_engine_shift_picker') ) {
        // Mybooking Product Shift Picker
        wp_enqueue_style( 'mybooking_wp_css_components_mybooking-engine-shift-picker',
                          plugins_url('/assets/styles/mybooking-engine-shift-picker.css', dirname( __DIR__ ) ),
                          array(), $this->version );
      }

      // Tariff Selector
      wp_enqueue_style( 'mybooking-tariff-selector',
                        plugins_url('/assets/styles/tariff-selector.css', dirname( __DIR__ ) ),
                        array(), '1.0.0' );

    }

    /**
     * Enqueue public JS
     */
    public function enqueue_public_js() {

      // Get the registry information
      $registry = Mybooking_Registry::getInstance();

      // Mybooking init
      wp_register_script( 'mybooking-init',
                          plugins_url( '/assets/js/mybooking-init.js', dirname(__DIR__) ),
                          array(), $this->version, true);
      wp_enqueue_script( 'mybooking-init' );
      wp_localize_script( 'mybooking-init', 'mybooking_init_vars', array(
          'mybooking_site_url' => get_site_url(),
          'mybooking_api_url_prefix' => $registry->mybooking_rent_plugin_api_url_prefix,
          'mybooking_account_id' => $registry->mybooking_rent_plugin_account_id,
          'mybooking_api_key' => $registry->mybooking_rent_plugin_api_key,
          // Renting
          'mybooking_choose_products_page' => mybooking_engine_translated_slug($registry->mybooking_rent_plugin_choose_products_page),
          'mybooking_checkout_page' => mybooking_engine_translated_slug($registry->mybooking_rent_plugin_checkout_page),
          'mybooking_summary_page' => mybooking_engine_translated_slug($registry->mybooking_rent_plugin_summary_page),
          'mybooking_terms_page' => mybooking_engine_translated_slug($registry->mybooking_rent_plugin_terms_page),
          'mybooking_detail_pages' => ( $registry->mybooking_rent_plugin_detail_pages ? 'true' : 'false') ,
          'mybooking_detail_pages_url_prefix' => $registry->mybooking_rent_plugin_navigation_products_url,
          'mybooking_selector_in_process' => $registry->mybooking_rent_plugin_selector_in_process,
          // Activities
          'mybooking_activities_shopping_cart_page' => mybooking_engine_translated_slug($registry->mybooking_activities_plugin_shopping_cart_page),
          'mybooking_activities_summary_page' => mybooking_engine_translated_slug($registry->mybooking_activities_plugin_summary_page),
          'mybooking_activities_terms_page' => mybooking_engine_translated_slug($registry->mybooking_activities_plugin_terms_page),
          'mybooking_activities_detail_pages' => $registry->mybooking_activities_plugin_detail_pages,
          // Transfer
          'mybooking_transfer_choose_vehicle_page' => mybooking_engine_translated_slug($registry->mybooking_transfer_plugin_choose_vehicle_page),
          'mybooking_transfer_checkout_page' => mybooking_engine_translated_slug($registry->mybooking_transfer_plugin_checkout_page),
          'mybooking_transfer_summary_page' => mybooking_engine_translated_slug($registry->mybooking_transfer_plugin_summary_page),
          'mybooking_transfer_terms_page' => mybooking_engine_translated_slug($registry->mybooking_transfer_plugin_terms_page),
          // Google API integration
          'mybooking_google_api_places' => ( $registry->mybooking_plugin_google_api_places == '1' ? 'true' : 'false') ,
          'mybooking_google_api_places_api_key' => $registry->mybooking_plugin_google_api_places_api_key,
          'mybooking_google_api_places_restrict_country_code' => $registry->mybooking_plugin_google_api_places_restrict_country_code,
          'mybooking_google_api_places_restrict_bounds' => ( $registry->mybooking_plugin_google_api_places_restrict_bounds == '1' ? 'true' : 'false') ,
          'mybooking_google_api_places_bounds_sw_lat' => $registry->mybooking_plugin_google_api_places_bounds_sw_lat,
          'mybooking_google_api_places_bounds_sw_lng' => $registry->mybooking_plugin_google_api_places_bounds_sw_lng,
          'mybooking_google_api_places_bounds_ne_lat' => $registry->mybooking_plugin_google_api_places_bounds_ne_lat,
          'mybooking_google_api_places_bounds_ne_lng' => $registry->mybooking_plugin_google_api_places_bounds_ne_lng,
          // Telephone validation
          'mybooking_phone_utils_path' => plugins_url( '/assets/js/intlTelInput-utils.js', dirname(__DIR__) ),
          // Custom Loader
          'mybooking_custom_loader' => 'false',
          'mybooking_js_select2' => ( $registry->mybooking_plugin_js_select2 == '1' ? 'true' : 'false'),
          // Contact form
          'mybooking_ajax_url' => admin_url('admin-ajax.php'),
          'mybooking_contact_nonce' => wp_create_nonce('mybooking_contact'),
          'mybooking_recaptcha_mode' => $registry->mybooking_rent_plugin_contact_form_captcha_mode,
          'mybooking_recaptcha_site_key' => $registry->mybooking_rent_plugin_contact_form_google_captcha_api_key ?: ''
          )
        );

      // Get content
      $content = mybooking_engine_page_current_page_content();

      // Moment JS TIMEZONE (0.5.33)
      // Uses WP moment
      wp_register_script( 'mybooking-moment-timezone-js',
                         plugins_url( '/assets/js/moment-timezone-with-data.min.js', dirname(__DIR__) ),
                         array( 'moment' ), $this->version, 
                         array(
                          'strategy' => 'async'
                         ));
      wp_enqueue_script( 'mybooking-moment-timezone-js');

      $mybooking_dependencies = array('jquery',
                             'jquery-ui-core',
                             'jquery-ui-datepicker',
                             'moment',
                             'mybooking-moment-timezone-js',
                             'mybooking-init');

      // Slick JS
      if ($registry->mybooking_rent_plugin_js_slickjs) {
        // Slick JS
        wp_register_script('mybooking_wp_js_slick',
                           plugins_url( '/assets/js/slick.min.js', dirname(__DIR__) ),
                           array( 'jquery' ), $this->version, array(
                            'strategy' => 'async'
                           ));
        wp_enqueue_script('mybooking_wp_js_slick');
        array_push($mybooking_dependencies, 'mybooking_wp_js_slick');
      }

      wp_register_script( 'mybooking-rent-engine-script',
                          plugins_url( '/assets/js/mybooking-js-engine-bundle.js',
                          dirname(__DIR__) ),
                          $mybooking_dependencies,
                          $this->version,
                          true
                        );
      wp_enqueue_script( 'mybooking-rent-engine-script');

      wp_localize_script( 'mybooking-rent-engine-script', 'mybookingTariffStrings', array(
        'details_button'      => _x( 'Rate details', 'tariff_selector', 'mybooking-reservation-engine' ),
        'details_modal_title' => _x( 'Rate details', 'tariff_selector', 'mybooking-reservation-engine' ),
      ) );

      // Complements (testimonials, cookies, popup)
      if ($registry->mybooking_rent_plugin_complements_testimonials == '1' ||
          $registry->mybooking_rent_plugin_complements_content_slider == '1' ||
          $registry->mybooking_rent_plugin_complements_product_slider == '1' ||
          $registry->mybooking_rent_plugin_complements_popup == '1' ||
          $registry->mybooking_rent_plugin_complements_cookies_notice == '1' ||
          $registry->mybooking_rent_plugin_complements_renting_item == '1' ||
          $registry->mybooking_rent_plugin_complements_activity_item == '1' ) {
        wp_register_script('mybooking_wp_js_complements',
                           plugins_url( '/assets/js/complements.js', dirname(__DIR__) ),
                           array( 'jquery'), $this->version, true);
        wp_enqueue_script('mybooking_wp_js_complements');
      }

      // Contact Form Google Captcha
      $captcha_mode = $registry->mybooking_rent_plugin_contact_form_captcha_mode;
      if ( ( is_active_widget( false, false, 'mybooking_engine_contact_widget', false ) ||
             has_shortcode( $content, 'mybooking_contact' ) ) &&
           $captcha_mode !== '' &&
           $registry->mybooking_rent_plugin_contact_form_include_google_captcha_js ) {

        if ( $captcha_mode === 'enterprise' ) {
          $captcha_api_url = 'https://www.google.com/recaptcha/enterprise.js?render=' . urlencode( $registry->mybooking_rent_plugin_contact_form_google_captcha_api_key );
        }

        // v2 is Legacy but still working in several sites.
        elseif ( $captcha_mode === 'v2' ) {
          $language = MyBookingEngineContext::getInstance()->getCurrentLanguageCode();
          $captcha_api_url = 'https://www.google.com/recaptcha/api.js';
          if ( isset( $language ) ) {
            $captcha_api_url .= '?hl=' . $language;
          }
        }

        wp_register_script('mybooking_wp_google_captcha', $captcha_api_url);
        wp_enqueue_script('mybooking_wp_google_captcha');

      }

    }

  }