<?php
	defined('ABSPATH') or die('Forbidden');
?>

<div class="mb-onboarding-page-header">
	<div class="mb-onboarding-title-section">
		<h1 class="mb-onboarding-title">
			<?php echo esc_html_x( 'Welcome onboard', 'onboarding_context', 'mybooking-wp-plugin' ) ?>
			<br>
			<?php esc_html_e($trade_name) ?>
		</h1>
		<p class="mb-onboarding-description">
			<?php echo esc_html_x( 'We will automatically setup the plugin based on your current account settings.', 'onboarding_context', 'mybooking-wp-plugin' ) ?>
		</p>
	</div>
</div>

<div class="mb-onboarding-generate mb-onboarding-commons">
	<div id="mb-onboarding-loading" class="mb-onboarding-loading" style="display: none;">
		<?php echo esc_html_x( 'Loading', 'onboarding_context', 'mybooking-wp-plugin' ) ?>...
	</div>

	<h2 class="mb-onboarding-step-title">
		<?php echo esc_html_x( 'Your current settings', 'onboarding_context', 'mybooking-wp-plugin' ) ?>
	</h2>
	<div class="mb-onboarding-setup-item">
		<?php echo esc_html_x( 'Type of bussiness', 'onboarding_context', 'mybooking-wp-plugin' ) ?>
		<strong>
			<?php esc_html_e($family_name) ?>
		</strong>
	</div>
	<div class="mb-onboarding-setup-item">
		<?php echo esc_html_x( 'Module(s)', 'onboarding_context', 'mybooking-wp-plugin' ) ?>
		<strong>
			<?php if ( $module_rental ): ?> 
				<?php echo esc_html_x( 'Renting', 'onboarding_context', 'mybooking-wp-plugin' ) ?> 
				<?php endif; ?>
			<?php if ( $module_rental && $module_activities ): ?> 
				<span class="mb-onboarding-separator"></span>
				<?php endif; ?>
			<?php if ( $module_activities ): ?> 
				<?php echo esc_html_x( 'Activities', 'onboarding_context', 'mybooking-wp-plugin' ) ?> 
				<?php endif; ?>
			<?php if ( $module_transfer ): ?> 
				<?php echo esc_html_x( 'Transfer', 'onboarding_context', 'mybooking-wp-plugin' ) ?> 
				<?php endif; ?>
		</strong>
	</div>
	
	<p class="mb-onboarding-description">
		<?php echo esc_html_x( 'To configure the plugin we are going to use the current configuration of your business', 'onboarding_context', 'mybooking-wp-plugin' ) ?>
	</p>
	
	<form  id="mb-onboarding-generate-form" method="POST">
		<?php wp_nonce_field( 'generate', 'nonce_field' ); ?>
		<input class="mb-onboarding-button" type="submit" value="<?php echo esc_attr_x( 'Do it!', 'onboarding_context', 'mybooking-wp-plugin' ) ?>" />
	</form>
</div>
