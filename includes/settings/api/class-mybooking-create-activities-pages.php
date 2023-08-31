<?php
  class MybookingCreateActivitiesPages extends MybookingCreatePages {
    /**
    * Create activities pages
    */
    function createActivitiesPages($navigation) {
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
        )
      );

      // Set the options settings (TODO Does not exist)
      $settings_activities = (array) get_option("mybooking_plugin_settings_activities");

      // Create pages
      foreach( $pages_to_create as $key => $page_to_create ) {

        $post_id = $this->createPage($page_to_create['title'],
                                     $page_to_create['content'],
                                     $page_to_create['slug'],
                                     $page_to_create['order']);
      

        if ($post_id) {
          // Update settings page
          $settings_activities[$page_to_create['option']] = $post_id;

          array_push($pages, 
            array( 'id' => $post_id,
                   'title' => $page_to_create['title'],
                   'permalink' => get_permalink( $post_id ),
                   'edit_post_link' => get_edit_post_link ( $post_id )));
        }
      }

      // Update activities settings (activities process pages)
      update_option( "mybooking_plugin_settings_activities", $settings_activities );

      // Set module in settings
      $settings = (array) get_option("mybooking_plugin_settings_configuration");
      $settings['mybooking_plugin_settings_activities_selector'] = "1";
      update_option("mybooking_plugin_settings_configuration", $settings); 

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