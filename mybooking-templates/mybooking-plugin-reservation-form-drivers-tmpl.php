<?php
/**
 *   MYBOOKING ENGINE - RESERVATION FORM DRIVERS TEMPLATE
 *   ---------------------------------------------------------------------------
 * 
 *   The Template for showing the form to fill the driver details in the reservation process
 * 
 *   This template can be overridden by copying it to your
 *   theme/mybooking-templates/mybooking-plugin-reservation-form-drivers-tmpl.php
 *
 */
?>
<% if (configuration.rentingFormFillDataDriverDetail) { %>
	<div id="driver_panel" class="mb-section mb-panel-container" <% if (booking.driver_is_customer) { %>style="display: none;"<% } %>>
		<!-- // Driver panel -->
		<br />
		<h3 class="mb-form_title">
			<?php echo esc_html( MyBookingEngineContext::getInstance()->getDriver() ) ?>
		</h3>
		<!-- Driver -->
		<div class="mb-form-row" >
			<div class="mb-form-group mb-col-md-6">
				<label>
					<?php echo esc_html_x('Name', 'renting_my_reservation', 'mybooking-wp-plugin') ?>
				</label>
				<input class="form-control" name="driver_name" type="text"
					placeholder="<%=configuration.escapeHtml("<?php echo esc_attr_x("Name", 'renting_my_reservation', 'mybooking-wp-plugin') ?>")%>" value="<%=booking.driver_name%>"
					maxlength="40" <% if (!booking.can_edit_online){%>disabled<%}%>>
			</div>
			<div class="mb-form-group mb-col-md-6">
				<label>
					<?php echo esc_html_x('Surname', 'renting_my_reservation', 'mybooking-wp-plugin') ?>
				</label>
				<input class="form-control" name="driver_surname" type="text"
					placeholder="<%=configuration.escapeHtml("<?php  echo esc_attr_x("Surname", 'renting_my_reservation', 'mybooking-wp-plugin') ?>")%>" value="<%=booking.driver_surname%>"
					maxlength="40" <% if (!booking.can_edit_online ){%>disabled<%}%>>
			</div>
		</div>
		<div class="mb-form-row">
			<div class="mb-form-group mb-col-md-6 js-date-select-control">
				<label>
					<?php echo esc_html_x('Date of birth', 'renting_my_reservation', 'mybooking-wp-plugin') ?>
				</label>
				<div class="mb-form-row mb-custom-date-form">
					<div class="mb-custom-date-item">
						<select name="driver_date_of_birth_day"
							class="form-control" <% if (!booking.can_edit_online){%>disabled<%}%>></select>
					</div>
					<div class="mb-custom-date-item">
						<select name="driver_date_of_birth_month"
							class="form-control" <% if (!booking.can_edit_online){%>disabled<%}%>></select>
					</div>
					<div class="mb-custom-date-item">
						<select name="driver_date_of_birth_year"
							class="form-control" <% if (!booking.can_edit_online){%>disabled<%}%>></select>
					</div>
				</div>
				<input type="hidden" name="driver_date_of_birth"></input>
			</div>
			<div class="mb-form-group mb-col-md-6">
				<label>
					<?php echo esc_html_x( 'Nacionality', 'renting_my_reservation', 'mybooking-wp-plugin') ?>
				</label>
				<select name="driver_nacionality" class="form-control" <% if (!booking.can_edit_online){%>disabled<%}%>></select>
			</div>
		</div>
		<h6>
			<?php echo esc_attr_x( 'ID card or passport', 'renting_my_reservation', 'mybooking-wp-plugin') ?>
		</h6>
		<hr />
		<div class="mb-form-row">
			<div class="mb-form-group mb-col-md-4" >
				<label>
					<?php echo esc_html_x( 'Document type', 'renting_my_reservation', 'mybooking-wp-plugin') ?>
				</label>
				<select name="driver_document_id_type_id" class="form-control" <% if (!booking.can_edit_online){%>disabled<%}%>></select>
			</div>
			<div class="mb-form-group mb-col-md-4" >
				<label>
					<?php echo esc_html_x('ID card or passport', 'renting_my_reservation', 'mybooking-wp-plugin') ?>
				</label>
				<input class="form-control" name="driver_document_id" type="text"
					placeholder="<%=configuration.escapeHtml("<?php echo esc_attr_x("ID card or passport", 'renting_my_reservation', 'mybooking-wp-plugin') ?>")%>" value="<%=booking.driver_document_id%>"
					maxlength="50" <% if (!booking.can_edit_online){%>disabled<%}%>>
			</div>
			<div class="mb-form-group mb-col-md-4">
				<label>
					<?php echo esc_html_x( 'Driving license expedition country', 'renting_my_reservation', 'mybooking-wp-plugin') ?>
				</label>
				<select name="driver_origin_country" class="form-control" <% if (!booking.can_edit_online){%>disabled<%}%>></select>
			</div>
		</div>
		<div class="mb-form-row">
			<div class="mb-form-group mb-col-md-6 js-date-select-control">
				<label>
					<?php echo esc_html_x('Date of Issue', 'renting_my_reservation', 'mybooking-wp-plugin') ?>
				</label>
				<div class="mb-form-row mb-custom-date-form">
					<div class="mb-custom-date-item">
						<select name="driver_document_id_date_day"
							class="form-control" <% if (!booking.can_edit_online){%>disabled<%}%>></select>
					</div>
					<div class="mb-custom-date-item">
						<select name="driver_document_id_date_month"
							class="form-control" <% if (!booking.can_edit_online){%>disabled<%}%>></select>
					</div>
					<div class="mb-custom-date-item">
						<select name="driver_document_id_date_year"
							class="form-control" <% if (!booking.can_edit_online){%>disabled<%}%>></select>
					</div>
				</div>
				<input type="hidden" name="driver_document_id_date"></input>
			</div>
			<div class="mb-form-group mb-col-md-6 js-date-select-control" data-date-select-control-direction="future">
				<label>
					<?php echo esc_html_x('Date of expiry', 'renting_my_reservation', 'mybooking-wp-plugin') ?>
				</label>
				<div class="mb-form-row mb-custom-date-form">
					<div class="mb-custom-date-item">
						<select name="driver_document_id_expiration_date_day"
							class="form-control" <% if (!booking.can_edit_online){%>disabled<%}%>></select>
					</div>
					<div class="mb-custom-date-item">
						<select name="driver_document_id_expiration_date_month"
							class="form-control" <% if (!booking.can_edit_online){%>disabled<%}%>></select>
					</div>
					<div class="mb-custom-date-item">
						<select name="driver_document_id_expiration_date_year"
							class="form-control" <% if (!booking.can_edit_online){%>disabled<%}%>></select>
					</div>
				</div>
				<input type="hidden" name="driver_document_id_expiration_date"></input>
			</div>
		</div>
		<h6>
			<%=configuration.escapeHtml("<?php echo esc_attr_x('License', 'renting_my_reservation', 'mybooking-wp-plugin') ?>")%>
		</h6>
		<hr />
		<div class="mb-form-row">
			<div class="mb-form-group mb-col-md-4">
				<label>
					<?php echo esc_html_x( 'License type', 'renting_my_reservation', 'mybooking-wp-plugin') ?>
				</label>
				<select name="driver_driving_license_type_id" class="form-control" <% if (!booking.can_edit_online){%>disabled<%}%>></select>
			</div>
			<div class="mb-form-group mb-col-md-4">
				<label>
					<?php echo esc_html_x('Driving license number', 'renting_my_reservation', 'mybooking-wp-plugin') ?>
				</label>
				<input class="form-control" name="driver_driving_license_number"
					type="text" placeholder="<%=configuration.escapeHtml("<?php echo esc_attr_x('Driving license number', 'renting_my_reservation', 'mybooking-wp-plugin') ?>")%>"
					value="<%=booking.driver_driving_license_number%>"
					maxlength="50" <% if (!booking.can_edit_online){%>disabled<%}%>>
			</div>
			<div class="mb-form-group mb-col-md-4">
				<label>
					<?php echo esc_html_x('Driving license expedition country', 'renting_my_reservation', 'mybooking-wp-plugin') ?>
				</label>
				<select name="driver_driving_license_country" class="form-control"
					<% if (!booking.can_edit_online){%>disabled<%}%>>
				</select>
			</div>                
		</div>
		<div class="mb-form-row">
			<div class="mb-form-group mb-col-md-6 js-date-select-control">
				<label>
					<?php echo esc_html_x('Date of Issue', 'renting_my_reservation', 'mybooking-wp-plugin') ?>
				</label>
				<div class="mb-form-row mb-custom-date-form">
					<div class="mb-custom-date-item">
						<select name="driver_driving_license_date_day"
							class="form-control" <% if (!booking.can_edit_online){%>disabled<%}%>></select>
					</div>
					<div class="mb-custom-date-item">
						<select name="driver_driving_license_date_month"
							class="form-control" <% if (!booking.can_edit_online){%>disabled<%}%>></select>
					</div>
					<div class="mb-custom-date-item">
						<select name="driver_driving_license_date_year"
							class="form-control" <% if (!booking.can_edit_online){%>disabled<%}%>></select>
					</div>
				</div>
				<input type="hidden" name="driver_driving_license_date"></input>
			</div>
			<div class="mb-form-group mb-col-md-6 js-date-select-control" data-date-select-control-direction="future">
				<label>
					<?php echo esc_html_x('Date of expiry', 'renting_my_reservation', 'mybooking-wp-plugin') ?>
				</label>
				<div class="mb-form-row mb-custom-date-form">
					<div class="mb-custom-date-item">
						<select name="driver_driving_license_expiration_date_day"
							class="form-control" <% if (!booking.can_edit_online){%>disabled<%}%>></select>
					</div>
					<div class="mb-custom-date-item">
						<select name="driver_driving_license_expiration_date_month"
							class="form-control" <% if (!booking.can_edit_online){%>disabled<%}%>></select>
					</div>
					<div class="mb-custom-date-item">
						<select name="driver_driving_license_expiration_date_year"
							class="form-control" <% if (!booking.can_edit_online){%>disabled<%}%>></select>
					</div>
				</div>
				<input type="hidden" name="driver_driving_license_expiration_date"></input>
			</div>
		</div>

		<!-- // Driver Address -->
		<h6>
			<?php echo esc_html_x( 'Address', 'renting_my_reservation', 'mybooking-wp-plugin') ?>
		</h6>
		<hr />
		<% if (configuration.rentingFormFillDataAddress) { %>
			<div class="mb-form-row">
				<div class="mb-form-group mb-col-md-6">
					<label>
						<?php echo esc_html_x( 'Street', 'renting_my_reservation', 'mybooking-wp-plugin') ?>
					</label>
					<input class="form-control" name="driver_address[street]" type="text"
						placeholder="<%=configuration.escapeHtml("<?php echo esc_attr_x( 'Street', 'renting_my_reservation', 'mybooking-wp-plugin') ?>")%>" value="<%=booking.driver_address_street%>" maxlength="60" <% if (!booking.can_edit_online){%>disabled<%}%>>
				</div>
				<div class="mb-form-group mb-col-md-3">
					<label>
						<?php echo esc_html_x( 'Number', 'renting_my_reservation', 'mybooking-wp-plugin') ?>
					</label>
					<input class="form-control" name="driver_address[number]" type="text"
						placeholder="<%=configuration.escapeHtml("<?php echo esc_attr_x( 'Number', 'renting_my_reservation', 'mybooking-wp-plugin') ?>")%>" value="<%=booking.driver_address_number%>" maxlength="10" <% if (!booking.can_edit_online){%>disabled<%}%>>
				</div>
				<div class="mb-form-group mb-col-md-3">
					<label>
						<?php echo esc_html_x( 'Complement', 'renting_my_reservation', 'mybooking-wp-plugin') ?>
					</label>
					<input class="form-control" name="driver_address[complement]" type="text"
						placeholder="<%=configuration.escapeHtml("<?php echo esc_attr_x( 'Complement', 'renting_my_reservation', 'mybooking-wp-plugin') ?>")%>" value="<%=booking.driver_address_complement%>"  maxlength="20" <% if (!booking.can_edit_online){%>disabled<%}%>>
				</div>
			</div>
			<div class="mb-form-row">
				<div class="mb-form-group mb-col-md-6">
					<label>
						<?php echo esc_html_x( 'City', 'renting_my_reservation', 'mybooking-wp-plugin') ?>
					</label>
					<input class="form-control" name="driver_address[city]" type="text"
						placeholder="<%=configuration.escapeHtml("<?php echo esc_attr_x( 'City', 'renting_my_reservation', 'mybooking-wp-plugin') ?>")%>" value="<%=booking.driver_address_city%>" maxlength="60" <% if (!booking.can_edit_online){%>disabled<%}%>>
				</div>
				<div class="mb-form-group mb-col-md-6">
					<label for=driver_address_state"><?php echo esc_html_x( 'State', 'renting_my_reservation', 'mybooking-wp-plugin') ?></label>
					<input class="form-control" name="driver_address[state]" type="text"
						placeholder="<%=configuration.escapeHtml("<?php echo esc_attr_x( 'State', 'renting_my_reservation', 'mybooking-wp-plugin') ?>")%>" value="<%=booking.driver_address_state%>"  maxlength="60" <% if (!booking.can_edit_online){%>disabled<%}%>>
				</div>
			</div>
			<div class="mb-form-row">
				<div class="mb-form-group mb-col-md-6">
					<label>
						<?php echo esc_html_x( 'Country', 'renting_my_reservation', 'mybooking-wp-plugin') ?>
					</label>
					<select name="driver_address[country]" class="form-control" <% if (!booking.can_edit_online){%>disabled<%}%>>
					</select>
				</div>
				<div class="mb-form-group mb-col-md-6">
					<label>
						<?php echo esc_html_x( 'Postal Code', 'renting_my_reservation', 'mybooking-wp-plugin') ?>
					</label>
					<input class="form-control" name="driver_address[zip]" type="text"
						placeholder="<%=configuration.escapeHtml("<?php echo esc_attr_x( 'Postal Code', 'renting_my_reservation', 'mybooking-wp-plugin') ?>")%>" value="<%=booking.driver_address_zip%>"  maxlength="10" <% if (!booking.can_edit_online){%>disabled<%}%>>
				</div>
			</div>
		<% } %>
	</div>
<% } %>

