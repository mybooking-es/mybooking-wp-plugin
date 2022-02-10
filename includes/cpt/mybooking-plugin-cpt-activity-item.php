<?php
  class MyBookingPluginCPTActivityItem {

	  public function __construct()
	  {
	    	$this->register_post_type();
	  }

	  private function register_post_type() {

        register_post_type( 'mybooking_activity_item',
          array(
            'labels' => array(
              'name' => _x('Activity Items', 'activity_item_content', 'mybooking-wp-plugin'),
              'singular_name' => _x('Activity Item', 'activity_item_content', 'mybooking-wp-plugin'),
              'add_new' => _x('Add activity item', 'activity_item_content', 'mybooking-wp-plugin'),
              'add_new_item' => _x('New activity item', 'activity_item_content', 'mybooking-wp-plugin'),
              'edit' => _x('Edit', 'activity_item_content', 'mybooking-wp-plugin'),
              'edit_item' => _x('Edit activity item', 'activity_item_content', 'mybooking-wp-plugin'),
              'new_item' => _x('New activity item', 'activity_item_content', 'mybooking-wp-plugin'),
              'view' => _x('See', 'activity_item_content', 'mybooking-wp-plugin'),
              'view_item' => _x('See activity item', 'activity_item_content', 'mybooking-wp-plugin'),
              'search_items' => _x('Search activity item', 'activity_item_content', 'mybooking-wp-plugin'),
              'not_found' => _x('No activity_item found', 'activity_item_content', 'mybooking-wp-plugin'),
              'not_found_in_trash' => _x('No activity item found on bin', 'activity_item_content', 'mybooking-wp-plugin'),
              'parent' => _x('Parent activity item', 'activity_item_content', 'mybooking-wp-plugin')
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
