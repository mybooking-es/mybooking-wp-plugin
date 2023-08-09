<?php
	defined('ABSPATH') or die('Forbidden');
?>

<?php
/**
* Render Mybooking onboarding page
*
* setting_fields: On boarding section id
* https://developer.wordpress.org/reference/functions/do_settings_fields/
*/
function mybooking_plugin_onboarding_page() {
	?>
	<!-- Styles -->
	<?php
		$plugin_dir = plugin_dir_url(__FILE__);
	?>
	<link rel="stylesheet" href="<?php echo $plugin_dir ?>styles/mybooking-plugin-onboarding.css">
	
	<div class="wrap mb-onboarding-login">
		<h1>
			Bienvenido al plugin de reservas de <strong>Mybooking</strong>
		</h1>
		<h2>
			Por favor, introduce un ID de cliente y un APIkey
		</h2>
		<form id="mb-onboarding-login-form" method="POST">
			<div class="mb-onboarding-row">
				<div class="mb-onboarding-column">
					<label for="client_id">
						ID cliente
					</label>
					<input type="text" name="client_id" id="client_id" placeholder="ID cliente" value="dev-rentacar" />
				</div>
				<div class="mb-onboarding-column">
					<label for="api_key">
						APIKey
					</label>
					<input type="text" name="api_key" id="api_key" placeholder="APIKey" value="" />
				</div>
			</div>
			<br/>
			<a  id="mb-onboarding-video-link" class="mb-onboarding-block mb-onboarding-video-link">¿Cómo obtengo mi ID de cliente?</a>
			<div class="mb-onboarding-buttons mb-onboarding-row">
				<input type="button" value="No tengo cuenta en Mybooking"  id="mybooking-onboarding-account" class="mybooking-onboarding-account" />
				<input type="submit" value="Entrar" />
			</div>
		</form>
		<div  id="mb-onboarding-video-container" class="mb-onboarding-video-container" style="display: none">
			<div id="mb-onboarding-close-btn" class="mb-onboarding-close-btn">x</div>
			<?php $video='login'; require_once ('mybooking-plugin-onboarding-video.php') ?>
		</div>
	</div>

	<!-- Scripts -->
	<script>
		(function($) {
			$(document).ready(function() {
				/*
				* Events
				*/
				$('#mybooking-onboarding-account').on('click', function() {
					window.open('https://mybooking.es/');
				});

				$('#mb-onboarding-login-form').validate({
						submitHandler: function(form) {
							var params = $(form).formParams();
							
							return false;
						},
						errorClass: 'error',
						rules : {
							'client_id': 'required',
							'apy_key': 'required',
						},
						messages: {
							'client_id': 'Es requerido', // TODO
							'apy_key': 'Es requerido', // TODO
						},
					}
        );
			});
		})(jQuery)
	</script>
<?php
}

mybooking_plugin_onboarding_page();
?>