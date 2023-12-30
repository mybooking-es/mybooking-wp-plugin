(function($) {
	$(document).ready(function() {
		
		// Wp i18n integration
		const { __, _x, _n, sprintf } = wp.i18n;

		/*
		* Button events
		*/
		$('#mybooking-onboarding-account').on('click', function(event) {
			event.preventDefault();
			
			window.open('https://mybooking.es/en/sign-up/');
		});

		/*
		* Form validation
		*/
		$('#mb-onboarding-login-form').validate({
				errorClass: 'error',
				rules : {
					'client_id': 'required',
					'api_key': 'required',
				},
				messages: {
					'client_id': _x('Required', 'onboarding_context_js', 'mybooking-wp-plugin'),
					'api_key': _x('Required', 'onboarding_context_js', 'mybooking-wp-plugin'),
				},
			}
		);
	});
})(jQuery);