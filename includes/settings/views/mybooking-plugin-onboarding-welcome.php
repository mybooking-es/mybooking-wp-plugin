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
		<div id="mb-onboarding-loading" class="mb-onboarding-loading" style="display: none;">
			<?php echo esc_html_x( 'Loading', 'onboarding_context', 'mybooking-wp-plugin' ) ?>...
		</div>
		<h1>
			<?php echo esc_html_x( 'Bienvenido al plugin de reservas de Mybooking', 'onboarding_context', 'mybooking-wp-plugin' ) ?>
		</h1>
		<p class="mb-onboarding-login-description">
			<?php echo esc_html_x( 'Mybooking is a platform that allow you to manage your inventory, reservations, planning, invoicing and integrate a reservation engine in your web site', 'onboarding_context', 'mybooking-wp-plugin' ) ?>
		</p>
		<h2>
			<?php echo esc_html_x( 'Por favor, introduce un ID de cliente y un APIkey', 'onboarding_context', 'mybooking-wp-plugin' ) ?>
		</h2>
		<form id="mb-onboarding-login-form" method="POST">
			<div class="mb-onboarding-row">
				<div class="mb-onboarding-column">
					<label for="client_id">
						<?php echo esc_html_x( 'ID cliente', 'onboarding_context', 'mybooking-wp-plugin' ) ?>
					</label>
					<input type="text" name="client_id" id="client_id" placeholder="<?php echo esc_attr_x( 'ID cliente', 'onboarding_context', 'mybooking-wp-plugin' ) ?>" value="" />
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
				<?php echo esc_html_x( '¿Cómo obtengo mi ID de cliente?', 'onboarding_context', 'mybooking-wp-plugin' ) ?>
			</a>
			<div class="mb-onboarding-buttons mb-onboarding-row">
				<input type="button" value="<?php echo esc_attr_x( 'No tengo cuenta en Mybooking', 'onboarding_context', 'mybooking-wp-plugin' ) ?>"  id="mybooking-onboarding-account" class="mybooking-onboarding-account" />
				<input type="submit" value="<?php echo esc_attr_x( 'Entrar', 'onboarding_context', 'mybooking-wp-plugin' ) ?>" />
			</div>
		</form>
		
		<!-- Video -->
		<?php $video='login'; require_once ('mybooking-plugin-onboarding-video.php') ?>

	</div>
<?php
}

mybooking_plugin_onboarding_welcome_page();
?>