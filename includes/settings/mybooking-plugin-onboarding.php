<?php
  class MybookingPluginOnBoarding {
	  public function __construct() {
	    	$this->wp_init();
	  }

    private function wp_init() {

			// Create menu in settings
			add_action( 'admin_menu', array($this, 'wp_onboarding_page'));
			// Remove onboarding pages from the menu
			add_action( 'admin_head', array($this, 'wp_remove_onboarding_page'));

    }

		// == Settings Page

		/**
		 * Settings page : Create new onboarding page
		 */
		public function wp_onboarding_page() {

		  add_submenu_page(
				'mybooking-plugin-configuration', // Parent slug
				_x('Welcome', 'onboarding_context', 'mybooking-wp-plugin'), // Page title
				_x('Welcome', 'onboarding_context', 'mybooking-wp-plugin'), // Menu option title
				'manage_options', // Capability
				'mybooking-onboarding', // Slug
				array($this, 'mybooking_plugin_onboarding_welcome_page'),
				-2
			); // Callable

			add_submenu_page(
				'mybooking-plugin-configuration', // Parent slug
				_x('Login', 'onboarding_context', 'mybooking-wp-plugin'), // Page title
				_x('Login', 'onboarding_context', 'mybooking-wp-plugin'), // Menu option title
				'manage_options', // Capability
				'mybooking-onboarding-login', // Slug
				array($this, 'mybooking_plugin_onboarding_login_page')
			); // Callable

			add_submenu_page(
				'mybooking-plugin-configuration', // Parent slug
				_x('Generate', 'onboarding_context', 'mybooking-wp-plugin'), // Page title
				_x('Generate', 'onboarding_context', 'mybooking-wp-plugin'), // Menu option title
				'manage_options', // Capability
				'mybooking-onboarding-generate', // Slug
				array($this, 'mybooking_plugin_onboarding_generate_page')
			); // Callable

			add_submenu_page(
				'mybooking-plugin-configuration', // Parent slug
				_x('Results', 'onboarding_context', 'mybooking-wp-plugin'), // Page title
				_x('Results', 'onboarding_context', 'mybooking-wp-plugin'), // Menu option title
				'manage_options', // Capability
				'mybooking-onboarding-resume', // Slug
				array($this, 'mybooking_plugin_onboarding_resume_page')
			); // Callable

			add_submenu_page(
				'mybooking-plugin-configuration', // Parent slug
				_x('Error', 'onboarding_context', 'mybooking-wp-plugin'), // Page title
				_x('Error', 'onboarding_context', 'mybooking-wp-plugin'), // Menu option title
				'manage_options', // Capability
				'mybooking-onboarding-error', // Slug
				array($this, 'mybooking_plugin_onboarding_error_page')
			); // Callable

			add_submenu_page(
				'mybooking-plugin-configuration', // Parent slug
				_x('Pages', 'onboarding_context', 'mybooking-wp-plugin'), // Page title
				_x('Pages', 'onboarding_context', 'mybooking-wp-plugin'), // Menu option title
				'manage_options', // Capability
				'mybooking-onboarding-pages', // Slug
				array($this, 'mybooking_plugin_onboarding_pages_page')
			); // Callable

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

				if ( $setup_completed ) {
					remove_submenu_page( 'mybooking-plugin-configuration', 'mybooking-onboarding-login' );
					remove_submenu_page( 'mybooking-plugin-configuration', 'mybooking-onboarding-generate' );
					remove_submenu_page( 'mybooking-plugin-configuration', 'mybooking-onboarding-resume' );
					remove_submenu_page( 'mybooking-plugin-configuration', 'mybooking-onboarding-error' );
				} else {
					remove_submenu_page( 'mybooking-plugin-configuration', 'mybooking-onboarding-pages' );
					remove_submenu_page( 'mybooking-plugin-configuration', 'mybooking-onboarding-components' );
					remove_submenu_page( 'mybooking-plugin-configuration', 'mybooking-onboarding-login' );
					remove_submenu_page( 'mybooking-plugin-configuration', 'mybooking-onboarding-generate' );
					remove_submenu_page( 'mybooking-plugin-configuration', 'mybooking-onboarding-resume' );
					remove_submenu_page( 'mybooking-plugin-configuration', 'mybooking-onboarding-error' );				
				}
		
		}

		/**
		 * Render Mybooking onboarding page
		 *
		 */
		public function mybooking_plugin_onboarding_welcome_page() {
		  require_once('views/mybooking-plugin-onboarding-welcome.php');
		}
		public function mybooking_plugin_onboarding_login_page() {
		  require_once('views/mybooking-plugin-onboarding-login.php');
		}
		public function mybooking_plugin_onboarding_generate_page() {
		  require_once('views/mybooking-plugin-onboarding-generate.php');
		}
		public function mybooking_plugin_onboarding_resume_page() {
		  require_once('views/mybooking-plugin-onboarding-resume.php');
		}
		public function mybooking_plugin_onboarding_error_page() {
		  require_once('views/mybooking-plugin-onboarding-error.php');
		}
		public function mybooking_plugin_onboarding_pages_page() {
		  require_once('views/mybooking-plugin-onboarding-pages.php');
		}
		public function mybooking_plugin_onboarding_components_page() {
		  require_once('views/mybooking-plugin-onboarding-components.php');
		}
  }
