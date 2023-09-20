(function($) {
  $(document).ready(function() {

		$('#mybooking_plugin_settings_api_key_active_btn').on('click', function() {

			if ($('#mybooking_plugin_settings_api_key_active').attr('readonly')) {
				var isConfirmed = confirm('Recuerda que la APIkey debe ser la que se proporciona para la cuenta identificada en el campo Mybooking Client Id');

				if (isConfirmed) {
					$('#mybooking_plugin_settings_api_key_active').removeAttr('readonly');
					$(this).attr('disabled', 'disabled');
				}
			}

		});

	});
})(jQuery);