<?php
  class MybookingRentingModule extends MybookingCreatePages {
    /**
    * Create renting pages
    */
    function createRentingPages($wc_rent_selector) {
      // Created pages (posts) ids
      $pages = array();

      $oneModule = MybookingInstall::isOneModuleInstall();

      $checkoutTitle = _x( 'Check out', 'plugin_custom_renting_pages', 'mybooking-wp-plugin' );
      $summaryTitle = _x( 'Summary', 'plugin_custom_renting_pages', 'mybooking-wp-plugin' );
      $myReservationTitle = _x( 'My reservation', 'plugin_custom_renting_pages', 'mybooking-wp-plugin' );
      $homeTestTitle = _x( 'Home Test', 'plugin_custom_renting_pages', 'mybooking-wp-plugin' );
      $chooseProductTitle = _x( 'Search result', 'plugin_custom_renting_pages', 'mybooking-wp-plugin' );

      $checkoutSlug = 'checkout';
      $summarySlug = 'summary';
      $myReservationSlug = 'my-reservation';
      $homeTestSlug = 'home-test';


      if ( !$oneModule ) {
        $checkoutTitle = _x( 'Renting Check out', 'plugin_custom_renting_pages', 'mybooking-wp-plugin' );
        $summaryTitle = _x( 'Renting Summary', 'plugin_custom_renting_pages', 'mybooking-wp-plugin' );
        $myReservationTitle = _x( 'Renting My reservation', 'plugin_custom_renting_pages', 'mybooking-wp-plugin' );
        $homeTestTitle = _x( 'Renting Home Test', 'plugin_custom_renting_pages', 'mybooking-wp-plugin' );
        $chooseProductTitle = _x( 'Renting Search result', 'plugin_custom_renting_pages', 'mybooking-wp-plugin' );

        $checkoutSlug = 'checkout-renting';
        $summarySlug = 'summary-renting';
        $myReservationSlug = 'my-reservation-renting';
        $homeTestSlug = 'home-test-renting';
      }

      // Define pages
      $pages_to_create = array(
        'checkout'           => array(
           'option' => 'mybooking_plugin_settings_checkout_page',
           'title' => $checkoutTitle,
           'content' => '<!-- wp:shortcode -->[mybooking_rent_engine_complete]<!-- /wp:shortcode -->',
           'slug' => $checkoutSlug,
           'order' => 3,
        ),
        'summary'           => array(
           'option' => 'mybooking_plugin_settings_summary_page',
           'title' => $summaryTitle,
           'content' => '<!-- wp:shortcode -->[mybooking_rent_engine_summary]<!-- /wp:shortcode -->',
           'slug' => $summarySlug,
           'order' => 4,
        ),
        'my_reservation'           => array(
           'option' => 'mybooking_plugin_settings_my_reservation_page',
           'title' => $myReservationTitle,
           'content' => '<!-- wp:shortcode -->[mybooking_rent_engine_reservation]<!-- /wp:shortcode -->',
           'slug' => $myReservationSlug,
           'order' => 5,
        )
      );        

      if ( $wc_rent_selector ) {
        // Home with selector
        $pages_to_create['home_test'] = array( 
                                               'option' => 'mybooking_plugin_settings_home_test_page',
                                               'title' => $homeTestTitle,
                                               'content' => '<!-- wp:shortcode -->[mybooking_rent_engine_selector]<!-- /wp:shortcode -->',
                                               'slug' => $homeTestSlug,
                                               'order' => 1,
                                              );
        // Choose product (search result)           
        $pages_to_create['choose_products'] = array( 
                                               'option' => 'mybooking_plugin_settings_choose_products_page',
                                               'title' => $chooseProductTitle,
                                               'content' => '<!-- wp:shortcode -->[mybooking_rent_engine_product_listing]<!-- /wp:shortcode -->',
                                               'slug' => 'search-result',
                                               'order' => 2,
                                              );
      }

      // Create pages
      foreach( $pages_to_create as $key => $page_to_create ) {
        // Create the page
        $post_id = $this->createPage($page_to_create['title'],
                                     $page_to_create['content'],
                                     $page_to_create['slug'],
                                     $page_to_create['order'],
                                     'mybooking_plugin_settings_renting',
                                     $page_to_create['option'],
                                     mybooking_engine_theme_template());

        if ($post_id) {
          array_push($pages, 
            array( 'id' => $post_id,
                   'title' => $page_to_create['title'],
                   'permalink' => get_permalink( $post_id ),
                   'edit_post_link' => get_edit_post_link ( $post_id )));
        }
      }

      // If there is not a selector clear home test and choose product pages
      if ( !$wc_rent_selector ) {
        $settings_renting = (array) get_option("mybooking_plugin_settings_renting");
        unset($settings_renting['mybooking_plugin_settings_home_test_page']);
        unset($settings_renting['mybooking_plugin_settings_choose_products_page']);
        update_option( "mybooking_plugin_settings_renting", $settings_renting );
      }
      
      if (count($pages) > 0) {
        $pages_info = array(
          "pages" => $pages
        );

        return $pages_info;
      } else {
        return null;
      }
    }

    /**
     * Setup the renting module
     */
    function setupRentingModule() {
      $settings = (array) get_option("mybooking_plugin_settings_configuration");
      $settings['mybooking_plugin_settings_renting_selector'] = "1";
      update_option("mybooking_plugin_settings_configuration", $settings); 
    }

    /**
     * Clear renting module
     */
    function clearRentingModule() {
        // Remove the renting module
        $settings = (array) get_option("mybooking_plugin_settings_configuration");
        $settings['mybooking_plugin_settings_renting_selector'] = "0";
        update_option("mybooking_plugin_settings_configuration", $settings);            
        // Clear the link to the renting pages
        $settings_renting = (array) get_option("mybooking_plugin_settings_renting");
        unset($settings_renting['mybooking_plugin_settings_home_test_page']);
        unset($settings_renting['mybooking_plugin_settings_choose_products_page']);
        unset($settings_renting['mybooking_plugin_settings_checkout_page']);
        unset($settings_renting['mybooking_plugin_settings_summary_page']);
        unset($settings_renting['mybooking_plugin_settings_my_reservation_page']);
        update_option( "mybooking_plugin_settings_renting", $settings_renting );  

    }
  }