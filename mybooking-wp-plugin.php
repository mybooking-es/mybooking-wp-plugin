<?php
/**
* Plugin Name: MyBooking Reservation Engine
* Plugin URI: https://www.mybooking.es/
* Description: Reservation Engine WordPress frontend for Mybooking. Transforms wordpress into a rental / accommodation / tours reservation engine.
* Version: 2.3.8
* Author: mybooking
* Author URI: https://mybooking.es/
* License: GPL v2 or later
* License URI: https://www.gnu.org/licenses/gpl-2.0.html
**/

// Include the main Mybooking class
if ( ! class_exists( 'MyBookingPlugin', false ) ) {
  include_once dirname( __FILE__ ) . '/includes/mybooking-plugin.php';
}

// Create a constant to hold the plugin URL so it can be used to build
// resources paths 
$url = plugin_dir_url(__FILE__);
define('MYBOOKING_RESERVATION_ENGINE_PLUGIN_URL', $url );

// Create a constant to hold the plugin languages folder
$languages_folder = dirname( plugin_basename(__FILE__) ).'/languages';
define('MYBOOKING_RESERVATION_ENGINE_LANGUAGES_FOLDER', $languages_folder );

// Create a constant to hold the plugin scripts languages folder (absolute path)
$scripts_languages_folder = plugin_dir_path( __FILE__).'languages';
define('MYBOOKING_RESERVATION_ENGINE_SCRIPTS_LANGUAGES_FOLDER', $scripts_languages_folder );

// Return the main instance of Mybooking Plugin
function mybookingPlugin() {
  return MyBookingPlugin::getInstance();
}

$GLOBALS['mybooking-wp-plugin'] = mybookingPlugin();
