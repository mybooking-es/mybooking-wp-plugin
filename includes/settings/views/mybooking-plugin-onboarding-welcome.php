<?php
	defined('ABSPATH') or die('Forbidden');
?>

<?php
/**
* Render Mybooking onboarding page
*
* https://developer.wordpress.org/reference/functions/do_settings_fields/
*/
function mybooking_plugin_onboarding_welcome_page() {
	?>
	
	<div class="mb-onboarding-welcome mb-onboarding-commons">
		<div id="mb-onboarding-loading" class="mb-onboarding-loading" style="display: none;">
			<?php echo esc_html_x( 'Loading...', 'onboarding_context', 'mybooking-wp-plugin' ) ?>
		</div>
		<h1>
			<?php echo esc_html_x( 'Welcome to the Mybooking booking plugin', 'onboarding_context', 'mybooking-wp-plugin' ) ?>
		</h1>
		<p class="mb-onboarding-login-description">
			<?php echo esc_html_x( 'Mybooking is a platform that allow you to manage your inventory, reservations, planning, invoicing and integrate a reservation engine in your web site', 'onboarding_context', 'mybooking-wp-plugin' ) ?>
		</p>
		<br />
		<div class="mb-onboarding-welcome-video-container">
			<div class="mb-onboarding-welcome-video-content">
				<iframe src="https://player.vimeo.com/video/850116866?badge=0&amp;autopause=0&amp;player_id=0&amp;app_id=58479" frameborder="0" allow="autoplay; fullscreen; picture-in-picture" title="Welcome"></iframe>
			</div>
		</div>
		<br /><br />
		<a href="<?php esc_attr(menu_page_url('mybooking-onboarding-login'))?>" class="mb-onboarding-btn">
			<?php echo esc_html_x( 'Enter', 'onboarding_context', 'mybooking-wp-plugin' ) ?>
		</a>
	</div>
<?php
}

mybooking_plugin_onboarding_welcome_page();
?>