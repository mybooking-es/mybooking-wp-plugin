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
    public function enqueue_admin_css($version) {
      
      // Admin CSS Styles
      wp_enqueue_style( 'mybooking_wp_admin_css',
                      plugins_url('/assets/styles/admin/mybooking-plugin-onboarding.css', dirname( __DIR__ ) ) );

    }

    /**
     * Enqueue admin JS
     */
    public function enqueue_admin_js($version) {
    
      // JQuery validate
      wp_register_script('mybooking_wp_admin_jquery_validate',
      plugins_url( '/assets/js/jquery.validate.min.js', dirname(__DIR__) ),
                   array( 'jquery' ), $version, true);
      wp_enqueue_script('mybooking_wp_admin_jquery_validate');

      // JQuery formparams
      wp_register_script('mybooking_wp_admin_jquery_formparams',
      plugins_url( '/assets/js/jquery.formparams.js', dirname(__DIR__) ),
                   array( 'jquery' ), $version, true);
      wp_enqueue_script('mybooking_wp_admin_jquery_formparams');


    }

    /**
     * Enqueue public css
     */
    public function enqueue_public_css($version) {

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
      if ( $registry->mybooking_rent_plugin_components_css ) {
        // Load JQUERY UI Boostrap like Style
        wp_enqueue_style( 'mybooking_wp_css_components_jqueryui',
                        plugins_url('/assets/styles/jquery-ui-1.10.0.custom.css', dirname( __DIR__ ) ) );
        // Load JQUERY Date Range
        wp_enqueue_style( 'mybooking_wp_css_components_jquery_date_range',
                        plugins_url('/assets/styles/daterangepicker-0.20.0.min.css', dirname( __DIR__ ) ) );
        // Mybooking styles
        wp_enqueue_style( 'mybooking_wp_css_components_mybooking-engine',
                        plugins_url('/assets/styles/mybooking-engine.css', dirname( __DIR__ ) ),
                        array(), $version );
        // Mybooking Helpers
        wp_enqueue_style( 'mybooking_wp_css_components_mybooking-engine-helpers',
                        plugins_url('/assets/styles/mybooking-engine-helpers.css', dirname( __DIR__ ) ),
                        array(), $version );
        // Mybooking Selector
        wp_enqueue_style( 'mybooking_wp_css_components_mybooking-engine-selector',
                        plugins_url('/assets/styles/mybooking-engine-selector.css', dirname( __DIR__ ) ),
                        array(), $version );
        // Mybooking Wizard Selector
        wp_enqueue_style( 'mybooking_wp_css_components_mybooking-engine-selector-wizard',
                        plugins_url('/assets/styles/mybooking-engine-selector-wizard.css', dirname( __DIR__ ) ),
                        array(), $version );
        // Mybooking Transfer Selector
        wp_enqueue_style( 'mybooking_wp_css_components_mybooking-engine-selector-trasfer',
                        plugins_url('/assets/styles/mybooking-engine-selector-transfer.css', dirname( __DIR__ ) ),
                        array(), $version );
        // Mybooking Components
        wp_enqueue_style( 'mybooking_wp_css_components_mybooking-engine-components',
                        plugins_url('/assets/styles/mybooking-engine-components.css', dirname( __DIR__ ) ),
                        array(), $version );
        // Mybooking Product
        wp_enqueue_style( 'mybooking_wp_css_components_mybooking-engine-product',
                        plugins_url('/assets/styles/mybooking-engine-product.css', dirname( __DIR__ ) ),
                        array(), $version );
        // Mybooking Modals
        wp_enqueue_style( 'mybooking_wp_css_components_jquerymodal',
                        plugins_url('/assets/styles/mybooking-engine-modals.css', dirname( __DIR__ ) ),
                        array(), $version );
        // == Load Customizer front-end
        $customizer_css = MyBookingPluginCustomizer::getInstance()->customize_enqueue( 'front-end' );
        if ( !empty($customizer_css) ) {
            wp_register_style( 'mybooking_wp_engine_customizer', false );
            wp_enqueue_style( 'mybooking_wp_engine_customizer' );
            wp_add_inline_style( 'mybooking_wp_engine_customizer', $customizer_css );
        }
      }

      $content = mybooking_engine_page_current_page_content();
      
      if ( has_shortcode( $content, 'mybooking_rent_engine_planning') ||
           has_shortcode( $content, 'mybooking_rent_engine_product_week_planning') ) {
        // Mybooking Planning
        wp_enqueue_style( 'mybooking_wp_css_components_mybooking-engine-planning',
                          plugins_url('/assets/styles/mybooking-engine-planning.css', dirname( __DIR__ ) ),
                          array(), $version );
        
        // Mybooking Product Week Planning
        wp_enqueue_style( 'mybooking_wp_css_components_mybooking-engine-product-week-planning',
                          plugins_url('/assets/styles/mybooking-engine-product-week-planning.css', dirname( __DIR__ ) ),
                          array(), $version );
      }

      if ( has_shortcode( $content, 'mybooking_rent_engine_shift_picker') ) {
        // Mybooking Product Shift Picker
        wp_enqueue_style( 'mybooking_wp_css_components_mybooking-engine-shift-picker',
                          plugins_url('/assets/styles/mybooking-engine-shift-picker.css', dirname( __DIR__ ) ),
                          array(), $version );     
      }

    }

    /**
     * Enqueue public JS
     */
    public function enqueue_public_js($version) {

      // Get the registry information
      $registry = Mybooking_Registry::getInstance();

      // Mybooking init
      wp_register_script( 'mybooking-init',
                          plugins_url( '/assets/js/mybooking-init.js', dirname(__DIR__) ),
                          array(), $version, true);
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
          'mybooking_detail_pages' => $registry->mybooking_rent_plugin_detail_pages,
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
          'mybooking_custom_loader' => ( $registry->mybooking_rent_plugin_custom_loader == '1' ? 'true' : 'false'),
          'mybooking_js_select2' => ( $registry->mybooking_plugin_js_select2 == '1' ? 'true' : 'false')
          )
        );

      // Moment JS TIMEZONE (0.5.33)
      // Uses WP moment
      wp_register_script( 'mybooking-moment-timezone-js',
                         plugins_url( '/assets/js/moment-timezone-with-data.min.js', dirname(__DIR__) ),
                         array( 'moment' ), $version, true);
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
                           array( 'jquery' ), $version, true);
        wp_enqueue_script('mybooking_wp_js_slick');
        array_push($mybooking_dependencies, 'mybooking_wp_js_slick');
      }


      // Enqueue the Engine Plugin [TO BE INCLUDED IN THE FOOTER 5th parameter true]
      wp_register_script( 'mybooking-rent-engine-script',
                           plugins_url( '/assets/js/mybooking-js-engine-bundle.js',
                           dirname(__DIR__) ),
                           $mybooking_dependencies,
                           $version,
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
                           array( 'jquery'), $version, true);
        wp_enqueue_script('mybooking_wp_js_complements');
      }

      // Contact Form Google Captcha

      $content = mybooking_engine_page_current_page_content();

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