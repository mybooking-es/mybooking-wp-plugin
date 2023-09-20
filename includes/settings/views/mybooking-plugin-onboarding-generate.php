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
	
	<div class="mb-onboarding-generate mb-onboarding-commons">
		<div id="mb-onboarding-loading" class="mb-onboarding-loading" style="display: none;">
			<?php echo esc_html_x( 'Loading', 'onboarding_context', 'mybooking-wp-plugin' ) ?>...
		</div>
		<h1>
			<?php echo esc_html_x( 'Motor de reservas de Mybooking', 'onboarding_context', 'mybooking-wp-plugin' ) ?>
		</h1>
		<h2>
		<?php echo esc_html_x( 'Tipo de negocio', 'onboarding_context', 'mybooking-wp-plugin' ) ?>: 
			<strong>
				<?php esc_html_e($family_name) ?>
			</strong>
			&nbsp;
			<?php echo esc_html_x( 'Modulo/s', 'onboarding_context', 'mybooking-wp-plugin' ) ?>: <strong>
				<?php if ( $module_rental ): ?> <?php echo esc_html_x( 'Alquiler', 'onboarding_context', 'mybooking-wp-plugin' ) ?> <?php endif; ?><?php if ( $module_activities ): ?> <?php echo esc_html_x( 'Actividades', 'onboarding_context', 'mybooking-wp-plugin' ) ?> <?php endif; ?><?php if ( $module_transfer ): ?> <?php echo esc_html_x( 'Transfer', 'onboarding_context', 'mybooking-wp-plugin' ) ?> <?php endif; ?></strong>
		</h2>
		<h3>
			<?php echo esc_html_x( 'Te agradecemos la confianza en nuestro producto y te damos la bienvenida ', 'onboarding_context', 'mybooking-wp-plugin' ) ?>
			<strong><?php esc_html_e($trade_name) ?></strong> :D
		</h3>
		<h4>
			<?php echo esc_html_x( 'Configuración', 'onboarding_context', 'mybooking-wp-plugin' ) ?>:
		</h4>
		<p>
			<?php echo esc_html_x( 'Para configurar el plugin vamos a utilizar la configuración actual de tu negocio de manera que con unos pocos pasos puedas empezar a utilizar tu motor de reserva', 'onboarding_context', 'mybooking-wp-plugin' ) ?>
		</p>
		<p>
			<?php echo esc_html_x( 'Comenzaremos generando las páginas que precisa el proceso de reserva y te proporcionaremos un listado de las páginas para que las puedas localizar e información complementaria para ayudarte a finalizar la configuración en el motor de reservas de Wordpress y en Mybooking', 'onboarding_context', 'mybooking-wp-plugin' ) ?>
			</p>
		<form  id="mb-onboarding-generate-form" method="POST">
			<br />
			<!-- Buttons -->
			<div class="mb-onboarding-row">
				<input type="submit" value="<?php echo esc_attr_x( 'Generar', 'onboarding_context', 'mybooking-wp-plugin' ) ?>" />
			</div>
		</form>
	</div>
<?php
}

mybooking_plugin_onboarding_generate_page();
?>