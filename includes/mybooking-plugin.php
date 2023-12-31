<?php

  // == Registry
  require_once('registry/mybooking-plugin-registry.php');

  // == Utilities
  require_once('utils/templates-functions.php');
  require_once('utils/page-functions.php');  
  require_once('utils/extract-query-string-functions.php');  
  require_once('utils/wpml-integration-functions.php');
  require_once('utils/themes-integration-functions.php');

  require_once('mybooking-class-install.php');

  // Routes (https://github.com/Upstatement/routes)
  if ( !class_exists('AltoRouter') ) {
    require_once('routes/altorouter.php');
  }
  
  // Routes (https://github.com/dannyvankooten/AltoRouter)
  if ( !class_exists('Routes') ) {
    require_once('routes/routes.php');
  }

  // Enqueue 
  require_once('enqueue/class-mybooking-enqueue.php');
  // Custom post types
  require_once('cpt/class-mybooking-cpt.php');
  // Shortcodes
  require_once('shortcodes/class-mybooking-shortcodes.php');
  
  // Mybooking Api Client + UI
  require_once('ui/mybooking-plugin-ui-pages.php');
  require_once('ui/mybooking-plugin-ui-pagination.php');
  require_once('api/mybooking-plugin-api-client.php');
  require_once('ui/mybooking-plugin-activities-ui-pages.php');
  require_once('api/mybooking-plugin-activities-api-client.php');
  // Engine context
  require_once('translation/mybooking-plugin-engine-context.php');

  // == WordPress components
  // Customizer
  require_once('customizer/mybooking-plugin-customizer.php');
  // Widgets
  require_once('widgets/mybooking-plugin-rent-selector-widget.php');
  require_once('widgets/mybooking-plugin-rent-selector-wizard-widget.php');
  require_once('widgets/mybooking-plugin-activity-widget.php');
  require_once('widgets/mybooking-plugin-contact-widget.php');
  require_once('widgets/mybooking-plugin-transfer-selector-widget.php');
  // Settings
  require_once('settings/mybooking-plugin-settings.php');
  // On boarding
  require_once('settings/mybooking-plugin-onboarding.php');

  // Patterns
  require_once('mybooking-patterns.php');

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
   * - Renting wizard widget
   * - Activity buy tickets widget
   * - Transfer selector widget
   *
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

        if ( is_admin() ) {
          // Prepare the plugin settings page
          $settings = new MyBookingPluginSettings();
          // Prepare the plugin onboarding page
          $onboarding = new MybookingPluginOnBoarding();
        }
    }

    // The object is created from within the class itself
    // only if the class has no instance.
    public static function getInstance()
    {
      if ( self::$instance == null )
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

      // Initialize customizer
      MyBookingPluginCustomizer::getInstance();

      // Initialize the custom routes for activities and products
      add_action( 'init', array( $this, 'init_routes' ) );

      // Register custom post types
      $cpt = new MybookingEngineCPT();

      // Load translations
      add_action( 'plugins_loaded', array( $this, 'wp_load_plugin_textdomain' ) );

      // Apply body tags on reservation pages
      add_filter( 'body_class', array( $this, 'wp_body_class' ) );

      // == Custom CSS and JavaScript
      $enqueue = new MybookingEngineEnqueue( $this->get_plugin_version() );

      // Enqueue BLOCK EDITOR styles
      add_action( 'enqueue_block_editor_assets', array( $this, 'wp_enqueue_block_editor_styles' ), 1, 1 );

      // Add micro templates
      add_action( 'wp_footer', array( $this, 'wp_include_micro_templates' ) );

      // Add Pop up
      add_action( 'wp_footer', array( $this, 'wp_include_popup' ) );

      // Add Cookies notice
      add_action( 'wp_footer', array( $this, 'wp_include_cookies_notice' ) );

      // == Widgets

      // Register Renting Selector Widget
      add_action( 'widgets_init', array( $this, 'wp_selector_widget' ) );

      // Register Renting Selector Wizard Widget
      add_action( 'widgets_init', array( $this, 'wp_selector_wizard_widget' ) );

      // Register Activities Activity Widget
      add_action( 'widgets_init', array( $this, 'wp_activities_activity_widget' ) );

      // Register Transfer Selector Widget
      add_action( 'widgets_init', array($this, 'wp_transfer_selector_widget') );

      // Register Contact widget
      add_action( 'widgets_init', array( $this, 'wp_contact_widget' ) );

      // == Shortcodes
      $shortcodes = new MybookingEngineShortcodes();


    }

    /**
     * Load the plugin textdomain languages
     */
    function wp_load_plugin_textdomain() {

       // This module is located in includes and the languages is in the
       // root directory of the plugin : 'mybooking-wp-plugin/languages/'
       load_plugin_textdomain( 'mybooking-wp-plugin', false, MYBOOKING_RESERVATION_ENGINE_LANGUAGES_FOLDER);

    }

    /**
     * Enqueue block editor styles
     */
    public function wp_enqueue_block_editor_styles() {

      // Get the registry information
      $registry = Mybooking_Registry::getInstance();


      // == Load Customizer front-end
      $customizer_css = MyBookingPluginCustomizer::getInstance()->customize_enqueue( 'block-editor' );
      if ( !empty($customizer_css) ) {
            wp_register_style( 'mybooking_wp_engine_customizer-block-editor-styles', false );
            wp_enqueue_style( 'mybooking_wp_engine_customizer-block-editor-styles' );
            wp_add_inline_style( 'mybooking_wp_engine_customizer-block-editor-styles', $customizer_css );
      }

    }

    /**
     * Add body classes to the pages
     */
    public function wp_body_class ( $classes ) {

      // Get the current page content
      $content = mybooking_engine_page_current_page_content();

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
      if ( $registry->mybooking_plugin_renting_module &&
           ( is_active_widget( false, false, 'mybooking_rent_engine_selector_widget', false ) ||
             has_shortcode( $content , 'mybooking_rent_engine_selector')
           )
         ) {
        $classes[] = 'mybooking-selector-widget';
      }

      // Selector Wizard widget or shortcode
      if ( $registry->mybooking_plugin_renting_module &&
           ( is_active_widget( false, false, 'mybooking_rent_engine_selector_wizard_widget', false ) ||
             has_shortcode( $content , 'mybooking_rent_engine_selector_wizard')
           )
         ) {
        $classes[] = 'mybooking-selector-wizard';
      }

      // Renting reservation steps pages
      if ( $registry->mybooking_plugin_renting_module &&
           $registry->mybooking_rent_plugin_choose_products_page != '' &&
           mybooking_engine_is_page( $registry->mybooking_rent_plugin_choose_products_page ) ) {
        $classes[] = 'choose_product';
      }
      else if ( $registry->mybooking_plugin_renting_module &&
                $registry->mybooking_rent_plugin_checkout_page != '' &&
                mybooking_engine_is_page( $registry->mybooking_rent_plugin_checkout_page ) ) {
        $classes[] = 'complete';
      }
      else if ( $registry->mybooking_plugin_renting_module &&
                $registry->mybooking_rent_plugin_summary_page != '' &&
                mybooking_engine_is_page( $registry->mybooking_rent_plugin_summary_page ) ) {
        $classes[] = 'summary';
      }

      // Renting shortcode : reservation
      if ( $registry->mybooking_plugin_renting_module &&
           has_shortcode( $content, 'mybooking_rent_engine_reservation') ) {
        $classes[] = 'reservation';
      }

      // Renting shortcodes : product search
      if ( $registry->mybooking_plugin_renting_module &&
           has_shortcode( $content, 'mybooking_rent_engine_products_search') ) {
        $classes[] = 'mybooking-product-search';
      }

      // Renting shortcode : product (resource) [availability and selector]
      if ( $registry->mybooking_plugin_renting_module &&
           has_shortcode( $content , 'mybooking_rent_engine_product') ) {
        $classes[] = 'mybooking-product';
      }

      if ( $registry->mybooking_plugin_renting_module &&
           has_shortcode( $content , 'mybooking_rent_engine_planning') ) {
        $classes[] = 'mybooking-rent-planning';
      }

      if ( $registry->mybooking_plugin_renting_module &&
           has_shortcode( $content , 'mybooking_rent_engine_product_week_planning') ) {
        $classes[] = 'mybooking-rent-product-planning-week';
      }

      if ( $registry->mybooking_plugin_renting_module &&
           has_shortcode( $content , 'mybooking_rent_engine_shift_picker') ) {
        $classes[] = 'mybooking-rent-shift-picker';
      }
      
      // == Activities

      // Activities reservation steps pages
      if ( $registry->mybooking_plugin_activities_module &&
           $registry->mybooking_activities_plugin_shopping_cart_page != '' &&
           mybooking_engine_is_page( $registry->mybooking_activities_plugin_shopping_cart_page ) ) {
        $classes[] = 'mybooking-activity-shopping-cart';
      }
      else if ( $registry->mybooking_plugin_activities_module &&
                $registry->mybooking_activities_plugin_summary_page != '' &&
                mybooking_engine_is_page( $registry->mybooking_activities_plugin_summary_page ) ) {
        $classes[] = 'mybooking-activity-summary';
      }

      // Activities shortcodes : Activity
      if ( $registry->mybooking_plugin_activities_module &&
           has_shortcode( $content, 'mybooking_activities_engine_search') ) {
        $classes[] = 'mybooking-activity-search';
      }

      // Activities shortcodes : Activity
      if ( $registry->mybooking_plugin_activities_module &&
           has_shortcode( $content, 'mybooking_activities_engine_activity') ) {
        $classes[] = 'mybooking-activity';
      }
      // Activities shortcodes : Order
      if ( $registry->mybooking_plugin_activities_module &&
           has_shortcode( $content, 'mybooking_activities_engine_order') ) {
        $classes[] = 'mybooking-activity-order';
      }

      // == Transfer

      // Selector widget or shortcode
      if ( $registry->mybooking_plugin_transfer_module &&
           ( is_active_widget( false, false, 'mybooking_transfer_engine_selector_widget', false ) ||
             has_shortcode( $content , 'mybooking_transfer_selector')
           )
         ) {
        $classes[] = 'mybooking-transfer-selector';
      }

      // Transfer reservation steps pages
      if ( $registry->mybooking_plugin_transfer_module &&
           $registry->mybooking_transfer_plugin_choose_vehicle_page != '' &&
           mybooking_engine_is_page( $registry->mybooking_transfer_plugin_choose_vehicle_page ) ) {
        $classes[] = 'mybooking-transfer-choose-product';
      }
      else if ( $registry->mybooking_plugin_transfer_module &&
                $registry->mybooking_transfer_plugin_checkout_page != '' &&
                mybooking_engine_is_page( $registry->mybooking_transfer_plugin_checkout_page ) ) {
        $classes[] = 'mybooking-transfer-complete';
      }
      else if ( $registry->mybooking_plugin_transfer_module &&
                $registry->mybooking_transfer_plugin_summary_page != '' &&
                mybooking_engine_is_page( $registry->mybooking_transfer_plugin_summary_page ) ) {
        $classes[] = 'mybooking-transfer-summary';
      }

      // Transfer shortcode : reservation
      if ( $registry->mybooking_plugin_transfer_module &&
           has_shortcode( $content, 'mybooking_transfer_reservation') ) {
        $classes[] = 'mybooking-transfer-reservation';
      }

      // == External products / activities

      // Only for product page
      if ( $registry->mybooking_plugin_renting_module ) {
        $url = $registry->mybooking_rent_plugin_navigation_products_url ? $registry->mybooking_rent_plugin_navigation_products_url : 'products';
        if ( isset($_SERVER['REQUEST_URI']) && preg_match_all('`/'.$url.'/(\w)+`', $_SERVER['REQUEST_URI']) ) {
          $classes[] = 'mybooking-product';
        }
      }

      // Only for activity page
      if ( $registry->mybooking_plugin_activities_module ) {
        $url = $registry->mybooking_rent_plugin_navigation_activities_url ? $registry->mybooking_rent_plugin_navigation_activities_url : 'activities';
        if ( isset($_SERVER['REQUEST_URI']) && preg_match_all('`/'.$url.'/(\w)+`', $_SERVER['REQUEST_URI']) ) {
          $classes[] = 'mybooking-activity';
        }
      }

      return $classes;

    }

    /**
     * Include micro templates
     * -----------------------
     *
     * Microtemplates are responsible of rendering parts of the reservation engine.
     * This method includes the current page necessary micro-templates on the footer
     */
    public function wp_include_micro_templates() {

      $registry = Mybooking_Registry::getInstance();

      // The the current page content
      $content = mybooking_engine_page_current_page_content();

      // Hold if the current page needs to modify selection data (for renting)
      $current_page_modify_reservation = false;

      // Hold if the current page needs to modify selection data (for transfer)
      $current_page_modify_transfer_reservation = false;

      // Renting Selector
      if ( $registry->mybooking_plugin_renting_module &&
           ( is_active_widget( false, false, 'mybooking_rent_engine_selector_widget', false ) ||
             has_shortcode ( $content, 'mybooking_rent_engine_selector')
           )
         ) {
        mybooking_engine_get_template( 'mybooking-plugin-selector-widget-tmpl.php');
      }

      // Renting Selector Wizard shortcode / widget
      if ( $registry->mybooking_plugin_renting_module &&
           ( is_active_widget( false, false, 'mybooking_rent_engine_selector_wizard_widget', false ) ||
             has_shortcode( $content , 'mybooking_rent_engine_selector_wizard')
           )
         ) {
        mybooking_engine_get_template('mybooking-plugin-selector-wizard-widget-tmpl.php');
      }

      // Transfer Selector
      if ( $registry->mybooking_plugin_transfer_module &&
           ( is_active_widget( false, false, 'mybooking_transfer_engine_selector_widget', false ) ||
             has_shortcode ( $content, 'mybooking_transfer_selector')
           )
         ) {
        mybooking_engine_get_template( 'mybooking-plugin-transfer-selector-widget-tmpl.php');
      }

      // Reservation Steps => Renting, activities, transfer
      if ( $registry->mybooking_plugin_renting_module &&
           $registry->mybooking_rent_plugin_choose_products_page != '' &&
           mybooking_engine_is_page( $registry->mybooking_rent_plugin_choose_products_page ) ) { // Renting choose product
        $data = array();
        $data['show_taxes_included'] = $registry->mybooking_rent_plugin_show_taxes_included;
        $data['show_key_characteristics'] = get_theme_mod('mybooking_reservation_engine_product_show_key_characteristics', 'hide');
        $data['choose_product_layout'] = get_theme_mod('mybooking_reservation_engine_rent_choose_product_layout', 'grid_only');
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
      else if ( $registry->mybooking_plugin_renting_module &&
                $registry->mybooking_rent_plugin_checkout_page != '' &&
                mybooking_engine_is_page( $registry->mybooking_rent_plugin_checkout_page ) ) { // Renting checkout
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
      else if ( $registry->mybooking_plugin_renting_module &&
                $registry->mybooking_rent_plugin_summary_page != '' &&
                mybooking_engine_is_page( $registry->mybooking_rent_plugin_summary_page ) ) { // Renting summary
        $data = array();
        $data['show_taxes_included'] = $registry->mybooking_rent_plugin_show_taxes_included;
        mybooking_engine_get_template('mybooking-plugin-summary-tmpl.php', $data);
      }
      else if ( $registry->mybooking_plugin_activities_module &&
                $registry->mybooking_activities_plugin_shopping_cart_page != '' &&
                mybooking_engine_is_page( $registry->mybooking_activities_plugin_shopping_cart_page ) ) { // Activities shopping cart
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
      else if ( $registry->mybooking_plugin_activities_module &&
                $registry->mybooking_activities_plugin_summary_page != '' &&
                mybooking_engine_is_page( $registry->mybooking_activities_plugin_summary_page ) ) { // Activities summary
        mybooking_engine_get_template('mybooking-plugin-activities-summary-tmpl.php');
      }
      else if ( $registry->mybooking_plugin_transfer_module &&
                $registry->mybooking_transfer_plugin_choose_vehicle_page != '' &&
                mybooking_engine_is_page( $registry->mybooking_transfer_plugin_choose_vehicle_page ) ) { // Transfer choose vehicle
        mybooking_engine_get_template('mybooking-plugin-transfer-choose-vehicle-tmpl.php');
        mybooking_engine_get_template('mybooking-plugin-transfer-modify-reservation-tmpl.php');
        $current_page_modify_transfer_reservation = true;
      }
      else if ( $registry->mybooking_plugin_transfer_module &&
                $registry->mybooking_transfer_plugin_checkout_page != '' &&
                mybooking_engine_is_page( $registry->mybooking_transfer_plugin_checkout_page ) ) { // Transfer checkout
        // Terms and conditions
        $data = array();
        if ( empty($registry->mybooking_transfer_plugin_terms_page) ) {
          $data['terms_and_conditions'] = '';
        }
        else {
          $data['terms_and_conditions'] = mybooking_engine_translated_slug($registry->mybooking_transfer_plugin_terms_page);
        }
        mybooking_engine_get_template('mybooking-plugin-transfer-checkout-tmpl.php', $data);
        mybooking_engine_get_template('mybooking-plugin-transfer-modify-reservation-tmpl.php');
        $current_page_modify_transfer_reservation = true;
      }
      else if ( $registry->mybooking_plugin_transfer_module &&
                $registry->mybooking_transfer_plugin_summary_page != '' &&
                mybooking_engine_is_page( $registry->mybooking_transfer_plugin_summary_page ) ) { // Transfer checkout
        mybooking_engine_get_template('mybooking-plugin-transfer-summary-tmpl.php');
      }

      // Renting shortcode : My reservation - reservation
      if ( $registry->mybooking_plugin_renting_module &&
           has_shortcode( $content, 'mybooking_rent_engine_reservation') ) {
        $data = array();
        $data['show_taxes_included'] = $registry->mybooking_rent_plugin_show_taxes_included;
        mybooking_engine_get_template('mybooking-plugin-reservation-tmpl.php', $data);
      }

      // Activities shortcode : My reservation - activities
      if ( $registry->mybooking_plugin_activities_module &&
           has_shortcode( $content, 'mybooking_activities_engine_order') ) {
        mybooking_engine_get_template('mybooking-plugin-activities-order-tmpl.php');
      }

      // Transfer shortcode : My reservation - transfer
      if ( $registry->mybooking_plugin_transfer_module &&
           has_shortcode( $content, 'mybooking_transfer_reservation') ) {
        mybooking_engine_get_template('mybooking-plugin-transfer-reservation-tmpl.php');
      }

      // Activities search shortcode
      if ( $registry->mybooking_plugin_activities_module &&
           has_shortcode( $content, 'mybooking_activities_engine_search') ) {
        $data = mybooking_engine_activities_extract_query_string();
        mybooking_engine_get_template('mybooking-plugin-activities-search-tmpl.php', $data);
      }

      // Renting shortcode : Products search
      if ( $registry->mybooking_plugin_renting_module &&
           has_shortcode( $content, 'mybooking_rent_engine_products_search') ) {
        $data = mybooking_engine_products_extract_query_string();
        mybooking_engine_get_template('mybooking-plugin-products-search-tmpl.php', $data);
      }

      // Renting shortcode : Product calendar
      if ( $registry->mybooking_plugin_renting_module &&
           has_shortcode( $content, 'mybooking_rent_engine_product') ) {
        mybooking_engine_get_template('mybooking-plugin-product-widget-tmpl.php');
      }

      // Renting shortcode :  Planning (diary or with a calendary)
      if ( $registry->mybooking_plugin_renting_module &&
           has_shortcode( $content, 'mybooking_rent_engine_planning') ) {
         mybooking_engine_get_template('mybooking-plugin-planning-tmpl.php');
      }

      // Renting shortcode : Product week planning
      if ( $registry->mybooking_plugin_renting_module &&
           has_shortcode( $content, 'mybooking_rent_engine_product_week_planning') ) {
        mybooking_engine_get_template('mybooking-plugin-product-week-planning-tmpl.php');
      }

      // Renting shortcode : Product shift picker
      if ( $registry->mybooking_plugin_renting_module &&
           has_shortcode( $content, 'mybooking_rent_engine_shift_picker') ) {
        mybooking_engine_get_template('mybooking-plugin-shift-picker-tmpl.php');
      }

      // Product page : reservation widget
      $url = $registry->mybooking_rent_plugin_navigation_products_url ? $registry->mybooking_rent_plugin_navigation_products_url : 'products';
      if ( $registry->mybooking_plugin_renting_module &&
           isset($_SERVER['REQUEST_URI']) && preg_match_all('`/'.$url.'/(\w)+`', $_SERVER['REQUEST_URI']) ) {
        mybooking_engine_get_template('mybooking-plugin-product-widget-tmpl.php');
      }

      // Activity page : calendar widget
      $url = $registry->mybooking_rent_plugin_navigation_activities_url ? $registry->mybooking_rent_plugin_navigation_activities_url : 'activities';
      if ( $registry->mybooking_plugin_activities_module &&
           isset($_SERVER['REQUEST_URI']) && preg_match_all('`/'.$url.'/(\w)+`', $_SERVER['REQUEST_URI']) ) {
        mybooking_engine_get_template('mybooking-plugin-activities-activity-widget-tmpl.php');
      }

      // Wizard container and modify reservation modal containers
      $active_wizard = is_active_widget( false, false, 'mybooking_rent_engine_selector_wizard_widget', false ) ||
                       has_shortcode( $content , 'mybooking_rent_engine_selector_wizard');

      if ( $registry->mybooking_plugin_renting_module &&
           ( $active_wizard || ( $current_page_modify_reservation && $registry->mybooking_rent_plugin_selector_in_process == 'wizard' ) ) ) {
         mybooking_engine_get_template('mybooking-plugin-selector-wizard-container.php');
      }

      if ( $registry->mybooking_plugin_renting_module &&
           $current_page_modify_reservation &&
           $registry->mybooking_rent_plugin_selector_in_process == 'form' ) {
         mybooking_engine_get_template('mybooking-plugin-modify-reservation.php');
      }

      // Modify transfer reservation
      if ( $registry->mybooking_plugin_transfer_module &&
           $current_page_modify_transfer_reservation ) {
         mybooking_engine_get_template('mybooking-plugin-transfer-modify-reservation.php');
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
     * Register transfer selector Widget
     */
    public function wp_transfer_selector_widget()
    {
      register_widget( 'MyBookingTransferEngineSelectorWidget' );
    }

    /**
     * Register contact Widget
     */
    public function wp_contact_widget() {

      register_widget( 'MyBookingEngineContactWidget' );

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

      // == Connection

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
      if ($settings && array_key_exists('mybooking_plugin_settings_sales_channel_code', $settings)) {
        $registry->mybooking_rent_plugin_sales_channel_code = trim(esc_attr( $settings["mybooking_plugin_settings_sales_channel_code"] ));
      }
      else {
        $registry->mybooking_rent_plugin_sales_channel_code = '';
      }



      // == Configuration

      $settings = (array) get_option("mybooking_plugin_settings_configuration");
      if ($settings && array_key_exists('mybooking_plugin_settings_google_api_places_selector', $settings)) {
        $registry->mybooking_plugin_google_api_places = (trim(esc_attr( $settings["mybooking_plugin_settings_google_api_places_selector"] )) == '1');
      }
      else {
        $registry->mybooking_plugin_google_api_places = false;
      }

      if ($settings && array_key_exists('mybooking_plugin_settings_renting_selector', $settings)) {
        $registry->mybooking_plugin_renting_module = true;
      }
      else {
        $registry->mybooking_plugin_renting_module = false;
      }
      if ($settings && array_key_exists('mybooking_plugin_settings_activities_selector', $settings)) {
        $registry->mybooking_plugin_activities_module = true;
      }
      else {
        $registry->mybooking_plugin_activities_module = false;
      }
      if ($settings && array_key_exists('mybooking_plugin_settings_transfer_selector', $settings)) {
        $registry->mybooking_plugin_transfer_module = true;
      }
      else {
        $registry->mybooking_plugin_transfer_module = false;
      }

      // == Renting

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

      // == Activities

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

      // == Transfer

      $settings = (array) get_option("mybooking_plugin_settings_transfer");

      // Choose Vehicle Page
      if ($settings && array_key_exists('mybooking_plugin_settings_transfer_choose_vehicle_page', $settings)) {
        $registry->mybooking_transfer_plugin_choose_vehicle_page = $this->page_slug(trim(esc_attr( $settings["mybooking_plugin_settings_transfer_choose_vehicle_page"] )));
      }
      else {
        $registry->mybooking_transfer_plugin_choose_vehicle_page = '';
      }
      // Checkout Page
      if ($settings && array_key_exists('mybooking_plugin_settings_transfer_checkout_page', $settings)) {
        $registry->mybooking_transfer_plugin_checkout_page = $this->page_slug(trim(esc_attr( $settings["mybooking_plugin_settings_transfer_checkout_page"] )));
      }
      else {
        $registry->mybooking_transfer_plugin_checkout_page = '';
      }
      // Summary Page
      if ($settings && array_key_exists('mybooking_plugin_settings_transfer_summary_page', $settings)) {
        $registry->mybooking_transfer_plugin_summary_page = $this->page_slug(trim(esc_attr( $settings["mybooking_plugin_settings_transfer_summary_page"] )));
      }
      else {
        $registry->mybooking_transfer_plugin_summary_page = '';
      }
      // Terms and Conditions
      if ($settings && array_key_exists('mybooking_plugin_settings_transfer_terms_page', $settings)) {
        $registry->mybooking_transfer_plugin_terms_page = $this->page_slug(trim(esc_attr( $settings["mybooking_plugin_settings_transfer_terms_page"] )));
      }
      else {
        $registry->mybooking_transfer_plugin_terms_page = '';
      }

      // == Google Places API

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
      // Slider
      if ($settings && array_key_exists('mybooking_plugin_settings_complements_content_slider', $settings)) {
        $registry->mybooking_rent_plugin_complements_content_slider = (trim(esc_attr( $settings["mybooking_plugin_settings_complements_content_slider"] )) == '1');
      }
      else {
        $registry->mybooking_rent_plugin_complements_content_slider = '';
      }
      // Slider
      if ($settings && array_key_exists('mybooking_plugin_settings_complements_product_slider', $settings)) {
        $registry->mybooking_rent_plugin_complements_product_slider = (trim(esc_attr( $settings["mybooking_plugin_settings_complements_product_slider"] )) == '1');
      }
      else {
        $registry->mybooking_rent_plugin_complements_product_slider = '';
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

      // Include SlickJS
      if ($settings && array_key_exists('mybooking_plugin_settings_components_js_slickjs', $settings)) {
        $registry->mybooking_rent_plugin_js_slickjs = (trim(esc_attr( $settings["mybooking_plugin_settings_components_js_slickjs"] )) == '1');
      }
      else {
        $registry->mybooking_rent_plugin_js_slickjs = '1';
      }

      // JS Select 2
      if ($settings && array_key_exists('mybooking_plugin_settings_components_js_use_select2', $settings)) {
        $registry->mybooking_plugin_js_select2 = (trim(esc_attr( $settings["mybooking_plugin_settings_components_js_use_select2"] )) == '1');
      }
      else {
        $registry->mybooking_plugin_js_select2 = '';
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