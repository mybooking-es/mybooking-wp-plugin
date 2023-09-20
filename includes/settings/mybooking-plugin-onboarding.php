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
        'Mybooking Welcome', // Page title
        'Welcome', // Menu option title
        'manage_options', // Capability
        'mybooking-onboarding', // Slug
        array($this, 'mybooking_plugin_onboarding_welcome_page')
      ); // Callable

			add_submenu_page(
				'mybooking-plugin-configuration', // Parent slug
        'Mybooking generate', // Page title
        'Generate', // Menu option title
        'manage_options', // Capability
        'mybooking-onboarding-generate', // Slug
        array($this, 'mybooking_plugin_onboarding_generate_page')
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

			add_submenu_page(
				'mybooking-plugin-configuration', // Parent slug
        'Mybooking Páginas', // Page title
        'Páginas', // Menu option title
        'manage_options', // Capability
        'mybooking-onboarding-pages', // Slug
        array($this, 'mybooking_plugin_onboarding_pages_page')
      ); // Callable

			add_submenu_page(
				'mybooking-plugin-configuration', // Parent slug
        'Mybooking Componentes', // Page title
        'Componentes', // Menu option title
        'manage_options', // Capability
        'mybooking-onboarding-components', // Slug
        array($this, 'mybooking_plugin_onboarding_components_page')
      ); // Callable

		}

		/**
		 * Settings page : Remove onboarding pages from the menu
		 */		
    public function wp_remove_onboarding_page() {

			// TODO Uncomment when finished
			//remove_submenu_page( 'mybooking-plugin-configuration', 'mybooking-onboarding-generate' );
		
		}

		/**
		 * Render Mybooking onboarding page
		 *
		 */
		public function mybooking_plugin_onboarding_welcome_page() {
		  require_once('views/mybooking-plugin-onboarding-welcome.php');
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
