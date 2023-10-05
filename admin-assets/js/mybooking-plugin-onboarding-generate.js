(function($) {
	$(document).ready(function() {

		/*
		* Form validation
		*/
		$('#xmb-onboarding-generate-form').validate({
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
				},
				messages: {
				},
			}
		);
	});
})(jQuery);