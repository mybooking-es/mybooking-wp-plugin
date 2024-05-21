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
 */
?>
<div id="driver_panel" class="mb-section mb-panel-container" <% if (booking.driver_is_customer) { %>style="display: none;"<% } %>>
	<br />
	<h3 class="mb-form_title">
		<?php echo esc_html_x('Skipper', 'renting_my_reservation', 'mybooking-wp-plugin') ?>
	</h3>
	<div class="mb-form-row">
		<div class="mb-form-group mb-col-md-6">
		<label for="driver_name"><?php echo esc_html_x('Name', 'renting_my_reservation', 'mybooking-wp-plugin') ?></label>
		<input class="form-control" id="driver_name" name="driver_name" type="text"
			placeholder="<%=configuration.escapeHtml("<?php echo esc_attr_x("Name", 'renting_my_reservation', 'mybooking-wp-plugin') ?>")%>" value="<%=booking.driver_name%>"
			maxlength="40" <% if (!booking.can_edit_online){%>disabled<%}%>>
		</div>
		<div class="mb-form-group mb-col-md-6">
		<label for="driver_surname"><?php echo esc_html_x('Surname', 'renting_my_reservation', 'mybooking-wp-plugin') ?></label>
		<input class="form-control" id="driver_surname" name="driver_surname" type="text"
			placeholder="<%=configuration.escapeHtml("<?php  echo esc_attr_x("Surname", 'renting_my_reservation', 'mybooking-wp-plugin') ?>")%>" value="<%=booking.driver_surname%>"
			maxlength="40" <% if (!booking.can_edit_online){%>disabled<%}%>>
		</div>
	</div>
	<div class="mb-form-row">
		<div class="mb-form-group mb-col-md-12">
		<label for="driver_document_id"><?php echo esc_html_x('ID card or passport', 'renting_my_reservation', 'mybooking-wp-plugin') ?></label>
		<input class="form-control" id="driver_document_id" name="driver_document_id" type="text"
			placeholder="<%=configuration.escapeHtml("<?php echo esc_attr_x("ID card or passport", 'renting_my_reservation', 'mybooking-wp-plugin') ?>")%>" value="<%=booking.driver_document_id%>"
			maxlength="50" <% if (!booking.can_edit_online){%>disabled<%}%>>
		</div>
	</div>
	<div class="mb-form-row">
		<div class="mb-form-group mb-col-md-6">
		<label
			for="driver_driving_license_type"><?php echo esc_html_x('Navigation license type', 'renting_my_reservation', 'mybooking-wp-plugin') ?></label>
		<input class="form-control" id="driver_driving_license_type" name="driver_driving_license_type"
			type="text" placeholder="<%=configuration.escapeHtml("<?php echo esc_attr_x('Navigation license type', 'renting_my_reservation', 'mybooking-wp-plugin') ?>")%>"
			value="<%=booking.driver_driving_license_type%>"
			maxlength="50" <% if (!booking.can_edit_online){%>disabled<%}%>>
		</div>

		<div class="mb-form-group mb-col-md-6">
		<label
			for="driver_driving_license_number"><?php echo esc_html_x('Navigation license number', 'renting_my_reservation', 'mybooking-wp-plugin') ?></label>
		<input class="form-control" id="driver_driving_license_number" name="driver_driving_license_number"
			type="text" placeholder="<%=configuration.escapeHtml("<?php echo esc_attr_x('Driving license number', 'renting_my_reservation', 'mybooking-wp-plugin') ?>")%>"
			value="<%=booking.driver_driving_license_number%>"
			maxlength="50" <% if (!booking.can_edit_online){%>disabled<%}%>>
		</div>
	</div>
</div>