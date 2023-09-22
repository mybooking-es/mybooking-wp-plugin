<?php
	defined('ABSPATH') or die('Forbidden');
?>

<?php
/**
* Render Mybooking onboarding page
*
* https://developer.wordpress.org/reference/functions/do_settings_fields/
*/
function mybooking_plugin_onboarding_login_page() {
	?>
	
	<div class="mb-onboarding-login mb-onboarding-commons">
		<div id="mb-onboarding-loading" class="mb-onboarding-loading" style="display: none;">
			<?php echo esc_html_x( 'Loading...', 'onboarding_context', 'mybooking-wp-plugin' ) ?>
		</div>
		<h1>
			<?php echo esc_html_x( 'Login', 'onboarding_context', 'mybooking-wp-plugin' ) ?>
		</h1>
		<h2>
			<?php echo esc_html_x( 'Please enter a customer ID and APIkey', 'onboarding_context', 'mybooking-wp-plugin' ) ?>
		</h2>
		<form id="mb-onboarding-login-form" method="POST">
			<div class="mb-onboarding-row">
				<div class="mb-onboarding-column">
					<label for="client_id">
						<?php echo esc_html_x( 'Client ID', 'onboarding_context', 'mybooking-wp-plugin' ) ?>
					</label>
					<input type="text" name="client_id" id="client_id" placeholder="<?php echo esc_attr_x( 'Client ID', 'onboarding_context', 'mybooking-wp-plugin' ) ?>" value="" />
				</div>
				<div class="mb-onboarding-column">
					<label for="api_key">
						<?php echo esc_html_x( 'APIKey', 'onboarding_context', 'mybooking-wp-plugin' ) ?>
					</label>
					<input type="text" name="api_key" id="api_key" placeholder="<?php echo esc_attr_x( 'APIKey', 'onboarding_context', 'mybooking-wp-plugin' ) ?>" value="" />
				</div>
			</div>
			<br/>
			<a href="#" class="mb-onboarding-block mb-onboarding-video-link">
				<?php echo esc_html_x( 'How do I get my customer ID?', 'onboarding_context', 'mybooking-wp-plugin' ) ?>
			</a>
			<div class="mb-onboarding-buttons mb-onboarding-row">
				<input type="button" value="<?php echo esc_attr_x( "I don't have a Mybooking account", 'onboarding_context', 'mybooking-wp-plugin' ) ?>"  id="mybooking-onboarding-account" class="mybooking-onboarding-account" />
				<input type="submit" value="<?php echo esc_attr_x( 'Enviar', 'onboarding_context', 'mybooking-wp-plugin' ) ?>" />
			</div>
		</form>
		
		<!-- Video -->
		<?php $video='login'; require_once ('mybooking-plugin-onboarding-video.php') ?>

	</div>
<?php
}

mybooking_plugin_onboarding_login_page();
?>