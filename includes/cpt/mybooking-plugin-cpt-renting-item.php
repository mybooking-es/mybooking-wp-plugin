<?php
  class MyBookingPluginCPTRentingItem {

	  public function __construct()
	  {
	    	$this->register_post_type();
	  }

	  private function register_post_type() {

        register_post_type( 'mybooking_renting_item',
          array(
            'labels' => array(
              'name' => _x('Renting Items', 'renting_item_content', 'mybooking-wp-plugin'),
              'singular_name' => _x('Renting Item', 'renting_item_content', 'mybooking-wp-plugin'),
              'add_new' => _x('Add renting item', 'renting_item_content', 'mybooking-wp-plugin'),
              'add_new_item' => _x('New renting item', 'renting_item_content', 'mybooking-wp-plugin'),
              'edit' => _x('Edit', 'renting_item_content', 'mybooking-wp-plugin'),
              'edit_item' => _x('Edit renting item', 'renting_item_content', 'mybooking-wp-plugin'),
              'new_item' => _x('New renting item', 'renting_item_content', 'mybooking-wp-plugin'),
              'view' => _x('See', 'renting_item_content', 'mybooking-wp-plugin'),
              'view_item' => _x('See renting item', 'renting_item_content', 'mybooking-wp-plugin'),
              'search_items' => _x('Search renting item', 'renting_item_content', 'mybooking-wp-plugin'),
              'not_found' => _x('No renting item found', 'renting_item_content', 'mybooking-wp-plugin'),
              'not_found_in_trash' => _x('No renting item found on bin', 'renting_item_content', 'mybooking-wp-plugin'),
              'parent' => _x('Parent renting item', 'renting_item_content', 'mybooking-wp-plugin')
            ),
            'show_ui' => true,
            'public' => true,
            'show_in_menu' => 'mybooking-plugin-configuration',
            'show_in_rest' => true, // Gutenberg activation!
            'supports' => array( 'title', 'editor', 'thumbnail' ),
            'menu_icon' => 'dashicons-grid-view',
            'has_archive' => true
          )
        );

	  }
	}
