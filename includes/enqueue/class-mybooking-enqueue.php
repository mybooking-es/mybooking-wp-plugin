<?php
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
                                   'mybooking-wp-plugin',
                                   MYBOOKING_RESERVATION_ENGINE_SCRIPTS_LANGUAGES_FOLDER);
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
                                     'mybooking-wp-plugin',
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
                                     'mybooking-wp-plugin',
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
                                   'mybooking-wp-plugin',
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
          'mybooking_js_select2' => ( $registry->mybooking_plugin_js_select2 == '1' ? 'true' : 'false')
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

      if ( is_active_widget( false, false, 'mybooking_engine_contact_widget', false ) ||
           has_shortcode( $content, 'mybooking_contact' ) ) {
        if ( $registry->mybooking_rent_plugin_contact_form_use_google_captcha &&
             $registry->mybooking_rent_plugin_contact_form_include_google_captcha_js ) {
          $language = MyBookingEngineContext::getInstance()->getCurrentLanguageCode();
          $captcha_api_url = 'https://www.google.com/recaptcha/api.js';
          if ( isset( $language ) ) {
            $captcha_api_url = $captcha_api_url.'?hl='.$language;
          }
          // Google Captcha
          wp_register_script('mybooking_wp_google_captcha',
                             $captcha_api_url);
          wp_enqueue_script('mybooking_wp_google_captcha');
        }

      }

    }

  }