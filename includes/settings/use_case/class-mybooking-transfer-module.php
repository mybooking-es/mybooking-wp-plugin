<?php
  class MybookingTransferModule extends MybookingCreatePages {
    /**
    * Create transfer pages
    */
    function createTransferPages() {
      // Created pages (posts) ids
      $pages = array();

      $oneModule = MybookingInstall::isOneModuleInstall();

      $checkoutTitle = _x( 'Check out', 'plugin_custom_transfer_pages', 'mybooking-wp-plugin' );
      $summaryTitle = _x( 'Summary', 'plugin_custom_transfer_pages', 'mybooking-wp-plugin' );
      $myReservationTitle = _x( 'My reservation', 'plugin_custom_transfer_pages', 'mybooking-wp-plugin' );
      $homeTestTitle = _x( 'Home Test', 'plugin_custom_transfer_pages', 'mybooking-wp-plugin' );
      $chooseProductTitle = _x( 'Search result', 'plugin_custom_transfer_pages', 'mybooking-wp-plugin' );

      $checkoutSlug = 'checkout';
      $summarySlug = 'summary';
      $myReservationSlug = 'my-reservation';
      $homeTestSlug = 'home-test';

      if ( !$oneModule ) {
        $checkoutTitle = _x( 'Transfer Check out', 'plugin_custom_transfer_pages', 'mybooking-wp-plugin' );
        $summaryTitle = _x( 'Transfer Summary', 'plugin_custom_transfer_pages', 'mybooking-wp-plugin' );
        $myReservationTitle = _x( 'Transfer My reservation', 'plugin_custom_transfer_pages', 'mybooking-wp-plugin' );
        $homeTestTitle = _x( 'Transfer Home Test', 'plugin_custom_transfer_pages', 'mybooking-wp-plugin' );
        $chooseProductTitle = _x( 'Transfer Search result', 'plugin_custom_transfer_pages', 'mybooking-wp-plugin' );

        $checkoutSlug = 'checkout-transfer';
        $summarySlug = 'summary-transfer';
        $myReservationSlug = 'my-reservation-transfer';
        $homeTestSlug = 'home-test-transfer';
      }

      // Define pages
      $pages_to_create = array(
        'checkout'           => array(
           'option' => 'mybooking_plugin_settings_transfer_checkout_page',
           'title' => $checkoutTitle,
           'content' => '<!-- wp:shortcode -->[mybooking_transfer_checkout]<!-- /wp:shortcode -->',
           'slug' => $checkoutSlug,
           'order' => 3,
        ),
        'summary'           => array(
           'option' => 'mybooking_plugin_settings_transfer_summary_page',
           'title' => $summaryTitle,
           'content' => '<!-- wp:shortcode -->[mybooking_transfer_summary]<!-- /wp:shortcode -->',
           'slug' => $summarySlug,
           'order' => 4,
        ),
        'my_reservation'           => array(
          'option' => 'mybooking_plugin_settings_my_reservation_page',
          'title' => $myReservationTitle,
          'content' => '<!-- wp:shortcode -->[mybooking_transfer_reservation]<!-- /wp:shortcode -->',
          'slug' => $myReservationSlug,
          'order' => 5,
       ),
				'home_test'           				=> array(
					'option' => 'mybooking_plugin_settings_home_test_page',
					'title' =>  $homeTestTitle,
					'content' => '<!-- wp:shortcode -->[mybooking_transfer_selector]<!-- /wp:shortcode -->',
					'slug' => $homeTestSlug,
					'order' => 1,
        ),
        'choose_vehicle'           				=> array(
					'option' => 'mybooking_plugin_settings_transfer_choose_vehicle_page',
					'title' => $chooseProductTitle,
					'content' => '<!-- wp:shortcode -->[mybooking_transfer_choose_vehicle]<!-- /wp:shortcode -->',
					'slug' => 'choose-vehicle',
					'order' => 1,
        )
      );

      // Create pages
      foreach( $pages_to_create as $key => $page_to_create ) {
        $post_id = $this->createPage($page_to_create['title'],
                                     $page_to_create['content'],
                                     $page_to_create['slug'],
                                     $page_to_create['order'],
                                     'mybooking_plugin_settings_transfer',
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