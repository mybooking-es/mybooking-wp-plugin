<?php
  class MybookingPluginOnBoarding {
	  public function __construct() {
	    	$this->wp_init();
	  }

    private function wp_init() {

			// Create menu in settings
			add_action( 'admin_menu', array($this,'wp_onboarding_page'));
    }

		// == Settings Page

		/**
		 * Settings page : Create new onboarding page
		 */
		public function wp_onboarding_page() {
		  add_submenu_page(
				'mybooking-plugin-configuration', // Parent slug
        'Mybooking Welcome', // Page title
        'Welcome', // Menu option title
        'manage_options', // Capability
        'mybooking-onboarding', // Slug
        array($this, 'mybooking_plugin_onboarding_welcome_page')
      ); // Callable

			add_submenu_page(
				'mybooking-plugin-configuration', // Parent slug
        'Mybooking Selector', // Page title
        'Selector', // Menu option title
        'manage_options', // Capability
        'mybooking-onboarding-selector', // Slug
        array($this, 'mybooking_plugin_onboarding_selector_page')
      ); // Callable

			add_submenu_page(
				'mybooking-plugin-configuration', // Parent slug
        'Mybooking Resultado', // Page title
        'Resultado', // Menu option title
        'manage_options', // Capability
        'mybooking-onboarding-resume', // Slug
        array($this, 'mybooking_plugin_onboarding_resume_page')
      ); // Callable

			add_submenu_page(
				'mybooking-plugin-configuration', // Parent slug
        'Mybooking Error', // Page title
        'Error', // Menu option title
        'manage_options', // Capability
        'mybooking-onboarding-error', // Slug
        array($this, 'mybooking_plugin_onboarding_error_page')
      ); // Callable

			function add_scripts() {
				wp_enqueue_script( 'jquery' );
			}

			add_action('wp_enqueue_scripts', 'add_scripts');
			do_action('wp_enqueue_scripts');
		}

		/**
		 * Render Mybooking onboarding page
		 *
		 */
		public function mybooking_plugin_onboarding_welcome_page() {
		  require_once('views/mybooking-plugin-onboarding-welcome.php');
		}
		public function mybooking_plugin_onboarding_selector_page() {
		  require_once('views/mybooking-plugin-onboarding-selector.php');
		}
		public function mybooking_plugin_onboarding_resume_page() {
		  require_once('views/mybooking-plugin-onboarding-resume.php');
		}
		public function mybooking_plugin_onboarding_error_page() {
		  require_once('views/mybooking-plugin-onboarding-error.php');
		}
  }
