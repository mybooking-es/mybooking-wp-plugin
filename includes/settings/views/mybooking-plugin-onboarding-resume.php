<?php
	defined('ABSPATH') or die('Forbidden');
?>

<?php
/**
* Render Mybooking onboarding page
*
* https://developer.wordpress.org/reference/functions/do_settings_fields/
*/
function mybooking_plugin_onboarding_resume_page() {
	?>
	<!-- Styles -->
	<?php
		$plugin_dir = plugin_dir_url(__FILE__);

		$onboarding_settings = (array) get_option('mybooking_plugin_onboarding_business_info');
		if ( $onboarding_settings ) {
			$module_rental = $module_activities = $module_transfer = false;
	    if (array_key_exists('module_rental', $onboarding_settings)) {
				$module_rental = $onboarding_settings["module_rental"];
	    }
			if (array_key_exists('module_activities', $onboarding_settings)) {
				$module_activities = $onboarding_settings["module_activities"];
	    }
			if (array_key_exists('module_transfer', $onboarding_settings)) {
				$module_transfer = $onboarding_settings["module_transfer"];
	    }
		}

		$settings_renting = (array) get_option("mybooking_plugin_settings_renting");
		$renting_pages_ids = array();
		$home_page_id = 0;
		if($settings_renting) {
			foreach ($settings_renting as $key => $value) {
				if (str_ends_with($key, '_page')) {
					if (get_post_field('menu_order', $value)) {
						$renting_pages_ids[get_post_field('menu_order', $value) - 1] = $value;
					}
				}
				if (str_contains($key, 'home')) {
					$home_page_id = $value;
				}
				ksort($renting_pages_ids);
			}
		}
	?>
	<link rel="stylesheet" href="<?php echo $plugin_dir ?>styles/mybooking-plugin-onboarding.css">
	
	<div class="mb-onboarding-resume mb-onboarding-commons">
		<div id="mb-onboarding-loading" class="mb-onboarding-loading" style="display: none;">Loading...</div>
		<h1 class="mb-onboarding-row">
			<span class="mb-onboarding-icon dashicons dashicons-saved"></span>
			&nbsp;&nbsp;
			Configuración finalizada con exito
		</h1>
		<h2>
			A continuación puedes ver las páginas de prueba que se han creado con los contenidos que has seleccionado y configurado.
		</h2>
		<?php if ( $module_rental ): ?>
			<br />
			<h5>
				Modulo: Alquiler
			</h5>
			<ul class="mb-onboarding-list">
				<?php foreach ($renting_pages_ids as $key => $id) { ?>
					<li>
						<div class="mb-onboarding-row mb-onboarding-space-between">
							<p>
								Página:
								&nbsp;
								<strong><?php echo get_the_title( $id ) ?></strong>
								<?php if ($home_page_id === $id) { ?>
									(recuerda que el proceso de reserva se inicia desde aquí)
								<?php } ?>
							</p>
							<?php if ($home_page_id === $id) { ?>
								<a href="<?php echo get_permalink( $id ) ?>" title="Show page" target="_blank">
									<span class="mb-onboarding-icon dashicons dashicons-visibility"></span>
								</a>
							<?php } ?>
							<a href="<?php echo get_edit_post_link( $id ) ?>" title="Edit page" target="_blank">
								<span class="mb-onboarding-icon dashicons dashicons-external"></span>
							</a>
						</div>
					</li>
				<?php } ?>
			</ul>
			<p>
				<strong>Recuerda seleccionar la página de inicio en Wordpress</strong> y configurar el menú para que apunte a las páginas que no forman parte del proceso de reserva.
			</p>
		<?php endif; ?>
		<?php if ( $module_activities ): ?>
			<br />
			<h5>
				Modulo: Actividades
			</h5>
			<!-- TODO -->
		<?php endif; ?>
		<?php if ( $module_transfer ): ?>
			<br />
			<h5>
				Modulo: Transfer
			</h5>
			<!-- TODO -->
		<?php endif; ?>
	</div>
<?php
}

mybooking_plugin_onboarding_resume_page();
?>