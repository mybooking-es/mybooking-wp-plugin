<% if (typeof booking.electronic_signature_url !== 'undefined' && booking.electronic_signature_url && booking.electronic_signature_url != '') { %>
	<div class="mb-section">
		<button id="js_mb_electronic_signature_link" class="mb-button block">
			<?php echo esc_html_x( 'Sign contract', 'renting_my_reservation', 'mybooking-wp-plugin') ?>
		</button>
	</div>
<% } %>