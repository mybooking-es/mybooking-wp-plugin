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
              'name' => _x('Content Slider', 'slider_content', 'mybooking-wp-plugin'),
              'singular_name' => _x('Testimonial', 'slider_content', 'mybooking-wp-plugin'),
              'add_new' => _x('Add slider', 'slider_content', 'mybooking-wp-plugin'),
              'add_new_item' => _x('New slider', 'slider_content', 'mybooking-wp-plugin'),
              'edit' => _x('Edit', 'slider_content', 'mybooking-wp-plugin'),
              'edit_item' => _x('Edit slider', 'slider_content', 'mybooking-wp-plugin'),
              'new_item' => _x('New slider', 'slider_content', 'mybooking-wp-plugin'),
              'view' => _x('See', 'slider_content', 'mybooking-wp-plugin'),
              'view_item' => _x('See slider', 'slider_content', 'mybooking-wp-plugin'),
              'search_items' => _x('Search slider', 'slider_content', 'mybooking-wp-plugin'),
              'not_found' => _x('No slider found', 'slider_content', 'mybooking-wp-plugin'),
              'not_found_in_trash' => _x('No slider found on bin', 'slider_content', 'mybooking-wp-plugin'),
              'parent' => _x('Parent slider', 'slider_content', 'mybooking-wp-plugin')
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
