<?php
/**
 *   MYBOOKING ENGINE - NEW CUSTOMER FORM TEMPLATE
 *   ---------------------------------------------------------------------------
 * 
 *   The Template for showing the new customer form
 * 
 *   This template can be overridden by copying it to your
 *   theme/mybooking-templates/mybooking-plugin-new-customer-form-tmpl.php
 *
 *   @phpcs:disable PHPCompatibility.Miscellaneous.RemovedAlternativePHPTags.MaybeASPOpenTagFound
 *   @phpcs:disable Generic.PHP.DisallowAlternativePHPTags.MaybeASPOpenTagFound
 *   @phpcs:disable Generic.PHP.DisallowAlternativePHPTags.MaybeASPShortOpenTagFound
 */
?>
<script type="text/tmpl" id="script_mybooking_new_customer">
	<div class="mybooking mb-section mb-panel-container">
		<h3>
			<?php echo esc_html_x( 'Customer/Driver', 'renting_my_reservation', 'mybooking-reservation-engine') ?>
		</h3>

		<form id="new_customer_form" name="new_customer_form" class="mybooking-form">
			<div class="mb-form-row">
				<div class="mb-form-group mb-col-md-6">
					<label for="name">
						<?php echo esc_html_x( 'Name', 'renting_my_reservation', 'mybooking-reservation-engine') ?> 
						<% if (required_fields.includes('name')) { %>*<% } %>
					</label>
					<!-- Name -->
					<input class="mb-form-control" id="name" name="name" type="text"
							placeholder="<?php echo esc_attr_x("Name", 'renting_my_reservation', 'mybooking-reservation-engine') ?>" 
							value=""
							maxlength="40" <% if (required_fields.includes('name')) { %>required<% } %>>
				</div>
				<div class="mb-form-group mb-col-md-6">
					<label for="surname">
						<?php echo esc_html_x( 'Surname', 'renting_my_reservation', 'mybooking-reservation-engine') ?>
						<% if (required_fields.includes('name')) { %>*<% } %>
					</label>
					<!-- Surname -->
					<input class="mb-form-control" id="surname" name="surname" type="text"
							placeholder="<?php  echo esc_attr_x("Surname", 'renting_my_reservation', 'mybooking-reservation-engine') ?>" value=""
							maxlength="40" <% if (required_fields.includes('surname')) { %>required<% } %>>
				</div>
			</div>

			<div class="mb-form-row">
				<div class="mb-form-group mb-col-md-6">
					<label for="email">
						<?php echo esc_html_x( 'E-mail', 'renting_complete', 'mybooking-reservation-engine') ?> 
						<% if (required_fields.includes('email')) { %>*<% } %>
					</label>
					<input class="mb-form-control" id="email" type="text" name="email" autocomplete="off" placeholder="<?php echo esc_attr_x( 'E-mail', 'renting_complete', 'mybooking-reservation-engine') ?>" maxlength="50" value=""
					<% if (required_fields.includes('email')) { %>required<% } %>>
				</div>
				<div class="mb-form-group mb-col-md-6">
					<label for="phone_number">
						<?php echo esc_html_x( 'Phone number', 'renting_complete', 'mybooking-reservation-engine') ?> 
						<% if (required_fields.includes('phone_number')) { %>*<% } %>
					</label>
					<input class="mb-form-control" id="phone_number" type="text" name="phone_number" autocomplete="off" placeholder="<?php echo esc_attr_x( 'Phone number', 'renting_complete', 'mybooking-reservation-engine') ?>" maxlength="15" value=""
					<% if (required_fields.includes('phone_number')) { %>required<% } %>>
				</div>
			</div>

			<div class="mb-form-row">
				<div class="mb-form-group mb-col-md-6 js-date-select-control">
					<label for="date_of_birth">
						<?php echo esc_html_x('Date of birth', 'renting_my_reservation', 'mybooking-reservation-engine') ?>
						<% if (required_fields.includes('email')) { %>*<% } %>
					</label>
					<div class="mb-form-row mb-custom-date-form">
						<div class="mb-custom-date-item">
							<select id="date_of_birth_day" name="date_of_birth_day"
								class="mb-form-control"></select>
						</div>
						<div class="mb-custom-date-item">
							<select id="date_of_birth_month" name="date_of_birth_month"
								class="mb-form-control"></select>
						</div>
						<div class="mb-custom-date-item">
							<select id="date_of_birth_year" name="date_of_birth_year"
								class="mb-form-control"></select>
						</div>
					</div>
					<input type="hidden" id="date_of_birth" name="date_of_birth" <% if (required_fields.includes('date_of_birth')) { %>required<% } %>>
				</div>

				<div class="mb-form-group mb-col-md-6">
					<label for="nacionality">
						<?php echo esc_html_x( 'Nacionality', 'renting_my_reservation', 'mybooking-reservation-engine') ?> 
						<% if (required_fields.includes('nacionality')) { %>*<% } %>
					</label>

					<!-- Driver nacionality -->
					<select id="nacionality" name="nacionality" class="mb-form-control" <% if (required_fields.includes('nacionality')) { %>required<% } %>></select>
				</div>
			</div>

			<h6>
				<?php echo esc_html_x( 'ID card or passport', 'renting_my_reservation', 'mybooking-reservation-engine') ?>
			</h6>
			<hr />

			<div class="mb-form-row">
				<div class="mb-form-group mb-col-md-4">
					<label for="document_id_type_id">
						<?php echo esc_html_x( 'Document type', 'renting_my_reservation', 'mybooking-reservation-engine') ?> 
						<% if (required_fields.includes('document_id_type_id')) { %>*<% } %>
					</label>

					<!-- Driver document type -->
					<select id="document_id_type_id" name="document_id_type_id" class="mb-form-control" 
									<% if (required_fields.includes('document_id_type_id')) { %>required<% } %>></select>
				</div>
				<div class="mb-form-group mb-col-md-4">
					<label for="customer_document_id">
						<?php echo esc_html_x( 'ID card/passport number', 'renting_my_reservation', 'mybooking-reservation-engine') ?> 
						<% if (required_fields.includes('document_id')) { %>*<% } %>
					</label>

					<!-- Driver document type -->
					<input class="mb-form-control" name="document_id" id="customer_document_id" type="text"
							placeholder="<?php echo esc_attr_x('ID card/passport number', 'renting_my_reservation', 'mybooking-reservation-engine') ?>" value=""
							maxlength="50" <% if (required_fields.includes('document_id')) { %>required<% } %>>
				</div>

				<!-- Driver origin country -->
				<div class="mb-form-group mb-col-md-4">
					<label for="origin_country">
						<?php echo esc_html_x( 'Expedition country', 'renting_my_reservation', 'mybooking-reservation-engine') ?> 
						<% if (required_fields.includes('origin_country')) { %>*<% } %>
					</label>

					<select id="origin_country" name="origin_country" class="mb-form-control" <% if (required_fields.includes('origin_country')) { %>required<% } %>></select>
				</div>
			</div>

			<div class="mb-form-row">
				<div class="mb-form-group mb-col-md-6 js-date-select-control">
					<label for="document_id_date">
						<?php echo esc_html_x('Date of Issue', 'renting_my_reservation', 'mybooking-reservation-engine') ?> 
						<% if (required_fields.includes('document_id_date')) { %>*<% } %>
					</label>
					<div class="mb-form-row mb-custom-date-form">
						<div class="mb-custom-date-item">
							<select id="document_id_date_day" name="document_id_date_day"
								class="mb-form-control"></select>
						</div>
						<div class="mb-custom-date-item">
							<select id="document_id_date_month" name="document_id_date_month"
								class="mb-form-control"></select>
						</div>
						<div class="mb-custom-date-item">
							<select id="document_id_date_year" name="document_id_date_year"
								class="mb-form-control"></select>
						</div>
					</div>
					<input type="hidden" id="document_id_date" name="document_id_date" <% if (required_fields.includes('document_id_date')) { %>required<% } %>>
				</div>
				<div class="mb-form-group mb-col-md-6 js-date-select-control" data-date-select-control-direction="future">
					<label for="document_id_expiration_date">
						<?php echo esc_html_x('Date of expiry', 'renting_my_reservation', 'mybooking-reservation-engine') ?> 
						<% if (required_fields.includes('document_id_expiration_date')) { %>*<% } %>
					</label>
					<div class="mb-form-row mb-custom-date-form">
						<div class="mb-custom-date-item">
							<select id="document_id_expiration_date_day" name="document_id_expiration_date_day"
								class="mb-form-control"></select>
						</div>
						<div class="mb-custom-date-item">
							<select id="document_id_expiration_date_month" name="document_id_expiration_date_month"
								class="mb-form-control"></select>
						</div>
						<div class="mb-custom-date-item">
							<select id="document_id_expiration_date_year" name="document_id_expiration_date_year"
								class="mb-form-control"></select>
						</div>
					</div>
					<input type="hidden" id="document_id_expiration_date" name="document_id_expiration_date" 
					   <% if (required_fields.includes('document_id_expiration_date')) { %>required<% } %>>
				</div>
			</div>

			<h6>
				<?php echo esc_html_x('License', 'renting_my_reservation', 'mybooking-reservation-engine') ?>
			</h6>
			<hr />

			<div class="mb-form-row">
				<div class="mb-form-group mb-col-md-4">
					<label for="driving_license_type_id">
						<?php echo esc_html_x( 'License type', 'renting_my_reservation', 'mybooking-reservation-engine') ?> 
						<% if (required_fields.includes('driving_license_type_id')) { %>*<% } %>
					</label>
					<select id="driving_license_type_id" name="driving_license_type_id" class="mb-form-control"
									<% if (required_fields.includes('driving_license_type_id')) { %>required<% } %>></select>
				</div>
				<div class="mb-form-group mb-col-md-4">
					<label for="driving_license_number">
						<?php echo esc_html_x('Driving license number', 'renting_my_reservation', 'mybooking-reservation-engine') ?>
						<% if (required_fields.includes('driving_license_number')) { %>*<% } %>
					</label>
					<input class="mb-form-control" id="driving_license_number" name="driving_license_number"
						type="text" placeholder="<?php echo esc_attr_x('Driving license number', 'renting_my_reservation', 'mybooking-reservation-engine') ?>"
						value="" maxlength="50" <% if (required_fields.includes('driving_license_number')) { %>required<% } %>>
				</div>
				<div class="mb-form-group mb-col-md-4">
					<label for="driving_license_country">
						<?php echo esc_html_x('Expedition country', 'renting_my_reservation', 'mybooking-reservation-engine') ?>
						<% if (required_fields.includes('driving_license_country')) { %>*<% } %>
					</label>
					<select id="driving_license_country" name="driving_license_country" class="mb-form-control" 
						 			<% if (required_fields.includes('driving_license_country')) { %>required<% } %>>
					</select>
				</div>                
			</div>

			<div class="mb-form-row">
				<div class="mb-form-group mb-col-md-6 js-date-select-control">
					<label for="driving_license_date">
						<?php echo esc_html_x('Date of Issue', 'renting_my_reservation', 'mybooking-reservation-engine') ?>
						<% if (required_fields.includes('driving_license_date')) { %>*<% } %>
					</label>
					<div class="mb-form-row mb-custom-date-form">
						<div class="mb-custom-date-item">
							<select id="driving_license_date_day" name="driving_license_date_day"
								class="mb-form-control"></select>
						</div>
						<div class="mb-custom-date-item">
							<select id="driving_license_date_month" name="driving_license_date_month"
								class="mb-form-control"></select>
						</div>
						<div class="mb-custom-date-item">
							<select id="driving_license_date_year" name="driving_license_date_year"
								class="mb-form-control"></select>
						</div>
					</div>
					<input type="hidden" id="driving_license_date" name="driving_license_date" 
									<% if (required_fields.includes('driving_license_date')) { %>required<% } %>>
				</div>
				<div class="mb-form-group mb-col-md-6 js-date-select-control" data-date-select-control-direction="future">
					<label for="driving_license_expiration_date">
						<?php echo esc_html_x('Date of expiry', 'renting_my_reservation', 'mybooking-reservation-engine') ?>
						<% if (required_fields.includes('driving_license_expiration_date')) { %>*<% } %>
					</label>
					<div class="mb-form-row mb-custom-date-form">
						<div class="mb-custom-date-item">
							<select id="driving_license_expiration_date_day" name="driving_license_expiration_date_day"
								class="mb-form-control"></select>
						</div>
						<div class="mb-custom-date-item">
							<select id="driving_license_expiration_date_month" name="driving_license_expiration_date_month"
								class="mb-form-control"></select>
						</div>
						<div class="mb-custom-date-item">
							<select id="driving_license_expiration_date_year" name="driving_license_expiration_date_year"
								class="mb-form-control"></select>
						</div>
					</div>
					<input type="hidden" id="driving_license_expiration_date" name="driving_license_expiration_date"
									<% if (required_fields.includes('driving_license_expiration_date')) { %>required<% } %>>
				</div>
			</div>

			<h6>
				<?php echo esc_html_x( 'Address', 'renting_my_reservation', 'mybooking-reservation-engine') ?> 
			</h6>
			<hr />

			<!-- Reorder address fields: Country, State, City, Zip, Street, Number, Complement -->

			<div class="mb-form-row">
				<!-- Country -->
				<div class="mb-form-group mb-col-md-6">
					<label for="address_country">
						<?php echo esc_html_x( 'Country', 'renting_my_reservation', 'mybooking-reservation-engine') ?>
						<% if (required_fields.includes('address[country]')) { %>*<% } %>
					</label>
					<select class="mb-form-control" id="address_country" name="address[country]"
						data-state-input-name="input[name=address\\[state\\]]" 
						data-state-selector-name="select[name=address\\[state_code\\]]"
						data-city-input-name="input[name=address\\[city\\]]"
						data-city-selector-name="select[name=address\\[city_code\\]]"						
						<% if (required_fields.includes('address[country]')) { %>required<% } %>>
					</select>
				</div>
				<!-- State -->
				<div class="mb-form-group mb-col-md-6 address_state_container">
					<label for="address_state">
						<?php echo esc_html_x( 'State', 'renting_my_reservation', 'mybooking-reservation-engine') ?>
						<% if (required_fields.includes('address[state]')) { %>*<% } %>
					</label>
					<input type="text" class="mb-form-control address_state_input" id="address_state" name="address[state]" placeholder="<?php echo esc_attr_x( 'State', 'renting_my_reservation', 'mybooking-reservation-engine') ?>" value="" maxlength="50">
					<select class="mb-form-control address_state_select" id="address_state_code" name="address[state_code]" style="display: none;">
					</select>
				</div>
			</div>

			<div class="mb-form-row">
				<!-- City -->
				<div class="mb-form-group mb-col-md-6 address_city_container">
					<label for="address_city">
						<?php echo esc_html_x( 'City', 'renting_my_reservation', 'mybooking-reservation-engine') ?>
						<% if (required_fields.includes('address[city]')) { %>*<% } %>
					</label>
					<input type="text" class="mb-form-control address_city_input" id="address_city" name="address[city]" placeholder="<?php echo esc_attr_x( 'City', 'renting_my_reservation', 'mybooking-reservation-engine') ?>" value="" maxlength="50">
					<select class="mb-form-control address_city_select" id="address_city_code" name="address[city_code]" style="display: none;">
					</select>
				</div>
				<!-- Zip Code -->
				<div class="mb-form-group mb-col-md-6">
					<label for="address_zip">
						<?php echo esc_html_x( 'Zip Code', 'renting_my_reservation', 'mybooking-reservation-engine') ?>
						<% if (required_fields.includes('address[zip]')) { %>*<% } %>
					</label>
					<input class="mb-form-control" id="address_zip" name="address[zip]" type="text"
						placeholder="<?php echo esc_attr_x( 'Zip Code', 'renting_my_reservation', 'mybooking-reservation-engine') ?>"
						value="" maxlength="10" <% if (required_fields.includes('address[zip]')) { %>required<% } %>>
				</div>
			</div>

			<div class="mb-form-row">
				<!-- Street -->
				<div class="mb-form-group mb-col-md-6">
					<label for="address_street">
						<?php echo esc_html_x( 'Street', 'renting_my_reservation', 'mybooking-reservation-engine') ?>
						<% if (required_fields.includes('address[street]')) { %>*<% } %>
					</label>
					<input class="mb-form-control" id="address_street" name="address[street]" type="text"
						placeholder="<?php echo esc_attr_x( 'Street', 'renting_my_reservation', 'mybooking-reservation-engine') ?>"
						value="" maxlength="100" <% if (required_fields.includes('address[street]')) { %>required<% } %>>
				</div>
				<!-- Number -->
				<div class="mb-form-group mb-col-md-3">
					<label for="address_number">
						<?php echo esc_html_x( 'Number', 'renting_my_reservation', 'mybooking-reservation-engine') ?>
						<% if (required_fields.includes('address[number]')) { %>*<% } %>
					</label>
					<input class="mb-form-control" id="address_number" name="address[number]" type="text"
						placeholder="<?php echo esc_attr_x( 'Number', 'renting_my_reservation', 'mybooking-reservation-engine') ?>"
						value="" maxlength="20" <% if (required_fields.includes('address[number]')) { %>required<% } %>>
				</div>
				<!-- Complement -->
				<div class="mb-form-group mb-col-md-3">
					<label for="address_complement">
						<?php echo esc_html_x( 'Complement', 'renting_my_reservation', 'mybooking-reservation-engine') ?>
						<% if (required_fields.includes('address[complement]')) { %>*<% } %>
					</label>
					<input class="mb-form-control" id="address_complement" name="address[complement]" type="text"
						placeholder="<?php echo esc_attr_x( 'Complement', 'renting_my_reservation', 'mybooking-reservation-engine') ?>"
						value="" maxlength="20" <% if (required_fields.includes('address[complement]')) { %>required<% } %>>
				</div>
			</div>
			<!-- Submit Button -->
			<div class="mb-form-row">
				<div class="mb-form-group mb-col-md-12">
					<button type="submit" class="mb-button">
						<?php echo esc_html_x( 'Submit', 'renting_new_customer', 'mybooking-reservation-engine') ?>
					</button>
				</div>
			</div>
		</form>
	</div>
</script>