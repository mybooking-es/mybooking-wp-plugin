<?php
/**
 *   MYBOOKING ENGINE - RESERVATION FORM FLIGHT TEMPLATE
 *   ---------------------------------------------------------------------------
 * 
 *   The Template for showing the form to fill the flight information
 * 
 *   This template can be overridden by copying it to your
 *   theme/mybooking-templates/mybooking-plugin-reservation-form-flight-tmpl.php
 *
 *   @phpcs:disable PHPCompatibility.Miscellaneous.RemovedAlternativePHPTags.MaybeASPOpenTagFound
 *   @phpcs:disable Generic.PHP.DisallowAlternativePHPTags.MaybeASPOpenTagFound
 *   @phpcs:disable Generic.PHP.DisallowAlternativePHPTags.MaybeASPShortOpenTagFound
 */
?>
<% if (configuration.rentingFromFillDataFlight) { %>
	<div id="airport-form-section" class="mb-section mb-panel-container" <% if (booking.pickup_place_type != 'airport' && booking.return_place_type != 'airport') { %>style="display: none;"<% } %>>
		<h3 class="mb-form_title">
			<?php echo esc_html_x('Flight', 'renting_my_reservation', 'mybooking-wp-plugin') ?>
		</h3>

		<h6>
			<?php echo esc_html_x('Arrival', 'renting_my_reservation', 'mybooking-wp-plugin') ?>
		</h6>
		<hr />

		<div class="mb-form-row">
			<div class="mb-form-group mb-col-md-4">
				<label for="flight_company"><?php echo esc_html_x('Company', 'renting_my_reservation', 'mybooking-wp-plugin') ?></label>
				<input class="form-control" id="flight_company" name="flight_company" type="text"
					placeholder="<%=configuration.escapeHtml("<?php echo esc_attr_x('Company', 'renting_my_reservation', 'mybooking-wp-plugin') ?>")%>" value="<%=booking.flight_company%>" maxlength="80" <% if (!booking.can_edit_online){%>disabled<%}%>>
			</div>
			<div class="mb-form-group mb-col-md-4">
				<label for="flight_number"><?php echo esc_html_x('Flight Number', 'renting_my_reservation', 'mybooking-wp-plugin') ?></label>
				<input class="form-control" id="flight_number" name="flight_number" type="text"
					placeholder="<%=configuration.escapeHtml("<?php echo esc_attr_x('Flight Number', 'renting_my_reservation', 'mybooking-wp-plugin') ?>")%>" value="<%=booking.flight_number%>" maxlength="10" <% if (!booking.can_edit_online){%>disabled<%}%>>
			</div>
			<div class="mb-form-group mb-col-md-4">
				<label for="flight_time"><?php echo esc_html_x('Estimated Time', 'renting_my_reservation', 'mybooking-wp-plugin') ?></label>
				<input class="form-control" id="flight_time" name="flight_time" type="text"
					placeholder="<%=configuration.escapeHtml("<?php echo esc_attr_x('Estimated Time', 'renting_my_reservation', 'mybooking-wp-plugin') ?>")%>" value="<%=booking.flight_time%>" maxlength="5" <% if (!booking.can_edit_online){%>disabled<%}%>>
			</div>
		</div>

		<h6>
			<?php echo esc_html_x('Departure', 'renting_my_reservation', 'mybooking-wp-plugin') ?>
		</h6>
		<hr />

		<div class="mb-form-row">
			<div class="mb-form-group mb-col-md-4">
				<label for="flight_company_departure"><?php echo esc_html_x('Company', 'renting_my_reservation', 'mybooking-wp-plugin') ?></label>
				<input class="form-control" id="flight_company_departure" name="flight_company_departure" type="text"
					placeholder="<%=configuration.escapeHtml("<?php echo esc_attr_x('Company', 'renting_my_reservation', 'mybooking-wp-plugin') ?>")%>" value="<%=booking.flight_company_departure%>" <% if (!booking.can_edit_online){%>disabled<%}%>>
			</div>
			<div class="mb-form-group mb-col-md-4">
				<label for="flight_number_departure"><?php echo esc_html_x('Flight Number', 'renting_my_reservation', 'mybooking-wp-plugin') ?></label>
				<input class="form-control" id="flight_number_departure" name="flight_number_departure" type="text"
					placeholder="<%=configuration.escapeHtml("<?php echo esc_attr_x('Flight Number', 'renting_my_reservation', 'mybooking-wp-plugin') ?>")%>" value="<%=booking.flight_number_departure%>" <% if (!booking.can_edit_online){%>disabled<%}%>>
			</div>
			<div class="mb-form-group mb-col-md-4">
				<label for="flight_time_departure"><?php echo esc_html_x('Estimated Time', 'renting_my_reservation', 'mybooking-wp-plugin') ?></label>
				<input class="form-control" id="flight_time_departure" name="flight_time_departure" type="text"
					placeholder="<%=configuration.escapeHtml("<?php echo esc_attr_x('Estimated Time', 'renting_my_reservation', 'mybooking-wp-plugin') ?>")%>" value="<%=booking.flight_time_departure%>" <% if (!booking.can_edit_online){%>disabled<%}%>>
			</div>
		</div>
	</div>
<% } %>