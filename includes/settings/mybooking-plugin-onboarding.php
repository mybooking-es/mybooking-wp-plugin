<?php

	require_once( 'use_case/class-mybooking-create-pages.php' );
	require_once( 'use_case/class-mybooking-renting-module.php' );
	require_once( 'use_case/class-mybooking-activities-module.php' );
	require_once( 'use_case/class-mybooking-transfer-module.php' );

  class MybookingPluginOnBoarding {
	  
		const PAGES_ORDER = ['mybooking_plugin_settings_home_test_page' => 1,
												'mybooking_plugin_settings_choose_products_page' => 2,
												'mybooking_plugin_settings_checkout_page' => 3,
												'mybooking_plugin_settings_summary_page' => 4,
												'mybooking_plugin_settings_my_reservation_page' => 13, // MAX for three modules
												'mybooking_plugin_settings_choose_vehicle_page' => 7,
												'mybooking_plugin_settings_transfer_checkout_page' => 8,
												'mybooking_plugin_settings_transfer_summary_page' => 9,
												'mybooking_plugin_settings_activities_shopping_cart_page' => 11,
												'mybooking_plugin_settings_activities_summary_page' => 12
												];
		
		private $last_error = null;

		public function __construct() {
	    	$this->wp_init();
	  }

    private function wp_init() {

			// Create menu in settings
			add_action( 'admin_menu', array($this, 'wp_onboarding_page'));
			// Remove onboarding pages from the menu
			add_action( 'admin_head', array($this, 'wp_remove_onboarding_page'));
			// To allow redirect in the onboarding wizard process 
			add_action('admin_init', array($this, 'wp_check_wizard_process'));

    }

		// == Settings Page

		/**
		 * Settings page : Create new onboarding page
		 */
		public function wp_onboarding_page() {

			// Onboarding Step 1 : Welcome
		  add_submenu_page(
				'mybooking-plugin-configuration', // Parent slug
				_x('Welcome', 'onboarding_context', 'mybooking-wp-plugin'), // Page title
				_x('Welcome', 'onboarding_context', 'mybooking-wp-plugin'), // Menu option title
				'manage_options', // Capability
				'mybooking-onboarding', // Slug
				array($this, 'mybooking_plugin_onboarding_welcome_page'),
				-2
			); // Callable

			// Onboarding Step 2 : Login
			add_submenu_page(
				null, // Parent slug - null to avoid to show in the menu
				_x('Login', 'onboarding_context', 'mybooking-wp-plugin'), // Page title
				_x('Login', 'onboarding_context', 'mybooking-wp-plugin'), // Menu option title
				'manage_options', // Capability
				'mybooking-onboarding-login', // Slug
				array($this, 'mybooking_plugin_onboarding_login_page')
			); // Callable

			// Onboarding Step 3 : Generate
			add_submenu_page(
				null, // Parent slug - null to avoid to show in the menu
				_x('Generate', 'onboarding_context', 'mybooking-wp-plugin'), // Page title
				_x('Generate', 'onboarding_context', 'mybooking-wp-plugin'), // Menu option title
				'manage_options', // Capability
				'mybooking-onboarding-generate', // Slug
				array($this, 'mybooking_plugin_onboarding_generate_page')
			); // Callable

			// Onboarding Step 4 : Resume
			add_submenu_page(
				null, // Parent slug - null to avoid to show in the menu
				_x('Results', 'onboarding_context', 'mybooking-wp-plugin'), // Page title
				_x('Results', 'onboarding_context', 'mybooking-wp-plugin'), // Menu option title
				'manage_options', // Capability
				'mybooking-onboarding-resume', // Slug
				array($this, 'mybooking_plugin_onboarding_resume_page')
			); // Callable

			// Onboarding Error (on any step) 
			add_submenu_page(
				null, // Parent slug - null to avoid to show in the menu
				_x('Error', 'onboarding_context', 'mybooking-wp-plugin'), // Page title
				_x('Error', 'onboarding_context', 'mybooking-wp-plugin'), // Menu option title
				'manage_options', // Capability
				'mybooking-onboarding-error', // Slug
				array($this, 'mybooking_plugin_onboarding_error_page')
			); // Callable

			// Summary pages
			// TODO Refactor extract from onboarding
			add_submenu_page(
				'mybooking-plugin-configuration', // Parent slug
				_x('Pages', 'onboarding_context', 'mybooking-wp-plugin'), // Page title
				_x('Pages', 'onboarding_context', 'mybooking-wp-plugin'), // Menu option title
				'manage_options', // Capability
				'mybooking-onboarding-pages', // Slug
				array($this, 'mybooking_plugin_onboarding_pages_page')
			); // Callable

			// Component pages
			// TODO Refactor extract from onboarding
			add_submenu_page(
				'mybooking-plugin-configuration', // Parent slug
				_x('Components', 'onboarding_context', 'mybooking-wp-plugin'), // Page title
				_x('Components', 'onboarding_context', 'mybooking-wp-plugin'), // Menu option title
				'manage_options', // Capability
				'mybooking-onboarding-components', // Slug
				array($this, 'mybooking_plugin_onboarding_components_page')
			); // Callable

		}

		/**
		 * Settings page : Remove onboarding pages from the menu
		 */		
    public function wp_remove_onboarding_page() {

			// Check install completed
			$setup_completed = MybookingInstall::installCompleted();

			if ( !$setup_completed ) {
				remove_submenu_page( 'mybooking-plugin-configuration', 'mybooking-onboarding-pages' );
				remove_submenu_page( 'mybooking-plugin-configuration', 'mybooking-onboarding-components' );
			}
		
		}

		/**
		 * Render Mybooking onboarding page
		 *
		 */
		public function mybooking_plugin_onboarding_welcome_page() {
		  require_once('views/mybooking-plugin-onboarding-welcome.php');
		}

		/**
		 * Check if it is a wizard process
		 */
		public function wp_check_wizard_process(){

			global $pagenow;
			if ( is_admin() ) {
				// Check it is an admin page
				if ($pagenow == 'admin.php') {
					// Check it is the login or genrate page
					if ( $_SERVER['REQUEST_METHOD'] === 'POST' ) {
						if ( isset( $_GET['page'] ) ) {		
							$the_page = sanitize_key( $_GET['page'] );		 
							if ( 'mybooking-onboarding-login' == $the_page ) {
								if ( isset( $_POST['nonce_field'] ) && wp_verify_nonce( $_POST['nonce_field'], 'login' ) ) {
									// This is required in order to redirect and make the wizard work
									ob_start();
								}
							}
							if ( 'mybooking-onboarding-generate' == $the_page ) {
								if ( isset( $_POST['nonce_field'] ) && wp_verify_nonce( $_POST['nonce_field'], 'generate' ) ) {
									// This is required in order to redirect and make the wizard work
									ob_start();
								}
							}
						}
					}
				}
			}

		}

		/**
		 * Login page
		 */
		public function mybooking_plugin_onboarding_login_page() {

			if ( $_SERVER['REQUEST_METHOD'] === 'POST' ) {
				if ( isset( $_POST['nonce_field'] ) && wp_verify_nonce( $_POST['nonce_field'], 'login' ) ) {
					// Extract parameters
					$clientId = sanitize_text_field( $_POST['client_id'] );
					$apiKey = sanitize_text_field( $_POST['api_key'] );					
					// Do the login
					$result = $this->login( $clientId, $apiKey );
					if ( $result ) {
						// Go to next step
						wp_safe_redirect( menu_page_url('mybooking-onboarding-generate') );
						exit;					
					}
					else {
						// Go to error page
						wp_safe_redirect( menu_page_url('mybooking-onboarding-error') );
						exit;
					}
				}
			}
			else {
				// Just render the page	
				require_once('views/mybooking-plugin-onboarding-login.php');
			}
		  
		}

		/**
		 * Generate page
		 */
		public function mybooking_plugin_onboarding_generate_page() {
		
			if ( $_SERVER['REQUEST_METHOD'] === 'POST' ) {

				if ( isset( $_POST['nonce_field'] ) && wp_verify_nonce( $_POST['nonce_field'], 'generate' ) ) {				
					$pages = $this->generate_pages();

					if ($pages !== null && !empty($pages) ) {
						// Go to next step
						wp_safe_redirect( menu_page_url('mybooking-onboarding-resume') );
						exit;			
					}
					else {
						// Go to error page
						wp_safe_redirect( menu_page_url('mybooking-onboarding-error') );
						exit;
					}
				}

			} else {

				// Load data required to render the view
				$onboarding_settings = (array) get_option('mybooking_plugin_onboarding_business_info');

				if ( $onboarding_settings ) {
					$trade_name = $family_name = '';
					if (array_key_exists('trade_name', $onboarding_settings)) {
						$trade_name = $onboarding_settings["trade_name"];
					}
					if (array_key_exists('booking_item_family_name', $onboarding_settings)) {
						$family_name = $onboarding_settings["booking_item_family_name"];
					}
		
					$module_rental = $module_activities = $module_transfer = false;
					if (array_key_exists('module_rental', $onboarding_settings)) {
						$module_rental = $onboarding_settings["module_rental"];
					}
				
					if (array_key_exists('module_activities', $onboarding_settings)) {
						$module_activities = $onboarding_settings["module_activities"];
					}
		
					if (array_key_exists('module_transfer', $onboarding_settings)) {
						$module_transfer = $onboarding_settings["module_transfer"];
					}
		
					// Just render the page
					require_once('views/mybooking-plugin-onboarding-generate.php');					

				}
				else {
					wp_safe_redirect('mybooking-plugin-onboarding-welcome.php');
					exit;
				}

			}

		}

		/**
		 * Resume page
		 */
		public function mybooking_plugin_onboarding_resume_page() {
		
			// Verify setup is completed
			$setup_completed = MybookingInstall::installCompleted();

			// Get onboarding settings
			$onboarding_settings = (array) get_option('mybooking_plugin_onboarding_business_info');
		
			if ( $onboarding_settings ) {
				// Set type of module 
				$module_rental = $module_activities = $module_transfer = false;
				if (array_key_exists('module_rental', $onboarding_settings)) {
						$module_rental = $onboarding_settings["module_rental"];
				}
					if (array_key_exists('module_activities', $onboarding_settings)) {
						$module_activities = $onboarding_settings["module_activities"];
				}
					if (array_key_exists('module_transfer', $onboarding_settings)) {
						$module_transfer = $onboarding_settings["module_transfer"];
				}
			}

			// Get settings
			if ($module_rental) {
				$rental_settings = (array) get_option("mybooking_plugin_settings_renting");
				$rental_pages_list = $this->build_resume_page_list($rental_settings);
			}

			// Get activities settings
			if ($module_activities) {
				$activities_settings = (array) get_option("mybooking_plugin_settings_activities");
				$activities_pages_list = $this->build_resume_page_list($activities_settings);
			}

			// Get transfer settings
			if ($module_transfer) {
				$transfer_settings = (array) get_option("mybooking_plugin_settings_transfer");
				$transfer_pages_list = $this->build_resume_page_list($transfer_settings);
			}

			// Get clientId from settings
			$connection_settings = (array) get_option("mybooking_plugin_settings_connection");
			$clientId = $connection_settings['mybooking_plugin_settings_account_id']; 

			require_once('views/mybooking-plugin-onboarding-resume.php');

		}

		/**
		 * Error in process
		 */
		public function mybooking_plugin_onboarding_error_page() {
		
			require_once('views/mybooking-plugin-onboarding-error.php');
		}

		/**
		 * List of pages
		 */
		public function mybooking_plugin_onboarding_pages_page() {
			
			// Get current active modules (take into account retro compatibility)
			$settings = (array) get_option("mybooking_plugin_settings_configuration");
			$module_rental = $module_activities = $module_transfer = false;
			if ( array_key_exists( 'mybooking_plugin_settings_renting_selector', $settings ) && 
					 $settings['mybooking_plugin_settings_renting_selector'] == '1' ) {
				$module_rental = true;        
			}
			if ( array_key_exists( 'mybooking_plugin_settings_activities_selector', $settings ) && 
					 $settings['mybooking_plugin_settings_activities_selector'] == '1' ) {
				$module_activities = true;        
			}
			if ( array_key_exists( 'mybooking_plugin_settings_transfer_selector', $settings ) && 
					 $settings['mybooking_plugin_settings_transfer_selector'] == '1' ) {
				$module_transfer = true;        
			}  

			// Get settings
			if ($module_rental) {
				$rental_settings = (array) get_option("mybooking_plugin_settings_renting");
				$rental_obj = $this->build_pages_page_list($rental_settings);
			}

			// Get activities settings
			if ($module_activities) {
				$activities_settings = (array) get_option("mybooking_plugin_settings_activities");
				$activities_obj = $this->build_pages_page_list($activities_settings);
			}

			// Get transfer settings
			if ($module_transfer) {
				$transfer_settings = (array) get_option("mybooking_plugin_settings_transfer");
				$transfer_obj = $this->build_pages_page_list($transfer_settings);
			}

			require_once('views/mybooking-plugin-onboarding-pages.php');
		}
		
		/**
		 * Components page
		 */
		public function mybooking_plugin_onboarding_components_page() {

			// Get onboarding settings
			$onboarding_settings = (array) get_option('mybooking_plugin_onboarding_business_info');

			if ( $onboarding_settings ) {
				// Set type of module 
				$module_rental = $module_activities = $module_transfer = false;
				if (array_key_exists('module_rental', $onboarding_settings)) {
					$module_rental = $onboarding_settings["module_rental"];
				}
				if (array_key_exists('module_activities', $onboarding_settings)) {
					$module_activities = $onboarding_settings["module_activities"];
				}
				if (array_key_exists('module_transfer', $onboarding_settings)) {
					$module_transfer = $onboarding_settings["module_transfer"];
				}
			}

		  require_once('views/mybooking-plugin-onboarding-components.php');
		}

		// ---- Internal methods

		/**
		 * Do the login to Mybooking account and retrieve customer details
		 */
		private function login($clientId, $apiKey) {

			// Check parameters
			if ( empty($clientId) || empty($apiKey) ) {
				return false;
			} 

			// Build the URL prefix from the clientID
			$urlPrefix = '';

			// Check if the clientId is an id or a full URL
			if (filter_var($clientId, FILTER_VALIDATE_URL)) {
				$urlPrefix = $clientId;
			}
			else {
				$urlPrefix = 'https://'.$clientId.'.mybooking.es';
			}

			// Build the URL
			$url = $urlPrefix.'/api/booking/frontend/wizard-info'; //MyBookingOnboardingApi::GET_SETTINGS;
			$url .= '?api_key='.$apiKey;

			// Make the API request to mybooking
			$res = wp_safe_remote_request($url, array(
				'headers'     => array(
					'Content-Type' => 'application/json; charset=utf-8',
					'reject_unsafe_urls' => true
				),
				'method'      => 'GET',
				'timeout'    => 30,
			));

			// Validate error
			if(!is_wp_error($res)) {

				if ($res['response']['code'] == 200 || $res['response']['code'] == 201 ) {

					// Decode response into an associate array
					$onboarding_data = json_decode($res['body'], true);

					// Store information in settings (add_option) - mybooking_plugin_onboarding_finished
					update_option("mybooking_plugin_onboarding_business_info", $onboarding_data);

					// Update connection settings (TODO if does not exist)
					$connection_settings = (array) get_option("mybooking_plugin_settings_connection");
					$connection_settings['mybooking_plugin_settings_account_id'] = $clientId; 
					$connection_settings['mybooking_plugin_settings_api_key'] = $apiKey;
					update_option("mybooking_plugin_settings_connection", $connection_settings);
					return true;

				} else {
					return false;					
				}
			} else {
				return false;				
			}

		}

		/**
		 * Generate pages
		 */
		private function generate_pages() {

      // Retrieve the business info stored in login
      $onboarding_settings = (array) get_option('mybooking_plugin_onboarding_business_info');

      $pages = array();

      if ( $onboarding_settings ) {

        // Renting
        $renting_module = new MybookingRentingModule();
        if ( array_key_exists('module_rental', $onboarding_settings) && $onboarding_settings['module_rental'] ) {
          // Create the pages
          $pages['renting'] = $renting_module->createRentingPages($onboarding_settings['wc_rent_selector']);
          // Configure renting module in settings
          $renting_module->setupRentingModule();
        } else {
          // Clear the renting module
          $renting_module->clearRentingModule();            
        }

        // Activities
        $activities_module = new MybookingActivitiesModule();
        if ( array_key_exists('module_activities', $onboarding_settings) && $onboarding_settings['module_activities'] ) {
          // Create the pages
          $pages['activities'] = $activities_module->createActivitiesPages();
          // Configure activities module in settings
          $activities_module->setupActivitiesModule();
        } else {
          // Clear the activities module
          $activities_module->clearActivitiesModule();            
        }

        // Transfer
        $transfer_module = new MybookingTransferModule();
        if ( array_key_exists('module_transfer', $onboarding_settings) && $onboarding_settings['module_transfer'] )  {
          // Create the pages
          $pages['transfer'] = $transfer_module->createTransferPages();
          // Configure transfer module in settings
          $transfer_module->setupTransferModule();
        } else {
          // Clear the transfer module
          $transfer_module->clearTransferModule();            
        }

      }

			return $pages;

		} 

		// ----- Utility methods

		/**
		 * Get page list from settings
		 */
		private function build_resume_page_list($settings) {
			$pages_ids = array();
			foreach ($settings as $key => $value) {
				// Get all pages with _page end characters in key
				if (str_ends_with($key, '_page') && ( strpos($key, '_summary_')  || strpos($key, '_my_reservation_')) ) {

					if (array_key_exists( $key, self::PAGES_ORDER) ) {
						$order = self::PAGES_ORDER[$key];
						$pages_ids[$order] = $value;
					}

				}
			}
			
			// Sort the pages
			ksort($pages_ids);

			return $pages_ids;
		}
		
		/**
		 * Build the page list on recover
		 */
		private function build_pages_page_list ($settings) {
			$pages_ids = array();
			$home_page_id = 0;

			foreach ($settings as $key => $value) {

				if (array_key_exists( $key, self::PAGES_ORDER) ) {
					$order = self::PAGES_ORDER[$key];
					$pages_ids[$order] = $value;
				}

				if ($key == 'mybooking_plugin_settings_home_test_page') {
					$home_page_id = $value;		
				}

			}
			
			// Sort the pages
			ksort($pages_ids);

			return array(
				"pages_ids" => $pages_ids,
				"home_page_id" => $home_page_id,
			);
		}

  }
