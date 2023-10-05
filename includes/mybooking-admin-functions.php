<?php

/**
 * Swith mybooking language to site locale
 */
function mybooking_switch_to_site_locale() {
	global $wp_locale_switcher;

	if ( function_exists( 'switch_to_locale' ) && isset( $wp_locale_switcher ) ) {
		switch_to_locale( get_locale() );

		// Filter on plugin_locale so load_plugin_textdomain loads the correct locale.
		add_filter( 'plugin_locale', 'get_locale' );

		// Init Mybooking locale.
		MyBookingInstall::load_plugin_textdomain();
	}
}

/**
 * Switch Mybooking language to original.
 *
 * @since 3.1.0
 */
function mybooking_restore_locale() {
	global $wp_locale_switcher;

	if ( function_exists( 'restore_previous_locale' ) && isset( $wp_locale_switcher ) ) {
		restore_previous_locale();

		// Remove filter.
		remove_filter( 'plugin_locale', 'get_locale' );

		// Init Mybooking locale.
		MyBookingInstall::load_plugin_textdomain();
	}
}