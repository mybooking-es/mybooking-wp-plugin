<?php
	defined('ABSPATH') or die('Forbidden');
?>

<?php
/**
* Render Mybooking onboarding page
*
* https://developer.wordpress.org/reference/functions/do_settings_fields/
*/
function mybooking_plugin_onboarding_error_page() {
	?>
	
	<div class="mb-onboarding-error mb-onboarding-commons">
		<h1 class="mb-onboarding-row mb-onboarding-error">
			<span class="mb-onboarding-icon dashicons dashicons-warning mb-onboarding-error"></span>
			&nbsp;&nbsp;
			<?php echo esc_html_x( 'Lo lamentamos, se ha producido un error', 'onboarding_context', 'mybooking-wp-plugin' ) ?>
		</h1>
		<h2>
			<?php echo esc_html_x( 'Revisa tus páginas y prueba de nuevo. Si no lo logras ponte en contacto con', 'onboarding_context', 'mybooking-wp-plugin' ) ?>
			&nbsp;
			<strong>
				<a href="mailto:soporte@mybooking.es">
					soporte@mybooking.es
				</a>
			</strong>
		</h2>
		<h3>
			<a href="<?php esc_attr(menu_page_url('mybooking-onboarding'))?>">
				<?php echo esc_html_x( 'Volver', 'onboarding_context', 'mybooking-wp-plugin' ) ?>
			</a>
		</h3>
	</div>
<?php
}

mybooking_plugin_onboarding_error_page();
?>