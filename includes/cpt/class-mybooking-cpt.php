<?php

  // Custom post types
  require_once('mybooking-plugin-cpt-testimonial.php');  
  require_once('mybooking-plugin-cpt-popup.php');
  require_once('mybooking-plugin-cpt-content-slider.php');
  require_once('mybooking-plugin-cpt-product-slider.php');

  /**
   * Manage the custom post types defined in the plugin
   */
  class MybookingEngineCPT {

    public function __construct() {
      $this->wp_init();
    }

    /**
     * Initialize hooks
     */
    private function wp_init() {

      add_action( 'init', array( $this, 'create_custom_post_types' ) );

    }

    /**
     * Create custom post types
     */
    public function create_custom_post_types() {

      // Get the registry information
      $registry = Mybooking_Registry::getInstance();

      // Popup Post Type
      if ($registry->mybooking_rent_plugin_complements_popup == '1') {
        //add_action( 'init', 'create_popup' );
        $popup = new MyBookingPluginCPTPopup();      
      }

      // Testimonials Post Type
      if ($registry->mybooking_rent_plugin_complements_testimonials == '1') {
        $testimonial = new MyBookingPluginCPTTestimonial();
      }

      // Content Slider Post Type
      if ($registry->mybooking_rent_plugin_complements_content_slider == '1') {
        $contentSlider = new MyBookingPluginCPTContentSlider();
      }

      // Product Slider Post Type
      if ($registry->mybooking_rent_plugin_complements_product_slider == '1') {
        $productSlider = new MyBookingPluginCPTProductSlider();
      }
        
    }

  }