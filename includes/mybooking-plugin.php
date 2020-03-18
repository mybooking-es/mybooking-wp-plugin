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
  require_once('ui/mybooking-plugin-activities-ui-pages.php');  
  require_once('api/mybooking-plugin-activities-api-client.php');  

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
   * [mybooking_rent_engine_selector sales_channel_code=String family_id=Number selector_type=horizontal]
   *
   * [mybooking_rent_enting_selector_wizard]
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
   * [mybooking_rent_engine_products]
   *
   * - Product availability and calendar
   *
   * [mybooking_rent_engine_product product_code=String]
   *
   * 2.2 Activities
   *
   * [mybooking_activities_engine_activities]
   * [mybooking_activities_engine_activity activity_id=Number]
   * [mybooking_activities_engine_shopping_cart]
   * [mybooking_activities_engine_summary]
   * [mybooking_activities_engine_order]
   *
   */
  class MyBookingPlugin
  {

  	private $registry;
  	private $settings;
  	private $version;

		// Hold the class instance.
	  private static $instance = null;
	  
	  // The constructor is private
	  // to prevent initiation with outer code.
	  private function __construct()
	  {
	    	$this->load_options();
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

    /*
     * Get the plugin version
     */
    private function get_plugin_version() {

			// Get plugin version
			if ( $version == null) {
				$plugin_file = dirname(__DIR__).'/mybooking-wp-plugin.php';
				$plugin_data = get_plugin_data( $plugin_file );
				$version = $plugin_data['Version'];
		  }

			return $version;

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

	  	// Load translations
	  	add_action( 'plugins_loaded', array($this, 'wp_load_plugin_textdomain') );

			// Apply body tags on reservation pages
			add_filter( 'body_class', array($this, 'wp_body_class'));

			// == Custom CSS and JavaScript

			// Enqueue CSS
			add_action( 'wp_enqueue_scripts', array($this, 'wp_enqueue_css'));

			// Add micro templates
			add_action( 'wp_footer', array($this, 'wp_include_micro_templates'));

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

			// Shortcode Renting products
			add_shortcode('mybooking_rent_engine_products', array($this, 'wp_rent_products_shortcode' ));

			// Shortcode Renting Product
			add_shortcode('mybooking_rent_engine_product', array($this, 'wp_rent_product_shortcode' ));

			// -- Activities shortcodes

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

		  if ($registry->mybooking_rent_plugin_components_css) {
			  // Load JQUERY UI Style
			  wp_enqueue_style('mybooking_wp_css_components_jqueryui',
			                   'https://cdnjs.cloudflare.com/ajax/libs/jquery-ui-bootstrap/0.5pre/css/custom-theme/jquery-ui-1.10.0.custom.css');
			  // Load JQUERY Date Range
        wp_enqueue_style('mybooking_wp_css_components_jquery_date_range',
        	               'https://cdnjs.cloudflare.com/ajax/libs/jquery-date-range-picker/0.20.0/daterangepicker.css');
        // Custom style
			  wp_enqueue_style('mybooking_wp_css_components_custom_style',
			                   plugins_url('/assets/styles/custom-styles.css', dirname(__FILE__) ),
			                   array(), $version );
		  }

		  if ($registry->mybooking_rent_plugin_custom_css) {
				// Load bootstrap CSS
			  wp_enqueue_style('mybooking_wp_css_framework_bootstrap',
			                   'https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css');
			  // Load font awesome 4.7
			  wp_enqueue_style('mybooking_wp_css_framework_fontawesome',
			  								 'https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css');
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

		  // Registers the Engine Plugin [TO BE INCLUDED IN THE FOOTER 5th parameter true]
			wp_register_script('mybooking-rent-engine-script', 
		  									 plugins_url( '/assets/js/mybooking-engine.js', dirname(__FILE__) ), 
		  									 array(), $version, true);
		  wp_enqueue_script( 'mybooking-rent-engine-script');

		  if ($registry->mybooking_rent_plugin_custom_css) {
			  // Load bootstrap JS
			  wp_register_script('mybooking_wp_js_framework_bootstrap', 
			  	                 'https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js', 
			  	                 array( 'jquery' ), $version, true);
			  wp_enqueue_script('mybooking_wp_js_framework_bootstrap');
			}

		}

		/**
		 * Add body classes to the pages
		 */
		public function wp_body_class ( $classes ) {

      // Get the post outside a loop
			global $post;

		  $registry = Mybooking_Registry::getInstance();

		  // == Contact

			if ( is_active_widget( false, false, 'mybooking_engine_contact_widget', false ) ) {
				$classes[] = 'mybooking-contact-widget';
			}

			// == Renting

      // Selector widget or shortcode 
			if ( is_active_widget( false, false, 'mybooking_rent_engine_selector_widget', false ) ||
			     has_shortcode( $post->post_content , 'mybooking_rent_engine_selector') ) {
				$classes[] = 'mybooking-selector-widget';
			}		

			// Selector Wizard widget or shortcode
			if ( is_active_widget( false, false, 'mybooking_rent_engine_selector_wizard_widget', false ) ||
			     ( $post && has_shortcode( $post->post_content , 'mybooking_rent_engine_selector_wizard') ) ) {
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
      if ( $post && has_shortcode( $post->post_content, 'mybooking_rent_engine_reservation') ) {
      	$classes[] = 'reservation';
      } 

		  // Renting shortcode : product (resource) [availability and selector]
		  if ( $post && has_shortcode( $post->post_content , 'mybooking_rent_engine_product') ) {
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
		  if ( $post && has_shortcode( $post->post_content , 'mybooking_activities_engine_activity') ) {
		  	$classes[] = 'mybooking-activity';
		  }
		  // Activities shortcodes : Order
		  if ( $post && has_shortcode( $post->post_content , 'mybooking_activities_engine_order') ) {
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

      // Get the post outside a loop
			global $post;
		  
		  $registry = Mybooking_Registry::getInstance();

		  // Include the initializer plugin
		  $data = array(
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
		      'mybooking_google_api_places' => $registry->mybooking_plugin_google_api_places,
		      'mybooking_google_api_places_api_key' => $registry->mybooking_plugin_google_api_places_api_key,
		      'mybooking_google_api_places_restrict_country_code' => $registry->mybooking_plugin_google_api_places_restrict_country_code,
		      'mybooking_google_api_places_restrict_bounds' => $registry->mybooking_plugin_google_api_places_restrict_bounds,
		      'mybooking_google_api_places_bounds_sw_lat' => $registry->mybooking_plugin_google_api_places_bounds_sw_lat,
		      'mybooking_google_api_places_bounds_sw_lng' => $registry->mybooking_plugin_google_api_places_bounds_sw_lng,
		      'mybooking_google_api_places_bounds_ne_lat' => $registry->mybooking_plugin_google_api_places_bounds_ne_lat,
		      'mybooking_google_api_places_bounds_ne_lng' => $registry->mybooking_plugin_google_api_places_bounds_ne_lng,
		      // Custom Loader
		      'mybooking_custom_loader' => $registry->mybooking_rent_plugin_custom_loader
		  );
		  mybooking_engine_get_template('mybooking-plugin-init-tmpl.php', $data);
		
		  // Renting Selector Wizard shortcode / widget
			if ( is_active_widget( false, false, 'mybooking_rent_engine_selector_wizard_widget', false ) ||
			     ( $post && has_shortcode( $post->post_content , 'mybooking_rent_engine_selector_wizard') ) ) {
				mybooking_engine_get_template('mybooking-plugin-selector-wizard-widget-tmpl.php');
			}		

		  // Load scripts
		  if ( $registry->mybooking_rent_plugin_choose_products_page != '' && mybooking_engine_is_page( $registry->mybooking_rent_plugin_choose_products_page ) ) {
		  	mybooking_engine_get_template('mybooking-plugin-choose-product-tmpl.php');
		  	// If selector in process Wizard, load the micro-templates for the process
		  	if ($registry->mybooking_rent_plugin_selector_in_process == 'wizard') {
		  	  mybooking_engine_get_template('mybooking-plugin-selector-wizard-widget-tmpl.php');
		    }
		  }
		  else if ( $registry->mybooking_rent_plugin_checkout_page != '' && mybooking_engine_is_page( $registry->mybooking_rent_plugin_checkout_page ) ) {
		  	mybooking_engine_get_template('mybooking-plugin-complete-tmpl.php');
		  	// If selector in process Wizard, load the micro-templates for the process
		  	if ($registry->mybooking_rent_plugin_selector_in_process == 'wizard') {
  		  	mybooking_engine_get_template('mybooking-plugin-selector-wizard-widget-tmpl.php');
  		  }
		  }
		  else if ( $registry->mybooking_rent_plugin_summary_page != '' && mybooking_engine_is_page( $registry->mybooking_rent_plugin_summary_page ) ) {
		  	mybooking_engine_get_template('mybooking-plugin-summary-tmpl.php');
		  }	
		  else if ( $registry->mybooking_activities_plugin_shopping_cart_page != '' && mybooking_engine_is_page( $registry->mybooking_activities_plugin_shopping_cart_page ) ) {
		  	mybooking_engine_get_template('mybooking-plugin-activities-shopping-cart-tmpl.php');
		  }
		  else if ( $registry->mybooking_activities_plugin_summary_page != '' && mybooking_engine_is_page( $registry->mybooking_activities_plugin_summary_page ) ) {
		  	mybooking_engine_get_template('mybooking-plugin-activities-summary-tmpl.php');
		  }

      // Renting shortcode : My reservation
      if ( $post && has_shortcode( $post->post_content, 'mybooking_rent_engine_reservation') ) {
      	mybooking_engine_get_template('mybooking-plugin-reservation-tmpl.php');
      } 

      // Activities shortcode : My order
      if ( $post && has_shortcode( $post->post_content, 'mybooking_activities_engine_order') ) {
      	mybooking_engine_get_template('mybooking-plugin-activities-order-tmpl.php');
      }       

      // Renting shortcode : Product calendar
      if ( $post && has_shortcode( $post->post_content, 'mybooking_rent_engine_product') ) {
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
        mybooking_engine_get_template('mybooking-plugin-activity-widget-tmpl.php');
      }


		}

		// == Widgets

		/**
		 * Register selector Widget 
		 */
		public function wp_selector_widget() {

		  register_widget( 'MyBookingRentEngineSelectorWizardWidget' );

		}

		/**
		 * Register selector wizard Widget 
		 */
		public function wp_selector_wizard_widget() {

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
     * Wizard selector wizard shortcode
     */
    public function wp_rent_selector_wizard_shortcode($atts = [], $content = null, $tag = '') {
			
      // Extract the shortcode attributes			
			extract( shortcode_atts( array('sales_channel_code' => '', 
				                             'family_id' => ''), $atts ) );

		  $data = array();

      if ( $sales_channel_code != '' ) {
      	$data['sales_channel_code'] = $sales_channel_code;
      }

      if ( $family_id != '' ) {
      	$data['family_id'] = $family_id;
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

    /**
     * Mybooking products
     */
    public function wp_rent_products_shortcode($atts = [], $content = null, $tag = '') {

			global $post;

      $page = array_key_exists('offsetpage', $_GET) ? $_GET['offsetpage'] : 1;
      $limit = array_key_exists('limit', $_GET) ? $_GET['limit'] : 12;
      $offset = ($page - 1) * $limit;

      // URL for pagination
      $url = $post->post_name;

      // Get the products from the API
      $registry = Mybooking_Registry::getInstance();
      $url_detail = $registry->mybooking_rent_plugin_navigation_products_url ? $registry->mybooking_rent_plugin_navigation_products_url : 'products';
      $api_client = new MybookingApiClient($registry->mybooking_rent_plugin_api_url_prefix,
      	                                   $registry->mybooking_rent_plugin_api_key);
      $data =$api_client->get_products($offset, $limit);
      if ( $data == null) {
      	$data = (object) array('total' => 0,
      		                     'data' => []);
      }

      // Pagination
      $total_pages = ceil($data->total / $limit);
      $current_page = floor($data->offset / $limit) + 1; 
      $pagination = new MyBookingUIPagination();          
      $pages = $pagination->pages($total_pages, $current_page);

      $data = array('data' => $data,
      	            'total_pages' => $total_pages,
      	            'current_page' => $current_page,
      	            'pages' => $pages,
                    'url' => $url,
                    'url_detail' => $url_detail);
			ob_start();
      mybooking_engine_get_template('mybooking-plugin-products.php', $data);
		  return ob_get_clean();

    }

    /**
     * Mybooking activities
     */
    public function wp_activities_activities_shortcode($atts = [], $content = null, $tag = '') {

			global $post;

      $page = array_key_exists('offsetpage', $_GET) ? $_GET['offsetpage'] : 1;
      $limit = array_key_exists('limit', $_GET) ? $_GET['limit'] : 12;
      $offset = ($page - 1) * $limit;

      // URL for pagination
      $url = $post->post_name;

      // Get the products from the API
      $registry = Mybooking_Registry::getInstance();
      $url_detail = $registry->mybooking_rent_plugin_navigation_activities_url ? $registry->mybooking_rent_plugin_navigation_activities_url : 'activities';
      $api_client = new MyBookingActivitiesApiClient($registry->mybooking_rent_plugin_api_url_prefix,
      	                                   					$registry->mybooking_rent_plugin_api_key);
      $data =$api_client->get_activities($offset, $limit);
      if ( $data == null) {
      	$data = (object) array('total' => 0,
      		                     'data' => []);
      }

      // Pagination
      $total_pages = ceil($data->total / $limit);
      $current_page = floor($data->offset / $limit) + 1; 
      $pagination = new MyBookingUIPagination();          
      $pages = $pagination->pages($total_pages, $current_page);

      $data = array('data' => $data,
      	            'total_pages' => $total_pages,
      	            'current_page' => $current_page,
      	            'pages' => $pages,
                    'url' => $url,
                    'url_detail' => $url_detail);
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

	  // ------------ Plugin setup -----------------------

	  /**
	   * Load the plugin options in the registry
	   *
	   * - mybooking_plugin_settings_connection
	   * - mybooking_plugin_settings_configuration
	   * - mybooking_plugin_settings_renting
	   * - mybooking_plugin_settings_activities
	   * - mybooking_plugin_settings_google_api_places
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
      // CSS
		  $settings = (array) get_option("mybooking_plugin_settings_css");	 
		  if ($settings && array_key_exists('mybooking_plugin_settings_components_custom_loader', $settings)) {
				$registry->mybooking_rent_plugin_custom_loader = (trim(esc_attr( $settings["mybooking_plugin_settings_components_custom_loader"] )) == '1');
		  }
		  else {
		  	$registry->mybooking_rent_plugin_custom_loader = '';
		  }		  
		  if ($settings && array_key_exists('mybooking_plugin_settings_components_css', $settings)) {
				$registry->mybooking_rent_plugin_components_css = (trim(esc_attr( $settings["mybooking_plugin_settings_components_css"] )) == '1');
		  }
		  else {
		  	$registry->mybooking_rent_plugin_components_css = '';
		  }
      if ($settings && array_key_exists('mybooking_plugin_settings_custom_css', $settings)) {
		    $registry->mybooking_rent_plugin_custom_css = (trim(esc_attr( $settings["mybooking_plugin_settings_custom_css"] )) == '1');
      }
      else {
        $registry->mybooking_rent_plugin_custom_css = '';
      }
		}

		// ------------ Custom routes ---------------------

    /**
     * Initialize custom routes to show all renting products and activities
     *
     */
		private function init_routes() {

      $registry = Mybooking_Registry::getInstance();


      // Renting product detail route (depends on the settings)
      if ( $registry->mybooking_rent_plugin_detail_pages ) {
	      $url = $registry->mybooking_rent_plugin_navigation_products_url ? $registry->mybooking_rent_plugin_navigation_products_url : 'products';
				Routes::map($url.'/:id', function($params) {
					$this->product_page($params);
				});
		  }

			// Activity detail route (depends on the settings)
			if ( $registry->mybooking_activities_plugin_detail_pages ) {
	      $url = $registry->mybooking_rent_plugin_navigation_activities_url ? $registry->mybooking_rent_plugin_navigation_activities_url : 'activities';
				Routes::map($url.'/:id', function($params) {
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

		/**
		 * Get the page slug from the page Id
		 */
		function page_slug( $pageId ) {

		  if ( $page = get_post( $pageId ) ) {
		    return $page->post_name;
		  }

		}
    

  }