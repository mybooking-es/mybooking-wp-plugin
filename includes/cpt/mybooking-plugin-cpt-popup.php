<?php
  class MyBookingPluginCPTPopup {

	  public function __construct()
	  {
	    	$this->register_post_type();
	  }

	  private function register_post_type() {

			register_post_type( 'popup',
			          array(
			            'labels' => array(
			              'name' => _x('Popup ads', 'popup_content', 'mybooking-reservation-engine'),
			              'singular_name' => _x('Popup ad', 'popup_content', 'mybooking-reservation-engine'),
			              'add_new' => _x('Add popup ad', 'popup_content', 'mybooking-reservation-engine'),
			              'add_new_item' => _x('New popup ad', 'popup_content', 'mybooking-reservation-engine'),
			              'edit' => _x('Edit', 'popup_content', 'mybooking-reservation-engine'),
			              'edit_item' => _x('Edit popup ad', 'popup_content', 'mybooking-reservation-engine'),
			              'new_item' => _x('New popup ad', 'popup_content', 'mybooking-reservation-engine'),
			              'view' => _x('See', 'popup_content', 'mybooking-reservation-engine'),
			              'view_item' => _x('See popup ad', 'popup_content', 'mybooking-reservation-engine'),
			              'search_items' => _x('Search popup ad', 'popup_content', 'mybooking-reservation-engine'),
			              'not_found' => _x('No popup ad found', 'popup_content', 'mybooking-reservation-engine'),
			              'not_found_in_trash' => _x('No popup ad on bin', 'popup_content',  'mybooking-reservation-engine'),
			              'parent' => _x('Parent popup ad','popup_content',  'mybooking-reservation-engine')
			            ),
			            'show_ui' => true,
			            'public' => true,
			            'show_in_menu' => 'mybooking-plugin-configuration',
			            'show_in_rest' => true, // Gutenberg activation!
			            'supports' => array( 'title', 'editor', 'thumbnail' ),
			            'menu_icon' => 'dashicons-awards',
			            'has_archive' => true
			          )
			        );

	  }
	}
