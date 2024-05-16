<script type="text/tmpl" id="script_documents_upload">
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
</script>