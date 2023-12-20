<?php
	defined('ABSPATH') or die('Forbidden');
?>
	
<div class="mb-onboarding-error mb-onboarding-commons">
	<h1 class="mb-onboarding-row mb-onboarding-error">
		<span class="mb-onboarding-icon dashicons dashicons-warning mb-onboarding-error"></span>
		&nbsp;&nbsp;
		<?php echo esc_html_x( 'We are sorry, an error has occurred', 'onboarding_context', 'mybooking-wp-plugin' ) ?>
	</h1>
	<h2>
		<?php echo esc_html_x( "Check your pages and try again. If you can't get it, contact", 'onboarding_context', 'mybooking-wp-plugin' ) ?>
		&nbsp;
		<strong>
			<a href="mailto:soporte@mybooking.es">
				soporte@mybooking.es
			</a>
		</strong>
	</h2>
	<h3>
		<a href="<?php esc_attr(menu_page_url('mybooking-onboarding'))?>">
			<?php echo esc_html_x( 'Return', 'onboarding_context', 'mybooking-wp-plugin' ) ?>
		</a>
	</h3>
</div>
