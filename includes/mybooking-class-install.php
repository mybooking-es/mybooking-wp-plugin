<?php 
class MyBookingInstall {


 /**
  * Load the plugin textdomain languages
  */
  public static function load_plugin_textdomain() {

		//$locale = determine_locale();

		/**
		 * Filter to adjust the Mybooking Plugin locale to use for translations.
		 */
		//$locale = apply_filters( 'plugin_locale', $locale, 'mybooking-wp-plugin' );

		//unload_textdomain( 'mybooking-wp-plugin' );
    
    $languages_folder = dirname(plugin_basename(__DIR__)).'/languages';

    unload_textdomain( 'mybooking-wp-plugin' );
    //load_text_domain( 'mybooking-wp-plugin', $locale_file);
    load_plugin_textdomain( 'mybooking-wp-plugin', FALSE, $languages_folder );

    // This module is located in includes and the languages is in the
    // root directory of the plugin : 'mybooking-wp-plugin/languages/'

    //$languages_folder = dirname(plugin_basename(__DIR__)).'/languages';
    //load_plugin_textdomain( 'mybooking-wp-plugin', FALSE, $languages_folder );

   }

  /**
   * Check if the install process is completed
   */
  public static function installCompleted() {

    $connection_settings = (array) get_option("mybooking_plugin_settings_connection");
    $settings = (array) get_option("mybooking_plugin_settings_configuration");
    $setup_completed = false;

    if (isset( $connection_settings['mybooking_plugin_settings_account_id'] ) ) {
      if ( ( array_key_exists( 'mybooking_plugin_settings_renting_selector', $settings) && 
            $settings['mybooking_plugin_settings_renting_selector'] == '1' ) || 
          ( array_key_exists( 'mybooking_plugin_settings_activities_selector', $settings) && 
            $settings['mybooking_plugin_settings_activities_selector'] == '1' ) ||
          ( array_key_exists( 'mybooking_plugin_settings_transfer_selector', $settings) && 
            $settings['mybooking_plugin_settings_transfer_selector'] == '1' ) ) {
        $setup_completed = true;				
      }
    }

    return $setup_completed;

  }

  /**
   * Check if it is one module install
   */
  public static function isOneModuleInstall() {

    $modules = 0;

    $onboarding_settings = (array) get_option('mybooking_plugin_onboarding_business_info');
    
    if ( array_key_exists('module_rental', $onboarding_settings) && $onboarding_settings['module_rental'] ) {
      $modules++;
    }
    
    if ( array_key_exists('module_activities', $onboarding_settings) && $onboarding_settings['module_activities'] ) {
      $modules++;
    }

    if ( array_key_exists('module_transfer', $onboarding_settings) && $onboarding_settings['module_transfer'] )  {
      $modules++;
    }

    return ($modules == 1);

  }

}