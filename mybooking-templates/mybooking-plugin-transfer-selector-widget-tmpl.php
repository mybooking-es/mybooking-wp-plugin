<?php
/**
 *   MYBOOKING ENGINE - TRANSFER SELECTOR TEMPLATES
 *   ---------------------------------------------------------------------------
 *   The Template for showing the renting complete step
 *   This template can be overridden by copying it to your
 *   theme /mybooking-templates/mybooking-plugin-transfer-selector-widget-tmpl.php
 *
 * @phpcs:disable PHPCompatibility.Miscellaneous.RemovedAlternativePHPTags.MaybeASPOpenTagFound
 * @phpcs:disable Generic.PHP.DisallowAlternativePHPTags.MaybeASPOpenTagFound
 * @phpcs:disable Generic.PHP.DisallowAlternativePHPTags.MaybeASPShortOpenTagFound
 */
?>

<script type="text/tmpl" id="widget_transfer_form_selector_tmpl">

<div class="mybooking-selector_transfers-group">
	<div class="mybooking-selector_type">

	  <!-- // One Way -->
		<label class="mb-custom-label">
			<input type="radio" class="mb-input_hidden" name="round_trip" value="false" checked>
			<?php echo esc_html_x( 'One way', 'transfer_form_selector', 'mybooking-wp-plugin') ?>
		</label>

		<!-- // Round trip -->
		<label class="mb-custom-label">
			<input type="radio" class="mb-input_hidden" name="round_trip" value="true">
			<?php echo esc_html_x( 'Round trip', 'transfer_form_selector', 'mybooking-wp-plugin') ?>
		</label>
	</div>
</div>

<br />

<div class="mybooking-selector_transfers-group">

	<!-- // GOING -->

	<div class="mybooking-selector_transfers-destination">

		<!-- // Pickup place -->
		<div class="mybooking-selector_place">
			<i class="mybooking-selector_field-icon">
				<span class="dashicons dashicons-location"></span>
			</i>
			<label for="origin_point">
				<?php echo esc_html_x( 'Origin', 'transfer_form_selector', 'mybooking-wp-plugin') ?>
			</label>
			<select class="mb-form-control" id="origin_point" name="origin_point_id"></select>
		</div>

		<!-- // Return place -->
		<div class="mybooking-selector_place">
			<i class="mybooking-selector_field-icon">
				<span class="dashicons dashicons-location"></span>
			</i>
			<label for="return_place">
				<?php echo esc_html_x( 'Destination', 'transfer_form_selector', 'mybooking-wp-plugin' ) ?>
			</label>
			<select class="mb-form-control" id="destination_point" name="destination_point_id"></select>
		</div>
	</div>


  <!-- // Date and time -->
  <div class="mybooking-selector_date">

		<!-- // Pickup date -->
    <div class="mybooking-selector_cal">
			<i class="mybooking-selector_field-icon">
				<span class="dashicons dashicons-calendar-alt"></span>
			</i>
      <label for="date">
				<?php echo esc_html_x( 'Date', 'transfer_form_selector', 'mybooking-wp-plugin') ?>
			</label>
			<input type="text" class="mb-form-control" name="date" id="date" autocomplete="off" readonly="true">
    </div>

		<!-- // Pickup time -->
		<div class="mybooking-selector_hour">
			<i class="mybooking-selector_field-icon">
				<span class="dashicons dashicons-clock"></span>
			</i>
			<label for="time">
				<?php echo esc_html_x( 'Time', 'transfer_form_selector', 'mybooking-wp-plugin') ?>
			</label>
			<select class="mb-form-control" name="time" id="time"></select>
		</div>
  </div>

  <% if (!configuration.transfer_allow_select_return_origin_destination) { %>
		<!-- // Date and time -->
	  <div id="return_block" class="mybooking-selector_date mybooking-selector_transfers-group" style="display:none">

			<div class="mybooking-selector_return">
				<!-- // Return date -->
				<div class="mybooking-selector_cal">
					<i class="mybooking-selector_field-icon">
						<span class="dashicons dashicons-calendar-alt"></span>
					</i>
					<label for="date">
						<?php echo esc_html_x( 'Return Date', 'transfer_form_selector', 'mybooking-wp-plugin') ?>
					</label>
					<input type="text" class="mb-form-control" name="return_date" id="return_date" autocomplete="off" readonly="true">
				</div>

				<!-- // Return time -->
				<div class="mybooking-selector_hour">
					<i class="mybooking-selector_field-icon">
						<span class="dashicons dashicons-clock"></span>
					</i>
					<label for="time">
						<?php echo esc_html_x( 'Time', 'transfer_form_selector', 'mybooking-wp-plugin') ?>
					</label>
					<select class="mb-form-control" name="return_time" id="return_time"></select>
				</div>
		</div>
	  </div>

  <% } %>

