<?php
  class MyBookingPluginCPTTestimonial {

	  public function __construct()
	  {
	    	$this->register_post_type();
	  }

	  private function register_post_type() {

        register_post_type( 'testimonial',
          array(
            'labels' => array(
              'name' => _x('Testimonials', 'testimonial_content', 'mybooking-reservation-engine'),
              'singular_name' => _x('Testimonial', 'testimonial_content', 'mybooking-reservation-engine'),
              'add_new' => _x('Add testimonial', 'testimonial_content', 'mybooking-reservation-engine'),
              'add_new_item' => _x('New testimonial', 'testimonial_content', 'mybooking-reservation-engine'),
              'edit' => _x('Edit', 'testimonial_content', 'mybooking-reservation-engine'),
              'edit_item' => _x('Edit testimonial', 'testimonial_content', 'mybooking-reservation-engine'),
              'new_item' => _x('New testimonial', 'testimonial_content', 'mybooking-reservation-engine'),
              'view' => _x('See', 'testimonial_content', 'mybooking-reservation-engine'),
              'view_item' => _x('See testimonial', 'testimonial_content', 'mybooking-reservation-engine'),
              'search_items' => _x('Search testimonial', 'testimonial_content', 'mybooking-reservation-engine'),
              'not_found' => _x('No testimonial found', 'testimonial_content', 'mybooking-reservation-engine'),
              'not_found_in_trash' => _x('No testimonial found on bin', 'testimonial_content', 'mybooking-reservation-engine'),
              'parent' => _x('Parent testimonial', 'testimonial_content', 'mybooking-reservation-engine')
            ),
            'show_ui' => true,
            'public' => true,
            'show_in_menu' => 'mybooking-plugin-configuration',
            'show_in_rest' => true, // Gutenberg activation!
            'supports' => array( 'title', 'editor', 'thumbnail' ),
            'menu_icon' => 'dashicons-format-quote',
            'has_archive' => true
          )
        );

	  }
	}
