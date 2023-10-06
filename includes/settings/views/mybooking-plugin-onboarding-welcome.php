<?php
	defined('ABSPATH') or die('Forbidden');
?>
<div class="mb-onboarding-page-header">
	<div class="mb-onboarding-title-section">
		<h1 class="mb-onboarding-title">
			<?php echo esc_html_x( 'Welcome to Mybooking Reservation Engine', 'onboarding_context', 'mybooking-wp-plugin' ) ?>
		</h1>
		<p class="mb-onboarding-description">
			<?php echo esc_html_x( 'This plugin connects your web site with Mybooking, the complete solution for renting and reservations', 'onboarding_context', 'mybooking-wp-plugin' ) ?>
		</p>
	</div>	
</div>

<div class="mb-onboarding-welcome mb-onboarding-commons">
	<div id="mb-onboarding-loading" class="mb-onboarding-loading" style="display: none;">
		<?php echo esc_html_x( 'Loading...', 'onboarding_context', 'mybooking-wp-plugin' ) ?>
	</div>

	<div class="mb-onboarding-welcome-video-container">
		<div class="mb-onboarding-welcome-video-content">
			<iframe src="https://player.vimeo.com/video/850116866?badge=0&amp;autopause=0&amp;player_id=0&amp;app_id=58479" frameborder="0" allow="autoplay; fullscreen; picture-in-picture" title="Welcome"></iframe>
		</div>
	</div>

	<a class="mb-onboarding-button" href="<?php esc_attr(menu_page_url('mybooking-onboarding-login'))?>">
		<?php echo esc_html_x( 'Enter', 'onboarding_context', 'mybooking-wp-plugin' ) ?>
	</a>
</div>
