<?php
	defined('ABSPATH') or die('Forbidden');
?>

<?php
/**
* Render Mybooking onboarding page
*
* https://developer.wordpress.org/reference/functions/do_settings_fields/
*/
function mybooking_plugin_onboarding_selector_page() {
	?>
	<!-- Styles -->
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
	
	<div class="mb-onboarding-selector mb-onboarding-commons">
		<div id="mb-onboarding-loading" class="mb-onboarding-loading" style="display: none;">Loading...</div>
		<h1>
			Motor de reservas de Mybooking
		</h1>
		<h2>
				Tipo de negocio: <strong><?php esc_html_e($family_name) ?></strong>
				&nbsp;
				Modulo/s: <strong><?php if ( $module_rental ): ?> Alquiler <?php endif; ?><?php if ( $module_activities ): ?> Actividades <?php endif; ?><?php if ( $module_transfer ): ?> Transfer <?php endif; ?></strong>
		</h2>
		<h3>
			Te agradecemos la confianza en nuestro producto y te damos la bienvenida <strong><?php esc_html_e($trade_name) ?></strong>. :D
		</h3>
		<h4>
			Configuración:
		</h4>
		<p>
			Para configurar el plugin <strong>vamos a utilizar la configuración actual de tu negocio de manera que con unos pocos pasos puedas empezar a utilizar tu motor de reserva.</strong>
		</p>
		<p>
			Comenzaremos generando las páginas que precisa el proceso de reserva y te proporcionaremos un listado de las páginas para que las puedas localizar e información complementaria para ayudarte a finalizar la configuración en el motor de reservas de Wordpress y en Mybooking.
			</p>
		<form  id="mb-onboarding-selector-form" method="POST">
			<br />
			<!-- Buttons -->
			<div class="mb-onboarding-row">
				<input type="submit" value="Generar" />
			</div>
		</form>

		<div  id="mb-onboarding-gallery-container" class="mb-onboarding-gallery-container" style="display: none">
			<?php require_once ('mybooking-plugin-onboarding-gallery.php') ?>
		</div>
	</div>

	<!-- Scripts -->
	<script>
		(function($) {
			$(document).ready(function() {
				/*
				* Form validation
				*/
				$('#mb-onboarding-selector-form').validate({
						submitHandler: function(form) {
							var url = '/wp-json/api/v1/setupOnboarding';
							var params = $(form).formParams();
							var data = JSON.stringify(params);

							// Request  
							$.ajax({
								type: 'POST',
								url,
								data,
								dataType : 'json',
								contentType : 'application/json; charset=utf-8',
								crossDomain: false,
								success: (data, textStatus, jqXHR) => {
									window.location.search = '?page=mybooking-onboarding-resume'; // TODO safe
								},
								error: function(err) {
									window.location.search = '?page=mybooking-onboarding-error'; // TODO safe
									// alert('Por favor, revisa los datos proporcionados se ha producido un error.'); // TODO
								},
								beforeSend: function() {
									$('#mb-onboarding-loading').show();
								},        
								complete: function() {
									$('#mb-onboarding-loading').hide();
								}
							});
							
							return false;
						},
						errorClass: 'error',
						rules : {
							'selector': 'required',
						},
						messages: {
							'selector': 'Es requerido', // TODO
						},
					}
        );
			});
		})(jQuery)
	</script>
<?php
}

mybooking_plugin_onboarding_selector_page();
?>