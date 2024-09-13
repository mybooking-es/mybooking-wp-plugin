<?php
/**
 *   MYBOOKING ENGINE - RESERVATION FORM SKIPPER TEMPLATE
 *   ---------------------------------------------------------------------------
 * 
 *   The Template for showing the form to fill the skipper information
 * 
 *   This template can be overridden by copying it to your
 *   theme/mybooking-templates/mybooking-plugin-reservation-form-skipper-tmpl.php
 *
 *   @phpcs:disable PHPCompatibility.Miscellaneous.RemovedAlternativePHPTags.MaybeASPOpenTagFound
 *   @phpcs:disable Generic.PHP.DisallowAlternativePHPTags.MaybeASPOpenTagFound
 *   @phpcs:disable Generic.PHP.DisallowAlternativePHPTags.MaybeASPShortOpenTagFound
 */
?>
<% if (configuration.rentingFormFillDataDriverDetail && !booking.has_optional_external_driver) { %>
	<div id="driver_panel" class="mb-section mb-panel-container">
		<h3 class="mb-form_title">
			<?php echo esc_html_x('Skipper', 'renting_my_reservation', 'mybooking-wp-plugin') ?>
		</h3>
		<div class="mb-form-row">
			<div class="mb-form-group mb-col-md-6">
			<label for="driver_name"><?php echo esc_html_x('Name', 'renting_my_reservation', 'mybooking-wp-plugin') ?>
			<% if (required_fields.includes('driver_name')) { %>*<% } %>
			</label>
			<input class="form-control" id="driver_name" name="driver_name" type="text"
				placeholder="<%=configuration.escapeHtml("<?php echo esc_attr_x("Name", 'renting_my_reservation', 'mybooking-wp-plugin') ?>")%>" value="<%=booking.driver_name%>"
				maxlength="40" <% if (!booking.can_edit_online){%>disabled<%}%>
				<% if (required_fields.includes('driver_name')) { %>required<% } %>>
			</div>
			<div class="mb-form-group mb-col-md-6">
			<label for="driver_surname"><?php echo esc_html_x('Surname', 'renting_my_reservation', 'mybooking-wp-plugin') ?>
				<% if (required_fields.includes('driver_surname')) { %>*<% } %>
			</label>
			<input class="form-control" id="driver_surname" name="driver_surname" type="text"
				placeholder="<%=configuration.escapeHtml("<?php  echo esc_attr_x("Surname", 'renting_my_reservation', 'mybooking-wp-plugin') ?>")%>" value="<%=booking.driver_surname%>"
				maxlength="40" <% if (!booking.can_edit_online){%>disabled<%}%>
				<% if (required_fields.includes('driver_surname')) { %>required<% } %>>
			</div>
		</div>
		<div class="mb-form-row">
			<div class="mb-form-group mb-col-md-6">
				<label>
					<?php echo esc_html_x( 'E-mail', 'renting_complete', 'mybooking-wp-plugin') ?>
					<% if (required_fields.includes('driver_email')) { %>*<% } %>
				</label>
				<input class="mb-form-control" type="text" name="driver_email" autocomplete="off" placeholder="<?php echo esc_attr_x( 'E-mail', 'renting_complete', 'mybooking-wp-plugin') ?>" maxlength="50" value="<%=booking.driver_email%>" 
							<% if (!booking.can_edit_online || (typeof booking.driver_email !== 'undefined' && booking.driver_email !== null && booking.driver_email != '')){%>disabled<%}%> <% if (required_fields.includes('driver_email')) { %>required<% } %>>
			</div>
			<div class="mb-form-group mb-col-md-6">
				<label>
					<?php echo esc_html_x( 'Phone number', 'renting_complete', 'mybooking-wp-plugin') ?>
					<% if (required_fields.includes('driver_phone')) { %>*<% } %>
				</label>
				<input class="mb-form-control" type="text" name="driver_phone" autocomplete="off" 
							placeholder="<?php echo esc_attr_x( 'Phone number', 'renting_complete', 'mybooking-wp-plugin') ?>" 
							maxlength="15" value="<%=booking.driver_phone%>" 
				<% if (!booking.can_edit_online || (typeof booking.driver_phone !== 'undefined' && booking.driver_phone !== null && booking.driver_phone != '')){%>disabled<%}%> <% if (required_fields.includes('driver_phone')) { %>required<% } %>>
			</div>
  	</div>
		<div class="mb-form-row">
			<div class="mb-form-group mb-col-md-12">
			<label for="driver_document_id"><?php echo esc_html_x('ID card/passport number', 'renting_my_reservation', 'mybooking-wp-plugin') ?>
				<% if (required_fields.includes('driver_document_id')) { %>*<% } %>
			</label>
			<input class="form-control" id="driver_document_id" name="driver_document_id" type="text"
				placeholder="<%=configuration.escapeHtml("<?php echo esc_attr_x("ID card/passport number", 'renting_my_reservation', 'mybooking-wp-plugin') ?>")%>" value="<%=booking.driver_document_id%>"
				maxlength="50" <% if (!booking.can_edit_online){%>disabled<%}%>
				<% if (required_fields.includes('driver_document_id')) { %>required<% } %>>
			</div>
		</div>
		<div class="mb-form-row">
			<div class="mb-form-group mb-col-md-6">
			<label
				for="driver_driving_license_type"><?php echo esc_html_x('Navigation license type', 'renting_my_reservation', 'mybooking-wp-plugin') ?>
				<% if (required_fields.includes('driver_driving_license_type')) { %>*<% } %>
			</label>
			<input class="form-control" id="driver_driving_license_type" name="driver_driving_license_type"
				type="text" placeholder="<%=configuration.escapeHtml("<?php echo esc_attr_x('Navigation license type', 'renting_my_reservation', 'mybooking-wp-plugin') ?>")%>"
				value="<%=booking.driver_driving_license_type%>"
				maxlength="50" <% if (!booking.can_edit_online){%>disabled<%}%>
				<% if (required_fields.includes('driver_driving_license_type')) { %>required<% } %>>
			</div>

			<div class="mb-form-group mb-col-md-6">
			<label
				for="driver_driving_license_number"><?php echo esc_html_x('Navigation license number', 'renting_my_reservation', 'mybooking-wp-plugin') ?>
				<% if (required_fields.includes('driver_driving_license_number')) { %>*<% } %>
			</label>
			<input class="form-control" id="driver_driving_license_number" name="driver_driving_license_number"
				type="text" placeholder="<%=configuration.escapeHtml("<?php echo esc_attr_x('Driving license number', 'renting_my_reservation', 'mybooking-wp-plugin') ?>")%>"
				value="<%=booking.driver_driving_license_number%>"
				maxlength="50" <% if (!booking.can_edit_online){%>disabled<%}%>
				<% if (required_fields.includes('driver_driving_license_number')) { %>required<% } %>>
			</div>
		</div>
	</div>
<% } %>