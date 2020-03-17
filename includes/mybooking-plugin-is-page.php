<?php
/**
 * is page.
 *
 * check if the pageId is a page
 * 
 * WPML integration
 *
 * @since 1.0.0
 *
 * @see mybooking_engine_get_template()
 *
 * @param number 	$page_id			The page Id.
 */
function mybooking_engine_is_page( $page_id ) {
	
	// WMPL verification
	if ( function_exists('icl_object_id') ) {

	  $page = get_page_by_path( $page_id );
	  $pageId = $page ? $page->ID : null;
	  if ($pageId != null) {
	    $translated_id = icl_object_id($pageId, $page->$post_type);
		  $result = is_page ( $page_id ) || ($translated_id != '' && is_page( $translated_id ));
	  }
	  else {
	  	$result = is_page ( $page_id );
	  }

	}
	else {
		$result = is_page ( $page_id );
	}


	return $result;
}

/**
 * is page.
 *
 * get the translated slug
 * 
 * WPML integration
 *
 * @since 0.5.8
 *
 * @see mybooking_engine_get_template()
 *
 * @param number 	$page_id			The page Id.
 */
function mybooking_engine_translated_slug( $page_id ) {

	// WMPL verification
	if ( function_exists('icl_object_id') ) {

		$page = get_page_by_path( $page_id );
	  $pageId = $page ? $page->ID : null;
	  if ($pageId != null) {
	    $translated_id = icl_object_id($pageId, $page->$post_type);
	    return $translated_id;
	  }

	}

	return $page_id;

}