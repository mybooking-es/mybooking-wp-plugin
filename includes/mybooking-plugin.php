<?php

	// Utilities from https://jeroensormani.com/how-to-add-template-files-in-your-plugin/ to manage templates 
	require_once('mybooking-plugin-locate-template.php');
	require_once('mybooking-plugin-get-template.php');
	require_once('mybooking-plugin-load-template.php');
	// Registry
	require_once('mybooking-plugin-registry.php');
	// Widget definition
	require_once('mybooking-plugin-rent-selector-widget.php');
	// Settings
	require_once('mybooking-plugin-settings.php');

  /**
   *
   * MyBooking WordPress Plugin
   * ===============================================================
   *
   * Mybooking Engine for WordPress. 
   * 
   * Extends WordPress to build a reservation engine that uses mybooking.es
   *
   * How it works?
   * ----------------------------
   *
   * The user selects what kind of mybooking wants to apply to the 
   * web site.
   *
   * 1. Reservation wizard for Renting / Accommodation / Car Rental
   *
   * 2. Reservation engine for Renting / Accommodation / Car Rental
   *
   * 3. Reservation engine for Activities / Tours
   *
   * Details 
   * ----------------------------
   *
   * 1.) Reservation Wizard for Renting / Accommodation / Car Rental
   *
   * - 4/5 Steps (each one represented in a page)
   * 
   *    1. Select dates [Widget]
   *    2. Select product(s) [Page]
   *    ?. Select extras [Page]
   *    3. Complete / Checkout [Page]
   *    4. Summary [Page]
   *   
   * 2.) Reservation Engine for Renting / Accommodation / Car Rental
   *
   *    1. Add to renting shopping cart
   *    2. Checkout
   *    3. Summary 
   *
   * 3.) Reservation Engine for Activities/Tours
   *
   *    1. Add to shopping cart
   *    2. Checkout
   *    3. Summary
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
		  $registry->mybooking_rent_plugin_api_key = trim(esc_attr( $settings["mybooking_plugin_settings_api_key"] ));
		  $registry->mybooking_rent_plugin_choose_products_page = $this->page_slug(trim(esc_attr( $settings["mybooking_plugin_settings_choose_products_page"] )));
		  $registry->mybooking_rent_plugin_choose_extras_page = $this->page_slug(trim(esc_attr( $settings["mybooking_plugin_settings_choose_extras_page"] )));
		  $registry->mybooking_rent_plugin_checkout_page = $this->page_slug(trim(esc_attr( $settings["mybooking_plugin_settings_checkout_page"] )));
		  $registry->mybooking_rent_plugin_summary_page = $this->page_slug(trim(esc_attr( $settings["mybooking_plugin_settings_summary_page"] )));
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


	  // ------------ WordPress plugin init -------------
	  
	  /*
	   * Initialize the WordPress Plugin
	   */
	  private function wp_init() {

			// Apply body tags on reservation pages
			add_filter( 'body_class', array($this, 'wp_body_class'));

			// -- Custom CSS and JavaScript

			// Add Header CSS
			add_action( 'wp_enqueue_scripts', array($this, 'wp_setup_css'));

			// Add Footer Scripts
			add_action( 'wp_footer', array($this, 'wp_setup_script'));

			// Add mybooking-engine.js
			add_action( 'wp_enqueue_scripts', array($this, 'wp_script_load'));

			// -- Widgets

			// Register Widget
			add_action( 'widgets_init', array($this, 'wp_selector_widget'));

			// -- Shortcodes

			// Shortcode widget selector
			add_shortcode('mybooking_rent_engine_selector', array($this, 'wp_selector_shortcode'));

			// Shortcode product listing
			add_shortcode('mybooking_rent_engine_product_listing', array($this, 'wp_product_listing_shortcode' ));

			// Shortcode complete
			add_shortcode('mybooking_rent_engine_complete', array($this, 'wp_complete_shortcode' ));

			// Shortcode summary
			add_shortcode('mybooking_rent_engine_summary', array($this, 'wp_summary_shortcode' ));

	  }


		/**
		 * Add body classes to the pages
		 */
		public function wp_body_class ( $classes ) {

		  $registry = Mybooking_Registry::getInstance();

			if ( is_active_widget( false, false, 'mybooking_rent_engine_selector_widget', false ) ) {
				$classes[] = 'mybooking-selector-widget';
			}		
		  
		  if ( $registry->mybooking_rent_plugin_choose_products_page != '' && is_page( $registry->mybooking_rent_plugin_choose_products_page) ) {
		  	$classes[] = 'choose_product';
		  }
		  else if ( $registry->mybooking_rent_plugin_checkout_page != '' && is_page( $registry->mybooking_rent_plugin_checkout_page ) ) {
		  	$classes[] = 'complete';
		  }
		  else if ( $registry->mybooking_rent_plugin_summary_page != '' && is_page( $registry->mybooking_rent_plugin_summary_page ) ) {
		  	$classes[] = 'summary';
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
		      'mybooking_summary_page' => $registry->mybooking_rent_plugin_summary_page
		  );
		  mybooking_engine_get_template('mybooking-plugin-init-tmpl.php', $data);
			
		  // Load scripts
		  if ( is_page( $registry->mybooking_rent_plugin_choose_products_page) ) {
		  	mybooking_engine_get_template('mybooking-plugin-choose-product-tmpl.php');
		  }
		  if ( is_page( $registry->mybooking_rent_plugin_checkout_page ) ) {
		  	mybooking_engine_get_template('mybooking-plugin-complete-tmpl.php');
		  }
		  if ( is_page( $registry->mybooking_rent_plugin_summary_page ) ) {
		  	mybooking_engine_get_template('mybooking-plugin-summary-tmpl.php');
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

		// == Shortcodes
		// See https://konstantin.blog/2013/get_template_part-within-shortcodes/

		/**
		 * Mybooking rent engine selector shortcode
		 */
		public function wp_selector_shortcode() {

			ob_start();
			mybooking_engine_get_template('mybooking-plugin-selector-widget.php'); 
			return ob_get_clean();

		}

		/**
		 * Mybooking rent engine Product Listing shortcode
		 */
		public function wp_product_listing_shortcode() {
			
			ob_start();
	    mybooking_engine_get_template('mybooking-plugin-choose-product.php');
	    return ob_get_clean();
	
		}

		/**
		 * Mybooking rent engine Complete shortcode
		 */
		public function wp_complete_shortcode() {
			
			ob_start();
			mybooking_engine_get_template('mybooking-plugin-complete.php');
			return ob_get_clean();

		}

		/**
		 * Mybooking rent engine Complete shortcode
		 */
		public function wp_summary_shortcode() {
			
			ob_start();
			mybooking_engine_get_template('mybooking-plugin-summary.php');
			return ob_get_clean();

		}

  }