<?php

	// == Registry
	require_once('registry/mybooking-plugin-registry.php');

	// == Utilities 
	// Templates (https://jeroensormani.com/how-to-add-template-files-in-your-plugin/)
	require_once('mybooking-plugin-templates.php');
  // Routes (https://github.com/Upstatement/routes)
  require_once('routes/altorouter.php');
  // Routes (https://github.com/dannyvankooten/AltoRouter)
  require_once('routes/routes.php');
	// Check is page WMPL integration
	require_once('mybooking-plugin-is-page.php');
  // Mybooking Api Client + UI  
  require_once('ui/mybooking-plugin-ui-pages.php');
  require_once('ui/mybooking-plugin-ui-pagination.php');
  require_once('api/mybooking-plugin-api-client.php');

  // == WordPress components

	// Widgets
	require_once('widgets/mybooking-plugin-rent-selector-widget.php');
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
   * -- Contact
   *
   * Mybooking Engine Contact Widget
   *
   * -- Renting / Accommodation
   *
   * Mybooking Rent Engine Selector Widget
   *
   * -- Activities
   *
   * Mybooking Activities Engine Activity Widget
   *
   * 2. Sort codes:
   *
   * -- Renting / Accommodation
   *
   * [mybooking_rent_engine_selector sales_channel_code=String family_id=Number selector_type=horizontal]
   * [mybooking_rent_engine_product_listing]
   * [mybooking_rent_engine_complete]
   * [mybooking_rent_engine_summary]
   * [mybooking_rent_engine_product product_code=String]
   *
   *
   * -- Activities
   *
   * [mybooking_activities_engine_activity activity_id=Number]
   * [mybooking_activities_engine_shopping_cart]
   * [mybooking_activities_engine_order]
   *
   */
  class MyBookingPlugin
  {

  	private $registry;
  	private $settings;

		// Hold the class instance.
	  private static $instance = null;
	  
	  // The constructor is private
	  // to prevent initiation with outer code.
	  private function __construct()
	  {
	    	$this->init_reservation_process_pages();
	    	//$this->init_routes();
	    	$this->wp_init();
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
	   */
	  private function wp_init() {

			// Apply body tags on reservation pages
			add_filter( 'body_class', array($this, 'wp_body_class'));

			// == Custom CSS and JavaScript

			// Add Header CSS
			add_action( 'wp_enqueue_scripts', array($this, 'wp_setup_css'));

			// Add Footer Scripts
			add_action( 'wp_footer', array($this, 'wp_setup_script'));

			// Add mybooking-engine.js
			add_action( 'wp_enqueue_scripts', array($this, 'wp_script_load'));

			// == Widgets

			// Register Renting Selector Widget
			add_action( 'widgets_init', array($this, 'wp_selector_widget') );

			// Register Activities Activity Widget
			add_action( 'widgets_init', array($this, 'wp_activities_activity_widget') );

      // Register Contact widget
      add_action( 'widgets_init', array($this, 'wp_contact_widget') );

			// == Shortcodes

      // -- Renting shortcodes

      // Shortcode Renting Wizard - Selector
      add_shortcode('mybooking_rent_engine_selector', array($this, 'wp_rent_selector_shortcode') );

			// Shortcode Renting Wizard - Product listing
			add_shortcode('mybooking_rent_engine_product_listing', array($this, 'wp_product_listing_shortcode' ));

			// Shortcode Renting Wizard - Complete
			add_shortcode('mybooking_rent_engine_complete', array($this, 'wp_complete_shortcode' ));

			// Shortcode Renting Wizard - Summary
			add_shortcode('mybooking_rent_engine_summary', array($this, 'wp_summary_shortcode' ));

			// Shortcode Renting Product
			add_shortcode('mybooking_rent_engine_product', array($this, 'wp_rent_product_shortcode' ));

			// -- Activities shortcodes

			// Shortcode Activities - Activity
			add_shortcode('mybooking_activities_engine_activity', array($this, 'wp_activities_activity_shortcode' ));	

			// Shortcode Activities - Activity
			add_shortcode('mybooking_activities_engine_shopping_cart', array($this, 'wp_activities_shopping_cart_shortcode' ));	

			// Shortcode Activities - Activity
			add_shortcode('mybooking_activities_engine_order', array($this, 'wp_activities_order_shortcode' ));				

	  }

		/**
		 * Custom CSS
		 */
		public function wp_setup_css() {

		  $registry = Mybooking_Registry::getInstance();

		  if ($registry->mybooking_rent_plugin_custom_css) {

			  // Load JQUERY UI Style
			  wp_enqueue_style('wp_style_jqueryui',
			                   'https://cdnjs.cloudflare.com/ajax/libs/jquery-ui-bootstrap/0.5pre/css/custom-theme/jquery-ui-1.10.0.custom.css');
			  // Load Bulma Style
			  wp_enqueue_style('wp_style_bulma',
			                   'https://cdnjs.cloudflare.com/ajax/libs/bulma/0.7.5/css/bulma.min.css');
			  // Load JQUERY Date Range
        wp_enqueue_style('wp_style_jquery_date_range',
        	               'https://cdnjs.cloudflare.com/ajax/libs/jquery-date-range-picker/0.20.0/daterangepicker.css');
			  // Load custom style
			  wp_enqueue_style('wp_custom_style',
			                   plugins_url('/assets/styles/styles.css', dirname(__FILE__) ) );

			}

		}


		/**
		 * Add body classes to the pages
		 */
		public function wp_body_class ( $classes ) {

      // Get the post outside a loop
			global $post;

		  $registry = Mybooking_Registry::getInstance();

      // Selector widget or shortcode 
			if ( is_active_widget( false, false, 'mybooking_rent_engine_selector_widget', false ) ||
			     has_shortcode( $post->post_content , 'mybooking_rent_engine_selector') ) {
				$classes[] = 'mybooking-selector-widget';
			}		

			if ( is_active_widget( false, false, 'mybooking_engine_contact_widget', false ) ) {
				$classes[] = 'mybooking-contact-widget';
			}
		  
		  // Renting pages : Choose product, complete, summary
		  if ( $registry->mybooking_rent_plugin_choose_products_page != '' && mybooking_engine_is_page( $registry->mybooking_rent_plugin_choose_products_page ) ) {
		  	$classes[] = 'choose_product';
		  }
		  else if ( $registry->mybooking_rent_plugin_checkout_page != '' && mybooking_engine_is_page( $registry->mybooking_rent_plugin_checkout_page ) ) {
		  	$classes[] = 'complete';
		  }
		  else if ( $registry->mybooking_rent_plugin_summary_page != '' && mybooking_engine_is_page( $registry->mybooking_rent_plugin_summary_page ) ) {
		  	$classes[] = 'summary';
		  }
		  // Activities page 
		  else if ( $registry->mybooking_activities_plugin_shopping_cart_page != '' && mybooking_engine_is_page( $registry->mybooking_activities_plugin_shopping_cart_page ) ) {
		  	$classes[] = 'mybooking-activity-shopping-cart';
		  }
		  else if ( $registry->mybooking_activities_plugin_order_page != '' && mybooking_engine_is_page( $registry->mybooking_activities_plugin_order_page ) ) {
		  	$classes[] = 'mybooking-activity-order';
		  }
		 
		  // Renting shortcode : product (resource) [availability and selector]
		  if ( $post && has_shortcode( $post->post_content , 'mybooking_rent_engine_product') ) {
		  	$classes[] = 'mybooking-product';
		  }
		  // Activities shortcodes : mybooking_activities_engine_activity [selector]
		  if ( $post && has_shortcode( $post->post_content , 'mybooking_activities_engine_activity') ) {
		  	$classes[] = 'mybooking-activity';
		  }


      // Only for product page
      $url = $registry->mybooking_rent_plugin_navigation_products_url ? $registry->mybooking_rent_plugin_navigation_products_url : 'products';
    	if ( preg_match_all('`/'.$url.'/(\w)+`', $_SERVER['REQUEST_URI']) ) {
    	  $classes[] = 'mybooking-product';
      }


		  return $classes;

		}

		/**
		 * Reservation Engine Templates + JS setup
		 */
		public function wp_setup_script() {

		  $registry = Mybooking_Registry::getInstance();

		  // Include the initializer plugin
		  $data = array(
		      'mybooking_account_id' => $registry->mybooking_rent_plugin_account_id,
		      'mybooking_api_key' => $registry->mybooking_rent_plugin_api_key,
		      'mybooking_choose_products_page' => $registry->mybooking_rent_plugin_choose_products_page,
		      'mybooking_choose_extras_page' => $registry->mybooking_rent_plugin_choose_extras_page,
		      'mybooking_checkout_page' => $registry->mybooking_rent_plugin_checkout_page,
		      'mybooking_summary_page' => $registry->mybooking_rent_plugin_summary_page,
		      'mybooking_activities_shopping_cart_page' => $registry->mybooking_activities_plugin_shopping_cart_page,
		      'mybooking_activities_order_page' => $registry->mybooking_activities_plugin_order_page,
		      'mybooking_google_api_places' => $registry->mybooking_plugin_google_api_places,
		      'mybooking_google_api_places_api_key' => $registry->mybooking_plugin_google_api_places_api_key,
		      'mybooking_google_api_places_restrict_country_code' => $registry->mybooking_plugin_google_api_places_restrict_country_code,
		      'mybooking_google_api_places_restrict_bounds' => $registry->mybooking_plugin_google_api_places_restrict_bounds,
		      'mybooking_google_api_places_bounds_sw_lat' => $registry->mybooking_plugin_google_api_places_bounds_sw_lat,
		      'mybooking_google_api_places_bounds_sw_lng' => $registry->mybooking_plugin_google_api_places_bounds_sw_lng,
		      'mybooking_google_api_places_bounds_ne_lat' => $registry->mybooking_plugin_google_api_places_bounds_ne_lat,
		      'mybooking_google_api_places_bounds_ne_lng' => $registry->mybooking_plugin_google_api_places_bounds_ne_lng	      
		  );
		  mybooking_engine_get_template('mybooking-plugin-init-tmpl.php', $data);
		
		  // Load scripts
		  if ( $registry->mybooking_rent_plugin_choose_products_page != '' && mybooking_engine_is_page( $registry->mybooking_rent_plugin_choose_products_page ) ) {
		  	mybooking_engine_get_template('mybooking-plugin-choose-product-tmpl.php');
		  }
		  else if ( $registry->mybooking_rent_plugin_checkout_page != '' && mybooking_engine_is_page( $registry->mybooking_rent_plugin_checkout_page ) ) {
		  	mybooking_engine_get_template('mybooking-plugin-complete-tmpl.php');
		  }
		  else if ( $registry->mybooking_rent_plugin_summary_page != '' && mybooking_engine_is_page( $registry->mybooking_rent_plugin_summary_page ) ) {
		  	mybooking_engine_get_template('mybooking-plugin-summary-tmpl.php');
		  }	
		  else if ( $registry->mybooking_activities_plugin_shopping_cart_page != '' && mybooking_engine_is_page( $registry->mybooking_activities_plugin_shopping_cart_page ) ) {
		  	mybooking_engine_get_template('mybooking-plugin-activities-shopping-cart-tmpl.php');
		  }
		  else if ( $registry->mybooking_activities_plugin_order_page != '' && mybooking_engine_is_page( $registry->mybooking_activities_plugin_order_page ) ) {
		  	mybooking_engine_get_template('mybooking-plugin-activities-order-tmpl.php');
		  }

      // Only for product page
      $url = $registry->mybooking_rent_plugin_navigation_products_url ? $registry->mybooking_rent_plugin_navigation_products_url : 'products';
    	if ( preg_match_all('`/'.$url.'/(\w)+`', $_SERVER['REQUEST_URI']) ) {
        mybooking_engine_get_template('mybooking-plugin-product-widget-tmpl.php');
      }

		}

		/**
		 * Custom JS : Mybooking Engine JS
		 */
		public function wp_script_load() {

		  // Registers the Engine Plugin [TO BE INCLUDED IN THE FOOTER 5th parameter true]
			wp_register_script('mybooking-rent-engine-script', 
		  									 plugins_url( '/assets/js/mybooking-engine.js', dirname(__FILE__) ), array(),' ',true);

			// TODO Improve and load only on the reservation process pages
		  wp_enqueue_script( 'mybooking-rent-engine-script');

		}

		// == Widget

		/**
		 * Register selector Widget 
		 */
		public function wp_selector_widget() {

		  register_widget( 'MyBookingRentEngineSelectorWidget' );

		}

    /**
     * Register the activity widget
     */
    public function wp_activities_activity_widget() {

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
			                               'selector_type' => '' ), $atts ) );

		  $data = array();

      if ( $sales_channel_code != '' ) {
      	$data['sales_channel_code'] = $sales_channel_code;
      }

      if ( $family_id != '' ) {
      	$data['family_id'] = $family_id;
      }

			ob_start();
			if ( $selector_type == 'horizontal' ) {
	      mybooking_engine_get_template('mybooking-plugin-selector-widget-horizontal.php', $data);
      }
      else {
      	mybooking_engine_get_template('mybooking-plugin-selector-widget.php', $data);
      }
	    return ob_get_clean();
	
		}

		/**
		 * Mybooking rent engine Product Listing shortcode
		 */
		public function wp_product_listing_shortcode($atts = [], $content = null, $tag = '') {
			
			ob_start();
	    mybooking_engine_get_template('mybooking-plugin-choose-product.php');
	    return ob_get_clean();
	
		}

		/**
		 * Mybooking rent engine Complete shortcode
		 */
		public function wp_complete_shortcode($atts = [], $content = null, $tag = '') {
			
			ob_start();
			mybooking_engine_get_template('mybooking-plugin-complete.php');
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
     * Mybooking product
     */
    public function wp_rent_product_shortcode($atts = [], $content = null, $tag = '') {

      // Extract the shortcode attributes			
			extract( shortcode_atts( array('code' => ''), $atts ) );

      $data = array();
      $data['code'] = $code;

      ob_start();
      mybooking_engine_get_template('mybooking-plugin-product-widget.php', $data);
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
     * Mybooking activities engine Order shortcode
     */
		public function wp_activities_order_shortcode($atts = [], $content = null, $tag = '') {

			ob_start();
			mybooking_engine_get_template('mybooking-plugin-activities-order.php');
			return ob_get_clean();

		}

	  // ------------ Plugin setup -----------------------

	  /**
	   * Init Reservation Process pages
	   */
	  private function init_reservation_process_pages() {

		  $registry = Mybooking_Registry::getInstance();

      // Connection
		  $settings = (array) get_option("mybooking_plugin_settings_connection");
		  if ($settings && array_key_exists('mybooking_plugin_settings_account_id', $settings)) {
		    $registry->mybooking_rent_plugin_account_id = trim(esc_attr( $settings["mybooking_plugin_settings_account_id"] ));
		    $registry->mybooking_rent_plugin_api_url_prefix = 'https://'.$registry->mybooking_rent_plugin_account_id.'.mybooking.es';
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
		  $settings = (array) get_option("mybooking_plugin_settings_renting_wizard");
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

		  if ($settings && array_key_exists('mybooking_plugin_settings_activities_order_page', $settings)) {
		    $registry->mybooking_activities_plugin_order_page = $this->page_slug(trim(esc_attr( $settings["mybooking_plugin_settings_settings_activities_order_page"] )));
      }
      else {
		    $registry->mybooking_activities_plugin_order_page = ''; 
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
      // CSS
		  $settings = (array) get_option("mybooking_plugin_settings_css");	  
      if ($settings && array_key_exists('mybooking_plugin_settings_custom_css', $settings)) {
		    $registry->mybooking_rent_plugin_custom_css = (trim(esc_attr( $settings["mybooking_plugin_settings_custom_css"] )) == '1');
      }
      else {
        $registry->mybooking_rent_plugin_custom_css = '';
      }
		}


		/**
		 * Get the page slug from the page Id
		 */
		function page_slug( $pageId ) {

		  if ( $page = get_post( $pageId ) ) {
		    return $page->post_name;
		  }

		}

		// ------------ Custom routes ---------------------

    /**
     * Initialize custom routes to show all renting products and activities
     *
     */
		private function init_routes() {

      $registry = Mybooking_Registry::getInstance();
      $url = $registry->mybooking_rent_plugin_navigation_products_url ? $registry->mybooking_rent_plugin_navigation_products_url : 'products';

      // Renting products route
			Routes::map($url, array($this, 'products_page'));
 
      // Renting product detail route
			Routes::map($url.'/:id', function($params) {
				$this->product_page($params);
			});

		}

    /**
     * Load the products page
     */
    function products_page() {

          // GET the pagination query parameters
          $page = $_GET['page'] ? $_GET['page'] : 1;
          $limit = $_GET['limit'] ? $_GET['limit'] : 12;

          $ui_products = new MyBookingUIPages();
          $ui_products->products($page, $limit);
        
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


  }