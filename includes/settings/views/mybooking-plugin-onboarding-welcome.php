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
	
	<div class="mb-onboarding-login mb-onboarding-commons">
		<div id="mb-onboarding-loading" class="mb-onboarding-loading" style="display: none;">Loading...</div>
		<h1>
			Bienvenido al plugin de reservas de <strong>Mybooking</strong>
		</h1>
		<p class="mb-onboarding-login-description">
			Mybooking is a platform that allow you to manage your inventory, reservations, planning, invoicing and integrate a reservation engine in your web site.
		</p>
		<h2>
			Por favor, introduce un ID de cliente y un APIkey
		</h2>
		<form id="mb-onboarding-login-form" method="POST">
			<div class="mb-onboarding-row">
				<div class="mb-onboarding-column">
					<label for="client_id">
						ID cliente
					</label>
					<input type="text" name="client_id" id="client_id" placeholder="ID cliente" value="" />
				</div>
				<div class="mb-onboarding-column">
					<label for="api_key">
						APIKey
					</label>
					<input type="text" name="api_key" id="api_key" placeholder="APIKey" value="" />
				</div>
			</div>
			<br/>
			<a  href="" class="mb-onboarding-block mb-onboarding-video-link">¿Cómo obtengo mi ID de cliente?</a>
			<div class="mb-onboarding-buttons mb-onboarding-row">
				<input type="button" value="No tengo cuenta en Mybooking"  id="mybooking-onboarding-account" class="mybooking-onboarding-account" />
				<input type="submit" value="Entrar" />
			</div>
		</form>
		
		<!-- Video -->
		<?php $video='login'; require_once ('mybooking-plugin-onboarding-video.php') ?>

		<!-- Script -->
		<script src="<?php echo MYBOOKING_RESERVATION_ENGINE_PLUGIN_URL.'admin-assets/js/mybooking-plugin-onboarding-welcome.js' ?>"></script>
	</div>
<?php
}

mybooking_plugin_onboarding_welcome_page();
?>