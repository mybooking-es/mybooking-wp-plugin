<?php
	defined('ABSPATH') or die('Forbidden');
?>

<?php
/**
* Render Mybooking onboarding page
*
* https://developer.wordpress.org/reference/functions/do_settings_fields/
*/
function mybooking_plugin_onboarding_generate_page() {
	?>
	<?php
		
		$onboarding_settings = (array) get_option('mybooking_plugin_onboarding_business_info');

		if ( $onboarding_settings ) {
			$trade_name = $family_name = '';
			if (array_key_exists('trade_name', $onboarding_settings)) {
				$trade_name = $onboarding_settings["trade_name"];
	    }
	    if (array_key_exists('booking_item_family_name', $onboarding_settings)) {
				$family_name = $onboarding_settings["booking_item_family_name"];
	    }

	    $module_rental = $module_activities = $module_transfer = false;
	    if (array_key_exists('module_rental', $onboarding_settings)) {
				$module_rental = $onboarding_settings["module_rental"];
	    }
	    
	    if ( $module_rental ) {
				$wc_rent_selector = false;
		    if (array_key_exists('wc_rent_selector', $onboarding_settings)) {
					$wc_rent_selector = $onboarding_settings["wc_rent_selector"];
		    }
				$wc_rent_calendar = $wc_rent_shift_picker = $wc_rent_weekly_planning = false;
				if (array_key_exists('wc_rent_calendar', $onboarding_settings)) {
					$wc_rent_calendar = $onboarding_settings["wc_rent_calendar"];
		    }
				if (array_key_exists('wc_rent_shift_picker', $onboarding_settings)) {
					$wc_rent_shift_picker = $onboarding_settings["wc_rent_shift_picker"];
		    }
				if (array_key_exists('wc_rent_weekly_planning', $onboarding_settings)) {
					$wc_rent_weekly_planning = $onboarding_settings["wc_rent_weekly_planning"];
		    }
	    }

			if (array_key_exists('module_activities', $onboarding_settings)) {
				$module_activities = $onboarding_settings["module_activities"];
	    }

			if ( $module_activities ) {
				$wc_activity_calendar = false;
				if (array_key_exists('wc_activity_calendar', $onboarding_settings)) {
					$wc_activity_calendar = $onboarding_settings["wc_activity_calendar"];
		    }
	    }

			if (array_key_exists('module_transfer', $onboarding_settings)) {
				$module_transfer = $onboarding_settings["module_transfer"];
	    }

			if ( $module_transfer ) {
				$wc_transfer_selector = false;
				if (array_key_exists('wc_transfer_selector', $onboarding_settings)) {
					$wc_transfer_selector = $onboarding_settings["wc_transfer_selector"];
				}
			}
		}
		else {
			wp_redirect('mybooking-plugin-onboarding-welcome.php');
			exit;
		}

	?>

	<div class="mb-onboarding-page-header">
		<div class="mb-onboarding-title-section">
			<h1 class="mb-onboarding-title">
				<?php echo esc_html_x( 'Welcome onboard', 'onboarding_context', 'mybooking-wp-plugin' ) ?>
				<br>
				<?php esc_html_e($trade_name) ?>
			</h1>
			<p class="mb-onboarding-description">
				<?php echo esc_html_x( 'We will start by generating the pages that the reservation process requires. You will get a list of the pages and complementary information to complete the configuration.', 'onboarding_context', 'mybooking-wp-plugin' ) ?>
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
			<input class="mb-onboarding-button" type="submit" value="<?php echo esc_attr_x( 'Generate', 'onboarding_context', 'mybooking-wp-plugin' ) ?>" />
		</form>
	</div>
	
<?php
}

mybooking_plugin_onboarding_generate_page();
?>