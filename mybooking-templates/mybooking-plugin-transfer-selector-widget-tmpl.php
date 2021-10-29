<?php
  /**
   * The Template for showing the transfer selector widget - JS Microtemplates
   *
   * This template can be overridden by copying it to yourtheme/mybooking-templates/mybooking-plugin-transfer-selector-widget-tmpl.php
   *
   * @phpcs:disable PHPCompatibility.Miscellaneous.RemovedAlternativePHPTags.MaybeASPOpenTagFound
   * @phpcs:disable Generic.PHP.DisallowAlternativePHPTags.MaybeASPOpenTagFound
   * @phpcs:disable Generic.PHP.DisallowAlternativePHPTags.MaybeASPShortOpenTagFound
   */
?>
<script type="text/tmpl" id="widget_transfer_form_selector_tmpl">

<div class="mybooking-selector_group">
	<div class="mybooking-selector_type">

	  <!-- // One Way -->
		<label class="mb-label">
			<input type="radio" class="mb-input_hidden" name="round_trip" value="false">
			<?php echo esc_html_x( 'One way', 'transfer_form_selector', 'mybooking-wp-plugin') ?>
		</label>

		<!-- // Round trip -->
		<label class="mb-label">
			<input type="radio" class="mb-input_hidden" name="round_trip" value="true">
			<?php echo esc_html_x( 'Round trip', 'transfer_form_selector', 'mybooking-wp-plugin') ?>
		</label>
	</div>
</div>

<div class="mybooking-selector_group">

	<!-- // GOING -->
	<div class="mybooking-selector_place">

	  <!-- // Pickup place -->
		<label for="origin_point">
		 1<?php echo esc_html_x( 'Origin', 'transfer_form_selector', 'mybooking-wp-plugin') ?>
		</label>
		<select class="mb-form-control" id="origin_point" name="origin_point_id"></select>
		<i class="mybooking-selector_field-icon fa fa-map-marker-alt"></i>
	</div>

	<div class="mybooking-selector_place">

    <!-- // Return place -->
		<label for="return_place">
			2<?php echo esc_html_x( 'Destination', 'transfer_form_selector', 'mybooking-wp-plugin' ) ?>
		</label>
		<select class="mb-form-control" id="destination_point" name="destination_point_id"></select>
		<i class="mybooking-selector_field-icon fa fa-map-marker-alt"></i>
	</div>
<!-- </div>

<div class="mybooking-selector_group"> -->

  <!-- // Date and time -->
  <div class="mybooking-selector_date">

		<!-- // Pickup date -->
    <div class="mybooking-selector_cal">
      <label for="date">
				3<?php echo esc_html_x( 'Date', 'transfer_form_selector', 'mybooking-wp-plugin') ?>
			</label>
			<input type="text" class="mb-form-control" name="date" id="date" autocomplete="off" readonly="true">
			<i class="mybooking-selector_field-icon fa fa-calendar-alt"></i>
    </div>

		<!-- // Pickup time -->
		<div class="mybooking-selector_hour">
			<label for="time">
				3<?php echo esc_html_x( 'Time', 'transfer_form_selector', 'mybooking-wp-plugin') ?>
			</label>
			<select class="mb-form-control" name="time" id="time"></select>
			<i class="mybooking-selector_field-icon fa fa-clock"></i>
		</div>
  </div>
</div>

<!-- // <%= if(configuration.transfer_allow_select_return_origin_destination) {} %> -->
<div class="mybooking-selector_group">

	<!-- Return -->
	<div id="return_block" class="mybooking-selector_transfers-return" style="display:none">

	  <!-- Origin and Return Points -->
	  <div class="flex-form-group" id="return_origin_destination_block" style="display: none">

	    <div class="mybooking-selector_place">
        <label for="origin_point">
					4<?php echo esc_html_x( 'Return Origin', 'transfer_form_selector', 'mybooking-wp-plugin') ?>
				</label>
				<select class="mb-form-control" id="return_origin_point" name="return_origin_point_id"></select>
	    </div>

	    <div class="mybooking-selector_place">
	      <label for="return_place">
					5<?php echo esc_html_x( 'Return Destination', 'transfer_form_selector', 'mybooking-wp-plugin' ) ?>
				</label>
				<select class="mb-form-control" id="return_destination_point" name="return_destination_point_id"></select>
	    </div>
	  </div>

		<!-- // Date and time -->
	  <div class="mybooking-selector_date">

			<!-- // Return date -->
	    <div class="mybooking-selector_cal">
	      <label for="date">
					4<?php echo esc_html_x( 'Return Date', 'transfer_form_selector', 'mybooking-wp-plugin') ?>
				</label>
				<input type="text" class="mb-form-control" name="return_date" id="return_date" autocomplete="off" readonly="true">
				<i class="mybooking-selector_field-icon fa fa-calendar-alt"></i>
	    </div>

			<!-- // Return time -->
			<div class="mybooking-selector_hour">
				<label for="time">
					4<?php echo esc_html_x( 'Time', 'transfer_form_selector', 'mybooking-wp-plugin') ?>
				</label>
				<select class="mb-form-control" name="return_time" id="return_time"></select>
				<i class="mybooking-selector_field-icon fa fa-clock"></i>
			</div>
	  </div>
	</div>
</div>

<!-- // FOOTER -->

<div class="mybooking-selector_group mybooking-selector_footer">

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
	<input class="mb-button mybooking-selector_button" type="submit" value="<?php echo esc_attr_x( 'Find transfer', 'transfer_form_selector', 'mybooking-wp-plugin') ?>" />
</div>

</script>
