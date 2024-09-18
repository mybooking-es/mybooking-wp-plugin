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
 *   @phpcs:disable PHPCompatibility.Miscellaneous.RemovedAlternativePHPTags.MaybeASPOpenTagFound
 *   @phpcs:disable Generic.PHP.DisallowAlternativePHPTags.MaybeASPOpenTagFound
 *   @phpcs:disable Generic.PHP.DisallowAlternativePHPTags.MaybeASPShortOpenTagFound
 */
?>
<% if (configuration.rentingFormFillDataDriverDetail && !booking.has_optional_external_driver) { %>
	<div id="driver_panel" class="mb-section mb-panel-container">
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
					<% if (required_fields.includes('driver_name')) { %>*<% } %>
				</label>
				<input class="form-control" name="driver_name" type="text"
					placeholder="<%=configuration.escapeHtml("<?php echo esc_attr_x("Name", 'renting_my_reservation', 'mybooking-wp-plugin') ?>")%>" value="<%=booking.driver_name%>"
					maxlength="40" <% if (!booking.can_edit_online){%>disabled<%}%> <% if (required_fields.includes('driver_name')) { %>required<% } %>>
			</div>
			<div class="mb-form-group mb-col-md-6">
				<label>
					<?php echo esc_html_x('Surname', 'renting_my_reservation', 'mybooking-wp-plugin') ?>
					<% if (required_fields.includes('driver_surname')) { %>*<% } %>
				</label>
				<input class="form-control" name="driver_surname" type="text"
					placeholder="<%=configuration.escapeHtml("<?php  echo esc_attr_x("Surname", 'renting_my_reservation', 'mybooking-wp-plugin') ?>")%>" value="<%=booking.driver_surname%>"
					maxlength="40" <% if (!booking.can_edit_online ){%>disabled<%}%> <% if (required_fields.includes('driver_surname')) { %>required<% } %>>
			</div>
		</div>
		<div class="mb-form-row">
			<div class="mb-form-group mb-col-md-6 js-date-select-control">
				<label>
					<?php echo esc_html_x('Date of birth', 'renting_my_reservation', 'mybooking-wp-plugin') ?>
					<% if (required_fields.includes('driver_date_of_birth')) { %>*<% } %>
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
				<input type="hidden" name="driver_date_of_birth" <% if (required_fields.includes('driver_date_of_birth')) { %>required<% } %>>
			</div>
			<div class="mb-form-group mb-col-md-6">
				<label>
					<?php echo esc_html_x( 'Nacionality', 'renting_my_reservation', 'mybooking-wp-plugin') ?>
					<% if (required_fields.includes('driver_nacionality')) { %>*<% } %>
				</label>
				<select name="driver_nacionality" class="form-control" <% if (!booking.can_edit_online){%>disabled<%}%> <% if (required_fields.includes('driver_nacionality')) { %>required<% } %>></select>
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

		<h6>
			<?php echo esc_attr_x( 'ID card or passport', 'renting_my_reservation', 'mybooking-wp-plugin') ?>
		</h6>
		<hr />
		<div class="mb-form-row">
			<div class="mb-form-group mb-col-md-4" >
				<label>
					<?php echo esc_html_x( 'Document type', 'renting_my_reservation', 'mybooking-wp-plugin') ?>
					<% if (required_fields.includes('driver_document_id_type_id')) { %>*<% } %>
				</label>
				<select name="driver_document_id_type_id" class="form-control" <% if (!booking.can_edit_online){%>disabled<%}%> <% if (required_fields.includes('driver_document_id_type_id')) { %>required<% } %>></select>
			</div>
			<div class="mb-form-group mb-col-md-4" >
				<label>
					<?php echo esc_html_x('ID card/passport number', 'renting_my_reservation', 'mybooking-wp-plugin') ?>
					<% if (required_fields.includes('driver_document_id')) { %>*<% } %>
				</label>
				<input class="form-control" name="driver_document_id" id="driver_document_id" type="text"
					placeholder="<%=configuration.escapeHtml("<?php echo esc_attr_x("ID card/passport number", 'renting_my_reservation', 'mybooking-wp-plugin') ?>")%>" value="<%=booking.driver_document_id%>"
					maxlength="50" <% if (!booking.can_edit_online){%>disabled<%}%> <% if (required_fields.includes('driver_document_id')) { %>required<% } %>>
			</div>
			<div class="mb-form-group mb-col-md-4">
				<label>
					<?php echo esc_html_x( 'Expedition country', 'renting_my_reservation', 'mybooking-wp-plugin') ?>
					<% if (required_fields.includes('driver_origin_country')) { %>*<% } %>
				</label>
				<select name="driver_origin_country" class="form-control" <% if (!booking.can_edit_online){%>disabled<%}%> <% if (required_fields.includes('driver_origin_country')) { %>required<% } %>></select>
			</div>
		</div>
		<div class="mb-form-row">
			<div class="mb-form-group mb-col-md-6 js-date-select-control">
				<label>
					<?php echo esc_html_x('Date of Issue', 'renting_my_reservation', 'mybooking-wp-plugin') ?>
					<% if (required_fields.includes('driver_document_id_date')) { %>*<% } %>
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
				<input type="hidden" name="driver_document_id_date" <% if (required_fields.includes('driver_document_id_date')) { %>required<% } %>>
			</div>
			<div class="mb-form-group mb-col-md-6 js-date-select-control" data-date-select-control-direction="future">
				<label>
					<?php echo esc_html_x('Date of expiry', 'renting_my_reservation', 'mybooking-wp-plugin') ?>
					<% if (required_fields.includes('driver_document_id_expiration_date')) { %>*<% } %>
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
				<input type="hidden" name="driver_document_id_expiration_date" <% if (required_fields.includes('driver_document_id_expiration_date')) { %>required<% } %>>
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
					<% if (required_fields.includes('driver_driving_license_type_id')) { %>*<% } %>
				</label>
				<select name="driver_driving_license_type_id" class="form-control" <% if (!booking.can_edit_online){%>disabled<%}%> <% if (required_fields.includes('driver_driving_license_type_id')) { %>required<% } %>></select>
			</div>
			<div class="mb-form-group mb-col-md-4">
				<label>
					<?php echo esc_html_x('Driving license number', 'renting_my_reservation', 'mybooking-wp-plugin') ?>
					<% if (required_fields.includes('driver_driving_license_number')) { %>*<% } %>
				</label>
				<input class="form-control" name="driver_driving_license_number"
					type="text" placeholder="<%=configuration.escapeHtml("<?php echo esc_attr_x('Driving license number', 'renting_my_reservation', 'mybooking-wp-plugin') ?>")%>"
					value="<%=booking.driver_driving_license_number%>"
					maxlength="50" <% if (!booking.can_edit_online){%>disabled<%}%> <% if (required_fields.includes('driver_driving_license_number')) { %>required<% } %>>
			</div>
			<div class="mb-form-group mb-col-md-4">
				<label>
					<?php echo esc_html_x('Expedition country', 'renting_my_reservation', 'mybooking-wp-plugin') ?>
					<% if (required_fields.includes('driver_driving_license_country')) { %>*<% } %>
				</label>
				<select name="driver_driving_license_country" class="form-control"
					<% if (!booking.can_edit_online){%>disabled<%}%> <% if (required_fields.includes('driver_driving_license_country')) { %>required<% } %>>
				</select>
			</div>                
		</div>
		<div class="mb-form-row">
			<div class="mb-form-group mb-col-md-6 js-date-select-control">
				<label>
					<?php echo esc_html_x('Date of Issue', 'renting_my_reservation', 'mybooking-wp-plugin') ?>
					<% if (required_fields.includes('driver_driving_license_date')) { %>*<% } %>
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
				<input type="hidden" name="driver_driving_license_date" <% if (required_fields.includes('driver_driving_license_date')) { %>required<% } %>>
			</div>
			<div class="mb-form-group mb-col-md-6 js-date-select-control" data-date-select-control-direction="future">
				<label>
					<?php echo esc_html_x('Date of expiry', 'renting_my_reservation', 'mybooking-wp-plugin') ?>
					<% if (required_fields.includes('driver_driving_license_expiration_date')) { %>*<% } %>
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
				<input type="hidden" name="driver_driving_license_expiration_date" <% if (required_fields.includes('driver_driving_license_expiration_date')) { %>required<% } %>>
			</div>
		</div>

		<!-- // Driver Address -->
		<h6>
			<?php echo esc_html_x( 'Address', 'renting_my_reservation', 'mybooking-wp-plugin') ?>
		</h6>
		<hr />
		<% if (configuration.rentingFormFillDataAddress) { %>
			<!-- // Address -->
			<div class="mb-form-row">
				<!-- Country -->
				<div class="mb-form-group mb-col-md-6">
					<label>
						<?php echo esc_html_x( 'Country', 'renting_my_reservation', 'mybooking-wp-plugin') ?>
						<% if (required_fields.includes('driver_address[country]')) { %>*<% } %>
					</label>
					<select name="driver_address[country]" class="form-control" 
						<% if (!booking.can_edit_online){%>disabled<%}%> 
						<% if (required_fields.includes('driver_address[country]')) { %>required<% } %>
						data-state-selector-name=".driver_address_state_code_container"
						data-state-input-name="input[name=driver_address\\[state\\]]"
						data-city-selector-name=".driver_address_city_code_container"
						data-city-input-name="input[name=driver_address\\[city\\]]">
					</select>
				</div>

				<!-- State (required applied by JS because there are two fields) -->
				<div class="mb-form-group mb-col-md-6">
					<label>
						<?php echo esc_html_x( 'State', 'renting_my_reservation', 'mybooking-wp-plugin') ?>
						<% if (required_fields.includes('driver_address[state]')) { %>*<% } %>
					</label>
					<% if (configuration.sesHospedajes) { %>
						<div class="driver_address_state_code_container"
								 <% if (booking.address_country !== 'ES') { %>style="display: none;"<%}%>>
							<select id="driver_address[state_code]" name="driver_address[state_code]" class="form-control" 
								<% if (!booking.can_edit_online){%>disabled<%}%> 
								data-select-name="driver_address[city_code]" 
								data-select-value="driver_city_code"
								data-code-value="<%=booking.driver_address_state_code%>"
								data-text-value="<%=booking.driver_address_state%>">
							</select>
						</div>
					<% } %>
					<input class="form-control" name="driver_address[state]" type="text"
						placeholder="<%=configuration.escapeHtml("<?php echo esc_attr_x( 'State', 'renting_my_reservation', 'mybooking-wp-plugin') ?>")%>" 
						value="<%=booking.driver_address_state%>"  maxlength="60" 
						<% if (!booking.can_edit_online){%>disabled<%}%> 
						<% if (configuration.sesHospedajes && booking.address_country === 'ES') { %>style="display: none;"<%}%>>
				</div>
			</div>

			<div class="mb-form-row">
				<!-- City (required applied by JS because there are two fields) -->
				<div class="mb-form-group mb-col-md-6">
					<label>
						<?php echo esc_html_x( 'City', 'renting_my_reservation', 'mybooking-wp-plugin') ?>
						<% if (required_fields.includes('driver_address[city]')) { %>*<% } %>
					</label>
					<% if (configuration.sesHospedajes) { %>
						<div class="driver_address_city_code_container"
								 <% if (booking.address_country !== 'ES') { %>style="display: none;"<%}%>>
							<select id="driver_address[city_code]" name="driver_address[city_code]" class="form-control" 
								<% if (!booking.can_edit_online || !booking.driver_address_state_code || booking.driver_address_state_code == ''){%>disabled<%}%>
								data-code-value="<%=booking.driver_address_city_code%>"
								data-text-value="<%=booking.driver_address_city%>">
							</select>
						</div>
					<% } %>
					<input class="form-control" name="driver_address[city]" type="text"
						placeholder="<%=configuration.escapeHtml("<?php echo esc_attr_x( 'City', 'renting_my_reservation', 'mybooking-wp-plugin') ?>")%>" 
						value="<%=booking.driver_address_city%>" maxlength="60" 
						<% if (!booking.can_edit_online){%>disabled<%}%> 
						<% if (configuration.sesHospedajes && booking.address_country === 'ES') { %>style="display: none;"<%}%>>
				</div>

				<!-- Zip -->
				<div class="mb-form-group mb-col-md-6">
					<label>
						<?php echo esc_html_x( 'Postal Code', 'renting_my_reservation', 'mybooking-wp-plugin') ?>
						<% if (required_fields.includes('driver_address[zip]')) { %>*<% } %>
					</label>
					<input class="form-control" name="driver_address[zip]" type="text"
						placeholder="<%=configuration.escapeHtml("<?php echo esc_attr_x( 'Postal Code', 'renting_my_reservation', 'mybooking-wp-plugin') ?>")%>" value="<%=booking.driver_address_zip%>"  maxlength="10" <% if (!booking.can_edit_online){%>disabled<%}%> <% if (required_fields.includes('driver_address[zip]')) { %>required<% } %>>
				</div>
			</div>

			<div class="mb-form-row">
				<!-- Street -->
				<div class="mb-form-group mb-col-md-6">
					<label>
						<?php echo esc_html_x( 'Street', 'renting_my_reservation', 'mybooking-wp-plugin') ?>
						<% if (required_fields.includes('driver_address[street]')) { %>*<% } %>
					</label>
					<input class="form-control" name="driver_address[street]" type="text"
						placeholder="<%=configuration.escapeHtml("<?php echo esc_attr_x( 'Street', 'renting_my_reservation', 'mybooking-wp-plugin') ?>")%>" value="<%=booking.driver_address_street%>" maxlength="60" <% if (!booking.can_edit_online){%>disabled<%}%> <% if (required_fields.includes('driver_address[street]')) { %>required<% } %>>
				</div>

				<!-- Number -->
				<div class="mb-form-group mb-col-md-3">
					<label>
						<?php echo esc_html_x( 'Number', 'renting_my_reservation', 'mybooking-wp-plugin') ?>
						<% if (required_fields.includes('driver_address[number]')) { %>*<% } %>
					</label>
					<input class="form-control" name="driver_address[number]" type="text"
						placeholder="<%=configuration.escapeHtml("<?php echo esc_attr_x( 'Number', 'renting_my_reservation', 'mybooking-wp-plugin') ?>")%>" value="<%=booking.driver_address_number%>" maxlength="10" <% if (!booking.can_edit_online){%>disabled<%}%> <% if (required_fields.includes('driver_address[number]')) { %>required<% } %>>
				</div>

				<!-- Complement -->
				<div class="mb-form-group mb-col-md-3">
					<label>
						<?php echo esc_html_x( 'Complement', 'renting_my_reservation', 'mybooking-wp-plugin') ?>
						<% if (required_fields.includes('driver_address[complement]')) { %>*<% } %>
					</label>
					<input class="form-control" name="driver_address[complement]" type="text"
						placeholder="<%=configuration.escapeHtml("<?php echo esc_attr_x( 'Complement', 'renting_my_reservation', 'mybooking-wp-plugin') ?>")%>" value="<%=booking.driver_address_complement%>"  maxlength="20" <% if (!booking.can_edit_online){%>disabled<%}%> <% if (required_fields.includes('driver_address[complement]')) { %>required<% } %>>
				</div>
			</div>
		<% } %>
	</div>
<% } %>