</div>

<% if (configuration.transfer_allow_select_return_origin_destination) { %>
	<div id="return_block" class="mybooking-selector_transfers-group" style="display:none">

		<!-- // RETURN -->
	  <div class="mybooking-selector_transfers-destination" id="return_origin_destination_block" style="display: none">

			<!-- // Origin point -->
			<div class="mybooking-selector_place">
				<i class="mybooking-selector_field-icon">
					<span class="dashicons dashicons-location"></span>
				</i>
        <label for="origin_point">
					<?php echo esc_html_x( 'Return Origin', 'transfer_form_selector', 'mybooking-wp-plugin') ?>
				</label>
				<select class="mb-form-control" id="return_origin_point" name="return_origin_point_id"></select>
	    </div>

			<!-- // Return point -->
	    <div class="mybooking-selector_place">
				<i class="mybooking-selector_field-icon">
					<span class="dashicons dashicons-location"></span>
				</i>
	      <label for="return_place">
					<?php echo esc_html_x( 'Return Destination', 'transfer_form_selector', 'mybooking-wp-plugin' ) ?>
				</label>
				<select class="mb-form-control" id="return_destination_point" name="return_destination_point_id"></select>
	    </div>
	  </div>

		<!-- // Date and time -->
	  <div class="mybooking-selector_return">

			<!-- // Return date -->
	    <div class="mybooking-selector_cal">
				<i class="mybooking-selector_field-icon">
					<span class="dashicons dashicons-calendar-alt"></span>
				</i>
	      <label for="date">
					<?php echo esc_html_x( 'Return Date', 'transfer_form_selector', 'mybooking-wp-plugin') ?>
				</label>
				<input type="text" class="mb-form-control" name="return_date" id="return_date" autocomplete="off" readonly="true">
	    </div>

			<!-- // Return time -->
			<div class="mybooking-selector_hour">
				<i class="mybooking-selector_field-icon">
					<span class="dashicons dashicons-clock"></span>
				</i>
				<label for="time">
					<?php echo esc_html_x( 'Time', 'transfer_form_selector', 'mybooking-wp-plugin') ?>
				</label>
				<select class="mb-form-control" name="return_time" id="return_time"></select>
			</div>
	  </div>
	</div>

<% } %>

<!-- // FOOTER -->

<div class="mybooking-selector_transfers-group mybooking-selector_footer">

  <!-- // Seats -->
  <div class="mybooking-selector_seats">

		<!-- //Adults -->
		<div class="mybooking-selector_seats-item">
			<label for="origin_point"><?php echo esc_html_x( 'Adults', 'transfer_form_selector', 'mybooking-wp-plugin') ?></label>
			<input type="number" class="" name="number_of_adults" id="number_of_adults" value="1">
		</div>

    <!-- // Children -->
		<div class="mybooking-selector_seats-item">
			<label for="return_place"><?php echo esc_html_x( 'Children', 'transfer_form_selector', 'mybooking-wp-plugin' ) ?></label>
			<input type="number" class="" name="number_of_children" id="number_of_children" value="0">
		</div>

    <!-- // Infants -->
		<div class="mybooking-selector_seats-item">
	    <label for="return_place"><?php echo esc_html_x( 'Infants', 'transfer_form_selector', 'mybooking-wp-plugin' ) ?></label>
			<input type="number" class="" name="number_of_infants" id="number_of_infants" value="0">
		</div>
	</div>

	<!-- // Search button -->
	<div class="mybooking-selector_button-box">
		<label>&nbsp;</label>
		<input class="mb-button mybooking-selector_button" type="submit" value="<?php echo esc_attr_x( 'Find transfer', 'transfer_form_selector', 'mybooking-wp-plugin') ?>" />
	</div>
</div>

</script>
