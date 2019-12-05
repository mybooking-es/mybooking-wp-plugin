<?php
/**
 * Locate template.
 *
 * @see https://jeroensormani.com/how-to-add-template-files-in-your-plugin/ 
 *
 * Search Order:
 * 1. /wp-content/mybooking-templates/$template_name
 * 2. /themes/theme/mybooking-plugin-templates/$template_name
 * 3. /themes/theme/$template_name
 * 4. /plugins/mybooking-plugin/templates/$template_name.
 *
 * @since 1.0.0
 *
 * @param 	string 	$template_name			Template to load.
 * @param 	string 	$string $template_path	Path to templates.
 * @param 	string	$default_path			Default path to template files.
 * @return 	string 							Path to the template file.
 */
function mybooking_engine_locate_template( $template_name, $template_path = '', $default_path = '' ) {

	// Set variable to search in mybooking-plugin-templates folder of theme.
	if ( ! $template_path ) :
		$template_path = 'mybooking-templates/';
	endif;

	// Set default plugin templates path.
	if ( ! $default_path ) :
		$default_path = dirname(plugin_dir_path( __FILE__ )) . '/mybooking-templates/'; // Path to the template folder
	endif;

  $template = null;

  // (1) Search template file in wp-content/mybooking-templates folder
  $content_template = WP_CONTENT_DIR.'/'.$template_path.$template_name;
  if ( file_exists( $content_template )) {
  	$template = $content_template;
  }

	// (2) and (3) Search template file in theme folder.
	if ( ! $template ) {
		$template = locate_template( array(
			$template_path . $template_name,
			$template_name
		) );
  }

	// (4) Get plugins template file.
	if ( ! $template ) :
		$template = $default_path . $template_name;
	endif;

	return apply_filters( 'mybooking_engine_locate_template', $template, $template_name, $template_path, $default_path );

}