<% if (configuration.rentingFormFillDataAdditionalDriver1 || configuration.rentingFormFillDataAdditionalDriver2) { %>
	<div class="mb-section mb-panel-container" <% if (booking.driver_is_customer) { %>style="display: none;"<% } %>>
		<div id="additional_drivers_toogle_btn" class="mb-form-row mb--flex-align_center"  data-panel="additional_drivers_panel" style="margin-bottom: -1rem; cursor: pointer;">
			<div class="mb-col-sm-6">
				<?php echo esc_html_x('There are additional drivers', 'renting_my_reservation', 'mybooking-wp-plugin') ?>
			</div>
			<div class="mb-col-sm-6 mb--txt-align_right">
				<span class="dashicons dashicons-arrow-down-alt2" style="margin-top: 3px;"></span>
			</div>
		</div>

		<div id="additional_drivers_panel" style="display: none;">
			<br />
			<!-- // Additional drivers information -->
			<h3 class="mb-form_title">
				<?php echo esc_html_x('Additional drivers', 'renting_my_reservation', 'mybooking-wp-plugin') ?>
			</h3>
			<!-- // Additional drivers panel -->
			<div class="mb-form-row">
				<div class="mb-form-group mb-col-md-6">
					<label>
						<?php echo esc_html_x('Name', 'renting_my_reservation', 'mybooking-wp-plugin') ?>
					</label>
					<input class="form-control" name="additional_driver_1_name" type="text"
						placeholder="<%=configuration.escapeHtml("<?php echo esc_attr_x("Name", 'renting_my_reservation', 'mybooking-wp-plugin') ?>")%>"
						value="<%=booking.additional_driver_1_name%>"
						maxlength="40" <% if (!booking.can_edit_online){%>disabled<%}%>>
				</div>
				<div class="mb-form-group mb-col-md-6">
					<label>
						<?php echo esc_html_x('Surname', 'renting_my_reservation', 'mybooking-wp-plugin') ?>
					</label>
					<input class="form-control" name="additional_driver_1_surname" type="text"
						placeholder="<%=configuration.escapeHtml("<?php echo esc_attr_x('Surname', 'renting_my_reservation', 'mybooking-wp-plugin') ?>")%>"
						value="<%=booking.additional_driver_1_surname%>"
						maxlength="40" <% if (!booking.can_edit_online){%>disabled<%}%>>
				</div>
			</div>
			<div class="mb-form-row">
				<div class="mb-form-group mb-col-md-6">
					<label>
						<?php echo esc_html_x( 'Nacionality', 'renting_my_reservation', 'mybooking-wp-plugin') ?>
					</label>
					<select name="additional_driver_1_nacionality" class="form-control" <% if (!booking.can_edit_online){%>disabled<%}%>></select>
				</div>
				<div class="mb-form-group mb-col-md-6 js-date-select-control">
					<label>
						<?php echo esc_html_x('Date of birth', 'renting_my_reservation', 'mybooking-wp-plugin') ?>
					</label>
					<div class="mb-form-row mb-custom-date-form">
						<div class="mb-custom-date-item">
							<select name="additional_driver_1_date_of_birth_day"
								class="form-control" <% if (!booking.can_edit_online){%>disabled<%}%>></select>
						</div>
						<div class="mb-custom-date-item">
							<select name="additional_driver_1_date_of_birth_month"
								class="form-control" <% if (!booking.can_edit_online){%>disabled<%}%>></select>
						</div>
						<div class="mb-custom-date-item">
							<select name="additional_driver_1_date_of_birth_year"
								class="form-control" <% if (!booking.can_edit_online){%>disabled<%}%>></select>
						</div>
					</div>
					<input type="hidden" name="additional_driver_1_date_of_birth"></input>
				</div>
			</div>
			<h6>
				<?php echo esc_attr_x( 'ID card or passport', 'renting_my_reservation', 'mybooking-wp-plugin') ?>
			</h6>
			<hr />
			<div class="mb-form-row">
				<div class="mb-form-group mb-col-md-4">
					<label>
						<?php echo esc_html_x( 'Document type', 'renting_my_reservation', 'mybooking-wp-plugin') ?>
					</label>
					<select name="additional_driver_1_document_id_type_id" class="form-control" <% if (!booking.can_edit_online){%>disabled<%}%>></select>
				</div>
				<div class="mb-form-group mb-col-md-4">
					<label>
						<?php echo esc_html_x('Document ID', 'renting_my_reservation', 'mybooking-wp-plugin') ?>
					</label>
					<input class="form-control" name="additional_driver_1_document_id"
						type="text" placeholder="<%=configuration.escapeHtml("<?php echo esc_attr_x('Document ID', 'renting_my_reservation', 'mybooking-wp-plugin') ?>")%>"
						value="<%=booking.additional_driver_1_document_id%>"
						maxlength="50" <% if (!booking.can_edit_online){%>disabled<%}%>>
				</div>
				<div class="mb-form-group mb-col-md-4">
					<label>
						<?php echo esc_html_x('Expedition country', 'renting_my_reservation', 'mybooking-wp-plugin') ?>
					</label>
					<select name="additional_driver_1_origin_country"
							class="form-control" <% if (!booking.can_edit_online){%>disabled<%}%>>
					</select>
				</div>
			</div>
			<div class="mb-form-row">
				<div class="mb-form-group mb-col-md-6 js-date-select-control">
					<label>
						<?php echo esc_html_x('Date of Issue', 'renting_my_reservation', 'mybooking-wp-plugin') ?>
					</label>
					<div class="mb-form-row mb-custom-date-form">
						<div class="mb-custom-date-item">
							<select name="additional_driver_1_document_id_date_day"
								class="form-control" <% if (!booking.can_edit_online){%>disabled<%}%>></select>
						</div>
						<div class="mb-custom-date-item">
							<select name="additional_driver_1_document_id_date_month"
								class="form-control" <% if (!booking.can_edit_online){%>disabled<%}%>></select>
						</div>
						<div class="mb-custom-date-item">
							<select name="additional_driver_1_document_id_date_year"
								class="form-control" <% if (!booking.can_edit_online){%>disabled<%}%>></select>
						</div>
					</div>
					<input type="hidden" name="additional_driver_1_document_id_date"></input>
				</div>
				<div class="mb-form-group mb-col-md-6 js-date-select-control" data-date-select-control-direction="future">
					<label>
						<?php echo esc_html_x('Date of expiry', 'renting_my_reservation', 'mybooking-wp-plugin') ?>
					</label>
					<div class="mb-form-row mb-custom-date-form">
						<div class="mb-custom-date-item">
							<select name="additional_driver_1_document_id_expiration_date_day"
								class="form-control" <% if (!booking.can_edit_online){%>disabled<%}%>></select>
						</div>
						<div class="mb-custom-date-item">
							<select name="additional_driver_1_document_id_expiration_date_month"
								class="form-control" <% if (!booking.can_edit_online){%>disabled<%}%>></select>
						</div>
						<div class="mb-custom-date-item">
							<select name="additional_driver_1_document_id_expiration_date_year"
								class="form-control" <% if (!booking.can_edit_online){%>disabled<%}%>></select>
						</div>
					</div>
					<input type="hidden" name="additional_driver_1_document_id_expiration_date"></input>
				</div>
			</div>
			<h6>
				<%=configuration.escapeHtml("<?php echo esc_attr_x('License', 'renting_my_reservation', 'mybooking-wp-plugin') ?>")%>
			</h6>
			<hr />
			<div class="mb-form-row">
				<div class="mb-form-group mb-col-md-4">
					<label>
						<?php echo esc_html_x( 'License type', 'renting_my_reservation', 'mybooking-wp-plugin') ?>
					</label>
					<select name="additional_driver_1_driving_license_type_id" class="form-control" <% if (!booking.can_edit_online){%>disabled<%}%>></select>
				</div>
				<div class="mb-form-group mb-col-md-4">
					<label>
						<?php echo esc_html_x('Driving license number', 'renting_my_reservation', 'mybooking-wp-plugin') ?>
					</label>
					<input class="form-control" name="additional_driver_1_driving_license_number"
						type="text" placeholder="<%=configuration.escapeHtml("<?php echo esc_attr_x('Driving license number', 'renting_my_reservation', 'mybooking-wp-plugin') ?>")%>"
						value="<%=booking.additional_driver_1_driving_license_number%>"
						maxlength="50" <% if (!booking.can_edit_online){%>disabled<%}%>>
				</div>
				<div class="mb-form-group mb-col-md-4">
					<label>
						<?php echo esc_html_x('Driving license expedition country', 'renting_my_reservation', 'mybooking-wp-plugin') ?>
					</label>
					<select name="additional_driver_1_driving_license_country" 
							class="form-control" <% if (!booking.can_edit_online){%>disabled<%}%>>
					</select>
				</div>
			</div>
			<div class="mb-form-row">
				<div class="mb-form-group mb-col-md-6 js-date-select-control">
					<label>
						<?php echo esc_html_x('Date of Issue', 'renting_my_reservation', 'mybooking-wp-plugin') ?>
					</label>
					<div class="mb-form-row mb-custom-date-form">
						<div class="mb-custom-date-item">
							<select name="additional_driver_1_driving_license_date_day"
								class="form-control" <% if (!booking.can_edit_online){%>disabled<%}%>></select>
						</div>
						<div class="mb-custom-date-item">
							<select name="additional_driver_1_driving_license_date_month"
								class="form-control" <% if (!booking.can_edit_online){%>disabled<%}%>></select>
						</div>
						<div class="mb-custom-date-item">
							<select name="additional_driver_1_driving_license_date_year"
								class="form-control" <% if (!booking.can_edit_online){%>disabled<%}%>></select>
						</div>
					</div>
					<input type="hidden" name="additional_driver_1_driving_license_date"></input>
				</div>
				<div class="mb-form-group mb-col-md-6 js-date-select-control" data-date-select-control-direction="future">
					<label>
						<?php echo esc_html_x('Date of expiry', 'renting_my_reservation', 'mybooking-wp-plugin') ?>
					</label>
					<div class="mb-form-row mb-custom-date-form">
						<div class="mb-custom-date-item">
							<select name="additional_driver_1_driving_license_expiration_date_day"
								class="form-control" <% if (!booking.can_edit_online){%>disabled<%}%>></select>
						</div>
						<div class="mb-custom-date-item">
							<select name="additional_driver_1_driving_license_expiration_date_month"
								class="form-control" <% if (!booking.can_edit_online){%>disabled<%}%>></select>
						</div>
						<div class="mb-custom-date-item">
							<select name="additional_driver_1_driving_license_expiration_date_year"
								class="form-control" <% if (!booking.can_edit_online){%>disabled<%}%>></select>
						</div>
					</div>
					<input type="hidden" name="additional_driver_1_driving_license_expiration_date"></input>
				</div>
			</div>
			<hr />
			<% if (configuration.rentingFormFillDataAdditionalDriver2) { %>
				<div class="mb-form-row">
					<div class="mb-form-group mb-col-md-6">
						<label>
							<?php echo esc_html_x('Name', 'renting_my_reservation', 'mybooking-wp-plugin') ?>
						</label>
						<input class="form-control" name="additional_driver_2_name" type="text"
							placeholder="<%=configuration.escapeHtml("<?php echo esc_attr_x('Name', 'renting_my_reservation', 'mybooking-wp-plugin') ?>")%>"
							value="<%=booking.additional_driver_2_name%>"
							maxlength="40" <% if (!booking.can_edit_online){%>disabled<%}%>>
					</div>
					<div class="mb-form-group mb-col-md-6">
						<label>
							<?php echo esc_html_x('Surname', 'renting_my_reservation', 'mybooking-wp-plugin') ?>
						</label>
						<input class="form-control" name="additional_driver_2_surname" type="text"
							placeholder="<%=configuration.escapeHtml("<?php echo esc_attr_x('Surname', 'renting_my_reservation', 'mybooking-wp-plugin') ?>")%>"
							value="<%=booking.additional_driver_2_surname%>"
							maxlength="40" <% if (!booking.can_edit_online){%>disabled<%}%>>
					</div>
				</div>
				<div class="mb-form-row">
					<div class="mb-form-group mb-col-md-6">
						<label>
							<?php echo esc_html_x( 'Nacionality', 'renting_my_reservation', 'mybooking-wp-plugin') ?>
						</label>
						<select name="additional_driver_2_nacionality" class="form-control" <% if (!booking.can_edit_online){%>disabled<%}%>></select>
					</div>
					<div class="mb-form-group mb-col-md-6 js-date-select-control">
						<label>
							<?php echo esc_html_x('Date of birth', 'renting_my_reservation', 'mybooking-wp-plugin') ?>
						</label>
						<div class="mb-form-row mb-custom-date-form">
							<div class="mb-custom-date-item">
								<select name="additional_driver_2_date_of_birth_day"
									class="form-control" <% if (!booking.can_edit_online){%>disabled<%}%>></select>
							</div>
							<div class="mb-custom-date-item">
								<select name="additional_driver_2_date_of_birth_month"
									class="form-control" <% if (!booking.can_edit_online){%>disabled<%}%>></select>
							</div>
							<div class="mb-custom-date-item">
								<select name="additional_driver_2_date_of_birth_year"
									class="form-control" <% if (!booking.can_edit_online){%>disabled<%}%>></select>
							</div>
						</div>
						<input type="hidden" name="additional_driver_2_date_of_birth"></input>
					</div>
				</div>
				<h6>
					<?php echo esc_attr_x( 'ID card or passport', 'renting_my_reservation', 'mybooking-wp-plugin') ?>
				</h6>
				<hr />
				<div class="mb-form-row">
					<div class="mb-form-group mb-col-md-4">
						<label>
							<?php echo esc_html_x( 'Document type', 'renting_my_reservation', 'mybooking-wp-plugin') ?>
						</label>
						<select name="additional_driver_2_document_id_type_id" class="form-control" <% if (!booking.can_edit_online){%>disabled<%}%>></select>
					</div>
					<div class="mb-form-group mb-col-md-4">
						<label>
							<?php echo esc_html_x('Document ID', 'renting_my_reservation', 'mybooking-wp-plugin') ?>
						</label>
						<input class="form-control" name="additional_driver_2_document_id"
							type="text" placeholder="<%=configuration.escapeHtml("<?php echo esc_attr_x('Document ID', 'renting_my_reservation', 'mybooking-wp-plugin') ?>")%>"
							value="<%=booking.additional_driver_2_document_id%>"
							maxlength="50" <% if (!booking.can_edit_online){%>disabled<%}%>>
					</div>
					<div class="mb-form-group mb-col-md-4">
						<label>
							<?php echo esc_html_x('Expedition country', 'renting_my_reservation', 'mybooking-wp-plugin') ?>
						</label>
						<select name="additional_driver_2_origin_country" 
								class="form-control" <% if (!booking.can_edit_online){%>disabled<%}%>>
						</select>
					</div>
				</div>
				<div class="mb-form-row">
					<div class="mb-form-group mb-col-md-6 js-date-select-control">
						<label>
							<?php echo esc_html_x('Date of Issue', 'renting_my_reservation', 'mybooking-wp-plugin') ?>
						</label>
						<div class="mb-form-row mb-custom-date-form">
							<div class="mb-custom-date-item">
								<select name="additional_driver_2_document_id_date_day"
									class="form-control" <% if (!booking.can_edit_online){%>disabled<%}%>></select>
							</div>
							<div class="mb-custom-date-item">
								<select name="additional_driver_2_document_id_date_month"
									class="form-control" <% if (!booking.can_edit_online){%>disabled<%}%>></select>
							</div>
							<div class="mb-custom-date-item">
								<select name="additional_driver_2_document_id_date_year"
									class="form-control" <% if (!booking.can_edit_online){%>disabled<%}%>></select>
							</div>
						</div>
						<input type="hidden" name="additional_driver_2_document_id_date"></input>
					</div>
					<div class="mb-form-group mb-col-md-6 js-date-select-control" data-date-select-control-direction="future">
						<label>
							<?php echo esc_html_x('Date of expiry', 'renting_my_reservation', 'mybooking-wp-plugin') ?>
						</label>
						<div class="mb-form-row mb-custom-date-form">
							<div class="mb-custom-date-item">
								<select name="additional_driver_2_document_id_expiration_date_day"
									class="form-control" <% if (!booking.can_edit_online){%>disabled<%}%>></select>
							</div>
							<div class="mb-custom-date-item">
								<select name="additional_driver_2_document_id_expiration_date_month"
									class="form-control" <% if (!booking.can_edit_online){%>disabled<%}%>></select>
							</div>
							<div class="mb-custom-date-item">
								<select name="additional_driver_2_document_id_expiration_date_year"
									class="form-control" <% if (!booking.can_edit_online){%>disabled<%}%>></select>
							</div>
						</div>
						<input type="hidden" name="additional_driver_2_document_id_expiration_date"></input>
					</div>
				</div>
				<h6>
					<%=configuration.escapeHtml("<?php echo esc_attr_x('License', 'renting_my_reservation', 'mybooking-wp-plugin') ?>")%>
				</h6>
				<hr />
				<div class="mb-form-row">
					<div class="mb-form-group mb-col-md-4">
						<label>
							<?php echo esc_html_x( 'License type', 'renting_my_reservation', 'mybooking-wp-plugin') ?>
						</label>
						<select name="additional_driver_2_driving_license_type_id" class="form-control" <% if (!booking.can_edit_online){%>disabled<%}%>></select>
					</div>
					<div class="mb-form-group mb-col-md-4">
						<label>
							<?php echo esc_html_x('Driving license number', 'renting_my_reservation', 'mybooking-wp-plugin') ?>
						</label>
						<input class="form-control" name="additional_driver_2_driving_license_number"
							type="text" placeholder="<%=configuration.escapeHtml("<?php echo esc_attr_x('Driving license number', 'renting_my_reservation', 'mybooking-wp-plugin') ?>")%>"
							value="<%=booking.additional_driver_2_driving_license_number%>"
							maxlength="50" <% if (!booking.can_edit_online){%>disabled<%}%>>
					</div>
					<div class="mb-form-group mb-col-md-4">
						<label>
							<?php echo esc_html_x('Driving license expedition country', 'renting_my_reservation', 'mybooking-wp-plugin') ?>
						</label>
						<select name="additional_driver_2_driving_license_country" 
								class="form-control" <% if (!booking.can_edit_online){%>disabled<%}%>>
						</select>
					</div>                    
				</div>
				<div class="mb-form-row">
					<div class="mb-form-group mb-col-md-6 js-date-select-control">
						<label>
							<?php echo esc_html_x('Date of Issue', 'renting_my_reservation', 'mybooking-wp-plugin') ?>
						</label>
						<div class="mb-form-row mb-custom-date-form">
							<div class="mb-custom-date-item">
								<select name="additional_driver_2_driving_license_date_day"
									class="form-control" <% if (!booking.can_edit_online){%>disabled<%}%>></select>
							</div>
							<div class="mb-custom-date-item">
								<select name="additional_driver_2_driving_license_date_month"
									class="form-control" <% if (!booking.can_edit_online){%>disabled<%}%>></select>
							</div>
							<div class="mb-custom-date-item">
								<select name="additional_driver_2_driving_license_date_year"
									class="form-control" <% if (!booking.can_edit_online){%>disabled<%}%>></select>
							</div>
						</div>
						<input type="hidden" name="additional_driver_2_driving_license_date"></input>
					</div>
					<div class="mb-form-group mb-col-md-6 js-date-select-control" data-date-select-control-direction="future">
						<label>
							<?php echo esc_html_x('Date of expiry', 'renting_my_reservation', 'mybooking-wp-plugin') ?>
						</label>
						<div class="mb-form-row mb-custom-date-form">
							<div class="mb-custom-date-item">
								<select name="additional_driver_2_driving_license_expiration_date_day"
									class="form-control" <% if (!booking.can_edit_online){%>disabled<%}%>></select>
							</div>
							<div class="mb-custom-date-item">
								<select name="additional_driver_2_driving_license_expiration_date_month"
									class="form-control" <% if (!booking.can_edit_online){%>disabled<%}%>></select>
							</div>
							<div class="mb-custom-date-item">
								<select name="additional_driver_2_driving_license_expiration_date_year"
									class="form-control" <% if (!booking.can_edit_online){%>disabled<%}%>></select>
							</div>
						</div>
						<input type="hidden" name="additional_driver_2_driving_license_expiration_date"></input>
					</div>
				</div>
			<% } %>
		</div>
	</div>
<% } %>