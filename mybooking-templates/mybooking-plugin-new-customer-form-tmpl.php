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
<div class="mybooking mb-section mb-panel-container">
	<h3>
		<?php echo esc_html_x( 'Customer/Driver', 'renting_my_reservation', 'mybooking-reservation-engine') ?>
	</h3>

	<form id="new_customer_form" name="new_customer_form" class="mybooking-form">
		<div class="mb-form-row">
			<div class="mb-form-group mb-col-md-6">
				<label for="driver_name">
					<?php echo esc_html_x( 'Name', 'renting_my_reservation', 'mybooking-reservation-engine') ?> <span class="required-indicator" style="display: none;">*</span>
				</label>

				<!-- Driver name -->
				<input class="mb-form-control" id="driver_name" name="driver_name" type="text"
						placeholder="<?php echo esc_attr_x("Name", 'renting_my_reservation', 'mybooking-reservation-engine') ?>" 
						value=""
						maxlength="40" required>
			</div>
			<div class="mb-form-group mb-col-md-6">
				<label for="driver_surname">
					<?php echo esc_html_x( 'Surname', 'renting_my_reservation', 'mybooking-reservation-engine') ?> <span class="required-indicator" style="display: none;">*</span>
				</label>

				<!-- Driver surname -->
				<input class="mb-form-control" id="driver_surname" name="driver_surname" type="text"
						placeholder="<?php  echo esc_attr_x("Surname", 'renting_my_reservation', 'mybooking-reservation-engine') ?>" value=""
						maxlength="40" required>
			</div>
		</div>

		<div class="mb-form-row">
			<div class="mb-form-group mb-col-md-6">
				<label for="customer_email">
					<?php echo esc_html_x( 'E-mail', 'renting_complete', 'mybooking-reservation-engine') ?> <span class="required-indicator" style="display: none;">*</span>
				</label>
				<input class="mb-form-control" id="customer_email" type="text" name="customer_email" autocomplete="off" placeholder="<?php echo esc_attr_x( 'E-mail', 'renting_complete', 'mybooking-reservation-engine') ?>" maxlength="50" value="">
			</div>
			<div class="mb-form-group mb-col-md-6">
				<label for="customer_phone">
					<?php echo esc_html_x( 'Phone number', 'renting_complete', 'mybooking-reservation-engine') ?> <span class="required-indicator" style="display: none;">*</span>
				</label>
				<input class="mb-form-control" id="customer_phone" type="text" name="customer_phone" autocomplete="off" placeholder="<?php echo esc_attr_x( 'Phone number', 'renting_complete', 'mybooking-reservation-engine') ?>" maxlength="15" value="">
			</div>
		</div>

		<div class="mb-form-row">
			<div class="mb-form-group mb-col-md-6 js-date-select-control">
				<label for="driver_date_of_birth">
					<?php echo esc_html_x('Date of birth', 'renting_my_reservation', 'mybooking-reservation-engine') ?> <span class="required-indicator" style="display: none;">*</span>
				</label>
				<div class="mb-form-row mb-custom-date-form">
					<div class="mb-custom-date-item">
						<select id="driver_date_of_birth_day" name="driver_date_of_birth_day"
							class="mb-form-control"></select>
					</div>
					<div class="mb-custom-date-item">
						<select id="driver_date_of_birth_month" name="driver_date_of_birth_month"
							class="mb-form-control"></select>
					</div>
					<div class="mb-custom-date-item">
						<select id="driver_date_of_birth_year" name="driver_date_of_birth_year"
							class="mb-form-control"></select>
					</div>
				</div>
				<input type="hidden" id="driver_date_of_birth" name="driver_date_of_birth">
			</div>

			<div class="mb-form-group mb-col-md-6">
				<label for="driver_nacionality">
					<?php echo esc_html_x( 'Nacionality', 'renting_my_reservation', 'mybooking-reservation-engine') ?> <span class="required-indicator" style="display: none;">*</span>
				</label>

				<!-- Driver nacionality -->
				<select id="driver_nacionality" name="driver_nacionality" class="mb-form-control"></select>
			</div>
		</div>

		<h6>
			<?php echo esc_html_x( 'ID card or passport', 'renting_my_reservation', 'mybooking-reservation-engine') ?>
		</h6>
		<hr />

		<div class="mb-form-row">
			<div class="mb-form-group mb-col-md-4">
				<label for="driver_document_id_type_id">
					<?php echo esc_html_x( 'Document type', 'renting_my_reservation', 'mybooking-reservation-engine') ?> <span class="required-indicator" style="display: none;">*</span>
				</label>

				<!-- Driver document type -->
				<select id="driver_document_id_type_id" name="driver_document_id_type_id" class="mb-form-control"></select>
			</div>
			<div class="mb-form-group mb-col-md-4">
				<label for="customer_driver_document_id">
					<?php echo esc_html_x( 'ID card/passport number', 'renting_my_reservation', 'mybooking-reservation-engine') ?> <span class="required-indicator" style="display: none;">*</span>
				</label>

				<!-- Driver document type -->
				<input class="mb-form-control" name="driver_document_id" id="customer_driver_document_id" type="text"
						placeholder="<?php echo esc_attr_x('ID card/passport number', 'renting_my_reservation', 'mybooking-reservation-engine') ?>" value=""
						maxlength="50">
			</div>

			<!-- Driver origin country -->
			<div class="mb-form-group mb-col-md-4">
				<label for="driver_origin_country">
					<?php echo esc_html_x( 'Expedition country', 'renting_my_reservation', 'mybooking-reservation-engine') ?> <span class="required-indicator" style="display: none;">*</span>
				</label>

				<select id="driver_origin_country" name="driver_origin_country" class="mb-form-control"></select>
			</div>
		</div>

		<div class="mb-form-row">
			<div class="mb-form-group mb-col-md-6 js-date-select-control">
				<label for="driver_document_id_date">
					<?php echo esc_html_x('Date of Issue', 'renting_my_reservation', 'mybooking-reservation-engine') ?> <span class="required-indicator" style="display: none;">*</span>
				</label>
				<div class="mb-form-row mb-custom-date-form">
					<div class="mb-custom-date-item">
						<select id="driver_document_id_date_day" name="driver_document_id_date_day"
							class="mb-form-control"></select>
					</div>
					<div class="mb-custom-date-item">
						<select id="driver_document_id_date_month" name="driver_document_id_date_month"
							class="mb-form-control"></select>
					</div>
					<div class="mb-custom-date-item">
						<select id="driver_document_id_date_year" name="driver_document_id_date_year"
							class="mb-form-control"></select>
					</div>
				</div>
				<input type="hidden" id="driver_document_id_date" name="driver_document_id_date">
			</div>
			<div class="mb-form-group mb-col-md-6 js-date-select-control" data-date-select-control-direction="future">
				<label for="driver_document_id_expiration_date">
					<?php echo esc_html_x('Date of expiry', 'renting_my_reservation', 'mybooking-reservation-engine') ?> <span class="required-indicator" style="display: none;">*</span>
				</label>
				<div class="mb-form-row mb-custom-date-form">
					<div class="mb-custom-date-item">
						<select id="driver_document_id_expiration_date_day" name="driver_document_id_expiration_date_day"
							class="mb-form-control"></select>
					</div>
					<div class="mb-custom-date-item">
						<select id="driver_document_id_expiration_date_month" name="driver_document_id_expiration_date_month"
							class="mb-form-control"></select>
					</div>
					<div class="mb-custom-date-item">
						<select id="driver_document_id_expiration_date_year" name="driver_document_id_expiration_date_year"
							class="mb-form-control"></select>
					</div>
				</div>
				<input type="hidden" id="driver_document_id_expiration_date" name="driver_document_id_expiration_date">
			</div>
		</div>

		<h6>
			<?php echo esc_html_x('License', 'renting_my_reservation', 'mybooking-reservation-engine') ?>
		</h6>
		<hr />

		<div class="mb-form-row">
			<div class="mb-form-group mb-col-md-4">
				<label for="driver_driving_license_type_id">
					<?php echo esc_html_x( 'License type', 'renting_my_reservation', 'mybooking-reservation-engine') ?> <span class="required-indicator" style="display: none;">*</span>
				</label>
				<select id="driver_driving_license_type_id" name="driver_driving_license_type_id" class="mb-form-control"></select>
			</div>
			<div class="mb-form-group mb-col-md-4">
				<label for="driver_driving_license_number">
					<?php echo esc_html_x('Driving license number', 'renting_my_reservation', 'mybooking-reservation-engine') ?> <span class="required-indicator" style="display: none;">*</span>
				</label>
				<input class="mb-form-control" id="driver_driving_license_number" name="driver_driving_license_number"
					type="text" placeholder="<?php echo esc_attr_x('Driving license number', 'renting_my_reservation', 'mybooking-reservation-engine') ?>"
					value=""
					maxlength="50">
			</div>
			<div class="mb-form-group mb-col-md-4">
				<label for="driver_driving_license_country">
					<?php echo esc_html_x('Expedition country', 'renting_my_reservation', 'mybooking-reservation-engine') ?> <span class="required-indicator" style="display: none;">*</span>
				</label>
				<select id="driver_driving_license_country" name="driver_driving_license_country" class="mb-form-control">
				</select>
			</div>                
		</div>

		<div class="mb-form-row">
			<div class="mb-form-group mb-col-md-6 js-date-select-control">
				<label for="driver_driving_license_date">
					<?php echo esc_html_x('Date of Issue', 'renting_my_reservation', 'mybooking-reservation-engine') ?> <span class="required-indicator" style="display: none;">*</span>
				</label>
				<div class="mb-form-row mb-custom-date-form">
					<div class="mb-custom-date-item">
						<select id="driver_driving_license_date_day" name="driver_driving_license_date_day"
							class="mb-form-control"></select>
					</div>
					<div class="mb-custom-date-item">
						<select id="driver_driving_license_date_month" name="driver_driving_license_date_month"
							class="mb-form-control"></select>
					</div>
					<div class="mb-custom-date-item">
						<select id="driver_driving_license_date_year" name="driver_driving_license_date_year"
							class="mb-form-control"></select>
					</div>
				</div>
				<input type="hidden" id="driver_driving_license_date" name="driver_driving_license_date">
			</div>
			<div class="mb-form-group mb-col-md-6 js-date-select-control" data-date-select-control-direction="future">
				<label for="driver_driving_license_expiration_date">
					<?php echo esc_html_x('Date of expiry', 'renting_my_reservation', 'mybooking-reservation-engine') ?> <span class="required-indicator" style="display: none;">*</span>
				</label>
				<div class="mb-form-row mb-custom-date-form">
					<div class="mb-custom-date-item">
						<select id="driver_driving_license_expiration_date_day" name="driver_driving_license_expiration_date_day"
							class="mb-form-control"></select>
					</div>
					<div class="mb-custom-date-item">
						<select id="driver_driving_license_expiration_date_month" name="driver_driving_license_expiration_date_month"
							class="mb-form-control"></select>
					</div>
					<div class="mb-custom-date-item">
						<select id="driver_driving_license_expiration_date_year" name="driver_driving_license_expiration_date_year"
							class="mb-form-control"></select>
					</div>
				</div>
				<input type="hidden" id="driver_driving_license_expiration_date" name="driver_driving_license_expiration_date">
			</div>
		</div>

		<h6>
			<?php echo esc_html_x( 'Address', 'renting_my_reservation', 'mybooking-reservation-engine') ?> <span class="required-indicator" style="display: none;">*</span>
		</h6>
		<hr />

		<!-- Reorder address fields: Country, State, City, Zip, Street, Number, Complement -->

		<div class="mb-form-row">
			<!-- Country -->
			<div class="mb-form-group mb-col-md-6">
				<label for="driver_address_country">
					<?php echo esc_html_x( 'Country', 'renting_my_reservation', 'mybooking-reservation-engine') ?> <span class="required-indicator" style="display: none;">*</span>
				</label>
				<select class="mb-form-control" id="driver_address_country" name="driver_address[country]"
					data-state-input-name="input[name='driver_address[state]']" 
					data-state-selector-name="select[name='driver_address[state_code]']"
					data-city-input-name="input[name='driver_address[city]']"
					data-city-selector-name="select[name='driver_address[city_code]']">
				</select>
			</div>
			<!-- State -->
			<div class="mb-form-group mb-col-md-6 driver_address_state_container">
				<label for="driver_address_state">
					<?php echo esc_html_x( 'State', 'renting_my_reservation', 'mybooking-reservation-engine') ?> <span class="required-indicator" style="display: none;">*</span>
				</label>
				<input type="text" class="mb-form-control driver_address_state_input" id="driver_address_state" name="driver_address[state]" placeholder="<?php echo esc_attr_x( 'State', 'renting_my_reservation', 'mybooking-reservation-engine') ?>" value="" maxlength="50">
				<select class="mb-form-control driver_address_state_select" id="driver_address_state_code" name="driver_address[state_code]" style="display: none;">
				</select>
			</div>
		</div>

		<div class="mb-form-row">
			<!-- City -->
			<div class="mb-form-group mb-col-md-6 driver_address_city_container">
				<label for="driver_address_city">
					<?php echo esc_html_x( 'City', 'renting_my_reservation', 'mybooking-reservation-engine') ?> <span class="required-indicator" style="display: none;">*</span>
				</label>
				<input type="text" class="mb-form-control driver_address_city_input" id="driver_address_city" name="driver_address[city]" placeholder="<?php echo esc_attr_x( 'City', 'renting_my_reservation', 'mybooking-reservation-engine') ?>" value="" maxlength="50">
				<select class="mb-form-control driver_address_city_select" id="driver_address_city_code" name="driver_address[city_code]" style="display: none;">
				</select>
			</div>
			<!-- Zip Code -->
			<div class="mb-form-group mb-col-md-6">
				<label for="driver_address_zip">
					<?php echo esc_html_x( 'Zip Code', 'renting_my_reservation', 'mybooking-reservation-engine') ?> <span class="required-indicator" style="display: none;">*</span>
				</label>
				<input class="mb-form-control" id="driver_address_zip" name="driver_address[zip]" type="text"
					placeholder="<?php echo esc_attr_x( 'Zip Code', 'renting_my_reservation', 'mybooking-reservation-engine') ?>"
					value="" maxlength="10">
			</div>
		</div>

		<div class="mb-form-row">
			<!-- Street -->
			<div class="mb-form-group mb-col-md-6">
				<label for="driver_address_street">
					<?php echo esc_html_x( 'Street', 'renting_my_reservation', 'mybooking-reservation-engine') ?> <span class="required-indicator" style="display: none;">*</span>
				</label>
				<input class="mb-form-control" id="driver_address_street" name="driver_address[street]" type="text"
					placeholder="<?php echo esc_attr_x( 'Street', 'renting_my_reservation', 'mybooking-reservation-engine') ?>"
					value="" maxlength="100">
			</div>
			<!-- Number -->
			<div class="mb-form-group mb-col-md-3">
				<label for="driver_address_number">
					<?php echo esc_html_x( 'Number', 'renting_my_reservation', 'mybooking-reservation-engine') ?>
				</label>
				<input class="mb-form-control" id="driver_address_number" name="driver_address[number]" type="text"
					placeholder="<?php echo esc_attr_x( 'Number', 'renting_my_reservation', 'mybooking-reservation-engine') ?>"
					value="" maxlength="20">
			</div>
			<!-- Complement -->
			<div class="mb-form-group mb-col-md-3">
				<label for="driver_address_complement">
					<?php echo esc_html_x( 'Complement', 'renting_my_reservation', 'mybooking-reservation-engine') ?>
				</label>
				<input class="mb-form-control" id="driver_address_complement" name="driver_address[complement]" type="text"
					placeholder="<?php echo esc_attr_x( 'Complement', 'renting_my_reservation', 'mybooking-reservation-engine') ?>"
					value="" maxlength="20">
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