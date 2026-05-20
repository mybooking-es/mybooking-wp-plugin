(function($) {
  $(document).ready(function() {

		// Wp i18n integration
    const { __, _x, _n, sprintf } = wp.i18n;

		$('#mybooking_plugin_settings_api_key_active_btn').on('click', function() {

			if ($('#mybooking_plugin_settings_api_key_active').attr('readonly')) {
				const msg =  _x('Remember that the API key must be the one provided for the account identified in the Mybooking Client Id field', 'onboarding_context_js', 'mybooking-reservation-engine');
				const isConfirmed = confirm(msg);

				if (isConfirmed) {
					$('#mybooking_plugin_settings_api_key_active').removeAttr('readonly');
					$(this).attr('disabled', 'disabled');
				}
			}

		});

		// Captcha mode conditional visibility
		function applyCaptchaVisibility(mode) {
			const $rowSiteKey = $('#mybooking_captcha_site_key').closest('tr');
			const $rowIncludeJs = $('#mybooking_captcha_include_js').closest('tr');
			const $rowCloudKey = $('#mybooking_captcha_cloud_api_key').closest('tr');
			const $rowProjectId = $('#mybooking_captcha_project_id').closest('tr');

			if (mode === '') {
				$rowSiteKey.hide();
				$rowIncludeJs.hide();
				$rowCloudKey.hide();
				$rowProjectId.hide();
			} else if (mode === 'v2') {
				$rowSiteKey.show();
				$rowIncludeJs.show();
				$rowCloudKey.hide();
				$rowProjectId.hide();
			} else if (mode === 'enterprise') {
				$rowSiteKey.show();
				$rowIncludeJs.show();
				$rowCloudKey.show();
				$rowProjectId.show();
			}
		}

	  const $captchaModeSelect = $('#mybooking_captcha_mode_select');
	  if ($captchaModeSelect.length) {
			applyCaptchaVisibility($captchaModeSelect.val());
			$captchaModeSelect.on('change', function() {
				applyCaptchaVisibility($(this).val());
			});
		}

	});
})(jQuery);