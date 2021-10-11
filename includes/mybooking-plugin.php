<?php

  // == Registry
  require_once('registry/mybooking-plugin-registry.php');

  // == Utilities
  // Templates (https://jeroensormani.com/how-to-add-template-files-in-your-plugin/)
  require_once('mybooking-plugin-templates.php');
  // Routes (https://github.com/Upstatement/routes)
  if ( !class_exists('AltoRouter') ) {
    require_once('routes/altorouter.php');
  }
  // Routes (https://github.com/dannyvankooten/AltoRouter)
  if ( !class_exists('Routes') ) {
    require_once('routes/routes.php');
  }
  // Check is page WMPL integration
  require_once('mybooking-plugin-is-page.php');
  // Mybooking Api Client + UI
  require_once('ui/mybooking-plugin-ui-pages.php');
  require_once('ui/mybooking-plugin-ui-pagination.php');
  require_once('api/mybooking-plugin-api-client.php');
  require_once('ui/mybooking-plugin-activities-ui-pages.php');
  require_once('api/mybooking-plugin-activities-api-client.php');
  // Engine context
  require_once('translation/mybooking-plugin-engine-context.php');

  // == WordPress components

  // Widgets
  require_once('widgets/mybooking-plugin-rent-selector-widget.php');
  require_once('widgets/mybooking-plugin-rent-selector-wizard-widget.php');
  require_once('widgets/mybooking-plugin-activity-widget.php');
  require_once('widgets/mybooking-plugin-contact-widget.php');
  // Settings
  require_once('settings/mybooking-plugin-settings.php');

  /**
   * =======================================================================
   * MyBooking WordPress Plugin
   * =======================================================================
   *
   * Mybooking Engine for WordPress.
   *
   * It extends WordPress to create a reservation website using mybooking.es
   *
   * What is does?
   * =======================================================================
   *
   * 1. Contact form
   *
   * 2. Reservation engine for Renting / Accommodation / Car Rental
   *
   * 3. Reservation engine for Activities / Tours
   *
   *
   * How it works?
   * =======================================================================
   *
   * It adds some widgets and shortcodes to integrate the reservation engine
   *
   * 1. Widgets
   *
   * - Contact widget
   * - Renting selector widget
   * - Activity buy tickets widget
   *
   * 2. Sort codes:
   *
   * 2.1 Renting
   *
   * 2.1.1 Reservation Wizard
   *
   * - Show renting selector: The starting point for a reservation
   *
   * [mybooking_rent_engine_selector sales_channel_code=String family_id=Number rental_location_code=String]
   *
   * [mybooking_rent_engine_selector_wizard sales_channel_code=String family_id=Number rental_location_code=String]
   *
   * - Renting search results:
   *
   * [mybooking_rent_engine_product_listing]
   *
   * - Renting complete: Checkout process
   *
   * [mybooking_rent_engine_complete]
   *
   * - Renting summary page: It shows the reservation information
   *
   * [mybooking_rent_engine_summary]
   *
   * - My reservation
   *
   * [mybooking_rent_engine_reservation]
   *
   * 2.1.2 Products explorer
   *
   * - Products
   *
   * [mybooking_rent_engine_products_search]
   * [mybooking_rent_engine_products]
   *
   * - Product availability and calendar
   *
   * [mybooking_rent_engine_product code=String]
   *
   * 2.2 Activities
   *
   * [mybooking_activities_engine_search]
   * [mybooking_activities_engine_activities]
   * [mybooking_activities_engine_activity activity_id=Number]
   * [mybooking_activities_engine_shopping_cart]
   * [mybooking_activities_engine_summary]
   * [mybooking_activities_engine_order]
   *
   * 2.3 Contact
   *
   * [mybooking_contact]
   *
   * 2.4 Complements
   *
   * [mybooking_testimonials]
   *
   * 2.5 Profile
   *
   * [mybooking_password_forgotten]
   * [mybooking_change_password]
   *
   */
  class MyBookingPlugin
  {

    private $registry;
    private $settings;
    private $version = null;

    // Hold the class instance.
    private static $instance = null;

    // The constructor is private
    // to prevent initiation with outer code.
    private function __construct()
    {
        // Load the plugin options into the $registry
        $this->load_options();
        // Initialize the plugin
        $this->wp_init();
        // Prepare the plugin settings page
        $settings = new MyBookingPluginSettings();
    }

    // The object is created from within the class itself
    // only if the class has no instance.
    public static function getInstance()
    {
      if (self::$instance == null)
      {
        self::$instance = new MyBookingPlugin();
      }

      return self::$instance;
    }

    // ------------ WordPress plugin init -------------

    /*
     * Initialize the WordPress Plugin
     *
     * - Load the language translations
     * - Setup the body class for mybooking_engine.js
     * - Enqueue styles and javascript
     * - Include micro-templates
     * - Registers shortcodes and widgets
     *
     */
    private function wp_init() {

      // Get the registry information
      $registry = Mybooking_Registry::getInstance();

      // Initialize the custom routes for activities and products
      add_action( 'init', array( $this, 'init_routes') );

      // Register custom post types
      add_action( 'init', array($this, 'create_custom_post_types' ));

      // Load translations
      add_action( 'plugins_loaded', array($this, 'wp_load_plugin_textdomain') );

      // Apply body tags on reservation pages
      add_filter( 'body_class', array($this, 'wp_body_class'));

      // == Custom CSS and JavaScript

      // Enqueue CSS
      add_action( 'wp_enqueue_scripts', array($this, 'wp_enqueue_css'));

      // Add micro templates
      add_action( 'wp_footer', array($this, 'wp_include_micro_templates'));

      // Add Pop up
      add_action( 'wp_footer', array($this, 'wp_include_popup') );

      // Add Cookies notice
      add_action( 'wp_footer', array($this, 'wp_include_cookies_notice') );

      // Enqueue JS
      add_action( 'wp_enqueue_scripts', array($this, 'wp_enqueue_js'));

      // == Widgets

      // Register Renting Selector Widget
      add_action( 'widgets_init', array($this, 'wp_selector_widget') );

      // Register Renting Selector Wizard Widget
      add_action( 'widgets_init', array($this, 'wp_selector_wizard_widget') );

      // Register Activities Activity Widget
      add_action( 'widgets_init', array($this, 'wp_activities_activity_widget') );

      // Register Contact widget
      add_action( 'widgets_init', array($this, 'wp_contact_widget') );

      // == Shortcodes

      // -- Renting shortcodes

      // Shortcode Renting Selector
      add_shortcode('mybooking_rent_engine_selector', array($this, 'wp_rent_selector_shortcode') );

      // Shortcode Renting Selector Wizard
      add_shortcode('mybooking_rent_engine_selector_wizard', array($this, 'wp_rent_selector_wizard_shortcode') );

      // Shortcode Renting Wizard - Product listing
      add_shortcode('mybooking_rent_engine_product_listing', array($this, 'wp_product_listing_shortcode' ));

      // Shortcode Renting Wizard - Complete
      add_shortcode('mybooking_rent_engine_complete', array($this, 'wp_complete_shortcode' ));

      // Shortcode Renting Wizard - Summary
      add_shortcode('mybooking_rent_engine_summary', array($this, 'wp_summary_shortcode' ));

      // Shortcode Renting Reservation
      add_shortcode('mybooking_rent_engine_reservation', array($this, 'wp_reservation_shortcode' ));

      // Shortcode Activities Search
      add_shortcode('mybooking_rent_engine_products_search', array($this, 'wp_rent_products_search_shortcode') );

      // Shortcode Renting products
      add_shortcode('mybooking_rent_engine_products', array($this, 'wp_rent_products_shortcode' ));

      // Shortcode Renting Product Calendar
      add_shortcode('mybooking_rent_engine_product', array($this, 'wp_rent_product_shortcode' ));

      // -- Activities shortcodes

      // Shortcode Activities Search
      add_shortcode('mybooking_activities_engine_search', array($this, 'wp_activities_search_shortcode') );

      // Shortcode Activities - Activities
      add_shortcode('mybooking_activities_engine_activities', array($this, 'wp_activities_activities_shortcode' ));

      // Shortcode Activities - Activity
      add_shortcode('mybooking_activities_engine_activity', array($this, 'wp_activities_activity_shortcode' ));

      // Shortcode Activities - Shopping Cart
      add_shortcode('mybooking_activities_engine_shopping_cart', array($this, 'wp_activities_shopping_cart_shortcode' ));

      // Shortcode Activities - Summary
      add_shortcode('mybooking_activities_engine_summary', array($this, 'wp_activities_summary_shortcode'));

      // Shortcode Activities - Order
      add_shortcode('mybooking_activities_engine_order', array($this, 'wp_activities_order_shortcode' ));

      // -- Contact shortcode

      // Shortcode Contact Form
      add_shortcode('mybooking_contact', array($this, 'wp_contact_shortcode' ));

      // -- Complements shortcodes

      // Shortcode testimonials
      if ( $registry->mybooking_rent_plugin_complements_testimonials == '1' ) {
        add_shortcode('mybooking_testimonials', array($this, 'wp_testimonials_shortcode' ));
      }

      // -- Profile

      // Shortcode Password Forgotten
      add_shortcode('mybooking_password_forgotten', array($this, 'wp_password_forgotten_shortcode'));

      // Shortcode Change Password
      add_shortcode('mybooking_change_password', array($this, 'wp_change_password_shortcode'));

    }

    /**
     * Load the plugin textdomain languages
     */
    function wp_load_plugin_textdomain() {

       // This module is located in includes and the languages is in the
       // root directory of the plugin : 'mybooking-wp-plugin/languages/'

       $languages_folder = dirname(plugin_basename(__DIR__)).'/languages';
       load_plugin_textdomain( 'mybooking-wp-plugin', FALSE, $languages_folder );

    }

    /**
     * Enqueue plugin CSS
     */
    public function wp_enqueue_css() {

      // Get plugin version
      $version = $this->get_plugin_version();

      // Get the registry information
      $registry = Mybooking_Registry::getInstance();

      // Enqueue select2 + select2 bootstrap CSS
      if ($registry->mybooking_plugin_js_select2) {
        // Load select2
        wp_enqueue_style( 'mybooking_wp_css_components_select2',
                          plugins_url('/assets/styles/select2-4.0.1.css', dirname( __FILE__ ) ) );
        wp_enqueue_style( 'mybooking_wp_css_components_select2_bootstrap',
                          plugins_url('/assets/styles/select2-bootstrap.css', dirname( __FILE__ ) ) );
      }

      // Font-Awesome CSS
      if ($registry->mybooking_rent_plugin_css_fontawesome) {
        // Load font awesome 4.7
        wp_enqueue_style( 'mybooking_wp_css_framework_fontawesome',
                          plugins_url('/assets/styles/font-awesome-4.7.0.min.css', dirname( __FILE__ ) ) );
      }

      // Slick JS CSS
      if ($registry->mybooking_rent_plugin_js_slickjs) {
        // Load Slick
        wp_enqueue_style( 'mybooking_wp_css_slick',
                          plugins_url('/assets/styles/slick.css', dirname( __FILE__ ) ) );
        wp_enqueue_style( 'mybooking_wp_css_slick-theme',
                          plugins_url('/assets/styles/slick-theme.css', dirname( __FILE__ ) ) );
      }

      // Enqueue Boostrap CSS
      if ($registry->mybooking_rent_plugin_custom_css) {
        // Load bootstrap CSS
        wp_enqueue_style( 'mybooking_wp_css_framework_bootstrap',
                          plugins_url('/assets/styles/bootstrap-4.4.1.min.css', dirname( __FILE__ ) ) );
      }

      // CSS Components
      if ($registry->mybooking_rent_plugin_components_css) {
        // Load JQUERY UI Boostrap like Style
        wp_enqueue_style( 'mybooking_wp_css_components_jqueryui',
                          plugins_url('/assets/styles/jquery-ui-1.10.0.custom.css', dirname( __FILE__ ) ) );
        // Load JQUERY Date Range
        wp_enqueue_style( 'mybooking_wp_css_components_jquery_date_range',
                          plugins_url('/assets/styles/daterangepicker-0.20.0.min.css', dirname( __FILE__ ) ) );
        // Custom style
        wp_enqueue_style('mybooking_wp_css_components_jquerymodal',
                         plugins_url('/assets/styles/jquery-modal.css', dirname( __FILE__ ) ),
                         array(), $version );
        // Custom style
        wp_enqueue_style('mybooking_wp_css_components_custom_style',
                         plugins_url('/assets/styles/custom-styles.css', dirname( __FILE__ ) ),
                         array(), $version );
      }

    }

    /**
     * Enqueue plugin JS
     *
     * TODO: Improve loading only on engine pages
     */
    public function wp_enqueue_js() {

      // Get plugin version
      $version = $this->get_plugin_version();

      // Get the registry information
      $registry = Mybooking_Registry::getInstance();

      // Mybooking init
      wp_register_script( 'mybooking-init',
                          plugins_url( '/assets/js/mybooking-init.js', dirname(__FILE__) ),
                          array(), $version, true);
      wp_enqueue_script( 'mybooking-init' );
      wp_localize_script('mybooking-init', 'mybooking_init_vars', array(
          'mybooking_site_url' => get_site_url(),
          'mybooking_api_url_prefix' => $registry->mybooking_rent_plugin_api_url_prefix,
          'mybooking_account_id' => $registry->mybooking_rent_plugin_account_id,
          'mybooking_api_key' => $registry->mybooking_rent_plugin_api_key,
          // Renting
          'mybooking_choose_products_page' => mybooking_engine_translated_slug($registry->mybooking_rent_plugin_choose_products_page),
          'mybooking_choose_extras_page' => mybooking_engine_translated_slug($registry->mybooking_rent_plugin_choose_extras_page),
          'mybooking_checkout_page' => mybooking_engine_translated_slug($registry->mybooking_rent_plugin_checkout_page),
          'mybooking_summary_page' => mybooking_engine_translated_slug($registry->mybooking_rent_plugin_summary_page),
          'mybooking_terms_page' => mybooking_engine_translated_slug($registry->mybooking_rent_plugin_terms_page),
          'mybooking_detail_pages' => $registry->mybooking_rent_plugin_detail_pages,
          'mybooking_selector_in_process' => $registry->mybooking_rent_plugin_selector_in_process,
          // Activities
          'mybooking_activities_shopping_cart_page' => mybooking_engine_translated_slug($registry->mybooking_activities_plugin_shopping_cart_page),
          'mybooking_activities_summary_page' => mybooking_engine_translated_slug($registry->mybooking_activities_plugin_summary_page),
          'mybooking_activities_terms_page' => mybooking_engine_translated_slug($registry->mybooking_activities_plugin_terms_page),
          'mybooking_activities_detail_pages' => $registry->mybooking_activities_plugin_detail_pages,
          // Google API integration
          'mybooking_google_api_places' => ( $registry->mybooking_plugin_google_api_places == '1' ? 'true' : 'false') ,
          'mybooking_google_api_places_api_key' => $registry->mybooking_plugin_google_api_places_api_key,
          'mybooking_google_api_places_restrict_country_code' => $registry->mybooking_plugin_google_api_places_restrict_country_code,
          'mybooking_google_api_places_restrict_bounds' => ( $registry->mybooking_plugin_google_api_places_restrict_bounds == '1' ? 'true' : 'false') ,
          'mybooking_google_api_places_bounds_sw_lat' => $registry->mybooking_plugin_google_api_places_bounds_sw_lat,
          'mybooking_google_api_places_bounds_sw_lng' => $registry->mybooking_plugin_google_api_places_bounds_sw_lng,
          'mybooking_google_api_places_bounds_ne_lat' => $registry->mybooking_plugin_google_api_places_bounds_ne_lat,
          'mybooking_google_api_places_bounds_ne_lng' => $registry->mybooking_plugin_google_api_places_bounds_ne_lng,
          // Custom Loader
          'mybooking_custom_loader' => ( $registry->mybooking_rent_plugin_custom_loader == '1' ? 'true' : 'false'),
          'mybooking_js_select2' => ( $registry->mybooking_plugin_js_select2 == '1' ? 'true' : 'false'),
          'mybooking_js_bs_modal_no_conflict' => ( $registry->mybooking_plugin_js_bs_modal_no_conflict == '1' ? 'true' : 'false'),
          'mybooking_js_bs_modal_backdrop_compatibility' => (  $registry->mybooking_plugin_js_bs_modal_backdrop_compatibility == '1' ? 'true' : 'false')
          )
        );

      // Moment JS TIMEZONE (0.5.33)
      // Uses WP moment
      wp_register_script('mybooking-moment-timezone-js',
                         plugins_url( '/assets/js/moment-timezone-with-data.min.js', dirname(__FILE__) ),
                         array( 'moment' ), $version, true);
      wp_enqueue_script( 'mybooking-moment-timezone-js');


      // Enqueue the Engine Plugin [TO BE INCLUDED IN THE FOOTER 5th parameter true]
      wp_register_script('mybooking-rent-engine-script',
                         plugins_url( '/assets/js/mybooking-js-engine-bundle.js', dirname(__FILE__) ),
                         array( 'jquery', 'jquery-ui-core', 'jquery-ui-datepicker', 'moment', 'mybooking-moment-timezone-js', 'mybooking-init' ), $version, true);
      wp_enqueue_script( 'mybooking-rent-engine-script');

      // Bootstrap and Jquery modal compatibility
      if ($registry->mybooking_plugin_js_bs_modal_no_conflict) {
        wp_register_script('mybooking_wp_js_app',
                           plugins_url( '/assets/js/noConflict.js', dirname(__FILE__) ),
                           array( 'jquery', 'mybooking_wp_js_framework_bootstrap' ), $version, true);
        wp_enqueue_script('mybooking_wp_js_app');
      }

      // Slick JS
      if ($registry->mybooking_rent_plugin_js_slickjs) {
        // Slick JS
        wp_register_script('mybooking_wp_js_slick',
                           plugins_url( '/assets/js/slick.min.js', dirname(__FILE__) ),
                           array( 'jquery' ), $version, true);
        wp_enqueue_script('mybooking_wp_js_slick');
      }

      // Complements (testimonials, cookies, popup)
      if ($registry->mybooking_rent_plugin_complements_testimonials == '1' ||
          $registry->mybooking_rent_plugin_complements_popup == '1' ||
          $registry->mybooking_rent_plugin_complements_cookies_notice == '1' ||
          $registry->mybooking_rent_plugin_complements_renting_item == '1' ||
          $registry->mybooking_rent_plugin_complements_activity_item == '1' ) {
        wp_register_script('mybooking_wp_js_complements',
                           plugins_url( '/assets/js/complements.js', dirname(__FILE__) ),
                           array( 'jquery'), $version, true);
        wp_enqueue_script('mybooking_wp_js_complements');
      }

      // Contact Form Google Captcha

      $content = $this->getCurrentPageContent();

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

    /**
     * Add body classes to the pages
     */
    public function wp_body_class ( $classes ) {

      // Get the current page content
      $content = $this->getCurrentPageContent();

      $registry = Mybooking_Registry::getInstance();

      // == Contact

      if ( is_active_widget( false, false, 'mybooking_engine_contact_widget', false ) ||
           has_shortcode( $content, 'mybooking_contact' )) {
        $classes[] = 'mybooking-contact-widget';
      }

      // == Profile

      // Password forgotten
      if ( has_shortcode( $content, 'mybooking_password_forgotten') ) {
        $classes[] = 'mybooking-password-forgotten';
      }

      // Change password
      if ( has_shortcode( $content, 'mybooking_change_password') ) {
        $classes[] = 'mybooking-change-password';
      }

      // == Renting

      // Selector widget or shortcode
      if ( is_active_widget( false, false, 'mybooking_rent_engine_selector_widget', false ) ||
           has_shortcode( $content , 'mybooking_rent_engine_selector') ) {
        $classes[] = 'mybooking-selector-widget';
      }

      // Selector Wizard widget or shortcode
      if ( is_active_widget( false, false, 'mybooking_rent_engine_selector_wizard_widget', false ) ||
           ( has_shortcode( $content , 'mybooking_rent_engine_selector_wizard') ) ) {
        $classes[] = 'mybooking-selector-wizard';
      }

      // Renting reservation steps pages
      if ( $registry->mybooking_rent_plugin_choose_products_page != '' && mybooking_engine_is_page( $registry->mybooking_rent_plugin_choose_products_page ) ) {
        $classes[] = 'choose_product';
      }
      else if ( $registry->mybooking_rent_plugin_checkout_page != '' && mybooking_engine_is_page( $registry->mybooking_rent_plugin_checkout_page ) ) {
        $classes[] = 'complete';
      }
      else if ( $registry->mybooking_rent_plugin_summary_page != '' && mybooking_engine_is_page( $registry->mybooking_rent_plugin_summary_page ) ) {
        $classes[] = 'summary';
      }

      // Renting shortcode : reservation
      if ( has_shortcode( $content, 'mybooking_rent_engine_reservation') ) {
        $classes[] = 'reservation';
      }

      // Renting shortcodes : product search
      if ( has_shortcode( $content, 'mybooking_rent_engine_products_search') ) {
        $classes[] = 'mybooking-product-search';
      }

      // Renting shortcode : product (resource) [availability and selector]
      if ( has_shortcode( $content , 'mybooking_rent_engine_product') ) {
        $classes[] = 'mybooking-product';
      }

      // == Activities

      // Activities reservation steps pages
      if ( $registry->mybooking_activities_plugin_shopping_cart_page != '' &&
           mybooking_engine_is_page( $registry->mybooking_activities_plugin_shopping_cart_page ) ) {
        $classes[] = 'mybooking-activity-shopping-cart';
      }
      else if ( $registry->mybooking_activities_plugin_summary_page != '' &&
                mybooking_engine_is_page( $registry->mybooking_activities_plugin_summary_page ) ) {
        $classes[] = 'mybooking-activity-summary';
      }

      // Activities shortcodes : Activity
      if ( has_shortcode( $content, 'mybooking_activities_engine_search') ) {
        $classes[] = 'mybooking-activity-search';
      }

      // Activities shortcodes : Activity
      if ( has_shortcode( $content, 'mybooking_activities_engine_activity') ) {
        $classes[] = 'mybooking-activity';
      }
      // Activities shortcodes : Order
      if ( has_shortcode( $content, 'mybooking_activities_engine_order') ) {
        $classes[] = 'mybooking-activity-order';
      }

      // Only for product page
      $url = $registry->mybooking_rent_plugin_navigation_products_url ? $registry->mybooking_rent_plugin_navigation_products_url : 'products';
      if ( isset($_SERVER['REQUEST_URI']) && preg_match_all('`/'.$url.'/(\w)+`', $_SERVER['REQUEST_URI']) ) {
        $classes[] = 'mybooking-product';
      }

      // Only for activity page
      $url = $registry->mybooking_rent_plugin_navigation_activities_url ? $registry->mybooking_rent_plugin_navigation_activities_url : 'activities';
      if ( isset($_SERVER['REQUEST_URI']) && preg_match_all('`/'.$url.'/(\w)+`', $_SERVER['REQUEST_URI']) ) {
        $classes[] = 'mybooking-activity';
      }

      return $classes;

    }

    /**
     * Include micro templates
     * -----------------------
     * Microtemplates are responsible of rendering parts of the reservation engine.
     * This method includes the current page necessary micro-templates on the footer
     */
    public function wp_include_micro_templates() {

      $registry = Mybooking_Registry::getInstance();

      // The the current page content
      $content = $this->getCurrentPageContent();

      // Hold if the current page needs the selector wizard
      $current_page_modify_reservation = false;

      // Renting Form
      if ( is_active_widget( false, false, 'mybooking_rent_engine_selector_widget', false ) ||
           ( has_shortcode ( $content, 'mybooking_rent_engine_selector') ) ) {
        mybooking_engine_get_template( 'mybooking-plugin-selector-widget-tmpl.php');
      }

      // Renting Selector Wizard shortcode / widget
      if ( is_active_widget( false, false, 'mybooking_rent_engine_selector_wizard_widget', false ) ||
           ( has_shortcode( $content , 'mybooking_rent_engine_selector_wizard') ) ) {
        mybooking_engine_get_template('mybooking-plugin-selector-wizard-widget-tmpl.php');
      }

      // Load scripts
      if ( $registry->mybooking_rent_plugin_choose_products_page != '' &&
           mybooking_engine_is_page( $registry->mybooking_rent_plugin_choose_products_page ) ) {
        $data = array();
        $data['show_taxes_included'] = $registry->mybooking_rent_plugin_show_taxes_included;
        mybooking_engine_get_template('mybooking-plugin-choose-product-tmpl.php', $data);
        // If selector in process Wizard, load the micro-templates for the process
        if ($registry->mybooking_rent_plugin_selector_in_process == 'wizard') {
          mybooking_engine_get_template('mybooking-plugin-selector-wizard-widget-tmpl.php');
        }
        else {
          mybooking_engine_get_template('mybooking-plugin-modify-reservation-tmpl.php');
        }
        $current_page_modify_reservation = true;
      }
      else if ( $registry->mybooking_rent_plugin_checkout_page != '' &&
                mybooking_engine_is_page( $registry->mybooking_rent_plugin_checkout_page ) ) {
        // Terms and conditions
        $data = array();
        if ( empty($registry->mybooking_rent_plugin_terms_page) ) {
          $data['terms_and_conditions'] = '';
        }
        else {
          $data['terms_and_conditions'] = mybooking_engine_translated_slug($registry->mybooking_rent_plugin_terms_page);
        }
        $data['show_taxes_included'] = $registry->mybooking_rent_plugin_show_taxes_included;
        mybooking_engine_get_template('mybooking-plugin-complete-tmpl.php', $data);
        // If selector in process Wizard, load the micro-templates for the process
        if ($registry->mybooking_rent_plugin_selector_in_process == 'wizard') {
          mybooking_engine_get_template('mybooking-plugin-selector-wizard-widget-tmpl.php');
        }
        else {
          mybooking_engine_get_template('mybooking-plugin-modify-reservation-tmpl.php');
        }
        $current_page_modify_reservation = true;
      }
      else if ( $registry->mybooking_rent_plugin_summary_page != '' &&
                mybooking_engine_is_page( $registry->mybooking_rent_plugin_summary_page ) ) {
        $data = array();
        $data['show_taxes_included'] = $registry->mybooking_rent_plugin_show_taxes_included;
        mybooking_engine_get_template('mybooking-plugin-summary-tmpl.php', $data);
      }
      else if ( $registry->mybooking_activities_plugin_shopping_cart_page != '' &&
                mybooking_engine_is_page( $registry->mybooking_activities_plugin_shopping_cart_page ) ) {
        // Terms and conditions
        $data = array();
        if ( empty($registry->mybooking_activities_plugin_terms_page) ) {
          $data['terms_and_conditions'] = '';
        }
        else {
          $data['terms_and_conditions'] = mybooking_engine_translated_slug($registry->mybooking_activities_plugin_terms_page);
        }
        mybooking_engine_get_template('mybooking-plugin-activities-shopping-cart-tmpl.php', $data);
      }
      else if ( $registry->mybooking_activities_plugin_summary_page != '' &&
                mybooking_engine_is_page( $registry->mybooking_activities_plugin_summary_page ) ) {
        mybooking_engine_get_template('mybooking-plugin-activities-summary-tmpl.php');
      }

      // Renting shortcode : My reservation - reservation
      if ( has_shortcode( $content, 'mybooking_rent_engine_reservation') ) {
        $data = array();
        $data['show_taxes_included'] = $registry->mybooking_rent_plugin_show_taxes_included;
        mybooking_engine_get_template('mybooking-plugin-reservation-tmpl.php', $data);
      }

      // Activities search shortcode
      if ( has_shortcode( $content, 'mybooking_activities_engine_search') ) {
        $data = $this->wp_activities_extract_query_string();
        mybooking_engine_get_template('mybooking-plugin-activities-search-tmpl.php', $data);
      }

      // Activities shortcode : My reservation - activities
      if ( has_shortcode( $content, 'mybooking_activities_engine_order') ) {
        mybooking_engine_get_template('mybooking-plugin-activities-order-tmpl.php');
      }

      // Renting shortcode : Products search
      if ( has_shortcode( $content, 'mybooking_rent_engine_products_search') ) {
        $data = $this->wp_products_extract_query_string();
        mybooking_engine_get_template('mybooking-plugin-products-search-tmpl.php', $data);
      }

      // Renting shortcode : Product calendar
      if ( has_shortcode( $content, 'mybooking_rent_engine_product') ) {
        mybooking_engine_get_template('mybooking-plugin-product-widget-tmpl.php');
      }

      // Product page : reservation widget
      $url = $registry->mybooking_rent_plugin_navigation_products_url ? $registry->mybooking_rent_plugin_navigation_products_url : 'products';
      if ( isset($_SERVER['REQUEST_URI']) && preg_match_all('`/'.$url.'/(\w)+`', $_SERVER['REQUEST_URI']) ) {
        mybooking_engine_get_template('mybooking-plugin-product-widget-tmpl.php');
      }

      // Activity page : reservation widget
      $url = $registry->mybooking_rent_plugin_navigation_activities_url ? $registry->mybooking_rent_plugin_navigation_activities_url : 'activities';
      if ( isset($_SERVER['REQUEST_URI']) && preg_match_all('`/'.$url.'/(\w)+`', $_SERVER['REQUEST_URI']) ) {
        mybooking_engine_get_template('mybooking-plugin-activities-activity-widget-tmpl.php');
      }

      // Wizard container and modify reservation modal containers
      $active_wizard = is_active_widget( false, false, 'mybooking_rent_engine_selector_wizard_widget', false ) ||
                       has_shortcode( $content , 'mybooking_rent_engine_selector_wizard');

      if ( $active_wizard || ( $current_page_modify_reservation && $registry->mybooking_rent_plugin_selector_in_process == 'wizard' ) ) {
         mybooking_engine_get_template('mybooking-plugin-selector-wizard-container.php');
      }

      if (  $current_page_modify_reservation && $registry->mybooking_rent_plugin_selector_in_process == 'form' ) {
         mybooking_engine_get_template('mybooking-plugin-modify-reservation.php');
      }

    }

    /**
     * Include popup
     * -----------------------
     * This method includes the current page necessary micro-templates on the footer
     */
    public function wp_include_popup()
    {
      $registry = Mybooking_Registry::getInstance();
      // Popup
      if ( $registry->mybooking_rent_plugin_complements_popup == '1' && is_front_page() )
      {
        mybooking_engine_get_template('mybooking-plugin-promotions-popup.php');
      }
    }

    /**
     * Include cookies notice
     * -----------------------
     * This method includes the current page necessary micro-templates on the footer
     */
    public function wp_include_cookies_notice()
    {
      $registry = Mybooking_Registry::getInstance();
      // Popup
      if ( $registry->mybooking_rent_plugin_complements_cookies_notice == '1' )
      {
        mybooking_engine_get_template('mybooking-plugin-cookies-notice.php');
      }
    }

    // == Widgets

    /**
     * Register selector Widget
     */
    public function wp_selector_widget()
    {
      register_widget( 'MyBookingRentEngineSelectorWizardWidget' );
    }

    /**
     * Register selector wizard Widget
     */
    public function wp_selector_wizard_widget()
    {
      register_widget( 'MyBookingRentEngineSelectorWidget' );
    }

    /**
     * Register the activity widget
     */
    public function wp_activities_activity_widget()
    {
      register_widget( 'MyBookingActivitiesEngineActivityWidget' );
    }

    /**
     * Register contact Widget
     */
    public function wp_contact_widget() {

      register_widget( 'MyBookingEngineContactWidget' );

    }

    // == Shortcodes
    // @see https://konstantin.blog/2013/get_template_part-within-shortcodes/

    // -- Renting

    /**
     * Wizard selector shortcode
     */
    public function wp_rent_selector_shortcode($atts = [], $content = null, $tag = '') {

      // Extract the shortcode attributes
      extract( shortcode_atts( array('sales_channel_code' => '',
                                     'family_id' => '',
                                     'rental_location_code' => '' ), $atts ) );

      $data = array();

      if ( $sales_channel_code != '' ) {
        $data['sales_channel_code'] = $sales_channel_code;
      }

      if ( $family_id != '' ) {
        $data['family_id'] = $family_id;
      }

      if ( $rental_location_code != '' ) {
        $data['rental_location_code'] = $rental_location_code;
      }

      ob_start();
      mybooking_engine_get_template('mybooking-plugin-selector-widget.php', $data);
      return ob_get_clean();

    }

    /**
     * Wizard selector wizard shortcode
     */
    public function wp_rent_selector_wizard_shortcode($atts = [], $content = null, $tag = '') {

      // Extract the shortcode attributes
      extract( shortcode_atts( array('sales_channel_code' => '',
                                     'family_id' => '',
                                     'rental_location_code' => ''), $atts ) );

      $data = array();

      if ( $sales_channel_code != '' ) {
        $data['sales_channel_code'] = $sales_channel_code;
      }

      if ( $family_id != '' ) {
        $data['family_id'] = $family_id;
      }

      if ( $rental_location_code != '' ) {
        $data['rental_location_code'] = $rental_location_code;
      }

      ob_start();
      mybooking_engine_get_template('mybooking-plugin-selector-wizard-widget.php', $data);
      return ob_get_clean();

    }

    /**
     * Mybooking rent engine Product Listing shortcode
     */
    public function wp_product_listing_shortcode($atts = [], $content = null, $tag = '') {

      // Get the selector to apply in choose product
      $registry = Mybooking_Registry::getInstance();
      $data = array();
      $data['selector_in_process'] = $registry->mybooking_rent_plugin_selector_in_process;

      ob_start();
      mybooking_engine_get_template('mybooking-plugin-choose-product.php', $data);
      return ob_get_clean();

    }

    /**
     * Mybooking rent engine Complete shortcode
     */
    public function wp_complete_shortcode($atts = [], $content = null, $tag = '') {

      // Get the selector to apply in complete
      $registry = Mybooking_Registry::getInstance();
      $data = array();
      $data['selector_in_process'] = $registry->mybooking_rent_plugin_selector_in_process;

      ob_start();
      mybooking_engine_get_template('mybooking-plugin-complete.php', $data);
      return ob_get_clean();

    }

    /**
     * Mybooking rent engine Complete shortcode
     */
    public function wp_summary_shortcode($atts = [], $content = null, $tag = '') {

      ob_start();
      mybooking_engine_get_template('mybooking-plugin-summary.php');
      return ob_get_clean();

    }

    /**
     * Mybooking rent engine Complete shortcode
     */
    public function wp_reservation_shortcode($atts = [], $content = null, $tag = '') {

      ob_start();
      mybooking_engine_get_template('mybooking-plugin-reservation.php');
      return ob_get_clean();

    }

    // ----- Products

    /**
     * Mybooking product
     */
    public function wp_rent_product_shortcode($atts = [], $content = null, $tag = '') {

      // Extract the shortcode attributes
      extract( shortcode_atts( array('code' => '',
                                     'sales_channel_code' => '',
                                     'rental_location_code' => ''), $atts ) );

      $data = array();
      $data['code'] = $code;
      if ( $sales_channel_code != '' ) {
        $data['sales_channel_code'] = $sales_channel_code;
      }
      if ( $rental_location_code != '' ) {
        $data['rental_location_code'] = $rental_location_code;
      }

      ob_start();
      mybooking_engine_get_template('mybooking-plugin-product-widget.php', $data);
      return ob_get_clean();

    }

    /**
     * Mybooking products
     */
    public function wp_rent_products_shortcode($atts = [], $content = null, $tag = '') {

      // Get the page and the limit from the request parameters
      $opts = $this->wp_products_extract_query_string();
      $page = array_key_exists('offsetpage', $_GET) ? filter_input( INPUT_GET, 'offsetpage', FILTER_VALIDATE_INT ) : 1;
      $limit = array_key_exists('limit', $_GET) ? filter_input( INPUT_GET, 'limit', FILTER_VALIDATE_INT ) : 12;
      if ( is_null($page) || $page === false ) {
        $page = 1;
      }
      if ( is_null($limit) || $limit === false || $limit > 12 ) {
        $limit = 12;
      }
      // Build the offset
      $offset = ($page - 1) * $limit;

      // URL for pagination
      if ($this->get_current_page() != null) {
        $url = mybooking_engine_translated_slug( $this->get_current_page()->post_name );
      }
      else {
        $url = null;
      }


      // Get the products from the API
      $registry = Mybooking_Registry::getInstance();
      $api_client = new MybookingApiClient($registry->mybooking_rent_plugin_api_url_prefix,
                                           $registry->mybooking_rent_plugin_api_key);
      $data =$api_client->get_products( $offset, $limit, $opts );
      if ( $data == null) {
        $data = (object) array('total' => 0,
                               'offset' => 0,
                               'data' => []);
      }

      // Prepare url_detail
      $current_locale = MyBookingEngineContext::getInstance()->getCurrentLanguageCode();
      $site_locale = MyBookingEngineContext::getInstance()->getDefaultLanguageCode();
      $url_detail = get_site_url();
      $url_detail = $url_detail.'/';
      if ($current_locale != $site_locale) {
        $url_detail = $url_detail.$current_locale.'/';
      }
      $url_detail = $url_detail.($registry->mybooking_rent_plugin_navigation_products_url ? $registry->mybooking_rent_plugin_navigation_products_url : 'products');

      // Pagination
      $total_pages = ceil($data->total / $limit);
      $current_page = floor($data->offset / $limit) + 1;
      $pagination = new MyBookingUIPagination();
      $pages = $pagination->pages($total_pages, $current_page);
      $querystring = $this->wp_products_build_query_string();
      if ( !empty($querystring) ) {
        $querystring = '&'.$querystring;
      }

      $data = array('data' => $data,
                    'total_pages' => $total_pages,
                    'current_page' => $current_page,
                    'pages' => $pages,
                    'url' => $url,
                    'use_detail_pages' => $registry->mybooking_rent_plugin_detail_pages,
                    'url_detail' => $url_detail,
                    'querystring' => $querystring );
      ob_start();
      mybooking_engine_get_template('mybooking-plugin-products.php', $data);
      return ob_get_clean();

    }

    /**
     * Mybooking search shortcode
     */
    public function wp_rent_products_search_shortcode($atts = [], $content = null, $tag = '') {

      // Get the query parameters
      $data = $this->wp_products_extract_query_string();

      ob_start();
      mybooking_engine_get_template('mybooking-plugin-products-search.php', $data);
      return ob_get_clean();

    }

    // ----- Activities

    /**
     * Mybooking search shortcode
     */
    public function wp_activities_search_shortcode($atts = [], $content = null, $tag = '') {

      // Get the query parameters
      $data = $this->wp_activities_extract_query_string();

      ob_start();
      mybooking_engine_get_template('mybooking-plugin-activities-search.php', $data);
      return ob_get_clean();

    }

    /**
     * Mybooking activities shortcode
     */
    public function wp_activities_activities_shortcode($atts = [], $content = null, $tag = '') {

      // Get the query, page and the limit from the request parameters
      $destination_id = array_key_exists('destination_id', $_GET) ? filter_input(INPUT_GET, 'destination_id', FILTER_VALIDATE_INT) : null;
      $family_id = array_key_exists('family_id', $_GET) ? filter_input(INPUT_GET, 'family_id', FILTER_VALIDATE_INT) : null;
      $q = array_key_exists('q', $_GET) ? filter_input(INPUT_GET, 'q', FILTER_SANITIZE_ENCODED) : '';
      $page = array_key_exists('offsetpage', $_GET) ? filter_input( INPUT_GET, 'offsetpage', FILTER_VALIDATE_INT ) : 1;
      $limit = array_key_exists('limit', $_GET) ? filter_input( INPUT_GET, 'limit', FILTER_VALIDATE_INT ) : 12;
      if ( is_null($page) || $page === false ) {
        $page = 1;
      }
      if ( is_null($limit) || $limit === false || $limit > 12 ) {
        $limit = 12;
      }
      // Build the offset
      $offset = ($page - 1) * $limit;

      // URL for pagination
      if ($this->get_current_page() != null) {
        //$url = $this->get_current_page()->post_name;
        $url = mybooking_engine_translated_slug( $this->get_current_page()->post_name );
      }
      else {
        $url = null;
      }

      // Get the products from the API
      $registry = Mybooking_Registry::getInstance();
      $api_client = new MyBookingActivitiesApiClient($registry->mybooking_rent_plugin_api_url_prefix,
                                                     $registry->mybooking_rent_plugin_api_key);
      $data =$api_client->get_activities($destination_id, $family_id, $q, $offset, $limit);
      if ( $data == null) {
        $data = (object) array('total' => 0,
                               'offset' => 0,
                               'data' => []);
      }

      // Prepare url_detail
      $current_locale = MyBookingEngineContext::getInstance()->getCurrentLanguageCode();
      $site_locale = MyBookingEngineContext::getInstance()->getDefaultLanguageCode();
      $url_detail = get_site_url();
      $url_detail = $url_detail.'/';
      if ($current_locale != $site_locale) {
        $url_detail = $url_detail.$current_locale.'/';
      }
      $url_detail = $url_detail.($registry->mybooking_rent_plugin_navigation_activities_url ? $registry->mybooking_rent_plugin_navigation_activities_url : 'activities');

      // Pagination
      $total = $data->total;
      $total_pages = ceil($data->total / $limit);
      $current_page = floor($data->offset / $limit) + 1;
      $pagination = new MyBookingUIPagination();
      $pages = $pagination->pages($total_pages, $current_page);
      $querystring = $this->wp_activities_build_query_string();
      if ( !empty($querystring) ) {
        $querystring = '&'.$querystring;
      }

      $data = array('total' => $total,
                    'data' => $data,
                    'total_pages' => $total_pages,
                    'current_page' => $current_page,
                    'pages' => $pages,
                    'url' => $url,
                    'use_detail_pages' => $registry->mybooking_activities_plugin_detail_pages,
                    'url_detail' => $url_detail,
                    'querystring' => $querystring );
      ob_start();
      mybooking_engine_get_template('mybooking-plugin-activities.php', $data);
      return ob_get_clean();

    }

    // -- Activities

    /**
     * Mybooking activities engine Activity shortcode
     *
     * Attributes:
     * -----------
     * activity_id:: Show the activity selector for the activity Id
     */
    public function wp_activities_activity_shortcode($atts = [], $content = null, $tag = '') {

      // Extract the shortcode attributes
      extract( shortcode_atts( array('activity_id' => '' ), $atts ) );

      // If the shortcode attributes include activity_id and it is not null load the data
      if ( $activity_id != '' ) {
        $data = array(
            'activity_id' => $activity_id,
        );

        ob_start();
        mybooking_engine_get_template('mybooking-plugin-activities-activity-widget.php', $data);
        return ob_get_clean();
      }

    }

    /**
     * Mybooking activities engine Shopping Cart shortcode
     */
    public function wp_activities_shopping_cart_shortcode($atts = [], $content = null, $tag = '') {

      ob_start();
      mybooking_engine_get_template('mybooking-plugin-activities-shopping-cart.php');
      return ob_get_clean();

    }

    /**
     * Mybooking activities engine Summary shortcode
     */
    public function wp_activities_summary_shortcode($atts = [], $content = null, $tag = '') {

      ob_start();
      mybooking_engine_get_template('mybooking-plugin-activities-summary.php');
      return ob_get_clean();

    }

    /**
     * Mybooking activities engine Order shortcode
     */
    public function wp_activities_order_shortcode($atts = [], $content = null, $tag = '') {

      ob_start();
      mybooking_engine_get_template('mybooking-plugin-activities-order.php');
      return ob_get_clean();

    }

    /**
     * Mybooking Contact shortcode
     */
    public function wp_contact_shortcode($atts = [], $content = null, $tag = '') {

      // == Extract the shortcode attributes
      extract( shortcode_atts( array('subject' => '',
                                     'source' => '',
                                     'sales_channel_code' => '',
                                     'rental_location_code' => ''), $atts ) );
      $data = array();

      // Subject
      if ( $subject != '' ) {
        $data['subject'] = $subject;
      }

      // Source
      if ( $source != '' ) {
        $data['source'] = $source;
      }

      // Sales Channel
      if ( $sales_channel_code != '' ) {
        $data['sales_channel_code'] = $sales_channel_code;
      }

      // Rental location code
      if ( $rental_location_code != '' ) {
        $data['rental_location_code'] = $rental_location_code;
      }

      // Get Google API Captcha
      $registry = Mybooking_Registry::getInstance();
      if ( $registry->mybooking_rent_plugin_contact_form_use_google_captcha &&
           !empty( $registry->mybooking_rent_plugin_contact_form_google_captcha_api_key ) ) {
        $data['google_captcha_api_key'] = $registry->mybooking_rent_plugin_contact_form_google_captcha_api_key;
      }

      ob_start();
      mybooking_engine_get_template('mybooking-plugin-contact-widget.php', $data);
      return ob_get_clean();

    }

    /**
     * MyBooking Password Forgotten shortcode
     *
     */
    public function wp_password_forgotten_shortcode($atts = [], $content = null, $tag = '') {

      ob_start();
      mybooking_engine_get_template('mybooking-plugin-profile-password-forgotten.php');
      return ob_get_clean();

    }

    /**
     * MyBooking Change password shortcode
     */
    public function wp_change_password_shortcode($atts = [], $content = null, $tag = '') {

      ob_start();
      mybooking_engine_get_template('mybooking-plugin-profile-change-password.php');
      return ob_get_clean();

    }

    /**
     * Mybooking Testimonials shortcode
     */
    public function wp_testimonials_shortcode($atts = [], $content = null, $tag = '') {

      ob_start();
      mybooking_engine_get_template('mybooking-plugin-testimonials.php');
      return ob_get_clean();

    }

    // ------------ Support methods --------------------

    /**
     * Extract Query String parameters for products
     *
     * @returns [Array] with the following elements:
     *
     *  - family_id
     *  - key_characteristic_1
     *  - key_characteristic_2
     *  - key_characteristic_3
     *  - key_characteristic_4
     *  - key_characteristic_5
     *  - key_characteristic_6
     *
     */
    private function wp_products_extract_query_string() {

      // Get the query parameter
      $family_id = array_key_exists('family_id', $_GET) ? filter_input(INPUT_GET, 'family_id', FILTER_VALIDATE_INT) : null;
      $key_characteristic_1 = array_key_exists('key_characteristic_1', $_GET) ? filter_input(INPUT_GET, 'key_characteristic_1', FILTER_VALIDATE_INT) : null;
      $key_characteristic_2 = array_key_exists('key_characteristic_2', $_GET) ? filter_input(INPUT_GET, 'key_characteristic_2', FILTER_VALIDATE_INT) : null;
      $key_characteristic_3 = array_key_exists('key_characteristic_3', $_GET) ? filter_input(INPUT_GET, 'key_characteristic_3', FILTER_VALIDATE_INT) : null;
      $key_characteristic_4 = array_key_exists('key_characteristic_4', $_GET) ? filter_input(INPUT_GET, 'key_characteristic_4', FILTER_VALIDATE_INT) : null;
      $key_characteristic_5 = array_key_exists('key_characteristic_5', $_GET) ? filter_input(INPUT_GET, 'key_characteristic_5', FILTER_VALIDATE_INT) : null;
      $key_characteristic_6 = array_key_exists('key_characteristic_6', $_GET) ? filter_input(INPUT_GET, 'key_characteristic_6', FILTER_VALIDATE_INT) : null;
      $price_range = array_key_exists('price_range', $_GET) ? filter_input(INPUT_GET, 'price_range', FILTER_VALIDATE_REGEXP,
        array("options" => array("regexp" => "/^[0-9]+-?[0-9]+?$/" ))) : null;
      // Build the result
      $data = array( );
      if ( !empty($family_id) ) {
        $data['family_id'] = $family_id;
      }
      if ( !empty($key_characteristic_1) ) {
        $data['key_characteristic_1'] = $key_characteristic_1;
      }
      if ( !empty($key_characteristic_2) ) {
        $data['key_characteristic_2'] = $key_characteristic_2;
      }
      if ( !empty($key_characteristic_3) ) {
        $data['key_characteristic_3'] = $key_characteristic_3;
      }
      if ( !empty($key_characteristic_4) ) {
        $data['key_characteristic_4'] = $key_characteristic_4;
      }
      if ( !empty($key_characteristic_5) ) {
        $data['key_characteristic_5'] = $key_characteristic_5;
      }
      if ( !empty($key_characteristic_6) ) {
        $data['key_characteristic_6'] = $key_characteristic_6;
      }
      if ( !empty($price_range) ) {
        $data['price_range'] = $price_range;
      }

      return $data;

    }

    /**
     * Build query string from Query string
     *
     */
    private function wp_products_build_query_string() {

      $result = '';
      $data = $this->wp_products_extract_query_string();
      foreach($data as $key => $value) {
        if ( !empty($result) ) {
          $result.='&';
        }
        if ( !empty($value) && is_int( $value ) ) {
          $result.=$key.'='.$value;
        }
        else if ( !empty($value) && is_string( $value ) ) {
          $result.=$key.'='.urlencode($value);
        }
      }

      return $result;

    }

    /**
     * Extract Query String parameters for activities
     *
     * @returns [Array] with the following elements:
     *
     *  - destination_id
     *  - family_id
     *  - q
     *
     */
    private function wp_activities_extract_query_string() {

      // Get the query parameter
      $destination_id = array_key_exists('destination_id', $_GET) ? filter_input(INPUT_GET, 'destination_id', FILTER_VALIDATE_INT) : null;
      $family_id = array_key_exists('family_id', $_GET) ? filter_input(INPUT_GET, 'family_id', FILTER_VALIDATE_INT) : null;
      $q = array_key_exists('q', $_GET) ? filter_input(INPUT_GET, 'q', FILTER_SANITIZE_ENCODED) : '';
      // Build the result
      $data = array( 'q' => urldecode($q) );
      if ( !empty($family_id) ) {
        $data['family_id'] = $family_id;
      }
      if ( !empty($destination_id) ) {
        $data['destination_id'] = $destination_id;
      }

      return $data;

    }

    /**
     * Build query string from Query string
     *
     */
    private function wp_activities_build_query_string() {

      $result = '';
      $data = $this->wp_activities_extract_query_string();
      foreach($data as $key => $value) {
        if ( !empty($result) ) {
          $result.='&';
        }
        if ( !empty($value) && is_int( $value ) ) {
          $result.=$key.'='.$value;
        }
        else if ( !empty($value) && is_string( $value ) ) {
          $result.=$key.'='.urlencode($value);
        }
      }

      return $result;

    }


    // ------------ Plugin setup -----------------------

    /**
     * Load the plugin options in the registry
     *
     * - mybooking_plugin_settings_connection
     * - mybooking_plugin_settings_configuration
     * - mybooking_plugin_settings_renting
     * - mybooking_plugin_settings_activities
     * - mybooking_plugin_settings_google_api_places
     * - mybooking_plugin_settings_complements
     * - mybooking_plugin_settings_css
     *
     */
    private function load_options() {

      $registry = Mybooking_Registry::getInstance();

      // Connection
      $settings = (array) get_option("mybooking_plugin_settings_connection");
      if ($settings && array_key_exists('mybooking_plugin_settings_account_id', $settings)) {
        $registry->mybooking_rent_plugin_account_id = trim(esc_attr( $settings["mybooking_plugin_settings_account_id"] ));
        if (filter_var($registry->mybooking_rent_plugin_account_id, FILTER_VALIDATE_URL)) {
          $registry->mybooking_rent_plugin_api_url_prefix = $registry->mybooking_rent_plugin_account_id;
        }
        else {
          $registry->mybooking_rent_plugin_api_url_prefix = 'https://'.$registry->mybooking_rent_plugin_account_id.'.mybooking.es';
        }
      }
      else {
        $registry->mybooking_rent_plugin_account_id = '';
        $registry->mybooking_rent_plugin_api_url_prefix = '';
      }
      if ($settings && array_key_exists('mybooking_plugin_settings_api_key', $settings)) {
        $registry->mybooking_rent_plugin_api_key = trim(esc_attr( $settings["mybooking_plugin_settings_api_key"] ));
      }
      else {
        $registry->mybooking_rent_plugin_api_key = '';
      }

      // Configuration
      $settings = (array) get_option("mybooking_plugin_settings_configuration");
      if ($settings && array_key_exists('mybooking_plugin_settings_google_api_places_selector', $settings)) {
        $registry->mybooking_plugin_google_api_places = (trim(esc_attr( $settings["mybooking_plugin_settings_google_api_places_selector"] )) == '1');
      }
      else {
        $registry->mybooking_plugin_google_api_places = false;
      }

      // Renting
      $settings = (array) get_option("mybooking_plugin_settings_renting");
      if ($settings && array_key_exists('mybooking_plugin_settings_choose_products_page', $settings)) {
        $registry->mybooking_rent_plugin_choose_products_page = $this->page_slug(trim(esc_attr( $settings["mybooking_plugin_settings_choose_products_page"] )));
      }
      else {
        $registry->mybooking_rent_plugin_choose_products_page = '';
      }

      if ($settings && array_key_exists('mybooking_plugin_settings_choose_products_page', $settings)) {
        $registry->mybooking_rent_plugin_choose_products_page = $this->page_slug(trim(esc_attr( $settings["mybooking_plugin_settings_choose_products_page"] )));
      }
      else {
        $registry->mybooking_rent_plugin_choose_products_page = '';
      }

      if ($settings && array_key_exists('mybooking_plugin_settings_choose_extras_page', $settings)) {
        $registry->mybooking_rent_plugin_choose_extras_page = $this->page_slug(trim(esc_attr( $settings["mybooking_plugin_settings_choose_extras_page"] )));
      }
      else {
        $registry->mybooking_rent_plugin_choose_extras_page = '';
      }

      if ($settings && array_key_exists('mybooking_plugin_settings_checkout_page', $settings)) {
        $registry->mybooking_rent_plugin_checkout_page = $this->page_slug(trim(esc_attr( $settings["mybooking_plugin_settings_checkout_page"] )));
      }
      else {
        $registry->mybooking_rent_plugin_checkout_page = '';
      }

      if ($settings && array_key_exists('mybooking_plugin_settings_summary_page', $settings)) {
        $registry->mybooking_rent_plugin_summary_page = $this->page_slug(trim(esc_attr( $settings["mybooking_plugin_settings_summary_page"] )));
      }
      else {
        $registry->mybooking_rent_plugin_summary_page = '';
      }

      if ($settings && array_key_exists('mybooking_plugin_settings_terms_page', $settings)) {
        $registry->mybooking_rent_plugin_terms_page = $this->page_slug(trim(esc_attr( $settings["mybooking_plugin_settings_terms_page"] )));
      }
      else {
        $registry->mybooking_rent_plugin_terms_page = '';
      }

      if ($settings && array_key_exists('mybooking_plugin_settings_selector_in_process', $settings)) {
        $registry->mybooking_rent_plugin_selector_in_process = $settings["mybooking_plugin_settings_selector_in_process"] ? $settings["mybooking_plugin_settings_selector_in_process"] : 'form';
      }
      else {
        $registry->mybooking_rent_plugin_selector_in_process = 'form';
      }

      if ($settings && array_key_exists('mybooking_plugin_settings_show_taxes_included', $settings)) {
        $registry->mybooking_rent_plugin_show_taxes_included = (trim(esc_attr( $settings["mybooking_plugin_settings_show_taxes_included"] )) == '1');
      }
      else {
        $registry->mybooking_rent_plugin_show_taxes_included = false;
      }

      if ($settings && array_key_exists('mybooking_plugin_settings_rental_location_context', $settings)) {
        $registry->mybooking_rent_plugin_rental_location_context = $settings["mybooking_plugin_settings_rental_location_context"] ? $settings["mybooking_plugin_settings_rental_location_context"] : 'branch_office';
      }
      else {
        $registry->mybooking_rent_plugin_rental_location_context = 'family';
      }

      if ($settings && array_key_exists('mybooking_plugin_settings_family_context', $settings)) {
        $registry->mybooking_rent_plugin_family_context = $settings["mybooking_plugin_settings_family_context"] ? $settings["mybooking_plugin_settings_family_context"] : 'family';
      }
      else {
        $registry->mybooking_rent_plugin_family_context = 'family';
      }

      if ($settings && array_key_exists('mybooking_plugin_settings_product_context', $settings)) {
        $registry->mybooking_rent_plugin_product_context = $settings["mybooking_plugin_settings_product_context"] ? $settings["mybooking_plugin_settings_product_context"] : 'product';
      }
      else {
        $registry->mybooking_rent_plugin_product_context = 'product';
      }

      if ($settings && array_key_exists('mybooking_plugin_settings_dates_context', $settings)) {
        $registry->mybooking_rent_plugin_dates_context = $settings["mybooking_plugin_settings_dates_context"] ? $settings["mybooking_plugin_settings_dates_context"] : 'pickup-return';
      }
      else {
        $registry->mybooking_rent_plugin_dates_context = 'pickup-return';
      }

      if ($settings && array_key_exists('mybooking_plugin_settings_not_available_context', $settings)) {
        $registry->mybooking_rent_plugin_not_available_context = $settings["mybooking_plugin_settings_not_available_context"] ? $settings["mybooking_plugin_settings_not_available_context"] : 'not-available';
      }
      else {
        $registry->mybooking_rent_plugin_not_available_context = 'not-available';
      }

      if ($settings && array_key_exists('mybooking_plugin_settings_duration_context', $settings)) {
        $registry->mybooking_rent_plugin_duration_context = $settings["mybooking_plugin_settings_duration_context"] ? $settings["mybooking_plugin_settings_duration_context"] : 'days';
      }
      else {
        $registry->mybooking_rent_plugin_duration_context = 'days';
      }

      if ($settings && array_key_exists('mybooking_plugin_settings_use_product_detail_pages', $settings)) {
        $registry->mybooking_rent_plugin_detail_pages = (trim(esc_attr( $settings["mybooking_plugin_settings_use_product_detail_pages"] )) == '1');
      }
      else {
        $registry->mybooking_rent_plugin_detail_pages = false;
      }

      if ($settings && array_key_exists('mybooking_plugin_settings_products_url', $settings)) {
        $registry->mybooking_rent_plugin_navigation_products_url = $settings["mybooking_plugin_settings_products_url"] ? $settings["mybooking_plugin_settings_products_url"] : 'products';
      }
      else {
        $registry->mybooking_rent_plugin_navigation_products_url = 'products';
      }

      // Activities
      $settings = (array) get_option("mybooking_plugin_settings_activities");
      if ($settings && array_key_exists('mybooking_plugin_settings_activities_shopping_cart_page', $settings)) {
        $registry->mybooking_activities_plugin_shopping_cart_page = $this->page_slug(trim(esc_attr( $settings["mybooking_plugin_settings_activities_shopping_cart_page"] )));
      }
      else {
        $registry->mybooking_activities_plugin_shopping_cart_page = '';
      }

      if ($settings && array_key_exists('mybooking_plugin_settings_activities_summary_page', $settings)) {
        $registry->mybooking_activities_plugin_summary_page = $this->page_slug(trim(esc_attr( $settings["mybooking_plugin_settings_activities_summary_page"] )));
      }
      else {
        $registry->mybooking_activities_plugin_summary_page = '';
      }

      if ($settings && array_key_exists('mybooking_plugin_settings_activities_terms_page', $settings)) {
        $registry->mybooking_activities_plugin_terms_page = $this->page_slug(trim(esc_attr( $settings["mybooking_plugin_settings_activities_terms_page"] )));
      }
      else {
        $registry->mybooking_activities_plugin_terms_page = '';
      }

      if ($settings && array_key_exists('mybooking_plugin_settings_use_activities_detail_pages', $settings)) {
        $registry->mybooking_activities_plugin_detail_pages = (trim(esc_attr( $settings["mybooking_plugin_settings_use_activities_detail_pages"] )) == '1');
      }
      else {
        $registry->mybooking_activities_plugin_detail_pages = false;
      }

      if ($settings && array_key_exists('mybooking_plugin_settings_activities_url', $settings)) {
        $registry->mybooking_rent_plugin_navigation_activities_url = $settings["mybooking_plugin_settings_activities_url"] ? $settings["mybooking_plugin_settings_activities_url"] : 'activities';
      }
      else {
        $registry->mybooking_rent_plugin_navigation_activities_url = 'activities';
      }

      // Google Places API
      $settings = (array) get_option("mybooking_plugin_settings_google_api_places");
      if ($settings && array_key_exists('mybooking_plugin_settings_google_api_places_api_key', $settings)) {
        $registry->mybooking_plugin_google_api_places_api_key = trim(esc_attr( $settings["mybooking_plugin_settings_google_api_places_api_key"] ));
      }
      else {
        $registry->mybooking_plugin_google_api_places_api_key = null;
      }
      if ($settings && array_key_exists('mybooking_plugin_settings_google_api_places_restrict_country_code', $settings)) {
        $registry->mybooking_plugin_google_api_places_restrict_country_code = trim(esc_attr( $settings["mybooking_plugin_settings_google_api_places_restrict_country_code"] ));
      }
      else {
        $registry->mybooking_plugin_google_api_places_restrict_country_code = null;
      }
      if ($settings && array_key_exists('mybooking_plugin_settings_google_api_places_restrict_bounds', $settings)) {
        $registry->mybooking_plugin_google_api_places_restrict_bounds = (trim(esc_attr( $settings["mybooking_plugin_settings_google_api_places_restrict_bounds"] )) == '1');
      }
      else {
        $registry->mybooking_plugin_google_api_places_restrict_bounds = false;
      }
      if ($settings && array_key_exists('mybooking_plugin_settings_google_api_places_bounds_sw_lat', $settings)) {
        $registry->mybooking_plugin_google_api_places_bounds_sw_lat = floatval(trim(esc_attr( $settings["mybooking_plugin_settings_google_api_places_bounds_sw_lat"] )));
      }
      else {
        $registry->mybooking_plugin_google_api_places_bounds_sw_lat = null;
      }
      if ($settings && array_key_exists('mybooking_plugin_settings_google_api_places_bounds_sw_lng', $settings)) {
        $registry->mybooking_plugin_google_api_places_bounds_sw_lng = floatval(trim(esc_attr( $settings["mybooking_plugin_settings_google_api_places_bounds_sw_lng"] )));
      }
      else {
        $registry->mybooking_plugin_google_api_places_bounds_sw_lng = null;
      }
      if ($settings && array_key_exists('mybooking_plugin_settings_google_api_places_bounds_ne_lat', $settings)) {
        $registry->mybooking_plugin_google_api_places_bounds_ne_lat = trim(esc_attr( $settings["mybooking_plugin_settings_google_api_places_bounds_ne_lat"] ));
      }
      else {
        $registry->mybooking_plugin_google_api_places_bounds_ne_lat = null;
      }
      if ($settings && array_key_exists('mybooking_plugin_settings_google_api_places_bounds_ne_lng', $settings)) {
        $registry->mybooking_plugin_google_api_places_bounds_ne_lng = trim(esc_attr( $settings["mybooking_plugin_settings_google_api_places_bounds_ne_lng"] ));
      }
      else {
        $registry->mybooking_plugin_google_api_places_bounds_ne_lng = null;
      }

      // == Contact Form
      $registry->mybooking_rent_plugin_contact_form_use_google_captcha = false;
      $registry->mybooking_rent_plugin_contact_form_include_google_captcha_js = false;
      $registry->mybooking_rent_plugin_contact_form_google_captcha_api_key = null;
      $settings = (array) get_option("mybooking_plugin_settings_contact_form");

      // Use Google Captcha on Contact Form
      if ( $settings && array_key_exists("mybooking_plugin_settings_contact_form_use_google_captcha", $settings) ) {
        $registry->mybooking_rent_plugin_contact_form_use_google_captcha = (trim(esc_attr( $settings["mybooking_plugin_settings_contact_form_use_google_captcha"] )) == '1');
        if ( $registry->mybooking_rent_plugin_contact_form_use_google_captcha ) {
          // Google Captcha API Key
          if ( $settings && array_key_exists("mybooking_plugin_settings_contact_form_google_captcha_api_key", $settings) ) {
            $registry->mybooking_rent_plugin_contact_form_google_captcha_api_key = trim(esc_attr( $settings["mybooking_plugin_settings_contact_form_google_captcha_api_key"] ));
            if ( !empty( $registry->mybooking_rent_plugin_contact_form_google_captcha_api_key ) ) {
              // Include google captcha JS
              if ( $settings && array_key_exists("mybooking_plugin_settings_contact_form_include_google_captcha_js", $settings) ) {
                $registry->mybooking_rent_plugin_contact_form_include_google_captcha_js = (trim(esc_attr( $settings["mybooking_plugin_settings_contact_form_include_google_captcha_js"] )) == '1');
              }
            }
          }
        }
      }

      // == Complements
      $settings = (array) get_option("mybooking_plugin_settings_complements");
      // Popups
      if ($settings && array_key_exists('mybooking_plugin_settings_complements_popup', $settings)) {
        $registry->mybooking_rent_plugin_complements_popup = (trim(esc_attr( $settings["mybooking_plugin_settings_complements_popup"] )) == '1');
      }
      else {
        $registry->mybooking_rent_plugin_complements_popup = '';
      }
      // Testimonials
      if ($settings && array_key_exists('mybooking_plugin_settings_complements_testimonials', $settings)) {
        $registry->mybooking_rent_plugin_complements_testimonials = (trim(esc_attr( $settings["mybooking_plugin_settings_complements_testimonials"] )) == '1');
      }
      else {
        $registry->mybooking_rent_plugin_complements_testimonials = '';
      }
      // Catalog
      if ($settings && array_key_exists('mybooking_plugin_settings_complements_renting_item', $settings)) {
        $registry->mybooking_rent_plugin_complements_renting_item = (trim(esc_attr( $settings["mybooking_plugin_settings_complements_renting_item"] )) == '1');
      }
      else {
        $registry->mybooking_rent_plugin_complements_renting_item = '';
      }
      // Service
      if ($settings && array_key_exists('mybooking_plugin_settings_complements_activity_item', $settings)) {
        $registry->mybooking_rent_plugin_complements_activity_item = (trim(esc_attr( $settings["mybooking_plugin_settings_complements_activity_item"] )) == '1');
      }
      else {
        $registry->mybooking_rent_plugin_complements_activity_item = '';
      }
      // Cookies
      if ($settings && array_key_exists('mybooking_plugin_settings_complements_cookies_notice', $settings)) {
        $registry->mybooking_rent_plugin_complements_cookies_notice = (trim(esc_attr( $settings["mybooking_plugin_settings_complements_cookies_notice"] )) == '1');
      }
      else {
        $registry->mybooking_rent_plugin_complements_cookies_notice = '';
      }

      // == CSS
      $settings = (array) get_option("mybooking_plugin_settings_css");

      // Include CSS
      if ($settings && array_key_exists('mybooking_plugin_settings_custom_css', $settings)) {
        $registry->mybooking_rent_plugin_custom_css = (trim(esc_attr( $settings["mybooking_plugin_settings_custom_css"] )) == '1');
      }
      else {
        $registry->mybooking_rent_plugin_custom_css = '1';
      }

      // Include Bootstrap
      if ($settings && array_key_exists('mybooking_plugin_settings_components_css', $settings)) {
        $registry->mybooking_rent_plugin_components_css = (trim(esc_attr( $settings["mybooking_plugin_settings_components_css"] )) == '1');
      }
      else {
        $registry->mybooking_rent_plugin_components_css = '1';
      }

      // Include FontAwesome
      if ($settings && array_key_exists('mybooking_plugin_settings_components_css_fontawesome', $settings)) {
        $registry->mybooking_rent_plugin_css_fontawesome = (trim(esc_attr( $settings["mybooking_plugin_settings_components_css_fontawesome"] )) == '1');
      }
      else {
        $registry->mybooking_rent_plugin_css_fontawesome = '1';
      }

      // Include SlickJS
      if ($settings && array_key_exists('mybooking_plugin_settings_components_js_slickjs', $settings)) {
        $registry->mybooking_rent_plugin_js_slickjs = (trim(esc_attr( $settings["mybooking_plugin_settings_components_js_slickjs"] )) == '1');
      }
      else {
        $registry->mybooking_rent_plugin_js_slickjs = '1';
      }

      // Custom Loader
      if ($settings && array_key_exists('mybooking_plugin_settings_components_custom_loader', $settings)) {
        $registry->mybooking_rent_plugin_custom_loader = (trim(esc_attr( $settings["mybooking_plugin_settings_components_custom_loader"] )) == '1');
      }
      else {
        $registry->mybooking_rent_plugin_custom_loader = '';
      }
      // JS Select 2
      if ($settings && array_key_exists('mybooking_plugin_settings_components_js_use_select2', $settings)) {
        $registry->mybooking_plugin_js_select2 = (trim(esc_attr( $settings["mybooking_plugin_settings_components_js_use_select2"] )) == '1');
      }
      else {
        $registry->mybooking_plugin_js_select2 = '';
      }
      // JS BS Modal No Conflict
      if ($settings && array_key_exists('mybooking_plugin_settings_components_js_bs_modal_no_conflict', $settings)) {
        $registry->mybooking_plugin_js_bs_modal_no_conflict = (trim(esc_attr( $settings["mybooking_plugin_settings_components_js_bs_modal_no_conflict"] )) == '1');
      }
      else {
        $registry->mybooking_plugin_js_bs_modal_no_conflict = '';
      }
      // JS BS backdrop compatibility
      if ($settings && array_key_exists('mybooking_plugin_settings_components_js_bs_modal_backdrop_compatibility', $settings)) {
        $registry->mybooking_plugin_js_bs_modal_backdrop_compatibility = (trim(esc_attr( $settings["mybooking_plugin_settings_components_js_bs_modal_backdrop_compatibility"] )) == '1');
      }
      else {
        $registry->mybooking_plugin_js_bs_modal_backdrop_compatibility = '';
      }

    }

    // ------------ Custom routes ---------------------

    /**
     * Initialize custom routes to show all renting products and activities
     */
    public function init_routes() {

      $registry = Mybooking_Registry::getInstance();


      // Renting product detail route (depends on the settings)
      if ( $registry->mybooking_rent_plugin_detail_pages ) {
        $url = $registry->mybooking_rent_plugin_navigation_products_url ? $registry->mybooking_rent_plugin_navigation_products_url : 'products';
        Routes::map($url.'/:id', function($params) {
          $this->product_page($params);
        });
        Routes::map(':lang/'.$url.'/:id', function($params) {
          $this->product_page($params);
        });
      }

      // Activity detail route (depends on the settings)
      if ( $registry->mybooking_activities_plugin_detail_pages ) {
        $url = $registry->mybooking_rent_plugin_navigation_activities_url ? $registry->mybooking_rent_plugin_navigation_activities_url : 'activities';
        Routes::map($url.'/:id', function($params) {
          $this->activity_page($params);
        });
        Routes::map(':lang/'.$url.'/:id', function($params) {
          $this->activity_page($params);
        });
      }


    }

    /**
     * Create custom post types
     */
    public function create_custom_post_types() {

      // Get the registry information
      $registry = Mybooking_Registry::getInstance();
      if ($registry->mybooking_rent_plugin_complements_popup == '1') {
        add_action( 'init', 'create_popup' );
          register_post_type( 'popup',
          array(
            'labels' => array(
              'name' => _x('Popup ads', 'popup_content', 'mybooking-wp-plugin'),
              'singular_name' => _x('Popup ad', 'popup_content', 'mybooking-wp-plugin'),
              'add_new' => _x('Add popup ad', 'popup_content', 'mybooking-wp-plugin'),
              'add_new_item' => _x('New popup ad', 'popup_content', 'mybooking-wp-plugin'),
              'edit' => _x('Edit', 'popup_content', 'mybooking-wp-plugin'),
              'edit_item' => _x('Edit popup ad', 'popup_content', 'mybooking-wp-plugin'),
              'new_item' => _x('New popup ad', 'popup_content', 'mybooking-wp-plugin'),
              'view' => _x('See', 'popup_content', 'mybooking-wp-plugin'),
              'view_item' => _x('See popup ad', 'popup_content', 'mybooking-wp-plugin'),
              'search_items' => _x('Search popup ad', 'popup_content', 'mybooking-wp-plugin'),
              'not_found' => _x('No popup ad found', 'popup_content', 'mybooking-wp-plugin'),
              'not_found_in_trash' => _x('No popup ad on bin', 'popup_content',  'mybooking-wp-plugin'),
              'parent' => _x('Parent popup ad','popup_content',  'mybooking-wp-plugin')
            ),
            'show_ui' => true,
            'public' => true,
            'show_in_menu' => 'mybooking-plugin-configuration',
            'show_in_rest' => true, // Gutenberg activation!
            'supports' => array( 'title', 'editor', 'thumbnail' ),
            'menu_icon' => 'dashicons-awards',
            'has_archive' => true
          )
        );
      }
      if ($registry->mybooking_rent_plugin_complements_testimonials == '1') {
        register_post_type( 'testimonial',
          array(
            'labels' => array(
              'name' => _x('Testimonials', 'testimonial_content', 'mybooking-wp-plugin'),
              'singular_name' => _x('Testimonial', 'testimonial_content', 'mybooking-wp-plugin'),
              'add_new' => _x('Add testimonial', 'testimonial_content', 'mybooking-wp-plugin'),
              'add_new_item' => _x('New testimonial', 'testimonial_content', 'mybooking-wp-plugin'),
              'edit' => _x('Edit', 'testimonial_content', 'mybooking-wp-plugin'),
              'edit_item' => _x('Edit testimonial', 'testimonial_content', 'mybooking-wp-plugin'),
              'new_item' => _x('New testimonial', 'testimonial_content', 'mybooking-wp-plugin'),
              'view' => _x('See', 'testimonial_content', 'mybooking-wp-plugin'),
              'view_item' => _x('See testimonial', 'testimonial_content', 'mybooking-wp-plugin'),
              'search_items' => _x('Search testimonial', 'testimonial_content', 'mybooking-wp-plugin'),
              'not_found' => _x('No testimonial found', 'testimonial_content', 'mybooking-wp-plugin'),
              'not_found_in_trash' => _x('No testimonial found on bin', 'testimonial_content', 'mybooking-wp-plugin'),
              'parent' => _x('Parent testimonial', 'testimonial_content', 'mybooking-wp-plugin')
            ),
            'show_ui' => true,
            'public' => true,
            'show_in_menu' => 'mybooking-plugin-configuration',
            'show_in_rest' => true, // Gutenberg activation!
            'supports' => array( 'title', 'editor', 'thumbnail' ),
            'menu_icon' => 'dashicons-format-quote',
            'has_archive' => true
          )
        );
      }
      if ($registry->mybooking_rent_plugin_complements_renting_item == '1') {
        register_post_type( 'mybooking_renting_item',
          array(
            'labels' => array(
              'name' => _x('Renting Items', 'renting_item_content', 'mybooking-wp-plugin'),
              'singular_name' => _x('Renting Item', 'renting_item_content', 'mybooking-wp-plugin'),
              'add_new' => _x('Add renting item', 'renting_item_content', 'mybooking-wp-plugin'),
              'add_new_item' => _x('New renting item', 'renting_item_content', 'mybooking-wp-plugin'),
              'edit' => _x('Edit', 'renting_item_content', 'mybooking-wp-plugin'),
              'edit_item' => _x('Edit renting item', 'renting_item_content', 'mybooking-wp-plugin'),
              'new_item' => _x('New renting item', 'renting_item_content', 'mybooking-wp-plugin'),
              'view' => _x('See', 'renting_item_content', 'mybooking-wp-plugin'),
              'view_item' => _x('See renting item', 'renting_item_content', 'mybooking-wp-plugin'),
              'search_items' => _x('Search renting item', 'renting_item_content', 'mybooking-wp-plugin'),
              'not_found' => _x('No renting item found', 'renting_item_content', 'mybooking-wp-plugin'),
              'not_found_in_trash' => _x('No renting item found on bin', 'renting_item_content', 'mybooking-wp-plugin'),
              'parent' => _x('Parent renting item', 'renting_item_content', 'mybooking-wp-plugin')
            ),
            'show_ui' => true,
            'public' => true,
            'show_in_menu' => 'mybooking-plugin-configuration',
            'show_in_rest' => true, // Gutenberg activation!
            'supports' => array( 'title', 'editor', 'thumbnail' ),
            'menu_icon' => 'dashicons-grid-view',
            'has_archive' => true
          )
        );
      }
      if ($registry->mybooking_rent_plugin_complements_activity_item == '1') {
        register_post_type( 'mybooking_activity_item',
          array(
            'labels' => array(
              'name' => _x('Activity Items', 'activity_item_content', 'mybooking-wp-plugin'),
              'singular_name' => _x('Activity Item', 'activity_item_content', 'mybooking-wp-plugin'),
              'add_new' => _x('Add activity item', 'activity_item_content', 'mybooking-wp-plugin'),
              'add_new_item' => _x('New activity item', 'activity_item_content', 'mybooking-wp-plugin'),
              'edit' => _x('Edit', 'activity_item_content', 'mybooking-wp-plugin'),
              'edit_item' => _x('Edit activity item', 'activity_item_content', 'mybooking-wp-plugin'),
              'new_item' => _x('New activity item', 'activity_item_content', 'mybooking-wp-plugin'),
              'view' => _x('See', 'activity_item_content', 'mybooking-wp-plugin'),
              'view_item' => _x('See activity item', 'activity_item_content', 'mybooking-wp-plugin'),
              'search_items' => _x('Search activity item', 'activity_item_content', 'mybooking-wp-plugin'),
              'not_found' => _x('No activity_item found', 'activity_item_content', 'mybooking-wp-plugin'),
              'not_found_in_trash' => _x('No activity item found on bin', 'activity_item_content', 'mybooking-wp-plugin'),
              'parent' => _x('Parent activity item', 'activity_item_content', 'mybooking-wp-plugin')
            ),
            'show_ui' => true,
            'public' => true,
            'show_in_menu' => 'mybooking-plugin-configuration',
            'show_in_rest' => true, // Gutenberg activation!
            'supports' => array( 'title', 'editor', 'thumbnail' ),
            'menu_icon' => 'dashicons-grid-view',
            'has_archive' => true
          )
        );
      }

    }

    /**
     * Load the product page
     */
    function product_page($params) {

          // Get the product code
          $code = $params['id'];

          $ui_products = new MyBookingUIPages();
          $ui_products->product($code);

    }

    /**
     * Load the activity page
     */
    function activity_page($params) {

          // Get the product code
          $code = $params['id'];

          $ui_products = new MyBookingUIActivitiesPages();
          $ui_products->activity($code);

    }

    // ----------------- Utilities --------------------------------------------

    /**
     * Get the current page content
     */
    private function getCurrentPageContent() {

      $current_page = $this->get_current_page();
      $content = '';
      if ( !is_null( $current_page ) && property_exists($current_page, 'post_content') ) {
        $content = $this->get_current_page()->post_content;
        // Check also post_excerpt for short
        if ( property_exists($current_page, 'post_excerpt')) {
          if ( empty($content) ) {
            $content = '';
          }
          $content = $content.$this->get_current_page()->post_excerpt;
        }
      }

      return $content;

    }

    /**
     * Get the current page
     *
     * Accessing to the current page has been changed from global $post to
     * get_queried_object() because some plugins/themes components may be
     * running queries on custom post types alter the global $post
     *
     * $wp_the_query seems tring to remain first WP_Query but 'custom loop' overrides
     * $wp_the_query->post and $wp_the_query->posts.
     *
     * Example of 'custom loop' :
     *
     * while($myposts->have_posts()): $mypost->the_post(); .... endwhile;
     *
     * or
     *
     * foreach($myposts as $post) { ... }
     *
     * So $wp_the_query->get_queried_object() would not stable until it is firstly
     * called before any plugin or theme because it returns pre-set value if available.
     *
     * https://wordpress.stackexchange.com/questions/291056/get-the-current-page-slug-name
     * https://wordpress.stackexchange.com/questions/220619/globalswp-the-query-vs-global-wp-query
     * Get the current page content (in order to check if it includes the shortcode)
     *
     *
     *
     *
     */
    private function get_current_page() {
      //$current_page = sanitize_post( $GLOBALS['wp_the_query']->get_queried_object() );
      $current_page = get_queried_object();
      return $current_page;
    }

    /*
     * Get the plugin version
     */
    private function get_plugin_version() {

      // Get plugin version
      if ( $this->version == null) {
        $plugin_file = dirname(__DIR__).'/mybooking-wp-plugin.php';
        $plugin_data = get_file_data( $plugin_file, ['Version' => 'Version'] );
        $this->version = $plugin_data['Version'];
      }

      return $this->version;

    }

    /**
     * Get the page slug from the page Id
     */
    private function page_slug( $pageId ) {

      if ( $page = get_post( $pageId ) ) {
        return $page->post_name;
      }

    }


  }
