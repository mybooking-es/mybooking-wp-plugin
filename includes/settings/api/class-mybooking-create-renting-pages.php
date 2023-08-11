<?php
 
  class MybookingCreateRentingPages extends MybookingCreatePages {
  	

    /**
    * Create renting pages
    */
    function createRentingPages($navigation) {
      
      // Created pages (posts) ids
      $pages = array();

      // Define pages
      $pages_to_create = array(
        'checkout'           => array(
           'option' => 'mybooking_plugin_settings_checkout_page',
           'title' => _x( 'Check-out', 'plugin_custom_renting_pages', 'mybooking-wp-plugin' ),
           'content' => '<!-- wp:shortcode -->[mybooking_rent_engine_complete]<!-- /wp:shortcode -->',
           'slug' => 'checkout'
        ),
        'summary'           => array(
           'option' => 'mybooking_plugin_settings_summary_page',
           'title' => _x( 'Summary', 'plugin_custom_renting_pages', 'mybooking-wp-plugin' ),
           'content' => '<!-- wp:shortcode -->[mybooking_rent_engine_summary]<!-- /wp:shortcode -->',
           'slug' => 'summary'
        ),
        'my_reservation'           => array(
           'option' => 'mybooking_plugin_settings_my_reservation_page',
           'title' => _x( 'My reservation', 'plugin_custom_renting_pages', 'mybooking-wp-plugin' ),
           'content' => '<!-- wp:shortcode -->[mybooking_rent_engine_reservation]<!-- /wp:shortcode -->',
           'slug' => 'my-reservation'
        )
      );        

      if ( $navigation == 'selector' ) {

        // Home with selector
        $pages_to_create['home_test'] = array( 
                                               'option' => 'mybooking_plugin_settings_home_test_page',
                                               'title' => _x( 'Home Test', 'plugin_custom_renting_pages', 'mybooking-wp-plugin' ),
                                               'content' => '<!-- wp:shortcode -->[mybooking_rent_engine_selector]<!-- /wp:shortcode -->',
                                               'slug' => 'home-test'
                                              );
        // Choose product (search result)           
        $pages_to_create['choose_products'] = array( 
                                               'option' => 'mybooking_plugin_settings_choose_products_page',
                                               'title' => _x( 'Search result', 'plugin_custom_renting_pages', 'mybooking-wp-plugin' ),
                                               'content' => '<!-- wp:shortcode -->[mybooking_rent_engine_product_listing]<!-- /wp:shortcode -->',
                                               'slug' => 'search-result'
                                              );
      }

      // Set the options settings (TODO Does not exist)
      $settings_renting = (array) get_option("mybooking_plugin_settings_renting");

      // Create pages
      foreach( $pages_to_create as $key => $page_to_create ) {

        $post_id = $this->createPage($page_to_create['title'],
                                     $page_to_create['content'],
                                     $page_to_create['slug']);
      

        if ($post_id) {
          // Update settings page
          $settings_renting[$page_to_create['option']] = $post_id;

          array_push($pages, 
            array( 'id' => $post_id,
                   'title' => $page_to_create['title'],
                   'permalink' => get_permalink( $post_id ),
                   'edit_post_link' => get_edit_post_link ( $post_id )));

        }

      }

      // Update renting settings (renting process pages)
      update_option( "mybooking_plugin_settings_renting", $settings_renting );

      if (count($pages) > 0) {
        
        $pages_info = array(
          "navigation" => $navigation,
          "pages" => $pages
        );

        return $pages_info;

      } else {
        return null;
      }
    
    }

  }