<?php
  class MybookingCreatePages {

   /*
    * Create page
    *
    * @param string $title The page title
    * @param string $content The page content
    * @param string $slug The page slug
    *
    */
    function createPage($title, $content, $slug, $order, $template = '') {
      // Get the page by its title
      $check = get_page_by_title( $title );

      // TODO check does not exist page in trash

      if( !isset($check->ID) ){
        $page = array(
          'post_name' => esc_sql( $slug ),
          'post_type' => 'page',
          'post_status' => 'publish',
          'post_title' => $title,
          'post_content' => $content,
          'menu_order' => $order
        );
        $page_id = wp_insert_post($page);

        if(!empty($template)){
          update_post_meta($page_id, '_wp_page_template', $template);
        }

        return $page_id;
      }
    }


  }