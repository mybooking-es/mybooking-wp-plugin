(function($) {
  $(document).ready(function() {

		// Wp i18n integration
    const { __, _x, _n, sprintf } = wp.i18n;

		$('#mybooking_plugin_settings_api_key_active_btn').on('click', function() {

			if ($('#mybooking_plugin_settings_api_key_active').attr('readonly')) {
				const msg =  _x('Remember that the API key must be the one provided for the account identified in the Mybooking Client Id field', 'onboarding_context_js', 'mybooking-wp-plugin');
				const isConfirmed = confirm(msg);

				if (isConfirmed) {
					$('#mybooking_plugin_settings_api_key_active').removeAttr('readonly');
					$(this).attr('disabled', 'disabled');
				}
			}

		});

	});
})(jQuery);