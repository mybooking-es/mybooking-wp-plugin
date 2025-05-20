<?php
  /**
   * Retrieve the URL for the characteristics icons.
   *
   */
function mybooking_engine_get_characteristics_icons_url() {
  $default_url = plugin_dir_url( dirname( __DIR__ ) ) . 'assets/images/key_characteristics/';
  return apply_filters( 'mybooking_engine_characteristics_icons_url', $default_url );
}