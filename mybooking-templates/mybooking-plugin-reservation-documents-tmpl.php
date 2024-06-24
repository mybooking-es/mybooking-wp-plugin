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
 *   @phpcs:disable PHPCompatibility.Miscellaneous.RemovedAlternativePHPTags.MaybeASPOpenTagFound
 *   @phpcs:disable Generic.PHP.DisallowAlternativePHPTags.MaybeASPOpenTagFound
 *   @phpcs:disable Generic.PHP.DisallowAlternativePHPTags.MaybeASPShortOpenTagFound
 */
?>
<script type="text/tmpl" id="script_documents_upload">
	<% if (booking.engine_sign_contract) { %>
		<h3>
			<div class="badge">2</div> <?php echo esc_html_x( 'Upload documentation', 'renting_my_reservation', 'mybooking-wp-plugin' ) ?>
		</h3>
		<br />
		<% if (!booking.customer_documents_uploaded) { %>
			<h5>
				<?php echo esc_html_x( 'Before signing the contract we need you to upload the documentation', 'renting_my_reservation', 'mybooking-wp-plugin' ) ?>
			</h5>
			<br />
			<% if (typeof booking.documentation_url !== 'undefined' && booking.documentation_url && booking.documentation_url != '') { %>
				<h6>
					<?php echo esc_html_x( 'Use the secure link to upload documentation', 'renting_my_reservation', 'mybooking-wp-plugin' ) ?>
				</h6>
				<hr />
				<small class="mb--txt-center">
					<?php echo esc_html_x( 'Remember to reload the page after uploading the documentation to continue with the process.', 'renting_my_reservation', 'mybooking-wp-plugin' ) ?>
				</small>
				<button id="js_mb_upload_documentation_link" class="mb-button block">
					<?php echo esc_html_x( 'Upload documentation', 'renting_my_reservation', 'mybooking-wp-plugin') ?>
				</button>
				<% } else { %>
					<div class="mb-alert warning">
						<?php echo esc_html_x( 'Documentation upload is not available', 'renting_my_reservation', 'mybooking-wp-plugin' ) ?>
					</div>
			<% } %>
		<% } else { %>
			<h5>
				<?php echo esc_html_x( 'Documention has been uploaded successfully', 'renting_my_reservation', 'mybooking-wp-plugin' ) ?>
			</h5>
		<% } %>
	<% } else { %>
		<div class="mb-alert warning">
			<?php echo esc_html_x( 'This step is not available for this reservation', 'renting_my_reservation', 'mybooking-wp-plugin' ) ?>
		</div>
	<% } %>
</script>