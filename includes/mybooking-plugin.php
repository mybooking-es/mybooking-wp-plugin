<?php

	// == Registry
	require_once('registry/mybooking-plugin-registry.php');

	// == Utilities 
	
	// Templates (https://jeroensormani.com/how-to-add-template-files-in-your-plugin/)
	require_once('mybooking-plugin-locate-template.php');
	require_once('mybooking-plugin-get-template.php');
	require_once('mybooking-plugin-load-template.php');
  // https://github.com/Upstatement/routes
  // https://github.com/dannyvankooten/AltoRouter
  require_once('routes/altorouter.php');
  require_once('routes/routes.php');
	// Check is page WMPL integration
	require_once('mybooking-plugin-is-page.php');

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
   * [mybooking_rent_engine_product_listing]
   * [mybooking_rent_engine_complete]
   * [mybooking_rent_engine_summary]
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
	    	$this->init_routes();
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

	  // ------------ Plugin setup -----------------------

	  /**
	   * Init Reservation Process pages
	   */
	  private function init_reservation_process_pages() {

		  $registry = Mybooking_Registry::getInstance();

		  $settings = (array) get_option("mybooking_plugin_settings");

		  $registry->mybooking_rent_plugin_account_id = trim(esc_attr( $settings["mybooking_plugin_settings_account_id"] ));
		  $registry->mybooking_rent_plugin_api_url_prefix = 'https://'.$registry->mybooking_rent_plugin_account_id.'.mybooking.es';
		  $registry->mybooking_rent_plugin_api_key = trim(esc_attr( $settings["mybooking_plugin_settings_api_key"] ));
		  $registry->mybooking_rent_plugin_choose_products_page = $this->page_slug(trim(esc_attr( $settings["mybooking_plugin_settings_choose_products_page"] )));
		  $registry->mybooking_rent_plugin_choose_extras_page = $this->page_slug(trim(esc_attr( $settings["mybooking_plugin_settings_choose_extras_page"] )));
		  $registry->mybooking_rent_plugin_checkout_page = $this->page_slug(trim(esc_attr( $settings["mybooking_plugin_settings_checkout_page"] )));
		  $registry->mybooking_rent_plugin_summary_page = $this->page_slug(trim(esc_attr( $settings["mybooking_plugin_settings_summary_page"] )));
		  $registry->mybooking_activities_plugin_shopping_cart_page = $this->page_slug(trim(esc_attr( $settings["mybooking_plugin_activities_shopping_cart_page"] )));
		  $registry->mybooking_activities_plugin_order_page = $this->page_slug(trim(esc_attr( $settings["mybooking_plugin_settings_activities_order_page"] )));
		  $registry->mybooking_rent_plugin_custom_css = (trim(esc_attr( $settings["mybooking_plugin_settings_custom_css"] )) == '1');

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

      // Renting products route
			Routes::map('products', function($params){

				  $registry = Mybooking_Registry::getInstance();
          
          // Call the API 
          $api_client = new MybookingApiClient($registry->mybooking_rent_plugin_api_url_prefix,
          	                                   $registry->mybooking_rent_plugin_api_key);
          $data =$api_client->get_products();
          
          // Error in API
          if ( $data == null) {
          	$this->routes_not_found();
          }

          mybooking_engine_get_template('mybooking-plugin-routes-products.php', $data);
          die;

			});
 
      // Renting product detail route
			Routes::map('products/:id', function($params){

				  $registry = Mybooking_Registry::getInstance();

          // Call the API 
          $api_client = new MybookingApiClient($registry->mybooking_rent_plugin_api_url_prefix,
          	                                   $registry->mybooking_rent_plugin_api_key);
          $data =$api_client->get_product($params['id']);

          // Error in API
          if ( $data == null) {
          	$this->routes_not_found();
          }
          
          mybooking_engine_get_template('mybooking-plugin-routes-product.php', $data);
          die;
			});

		}

		private function routes_not_found() {
          status_header(404);
          nocache_headers();
          include( get_query_template( '404' ) );			
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

			// -- Activities shortcodes

			// Shortcode Activities - Activity
			add_shortcode('mybooking_activities_engine_activity', array($this, 'wp_activities_activity_shortcode' ));	

			// Shortcode Activities - Activity
			add_shortcode('mybooking_activities_engine_shopping_cart', array($this, 'wp_activities_shopping_cart_shortcode' ));	

			// Shortcode Activities - Activity
			add_shortcode('mybooking_activities_engine_order', array($this, 'wp_activities_order_shortcode' ));				

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
		 

		  // Shortcodes : mybooking_activities_engine_activity
		  if ( has_shortcode( $post->post_content , 'mybooking_activities_engine_activity') ) {
		  	$classes[] = 'mybooking-activity';
		  }

		  return $classes;

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
			  // Load custom style
			  wp_enqueue_style('wp_custom_style',
			                   plugins_url('/assets/styles/styles.css', dirname(__FILE__) ) );

			}

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
		      'mybooking_activities_order_page' => $registry->mybooking_activities_plugin_order_page
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

		public function wp_activities_shopping_cart_shortcode($atts = [], $content = null, $tag = '') {

			ob_start();
			mybooking_engine_get_template('mybooking-plugin-activities-shopping-cart.php');
			return ob_get_clean();

		}

		public function wp_activities_order_shortcode($atts = [], $content = null, $tag = '') {

			ob_start();
			mybooking_engine_get_template('mybooking-plugin-activities-order.php');
			return ob_get_clean();

		}

  }