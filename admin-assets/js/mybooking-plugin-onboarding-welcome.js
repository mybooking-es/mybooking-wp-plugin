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
				submitHandler: function(form) {
					var url = '/wp-json/api/v1/login';
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
							window.location.search = '?page=mybooking-onboarding-selector'; // TODO safe
						},
						error: function() {
							alert('Por favor, revisa los datos proporcionados se ha producido un error.'); // TODO
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
					'client_id': 'required',
					'apy_key': 'required',
				},
				messages: {
					'client_id': _x('Required', 'onboarding_context_js', 'mybooking-wp-plugin'),
					'apy_key': _x('Required', 'onboarding_context_js', 'mybooking-wp-plugin') 
				},
			}
		);
	});
})(jQuery);