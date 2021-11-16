<?php

/**
 *		MYBOOKING Plugin CUSTOMIZER
 *  	--------------------------
 *
 *   Section: Mybooking layout settings
 *
 *
 * 	 @version 1.0.0
 *   @package WordPress
 *   @subpackage Mybooking Reservation Engine
 *   @since Mybooking Reservation Engine 0.13.0
 *
 */

// Exit if accessed directly.
defined('ABSPATH') || exit;

if (!class_exists('MyBookingPluginCustomizer')) {
  /**
   * Customizer class
   *
   */
  class MyBookingPluginCustomizer
  {

    // Hold the class instance.
    private static $instance = null;

    // Holds the theme options
    private $theme_options = null;

    // The constructor is private
    // to prevent initiation with outer code.
    private function __construct()
    {
      $this->register();
      $this->setup();
    }

    // The object is created from within the class itself
    // only if the class has no instance.
    public static function getInstance()
    {
      if (self::$instance == null) {
        self::$instance = new MyBookingPluginCustomizer();
      }

      return self::$instance;
    }

    // ---------------------------------------------------------------

    /**
     * Register the customizer
     */
    private function register()
    {

      add_action('customize_register', array($this, 'customize_register'));
    }

    /**
     * Setup the customizer
     */
    private function setup()
    {

      // Enqueue css-properties customization
      add_action('wp_enqueue_scripts', array($this, 'customize_enqueue'));
    
    }

    // ---------------------------------------------------------------

    /**
     * Register the customizer
     */
    public function customize_register($wp_customize)
    {

      // Register panel
      $this->mybooking_settings_panel($wp_customize);

      // Customize catalog sections
      $this->customize_catalog_section($wp_customize);

    }

    /**
     * Enqueue -> css-properties as inline styles
     */
    public function customize_enqueue($type = 'frontend')
    {

      $custom_css = '';

      // Renting product image height
      $product_image_height_img = get_theme_mod('mybooking_reservation_engine_product_image_height_img', 'photo');

      // == Build the css-properties
      $custom_css .= ":root {";

      // Product Image Height
      if (!empty($product_image_height_img) && $product_image_height_img == 'photo') {
        $custom_css .= "--mb-product-image-height-img: 100%;";
      }

      $custom_css .= "}";

      return $custom_css;
    }

    // ----------------------- Customize Sections -----------------------------

    private function mybooking_settings_panel($wp_customize)
    {
      $wp_customize->add_panel(
        'mybooking_reservation_engine_settings_panel',
        array(
          'title' => _x('Mybooking Reservation Engine', 'customizer_panel', 'mybooking-wp-plugin'),
          'description' => _x('Customise your installation of Mybooking Reservation Engine', 'customizer_panel', 'mybooking-wp-plugin'),
          'priority' => 10,
        )
      );
    }

    /**
     * 	Customize Colors
     *
     */

    private function customize_catalog_section($wp_customize)
    {
      // Section
      $wp_customize->add_section(
        'mybooking_reservation_engine_renting_options',
        array(
          'title'       => _x('Catalog of Products', 'customizer_colors', 'mybooking-wp-plugin'),
          'capability'  => 'edit_theme_options',
          'description' => _x('Characteristics of products', 'customizer_colors', 'mybooking-wp-plugin'),
          'priority'    => 50,
          'panel'        => 'mybooking_reservation_engine_settings_panel',
        )
      );

      // == Product image

      // Setting
      $wp_customize->add_setting(
        'mybooking_reservation_engine_product_image_height_img',
        array(
          'default'           => 'photo',
          'type'              => 'theme_mod',
          'sanitize_callback' => array($this, 'slug_sanitize_select'),
          'capability'        => 'edit_theme_options',
        )
      );

      // Control
      $wp_customize->add_control(
        new WP_Customize_Control(
          $wp_customize,
          'mybooking_reservation_engine_product_image_height_img',
          array(
            'label'       => _x('Image', 'customizer_layout', 'mybooking-wp-plugin'),
            'description' => _x(
              'Choose depending on the images that you are using for your products',
              'customizer_layout',
              'mybooking-wp-plugin'
            ),
            'section'     => 'mybooking_reservation_engine_renting_options',
            'settings'    => 'mybooking_reservation_engine_product_image_height_img',
            'type'        => 'select',
            'choices'     => array(
              'auto' => _x('Transparent background', 'customizer_layout', 'mybooking-wp-plugin'),
              'photo'      => _x('Photo', 'customizer_layout', 'mybooking-wp-plugin'),
            ),
            'priority'    => '10',
          )
        )
      );

    }

    // ----------- Sanitize

    /**
     * Radio Button sanitization function
     *
     * @param $checked Slug to sanitize
     */
    function slug_sanitize_radio($input, $setting)
    {
      //input must be a slug: lowercase alphanumeric characters, dashes and underscores are allowed only
      $input = sanitize_key($input);

      //get the list of possible radio box options
      $choices = $setting->manager->get_control($setting->id)->choices;

      //return input if valid or return default option
      return (array_key_exists($input, $choices) ? $input : $setting->default);
    }

    /**
     * Checkbox sanitization function
     *
     * @param $checked Slug to sanitize
     */
    function slug_sanitize_checkbox($checked)
    {
      // Boolean check.
      return ((isset($checked) && true == $checked) ? true : false);
    }


    /**
     * Select sanitization function
     *
     * @param string               $input   Slug to sanitize.
     * @param WP_Customize_Setting $setting Setting instance.
     * @return string Sanitized slug if it is a valid choice; otherwise, the setting default.
     */
    function slug_sanitize_select($input, $setting)
    {
      // Ensure input is a slug (lowercase alphanumeric characters, dashes and underscores are allowed only).
      $input = sanitize_key($input);

      // Get the list of possible select options.
      $choices = $setting->manager->get_control($setting->id)->choices;

      // If the input is a valid key, return it; otherwise, return the default.
      return (array_key_exists($input, $choices) ? $input : $setting->default);
    }

    /**
     * RGBA color sanitization function
     */
    function slug_sanitize_rgba($color)
    {
      if (empty($color) || is_array($color)) {
        return 'rgba(0,0,0,0)';
      }

      // If string does not start with 'rgba', then treat as hex
      // sanitize the hex color and finally convert hex to rgba
      if (false === strpos($color, 'rgba')) {
        return sanitize_hex_color($color);
      }

      // By now we know the string is formatted as an rgba color so we need to further sanitize it.
      $color = str_replace(' ', '', $color);
      sscanf($color, 'rgba(%d,%d,%d,%f)', $red, $green, $blue, $alpha);
      return 'rgba(' . $red . ',' . $green . ',' . $blue . ',' . $alpha . ')';
    }

  }
}