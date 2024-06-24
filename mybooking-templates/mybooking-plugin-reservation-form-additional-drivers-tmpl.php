<?php
/**
 *   MYBOOKING ENGINE - RESERVATION FORM ADDITIONAL DRIVERS TEMPLATE
 *   ---------------------------------------------------------------------------
 * 
 *   The Template for showing the form to fill the additional drivers details in the reservation process
 * 
 *   This template can be overridden by copying it to your
 *   theme/mybooking-templates/mybooking-plugin-reservation-form-additional-drivers-tmpl.php
 *
 *   @phpcs:disable PHPCompatibility.Miscellaneous.RemovedAlternativePHPTags.MaybeASPOpenTagFound
 *   @phpcs:disable Generic.PHP.DisallowAlternativePHPTags.MaybeASPOpenTagFound
 *   @phpcs:disable Generic.PHP.DisallowAlternativePHPTags.MaybeASPShortOpenTagFound
 */
?>
<% if (configuration.rentingFormFillDataAdditionalDriver1 || configuration.rentingFormFillDataAdditionalDriver2) { %>
	<div class="mb-section mb-panel-container">
		<div id="additional_drivers_toggle_btn" class="mb-form-row mb--flex-align_center"  data-panel="additional_drivers_panel" style="margin-bottom: -1rem; cursor: pointer;">
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
						<% if (required_fields.includes('additional_driver_1_name')) { %>*<% } %>
					</label>
					<input class="form-control" name="additional_driver_1_name" type="text"
						placeholder="<%=configuration.escapeHtml("<?php echo esc_attr_x("Name", 'renting_my_reservation', 'mybooking-wp-plugin') ?>")%>"
						value="<%=booking.additional_driver_1_name%>"
						maxlength="40" <% if (!booking.can_edit_online){%>disabled<%}%> <% if (required_fields.includes('additional_driver_1_name')) { %>required<% } %>>
				</div>
				<div class="mb-form-group mb-col-md-6">
					<label>
						<?php echo esc_html_x('Surname', 'renting_my_reservation', 'mybooking-wp-plugin') ?>
						<% if (required_fields.includes('additional_driver_1_surname')) { %>*<% } %>
					</label>
					<input class="form-control" name="additional_driver_1_surname" type="text"
						placeholder="<%=configuration.escapeHtml("<?php echo esc_attr_x('Surname', 'renting_my_reservation', 'mybooking-wp-plugin') ?>")%>"
						value="<%=booking.additional_driver_1_surname%>"
						maxlength="40" <% if (!booking.can_edit_online){%>disabled<%}%> <% if (required_fields.includes('additional_driver_1_surname')) { %>required<% } %>>
				</div>
			</div>
			<div class="mb-form-row">
				<div class="mb-form-group mb-col-md-6">
					<label>
						<?php echo esc_html_x( 'Nacionality', 'renting_my_reservation', 'mybooking-wp-plugin') ?>
						<% if (required_fields.includes('additional_driver_1_nacionality')) { %>*<% } %>
					</label>
					<select name="additional_driver_1_nacionality" class="form-control" <% if (!booking.can_edit_online){%>disabled<%}%> <% if (required_fields.includes('additional_driver_1_nacionality')) { %>required<% } %>></select>
				</div>
				<div class="mb-form-group mb-col-md-6 js-date-select-control">
					<label>
						<?php echo esc_html_x('Date of birth', 'renting_my_reservation', 'mybooking-wp-plugin') ?>
						<% if (required_fields.includes('additional_driver_1_date_of_birth')) { %>*<% } %>
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
					<input type="hidden" name="additional_driver_1_date_of_birth" <% if (required_fields.includes('additional_driver_1_date_of_birth')) { %>required<% } %>>
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
						<% if (required_fields.includes('additional_driver_1_document_id_type_id')) { %>*<% } %>
					</label>
					<select name="additional_driver_1_document_id_type_id" class="form-control" <% if (!booking.can_edit_online){%>disabled<%}%> <% if (required_fields.includes('additional_driver_1_document_id_type_id')) { %>required<% } %>></select>
				</div>
				<div class="mb-form-group mb-col-md-4">
					<label>
						<?php echo esc_html_x('ID card/passport number', 'renting_my_reservation', 'mybooking-wp-plugin') ?>
						<% if (required_fields.includes('additional_driver_1_document_id')) { %>*<% } %>
					</label>
					<input class="form-control" name="additional_driver_1_document_id"
						type="text" placeholder="<?php echo esc_attr_x('ID card/passport number', 'renting_my_reservation', 'mybooking-wp-plugin') ?>"
						value="<%=booking.additional_driver_1_document_id%>"
						maxlength="50" <% if (!booking.can_edit_online){%>disabled<%}%> <% if (required_fields.includes('additional_driver_1_document_id')) { %>required<% } %>>
				</div>
				<div class="mb-form-group mb-col-md-4">
					<label>
						<?php echo esc_html_x('Expedition country', 'renting_my_reservation', 'mybooking-wp-plugin') ?>
						<% if (required_fields.includes('additional_driver_1_origin_country')) { %>*<% } %>
					</label>
					<select name="additional_driver_1_origin_country"
							class="form-control" <% if (!booking.can_edit_online){%>disabled<%}%> <% if (required_fields.includes('additional_driver_1_origin_country')) { %>required<% } %>>
					</select>
				</div>
			</div>
			<div class="mb-form-row">
				<div class="mb-form-group mb-col-md-6 js-date-select-control">
					<label>
						<?php echo esc_html_x('Date of Issue', 'renting_my_reservation', 'mybooking-wp-plugin') ?>
						<% if (required_fields.includes('additional_driver_1_document_id_date')) { %>*<% } %>
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
					<input type="hidden" name="additional_driver_1_document_id_date" <% if (required_fields.includes('additional_driver_1_document_id_date')) { %>required<% } %>>
				</div>
				<div class="mb-form-group mb-col-md-6 js-date-select-control" data-date-select-control-direction="future">
					<label>
						<?php echo esc_html_x('Date of expiry', 'renting_my_reservation', 'mybooking-wp-plugin') ?>
						<% if (required_fields.includes('additional_driver_1_document_id_expiration_date')) { %>*<% } %>
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
					<input type="hidden" name="additional_driver_1_document_id_expiration_date" <% if (required_fields.includes('additional_driver_1_document_id_expiration_date')) { %>required<% } %>>
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
						<% if (required_fields.includes('additional_driver_1_driving_license_type_id')) { %>*<% } %>
					</label>
					<select name="additional_driver_1_driving_license_type_id" class="form-control" <% if (!booking.can_edit_online){%>disabled<%}%> <% if (required_fields.includes('additional_driver_1_driving_license_type_id')) { %>required<% } %>></select>
				</div>
				<div class="mb-form-group mb-col-md-4">
					<label>
						<?php echo esc_html_x('Driving license number', 'renting_my_reservation', 'mybooking-wp-plugin') ?>
						<% if (required_fields.includes('additional_driver_1_driving_license_number')) { %>*<% } %>
					</label>
					<input class="form-control" name="additional_driver_1_driving_license_number"
						type="text" placeholder="<%=configuration.escapeHtml("<?php echo esc_attr_x('Driving license number', 'renting_my_reservation', 'mybooking-wp-plugin') ?>")%>"
						value="<%=booking.additional_driver_1_driving_license_number%>"
						maxlength="50" <% if (!booking.can_edit_online){%>disabled<%}%> <% if (required_fields.includes('additional_driver_1_driving_license_number')) { %>required<% } %>>
				</div>
				<div class="mb-form-group mb-col-md-4">
					<label>
						<?php echo esc_html_x('Expedition country', 'renting_my_reservation', 'mybooking-wp-plugin') ?>
						<% if (required_fields.includes('additional_driver_1_driving_license_country')) { %>*<% } %>
					</label>
					<select name="additional_driver_1_driving_license_country" 
							class="form-control" <% if (!booking.can_edit_online){%>disabled<%}%> <% if (required_fields.includes('additional_driver_1_driving_license_country')) { %>required<% } %>>
					</select>
				</div>
			</div>
			<div class="mb-form-row">
				<div class="mb-form-group mb-col-md-6 js-date-select-control">
					<label>
						<?php echo esc_html_x('Date of Issue', 'renting_my_reservation', 'mybooking-wp-plugin') ?>
						<% if (required_fields.includes('additional_driver_1_driving_license_date')) { %>*<% } %>
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
					<input type="hidden" name="additional_driver_1_driving_license_date" <% if (required_fields.includes('additional_driver_1_driving_license_date')) { %>required<% } %>>
				</div>
				<div class="mb-form-group mb-col-md-6 js-date-select-control" data-date-select-control-direction="future">
					<label>
						<?php echo esc_html_x('Date of expiry', 'renting_my_reservation', 'mybooking-wp-plugin') ?>
						<% if (required_fields.includes('additional_driver_1_driving_license_expiration_date')) { %>*<% } %>
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
					<input type="hidden" name="additional_driver_1_driving_license_expiration_date" <% if (required_fields.includes('additional_driver_1_driving_license_expiration_date')) { %>required<% } %>>
				</div>
			</div>
			<hr />
			<% if (configuration.rentingFormFillDataAdditionalDriver2) { %>
				<div class="mb-form-row">
					<div class="mb-form-group mb-col-md-6">
						<label>
							<?php echo esc_html_x('Name', 'renting_my_reservation', 'mybooking-wp-plugin') ?>
							<% if (required_fields.includes('additional_driver_2_name')) { %>*<% } %>
						</label>
						<input class="form-control" name="additional_driver_2_name" type="text"
							placeholder="<%=configuration.escapeHtml("<?php echo esc_attr_x('Name', 'renting_my_reservation', 'mybooking-wp-plugin') ?>")%>"
							value="<%=booking.additional_driver_2_name%>"
							maxlength="40" <% if (!booking.can_edit_online){%>disabled<%}%> <% if (required_fields.includes('additional_driver_2_name')) { %>required<% } %>>
					</div>
					<div class="mb-form-group mb-col-md-6">
						<label>
							<?php echo esc_html_x('Surname', 'renting_my_reservation', 'mybooking-wp-plugin') ?>
							<% if (required_fields.includes('additional_driver_2_surname')) { %>*<% } %>
						</label>
						<input class="form-control" name="additional_driver_2_surname" type="text"
							placeholder="<%=configuration.escapeHtml("<?php echo esc_attr_x('Surname', 'renting_my_reservation', 'mybooking-wp-plugin') ?>")%>"
							value="<%=booking.additional_driver_2_surname%>"
							maxlength="40" <% if (!booking.can_edit_online){%>disabled<%}%> <% if (required_fields.includes('additional_driver_2_surname')) { %>required<% } %>>
					</div>
				</div>
				<div class="mb-form-row">
					<div class="mb-form-group mb-col-md-6">
						<label>
							<?php echo esc_html_x( 'Nacionality', 'renting_my_reservation', 'mybooking-wp-plugin') ?>
							<% if (required_fields.includes('additional_driver_2_nacionality')) { %>*<% } %>
						</label>
						<select name="additional_driver_2_nacionality" class="form-control" <% if (!booking.can_edit_online){%>disabled<%}%> <% if (required_fields.includes('additional_driver_2_nacionality')) { %>required<% } %>></select>
					</div>
					<div class="mb-form-group mb-col-md-6 js-date-select-control">
						<label>
							<?php echo esc_html_x('Date of birth', 'renting_my_reservation', 'mybooking-wp-plugin') ?>
							<% if (required_fields.includes('additional_driver_2_date_of_birth')) { %>*<% } %>
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
						<input type="hidden" name="additional_driver_2_date_of_birth" <% if (required_fields.includes('additional_driver_2_date_of_birth')) { %>required<% } %>>
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
							<% if (required_fields.includes('additional_driver_2_document_id_type_id')) { %>*<% } %>
						</label>
						<select name="additional_driver_2_document_id_type_id" class="form-control" <% if (!booking.can_edit_online){%>disabled<%}%> <% if (required_fields.includes('additional_driver_2_document_id_type_id')) { %>required<% } %>></select>
					</div>
					<div class="mb-form-group mb-col-md-4">
						<label>
							<?php echo esc_html_x('ID card/passport number', 'renting_my_reservation', 'mybooking-wp-plugin') ?>
							<% if (required_fields.includes('additional_driver_2_document_id')) { %>*<% } %>
						</label>
						<input class="form-control" name="additional_driver_2_document_id"
							type="text" placeholder="<?php echo esc_attr_x('ID card/passport number', 'renting_my_reservation', 'mybooking-wp-plugin') ?>"
							value="<%=booking.additional_driver_2_document_id%>"
							maxlength="50" <% if (!booking.can_edit_online){%>disabled<%}%> <% if (required_fields.includes('additional_driver_2_document_id')) { %>required<% } %>>
					</div>
					<div class="mb-form-group mb-col-md-4">
						<label>
							<?php echo esc_html_x('Expedition country', 'renting_my_reservation', 'mybooking-wp-plugin') ?>
							<% if (required_fields.includes('additional_driver_2_origin_country')) { %>*<% } %>
						</label>
						<select name="additional_driver_2_origin_country" 
								class="form-control" <% if (!booking.can_edit_online){%>disabled<%}%> <% if (required_fields.includes('additional_driver_2_origin_country')) { %>required<% } %>>
						</select>
					</div>
				</div>
				<div class="mb-form-row">
					<div class="mb-form-group mb-col-md-6 js-date-select-control">
						<label>
							<?php echo esc_html_x('Date of Issue', 'renting_my_reservation', 'mybooking-wp-plugin') ?>
							<% if (required_fields.includes('additional_driver_2_document_id_date')) { %>*<% } %>
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
						<input type="hidden" name="additional_driver_2_document_id_date" <% if (required_fields.includes('additional_driver_2_document_id_date')) { %>required<% } %>>
					</div>
					<div class="mb-form-group mb-col-md-6 js-date-select-control" data-date-select-control-direction="future">
						<label>
							<?php echo esc_html_x('Date of expiry', 'renting_my_reservation', 'mybooking-wp-plugin') ?>
							<% if (required_fields.includes('additional_driver_2_document_id_expiration_date')) { %>*<% } %>
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
						<input type="hidden" name="additional_driver_2_document_id_expiration_date" <% if (required_fields.includes('additional_driver_2_document_id_expiration_date')) { %>required<% } %>>
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
							<% if (required_fields.includes('additional_driver_2_driving_license_type_id')) { %>*<% } %>
						</label>
						<select name="additional_driver_2_driving_license_type_id" class="form-control" <% if (!booking.can_edit_online){%>disabled<%}%> <% if (required_fields.includes('additional_driver_2_driving_license_type_id')) { %>required<% } %>></select>
					</div>
					<div class="mb-form-group mb-col-md-4">
						<label>
							<?php echo esc_html_x('Driving license number', 'renting_my_reservation', 'mybooking-wp-plugin') ?>
							<% if (required_fields.includes('additional_driver_2_driving_license_number')) { %>*<% } %>
						</label>
						<input class="form-control" name="additional_driver_2_driving_license_number"
							type="text" placeholder="<%=configuration.escapeHtml("<?php echo esc_attr_x('Driving license number', 'renting_my_reservation', 'mybooking-wp-plugin') ?>")%>"
							value="<%=booking.additional_driver_2_driving_license_number%>"
							maxlength="50" <% if (!booking.can_edit_online){%>disabled<%}%> <% if (required_fields.includes('additional_driver_2_driving_license_number')) { %>required<% } %>>
					</div>
					<div class="mb-form-group mb-col-md-4">
						<label>
							<?php echo esc_html_x('Expedition country', 'renting_my_reservation', 'mybooking-wp-plugin') ?>
							<% if (required_fields.includes('additional_driver_2_driving_license_country')) { %>*<% } %>
						</label>
						<select name="additional_driver_2_driving_license_country" 
								class="form-control" <% if (!booking.can_edit_online){%>disabled<%}%> <% if (required_fields.includes('additional_driver_2_driving_license_country')) { %>required<% } %>>
						</select>
					</div>                    
				</div>
				<div class="mb-form-row">
					<div class="mb-form-group mb-col-md-6 js-date-select-control">
						<label>
							<?php echo esc_html_x('Date of Issue', 'renting_my_reservation', 'mybooking-wp-plugin') ?>
							<% if (required_fields.includes('additional_driver_2_driving_license_date')) { %>*<% } %>
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
						<input type="hidden" name="additional_driver_2_driving_license_date" <% if (required_fields.includes('additional_driver_2_driving_license_date')) { %>required<% } %>>
					</div>
					<div class="mb-form-group mb-col-md-6 js-date-select-control" data-date-select-control-direction="future">
						<label>
							<?php echo esc_html_x('Date of expiry', 'renting_my_reservation', 'mybooking-wp-plugin') ?>
							<% if (required_fields.includes('additional_driver_2_driving_license_expiration_date')) { %>*<% } %>
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
						<input type="hidden" name="additional_driver_2_driving_license_expiration_date" <% if (required_fields.includes('additional_driver_2_driving_license_expiration_date')) { %>required<% } %>>
					</div>
				</div>
			<% } %>
		</div>
	</div>
<% } %>