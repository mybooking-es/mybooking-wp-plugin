<?php
/**
 * The Template for showing the main template for new customer form
 *
 * This template can be overridden by copying it to your
 * theme/mybooking-templates/mybooking-plugin-new-customer-form.php
 *
 * @phpcs:disable PHPCompatibility.Miscellaneous.RemovedAlternativePHPTags.MaybeASPOpenTagFound
 * @phpcs:disable Generic.PHP.DisallowAlternativePHPTags.MaybeASPOpenTagFound
 * @phpcs:disable Generic.PHP.DisallowAlternativePHPTags.MaybeASPShortOpenTagFound
 */

// The $data array comes from the shortcode function

// Set the args to pass to the tmpl template
$args = array();

// Pass registry object if it was successfully retrieved in the shortcode
// Use the new key 'registry_object' from the $data array
if (isset($registry_object)) {
	$args['registry'] = $registry_object;
}


// Include the template _tmpl
mybooking_engine_get_template('mybooking-plugin-new-customer-form-tmpl.php', $args);
?> 