<?php
	defined('ABSPATH') or die('Forbidden');
?>

<?php
/**
* Render Mybooking onboarding page
*
* https://developer.wordpress.org/reference/functions/do_settings_fields/
*/
function mybooking_plugin_onboarding_resume_page() {
	?>
	<?php
	// Get onboarding settings
	$onboarding_settings = (array) get_option('mybooking_plugin_onboarding_business_info');

	if ( $onboarding_settings ) {
		// Set type of module 
		$module_rental = $module_activities = $module_transfer = false;
		if (array_key_exists('module_rental', $onboarding_settings)) {
			$module_rental = $onboarding_settings["module_rental"];
		}
		if (array_key_exists('module_activities', $onboarding_settings)) {
			$module_activities = $onboarding_settings["module_activities"];
		}
		if (array_key_exists('module_transfer', $onboarding_settings)) {
			$module_transfer = $onboarding_settings["module_transfer"];
		}
	}

	// Get settings
	if ($module_rental) {
		$settings = (array) get_option("mybooking_plugin_settings_renting");
	}

	// Get activities settings
	if ($module_activities) {
		$settings = (array) get_option("mybooking_plugin_settings_activities");
	}

	// Get transfer settings
	if ($module_transfer) {
		$settings = (array) get_option("mybooking_plugin_settings_transfer");
	}

	?>

	<div class="mb-onboarding-resume mb-onboarding-commons">
		<?php if ( isset($settings) ) { ?>
			<h1 class="mb-onboarding-row">
				<span class="mb-onboarding-icon dashicons dashicons-saved"></span>
				&nbsp;
				<?php echo esc_html_x( 'Configuration completed successfully', 'onboarding_context', 'mybooking-wp-plugin' ) ?>
			</h1>
		<?php } else { ?>
			<h1 class="mb-onboarding-row mb-onboarding-error">
				<span class="mb-onboarding-icon dashicons dashicons-error"></span>
				&nbsp;
				<?php echo esc_html_x( 'An error has occurred', 'onboarding_context', 'mybooking-wp-plugin' ) ?>
			</h1>
		<?php } ?>
	</div>

	<!-- Import pages list -->
	<?php require_once('mybooking-plugin-onboarding-pages.php'); ?>
<?php
}

mybooking_plugin_onboarding_resume_page();
?>