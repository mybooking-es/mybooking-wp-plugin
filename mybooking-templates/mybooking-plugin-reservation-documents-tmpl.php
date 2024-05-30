<?php
/**
 *   MYBOOKING ENGINE - RESERVATION DOCUMENTS UPLOAD TEMPLATE
 *   ---------------------------------------------------------------------------
 * 
 *   The Template for showing the documents upload step in the reservation process
 * 
 *   This template can be overridden by copying it to your
 *   theme/mybooking-templates/mybooking-plugin-reservation-documents-tmpl.php
 *
 */
?>
<script type="text/tmpl" id="script_documents_upload">
	<% if (booking.engine_sign_contract) { %>
		<h3 class="text-primary">
			2 | <?php echo esc_html_x( 'Documentation', 'renting_complete', 'mybooking-wp-plugin' ) ?>
		</h3>
		<br />
		<h5>
			<?php echo esc_html_x( 'Before signing the contract we need you to upload the documentation', 'renting_complete', 'mybooking-wp-plugin' ) ?>
		</h5>
		<br />
		<h6>
			<?php echo esc_html_x( 'Use the secure link to upload documentation', 'renting_complete', 'mybooking-wp-plugin' ) ?>
		</h6>
		<% if (typeof booking.documentation_url !== 'undefined' && booking.documentation_url && booking.documentation_url != '') { %>
			<hr />
			<button id="js_mb_upload_documentation_link" class="mb-button block">
				<?php echo esc_html_x( 'Upload documentation', 'renting_my_reservation', 'mybooking-wp-plugin') ?>
			</button>
		<% } %>
	<% } else { %>
		<div class="mb-alert warning">
			<?php echo esc_html_x( 'This step is not available for this reservation', 'renting_complete', 'mybooking-wp-plugin' ) ?>
		</div>
	<% } %>
</script>