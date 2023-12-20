<?php
/**
 * Check if theme container class.
 *
 * @since 0.13.0
 *
 */
function mybooking_engine_theme_align_width() {

      $theme = wp_get_theme(); // gets the current theme

      $alignwide = '';

      if (
        'Twenty Twenty' == $theme->name ||
        'Twenty Twenty' == $theme->parent_theme ||
        'Twenty Twenty-One' == $theme->name ||
        'Twenty Twenty-One' == $theme->parent_theme ||
				'Twenty Twenty-Two' == $theme->name ||
        'Twenty Twenty-Two' == $theme->parent_theme ||
				'Twenty Twenty-Three' == $theme->name ||
        'Twenty Twenty-Three' == $theme->parent_theme ||	        				
				'Twenty Twenty-Four' == $theme->name ||
        'Twenty Twenty-Four' == $theme->parent_theme ||	
        'Twenty Nineteen' == $theme->name ||
        'Twenty Nineteen' == $theme->parent_theme ||
        'Varia' == $theme->name ||
        'Varia' == $theme->parent_theme) {
         $alignwide = 'alignwide';
      }

      return $alignwide;

}

/**
 * Page template when creating reservation process pages
 */
function mybooking_engine_theme_template() {

  $theme = wp_get_theme(); // gets the current theme

  $page_template = '';

  if ('Mybooking' == $theme->name || 
      'Mybooking' == $theme->parent_theme) {
    $page_template = 'mybooking-parts/mybooking-empty.php';
  }
  
  return $page_template;

}
