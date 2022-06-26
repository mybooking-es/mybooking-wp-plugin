<?php
/**
* Plugin Name: MyBooking Reservation Engine
* Plugin URI: https://www.mybooking.es/
* Description: Reservation Engine WordPress frontend for Mybooking. Transforms wordpress into a rental / accommodation / tours reservation engine.
* Version: 1.6.7
* Author: mybooking
* Author URI: https://mybooking.es/
**/

// Include the main Mybooking class
if ( ! class_exists( 'MyBookingPlugin', false ) ) {
  include_once dirname( __FILE__ ) . '/includes/mybooking-plugin.php';
}

// Return the main instance of Mybooking Plugin
function mybookingPlugin() {
  return MyBookingPlugin::getInstance();
}

$GLOBALS['mybooking-wp-plugin'] = mybookingPlugin();
