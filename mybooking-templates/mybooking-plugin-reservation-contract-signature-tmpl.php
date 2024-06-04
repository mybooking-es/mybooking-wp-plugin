<?php
/**
 *   MYBOOKING ENGINE - RESERVATION CONTRACT SIGNATURE TEMPLATE
 *   ---------------------------------------------------------------------------
 * 
 *   The Template for showing the contract signature step in the reservation process
 * 
 *   This template can be overridden by copying it to your
 *   theme/mybooking-templates/mybooking-plugin-reservation-contract-signature-tmpl.php
 *
 */
?>
<script type="text/tmpl" id="script_contract_signature">
	<% if (booking.engine_sign_contract) { %>
		<h3>
			<div class="badge">3</div> <?php echo esc_html_x( 'Sign contract', 'renting_complete', 'mybooking-wp-plugin' ) ?>
		</h3>
		<br />
		<% if (!booking.contract_signed) { %>
			<h5>
				<?php echo esc_html_x( 'To complete the process we need the signature', 'renting_complete', 'mybooking-wp-plugin' ) ?>
			</h5>
			<br />
			<% if (typeof booking.electronic_signature_url !== 'undefined' && booking.electronic_signature_url && booking.electronic_signature_url != '') { %>
				<h6>
					<?php echo esc_html_x( 'Use the secure link to sign the contract', 'renting_complete', 'mybooking-wp-plugin' ) ?>
				</h6>
				<hr />
				<small class="mb--txt-center">
					<?php echo esc_html_x( 'Remember to reload the page after signing the contract to download it.', 'renting_complete', 'mybooking-wp-plugin' ) ?>
				</small>
				<button id="js_mb_electronic_signature_link" class="mb-button block">
					<?php echo esc_html_x( 'Sign contract', 'renting_my_reservation', 'mybooking-wp-plugin') ?>
				</button>
			<% } %>
		<% } else { %>
			<h5>
				<?php echo esc_html_x( 'The contract has been signed successfully', 'renting_complete', 'mybooking-wp-plugin' ) ?>
			</h5>
			<br />
			<% if (typeof booking.signed_contract_url !== 'undefined' && booking.signed_contract_url && booking.signed_contract_url != '') { %>
				<h6>
					<?php echo esc_html_x( 'Use the link to view the contract', 'renting_complete', 'mybooking-wp-plugin' ) ?>
				</h6>
				<hr />
				<a href="<%= booking.signed_contract_url %>" target="_blank" class="mb-button block text-center">
					<?php echo esc_html_x( 'Go to document', 'renting_my_reservation', 'mybooking-wp-plugin') ?>
				</a>
			<% } %>
		<% } %>
	<% } else { %>
		<div class="mb-alert warning">
			<?php echo esc_html_x( 'This step is not available for this reservation', 'renting_complete', 'mybooking-wp-plugin' ) ?>
		</div>
	<% } %>
</script>