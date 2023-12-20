<?php
  class MybookingCreatePages {

   /*
    * Create page
    *
    * What does it does?
    * ------------------
    * 1. Check if the page exists
    * 2. Create the post if not exists
    * 3. Update settings to store the page ID
    * 4. Returns the post ID
    *
    *
    * How pages are configured in mybooking?
    * --------------------------------------
    * There are three options represented by an associative array which different options
    * per pages
    *
    *  - mybooking_plugin_settings_renting => Holds the renting pages
    *  - mybooking_plugin_settings_activities => Holds the activities pages
    *  - mybooking_plugin_settings_transfer => Holds the activities pages
    *
    *
    *
    * @param string $title The page title
    * @param string $content The page content
    * @param string $slug The page slug
    * @param string $option The option where pages are configured (depends on the module)
    * @param string $option_page_attribute The page inside the option 
    * @return int page ID
    */
    function createPage($title, $content, $slug, $order, $option, $option_page_attribute, $template = '') {
      
      global $wpdb;

      // Each vertical settings are stored in an option
      $option_value = get_option( $option );

      // 1. Get existing page 

      if ( $option_value  ) {
        $option_value = (array) $option_value;
        // Get the page
        $option_value_page_attribute = $option_value[$option_page_attribute];
        if ( isset( $option_value_page_attribute ) && !empty ( $option_value_page_attribute ) ) {
          // Load the page
          $page_object = get_post( $option_value_page_attribute );
          if ( $page_object && 'page' === $page_object->post_type && ! in_array( $page_object->post_status, array( 'pending', 'trash', 'future', 'auto-draft' ), true ) ) {
            // Valid page is already in place.
            return $page_object->ID;
          }
        }
      }

      // 2. Search the page by its content or page slug
      if ( strlen( $content ) > 0 ) {
        // Search for an existing page with the specified page content (typically a shortcode).
        $shortcode        = str_replace( array( '<!-- wp:shortcode -->', '<!-- /wp:shortcode -->' ), '', $content );
        $valid_page_found = $wpdb->get_var( $wpdb->prepare( "SELECT ID FROM $wpdb->posts WHERE post_type='page' AND post_status NOT IN ( 'pending', 'trash', 'future', 'auto-draft' ) AND post_content LIKE %s LIMIT 1;", "%{$shortcode}%" ) );
      } else {
        // Search for an existing page with the specified page slug.
        $valid_page_found = $wpdb->get_var( $wpdb->prepare( "SELECT ID FROM $wpdb->posts WHERE post_type='page' AND post_status NOT IN ( 'pending', 'trash', 'future', 'auto-draft' )  AND post_name = %s LIMIT 1;", $slug ) );
      }      

      if ( $valid_page_found ) {
        if ( $option_value ) {
          $option_value[$option_page_attribute] = $valid_page_found;  
          update_option( $option, $option_value );
        }
        return $valid_page_found;
      }

      // 3. Search in trash
      if ( strlen( $content ) > 0 ) {
        // Search for an existing page with the specified page content (typically a shortcode).
        $trashed_page_found = $wpdb->get_var( $wpdb->prepare( "SELECT ID FROM $wpdb->posts WHERE post_type='page' AND post_status = 'trash' AND post_content LIKE %s LIMIT 1;", "%{$content}%" ) );
      } else {
        // Search for an existing page with the specified page slug.
        $trashed_page_found = $wpdb->get_var( $wpdb->prepare( "SELECT ID FROM $wpdb->posts WHERE post_type='page' AND post_status = 'trash' AND post_name = %s LIMIT 1;", $slug ) );
      }

      if ( $trashed_page_found ) {
        $page_id   = $trashed_page_found;
        $page_data = array(
          'ID'          => $page_id,
          'post_status' => 'publish',
        );
        wp_update_post( $page_data );
      }
      else {
        // Create the page
        $page = array(
          'post_status' => 'publish',
          'post_type' => 'page',
          'post_author' => 1,
          'post_name' => esc_sql( $slug ),
          'post_title' => $title,
          'post_content' => $content,
          'comment_status' => 'closed',
          'menu_order' => $order
        );
        $page_id = wp_insert_post($page);

        if(!empty($template)){
          // Setup the page template
          update_post_meta($page_id, '_wp_page_template', $template);
        }
        
      }

      $option_value[$option_page_attribute] = $page_id;  
      update_option( $option, $option_value );
      return $page_id;

    }


  }