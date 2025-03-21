<?php
  class MyBookingPluginCPTContentSlider {

    public function __construct()
    {
        $this->register_post_type();
    }

    private function register_post_type() {

        register_post_type( 'content-slider',
          array(
            'labels' => array(
              'name' => _x('Content Slider', 'slider_content', 'mybooking-reservation-engine'),
              'singular_name' => _x('Testimonial', 'slider_content', 'mybooking-reservation-engine'),
              'add_new' => _x('Add slider', 'slider_content', 'mybooking-reservation-engine'),
              'add_new_item' => _x('New slider', 'slider_content', 'mybooking-reservation-engine'),
              'edit' => _x('Edit', 'slider_content', 'mybooking-reservation-engine'),
              'edit_item' => _x('Edit slider', 'slider_content', 'mybooking-reservation-engine'),
              'new_item' => _x('New slider', 'slider_content', 'mybooking-reservation-engine'),
              'view' => _x('See', 'slider_content', 'mybooking-reservation-engine'),
              'view_item' => _x('See slider', 'slider_content', 'mybooking-reservation-engine'),
              'search_items' => _x('Search slider', 'slider_content', 'mybooking-reservation-engine'),
              'not_found' => _x('No slider found', 'slider_content', 'mybooking-reservation-engine'),
              'not_found_in_trash' => _x('No slider found on bin', 'slider_content', 'mybooking-reservation-engine'),
              'parent' => _x('Parent slider', 'slider_content', 'mybooking-reservation-engine')
            ),
            'show_ui' => true,
            'public' => true,
            'show_in_menu' => 'mybooking-plugin-configuration',
            'show_in_rest' => true, // Gutenberg activation!
            'supports' => array( 'title', 'editor', 'thumbnail' ),
            'menu_icon' => 'dashicons-slides',
            'has_archive' => true
          )
        );

    }
  }
