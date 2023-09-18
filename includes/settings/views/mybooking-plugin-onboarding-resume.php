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
	<div class="mb-onboarding-resume mb-onboarding-commons">
		<h1 class="mb-onboarding-row">
			<span class="mb-onboarding-icon dashicons dashicons-saved"></span>
			&nbsp;
			<?php echo esc_html_x( 'Configuración finalizada con exito', 'onboarding_context', 'mybooking-wp-plugin' ) ?>
		</h1>
	</div>

	<!-- Import pages list -->
	<?php require_once('mybooking-plugin-onboarding-pages.php'); ?>
<?php
}

mybooking_plugin_onboarding_resume_page();
?>