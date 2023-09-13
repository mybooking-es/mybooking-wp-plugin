<?php
  class MybookingTransferModule extends MybookingCreatePages {
    /**
    * Create transfer pages
    */
    function createTransferPages() {
      // Created pages (posts) ids
      $pages = array();

      // Define pages
      $pages_to_create = array(
        'choose_vehicle'           				=> array(
					'option' => 'mybooking_plugin_settings_transfer_choose_vehicle_page',
					'title' => _x( 'Transfer Choose Vehicle', 'plugin_custom_transfer_pages', 'mybooking-wp-plugin' ),
					'content' => '<!-- wp:shortcode -->[mybooking_transfer_choose_vehicle]<!-- /wp:shortcode -->',
					'slug' => 'transfer_choose-vehicle',
					'order' => 1,
        ),
        'checkout'           => array(
           'option' => 'mybooking_plugin_settings_transfer_checkout_page',
           'title' => _x( 'Transfer Check-out', 'plugin_custom_transfer_pages', 'mybooking-wp-plugin' ),
           'content' => '<!-- wp:shortcode -->[mybooking_transfer_checkout]<!-- /wp:shortcode -->',
           'slug' => 'transfer_checkout',
           'order' => 3,
        ),
        'summary'           => array(
           'option' => 'mybooking_plugin_settings_transfer_summary_page',
           'title' => _x( 'Transfer Summary', 'plugin_custom_transfer_pages', 'mybooking-wp-plugin' ),
           'content' => '<!-- wp:shortcode -->[mybooking_transfer_summary]<!-- /wp:shortcode -->',
           'slug' => 'transfer_summary',
           'order' => 4,
        ),
        'my_reservation'           => array(
          'option' => 'mybooking_plugin_settings_my_reservation_page',
          'title' => _x( 'Transfer My reservation', 'plugin_custom_transfer_pages', 'mybooking-wp-plugin' ),
          'content' => '<!-- wp:shortcode -->[mybooking_transfer_reservation]<!-- /wp:shortcode -->',
          'slug' => 'transfer_my-reservation',
          'order' => 5,
       ),
				'home_test'           				=> array(
					'option' => 'mybooking_plugin_settings_home_test_page',
					'title' => _x( 'Transfer Home Test', 'plugin_custom_transfer_pages', 'mybooking-wp-plugin' ),
					'content' => '<!-- wp:shortcode -->[mybooking_transfer_selector]<!-- /wp:shortcode -->',
					'slug' => 'transfer_home-test',
					'order' => 1,
        ),
        
      );

      // Create pages
      foreach( $pages_to_create as $key => $page_to_create ) {
        $post_id = $this->createPage($page_to_create['title'],
                                     $page_to_create['content'],
                                     $page_to_create['slug'],
                                     $page_to_create['order'],
                                     'mybooking_plugin_settings_transfer',
                                     $page_to_create['option']);

        if ($post_id) {
          array_push($pages, 
            array( 'id' => $post_id,
                   'title' => $page_to_create['title'],
                   'permalink' => get_permalink( $post_id ),
                   'edit_post_link' => get_edit_post_link ( $post_id )));
        }
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
     * Setup the transfer module
     */
    function setupTransferModule() {
      $settings = (array) get_option("mybooking_plugin_settings_configuration");
      $settings['mybooking_plugin_settings_transfer_selector'] = "1";
      update_option("mybooking_plugin_settings_configuration", $settings); 
    }

    /**
     * Clear transfer module
     */
    function clearTransferModule() {
        // Remove the transfer module
        $settings = (array) get_option("mybooking_plugin_settings_configuration");
        $settings['mybooking_plugin_settings_transfer_selector'] = "0";
        update_option("mybooking_plugin_settings_configuration", $settings);            
        // Clear the link to the transfer pages
        $settings_transfer = (array) get_option("mybooking_plugin_settings_transfer");
        
        unset($settings_transfer['mybooking_plugin_settings_transfer_checkout_page']);
        unset($settings_transfer['mybooking_plugin_settings_transfer_summary_page']);
        unset($settings_transfer['mybooking_plugin_settings_my_reservation_page']);
        unset($settings_transfer['mybooking_plugin_settings_transfer_choose_vehicle_page']);

        update_option( "mybooking_plugin_settings_transfer", $settings_transfer );
    }
  }