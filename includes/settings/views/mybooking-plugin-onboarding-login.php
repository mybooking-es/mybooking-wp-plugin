<?php
	defined('ABSPATH') or die('Forbidden');
?>
	
	<div class="mb-onboarding-page-header">
		<div class="mb-onboarding-title-section">
			<div class="mb-onboarding-loading" id="mb-onboarding-loading" style="display: none;">
				<?php echo esc_html_x( 'Loading', 'onboarding_context', 'mybooking-wp-plugin' ) ?>...
			</div>
			<h1 class="mb-onboarding-title">
				<?php echo esc_html_x( 'Mybooking Reservation Engine installation wizard', 'onboarding_context', 'mybooking-wp-plugin' ) ?>
			</h1>
			<p class="mb-onboarding-description">
				<?php echo esc_html_x( 'Follow the instructions to start the configuration process to set up the booking engine on your site', 'onboarding_context', 'mybooking-wp-plugin' ) ?>
			</p>
		</div>	
	</div>

	<div class="mb-onboarding-login mb-onboarding-commons">
		<h2 class="mb-onboarding-step-title">
			<?php echo esc_html_x( 'Insert your client ID and API key', 'onboarding_context', 'mybooking-wp-plugin' ) ?>
		</h2>
		
		<a class="mb-onboarding-video-link mb-onboarding-help-link" href="#">
			<?php echo esc_html_x( 'Get your client ID and API key', 'onboarding_context', 'mybooking-wp-plugin' ) ?>
		</a>
		<span class="mb-onboarding-separator"></span>
		<a class="mybooking-onboarding-account mb-onboarding-help-link" id="mybooking-onboarding-account">
			<?php echo esc_attr_x( 'Create an account', 'onboarding_context', 'mybooking-wp-plugin' ) ?>
		</a>
		
		<div class="mb-onboarding-row">
			<div class="mb-onboarding-column-center">
				<form class="mb-onboarding-login-form" id="mb-onboarding-login-form" method="POST">
					<?php wp_nonce_field( 'login', 'nonce_field' ); ?>
					<input class="mb-onboarding-login-field" type="text" name="client_id" id="client_id" placeholder="<?php echo esc_attr_x( 'Client ID', 'onboarding_context', 'mybooking-wp-plugin' ) ?>" value="" />
					<input class="mb-onboarding-login-field" type="text" name="api_key" id="api_key" placeholder="<?php echo esc_attr_x( 'API Key', 'onboarding_context', 'mybooking-wp-plugin' ) ?>" value="" />
					<br>
					<input class="mb-onboarding-button" type="submit" value="<?php echo esc_attr_x( 'Let\'s start', 'onboarding_context', 'mybooking-wp-plugin' ) ?>" />
				</form>
			</div>
		</div>
	</div>

	<!-- Video -->
	<?php $video='login'; require_once ('mybooking-plugin-onboarding-video.php') ?>
