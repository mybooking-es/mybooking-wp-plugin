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

      // Renting product image width
      
      // Image background (transparent or not)
      $product_image_bg = get_theme_mod('mybooking_reservation_engine_product_image_bg', 'transparent');
      // Image max height 
      $product_image_width_img = get_theme_mod('mybooking_reservation_engine_product_image_height', '250');
      // Image width percentage
      $product_image_width_img = get_theme_mod('mybooking_reservation_engine_product_image_width_img', '100');
      // Product text height (grid)
      $product_body_height = get_theme_mod('mybooking_reservation_engine_product_body_height', '120');
      // Product text height (list)
      $product_list_body_height = get_theme_mod('mybooking_reservation_engine_list_product_body_height', '140');
      // Show key characteristics
      $product_show_key_characteristics = get_theme_mod('mybooking_reservation_engine_product_show_key_characteristics', 'hide'); 

      // == Build the css-properties
      $custom_css .= ":root {";

      // Product Image Background
      if (!empty($product_image_bg)) {
        if ( $product_image_bg == 'transparent' ) {
          $custom_css .= "--mb-product-image-fit: contain;";
          $custom_css .= "--mb-product-image-padding: 20px;";
        }
        else {
          $custom_css .= "--mb-product-image-fit: cover;";
          $custom_css .= "--mb-product-image-padding: 0px;";
        }
      }

      // Product key characteristics
      if (!empty($product_show_key_characteristics)) {
        if ( $product_show_key_characteristics == 'show' ) {
          $custom_css .= "--mb-product-list-key-show: flex;";
        }
        else {
          $custom_css .= "--mb-product-list-key-show: none;";
        }
      }      

      // Product Image Width
      if (!empty($product_image_width_img)) {
        if ( $product_image_width_img > 100 ) {
          $product_image_width_img = 100;
        }
        $custom_css .= "--mb-product-image-width-img: ".$product_image_width_img.'%;';
      }

      // Product text height (grid)
      if (!empty($product_image_width_img)) {
        $custom_css .= "--mb-product-body-height: ".$product_body_height.'px;';
      }
      
      // Product text height (list)
      if (!empty($product_list_body_height)) {
        $custom_css .= "--mb-product-list-body-height: ".$product_list_body_height.'px;';
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
          'title'       => _x('Product card', 'customizer_product_catalog', 'mybooking-wp-plugin'),
          'capability'  => 'edit_theme_options',
          'description' => _x('Customize the product card', 'customizer_product_catalog', 'mybooking-wp-plugin'),
          'priority'    => 50,
          'panel'        => 'mybooking_reservation_engine_settings_panel',
        )
      );

      // == Product image background

      // Setting
      $wp_customize->add_setting(
        'mybooking_reservation_engine_product_image_bg',
        array(
          'default'           => 'transparent',
          'type'              => 'theme_mod',
          'sanitize_callback' => array($this, 'slug_sanitize_select'),
          'capability'        => 'edit_theme_options',
        )
      );

      // Control
      $wp_customize->add_control(
        new WP_Customize_Control(
          $wp_customize,
          'mybooking_reservation_engine_product_image_bg',
          array(
            'label'       => _x('Product background', 'customizer_product_catalog', 'mybooking-wp-plugin'),
            'description' => _x('Choose depending on the images that you are using for your products', 
                                'customizer_product_catalog', 'mybooking-wp-plugin'),
            'section'     => 'mybooking_reservation_engine_renting_options',
            'settings'    => 'mybooking_reservation_engine_product_image_bg',
            'type'        => 'select',
            'choices'     => array(
              'transparent' => _x('Transparent background', 'customizer_product_catalog', 'mybooking-wp-plugin'),
              'background'  => _x('Photo', 'customizer_product_catalog', 'mybooking-wp-plugin')
            ),
          )
        )
      );

      // == Product show key characteristics

      // Setting
      $wp_customize->add_setting(
        'mybooking_reservation_engine_product_show_key_characteristics',
        array(
          'default'           => 'hide',
          'type'              => 'theme_mod',
          'sanitize_callback' => array($this, 'slug_sanitize_select'),
          'capability'        => 'edit_theme_options',
        )
      );

      // Control
      $wp_customize->add_control(
        new WP_Customize_Control(
          $wp_customize,
          'mybooking_reservation_engine_product_show_key_characteristics',
          array(
            'label'       => _x('Product show characteristics', 'customizer_product_catalog', 'mybooking-wp-plugin'),
            'description' => _x('Show caracteritics icons', 
                                'customizer_product_catalog', 'mybooking-wp-plugin'),
            'section'     => 'mybooking_reservation_engine_renting_options',
            'settings'    => 'mybooking_reservation_engine_product_show_key_characteristics',
            'type'        => 'select',
            'choices'     => array(
              'show' => _x('Yes', 'customizer_product_catalog', 'mybooking-wp-plugin'),
              'hide' => _x('No', 'customizer_product_catalog', 'mybooking-wp-plugin')
            ),
          )
        )
      );


      // == Product image width

      // Setting
      $wp_customize->add_setting(
        'mybooking_reservation_engine_product_image_width_img',
        array(
          'default'           => '100',
          'type'              => 'theme_mod',
          'sanitize_callback' => 'absint',
          'capability'        => 'edit_theme_options',
        )
      );

      // Control
      $wp_customize->add_control(
        new WP_Customize_Control(
          $wp_customize,
          'mybooking_reservation_engine_product_image_width_img',
          array(
            'label'       => _x('Product card Image Width', 'customizer_product_catalog', 'mybooking-wp-plugin'),
            'description' => _x(
              'Choose depending on the images that you are using for your products (in %)',
              'customizer_product_catalog',
              'mybooking-wp-plugin'
            ),
            'section'     => 'mybooking_reservation_engine_renting_options',
            'settings'    => 'mybooking_reservation_engine_product_image_width_img',
            'type'        => 'text',
            'priority'    => '10',
          )
        )
      );

      // == Product body (text on grid) height

      // Setting
      $wp_customize->add_setting(
        'mybooking_reservation_engine_product_body_height',
        array(
          'default'           => '120',
          'type'              => 'theme_mod',
          'sanitize_callback' => 'absint',
          'capability'        => 'edit_theme_options',
        )
      );

      // Control
      $wp_customize->add_control(
        new WP_Customize_Control(
          $wp_customize,
          'mybooking_reservation_engine_product_body_height',
          array(
            'label'       => _x('Product card Body Height (Grid)', 'customizer_product_catalog', 'mybooking-wp-plugin'),
            'description' => _x(
              'Choose product card body height (in px)',
              'customizer_product_catalog',
              'mybooking-wp-plugin'
            ),
            'section'     => 'mybooking_reservation_engine_renting_options',
            'settings'    => 'mybooking_reservation_engine_product_body_height',
            'type'        => 'text',
            'priority'    => '10',
          )
        )
      );

      // == Product body height

      // Settings
      $wp_customize->add_setting(
        'mybooking_reservation_engine_list_product_body_height',
        array(
          'default'           => '140',
          'type'              => 'theme_mod',
          'sanitize_callback' => 'absint',
          'capability'        => 'edit_theme_options',
        )
      );

      // Control
      $wp_customize->add_control(
        new WP_Customize_Control(
          $wp_customize,
          'mybooking_reservation_engine_list_product_body_height',
          array(
            'label'       => _x('Product card Body Height (List)', 'customizer_product_catalog', 'mybooking-wp-plugin'),
            'description' => _x(
              'Choose product card body height (in px)',
              'customizer_product_catalog',
              'mybooking-wp-plugin'
            ),
            'section'     => 'mybooking_reservation_engine_renting_options',
            'settings'    => 'mybooking_reservation_engine_list_product_body_height',
            'type'        => 'text',
            'priority'    => '10',
          )
        )
      );

      // == Selector

      // Setting
      $wp_customize->add_setting(
        'mybooking_reservation_engine_rent_choose_product_layout',
        array(
          'default'           => 'grid_only',
          'type'              => 'theme_mod',
          'sanitize_callback' => array($this, 'slug_sanitize_select'),
          'capability'        => 'edit_theme_options',
        )
      );

      // Control
      $wp_customize->add_control(
        new WP_Customize_Control(
          $wp_customize,
          'mybooking_reservation_engine_rent_choose_product_layout',
          array(
            'label'       => _x('Renting choose product layout', 'customizer_product_catalog', 'mybooking-wp-plugin'),
            'description' => _x(
              'Choose depending on the layout to show the products in the choose product page',
              'customizer_product_catalog',
              'mybooking-wp-plugin'
            ),
            'section'     => 'mybooking_reservation_engine_renting_options',
            'settings'    => 'mybooking_reservation_engine_rent_choose_product_layout',
            'type'        => 'select',
            'choices'     => array(
              'list_only' => _x('List 1 product per row', 'customizer_product_catalog', 'mybooking-wp-plugin'),
              'grid_only' => _x('Grid 3 products per row', 'customizer_product_catalog', 'mybooking-wp-plugin'),
              'list'      => _x('List 1 product per row - allow change', 'customizer_product_catalog', 'mybooking-wp-plugin'),
              'grid'      => _x('Grid 3 products per row - allow change', 'customizer_product_catalog', 'mybooking-wp-plugin'),
              'reduce_list_only' => _x('List 1 product per row in reduce format', 'customizer_product_catalog', 'mybooking-wp-plugin')
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