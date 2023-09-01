<?php
  class MybookingActivitiesModule extends MybookingCreatePages {
    /**
    * Create activities pages
    */
    function createActivitiesPages() {
      // Created pages (posts) ids
      $pages = array();

      // Define pages
      $pages_to_create = array(
        'checkout'           => array(
           'option' => 'mybooking_plugin_settings_activities_shopping_cart_page',
           'title' => _x( 'Check-out', 'plugin_custom_activities_pages', 'mybooking-wp-plugin' ),
           'content' => '<!-- wp:shortcode -->[mybooking_activities_engine_shopping_cart]<!-- /wp:shortcode -->',
           'slug' => 'checkout',
           'order' => 3,
        ),
        'summary'           => array(
           'option' => 'mybooking_plugin_settings_activities_summary_page',
           'title' => _x( 'Summary', 'plugin_custom_activities_pages', 'mybooking-wp-plugin' ),
           'content' => '<!-- wp:shortcode -->[mybooking_activities_engine_summary]<!-- /wp:shortcode -->',
           'slug' => 'summary',
           'order' => 4,
        ),
        'my_reservation'           => array(
          'option' => 'mybooking_plugin_settings_my_reservation_page',
          'title' => _x( 'My reservation', 'plugin_custom_activities_pages', 'mybooking-wp-plugin' ),
          'content' => '<!-- wp:shortcode -->[mybooking_activities_engine_order]<!-- /wp:shortcode -->',
          'slug' => 'my-reservation',
          'order' => 5,
        )
      );

      // Create pages
      foreach( $pages_to_create as $key => $page_to_create ) {
        $post_id = $this->createPage($page_to_create['title'],
                                     $page_to_create['content'],
                                     $page_to_create['slug'],
                                     $page_to_create['order'],
                                     'mybooking_plugin_settings_activities',
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
     * Setup the activities module
     */
    function setupActivitiesModule() {
      $settings = (array) get_option("mybooking_plugin_settings_configuration");
      $settings['mybooking_plugin_settings_activities_selector'] = "1";
      update_option("mybooking_plugin_settings_configuration", $settings); 
    }

    /**
     * Clear activities module
     */
    function clearActivitiesModule() {
        // Remove the activities module
        $settings = (array) get_option("mybooking_plugin_settings_configuration");
        $settings['mybooking_plugin_settings_activities_selector'] = "0";
        update_option("mybooking_plugin_settings_configuration", $settings);            
        // Clear the link to the activities pages
        $settings_activities = (array) get_option("mybooking_plugin_settings_activities");
        unset($settings_activities['mybooking_plugin_settings_activities_shopping_cart_page']);
        unset($settings_activities['mybooking_plugin_settings_activities_summary_page']);
        unset($settings_activities['mybooking_plugin_settings_my_reservation_page']);
        update_option( "mybooking_plugin_settings_activities", $settings_activities );
    }
  }