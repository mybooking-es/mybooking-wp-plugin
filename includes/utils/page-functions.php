<?php

  /**
   * Get the current page content
   */
  function mybooking_engine_page_current_page_content() {

    $current_page = mybooking_engine_current_page();
    $content = '';
    if ( !is_null( $current_page ) && property_exists($current_page, 'post_content') ) {
      $content = $current_page->post_content;
      // Check also post_excerpt for short
      if ( property_exists($current_page, 'post_excerpt')) {
        if ( empty($content) ) {
          $content = '';
        }
        $content = $content.$current_page->post_excerpt;
      }
    }

    return $content;

  }

  /**
   * Get the current page
   *
   * Accessing to the current page has been changed from global $post to
   * get_queried_object() because some plugins/themes components may be
   * running queries on custom post types alter the global $post
   *
   * $wp_the_query seems tring to remain first WP_Query but 'custom loop' overrides
   * $wp_the_query->post and $wp_the_query->posts.
   *
   * Example of 'custom loop' :
   *
   * while($myposts->have_posts()): $mypost->the_post(); .... endwhile;
   *
   * or
   *
   * foreach($myposts as $post) { ... }
   *
   * So $wp_the_query->get_queried_object() would not stable until it is firstly
   * called before any plugin or theme because it returns pre-set value if available.
   *
   * https://wordpress.stackexchange.com/questions/291056/get-the-current-page-slug-name
   * https://wordpress.stackexchange.com/questions/220619/globalswp-the-query-vs-global-wp-query
   * Get the current page content (in order to check if it includes the shortcode)
   *
   *
   *
   *
   */
  function mybooking_engine_current_page() {

    $current_page = get_queried_object();
    return $current_page;

  }