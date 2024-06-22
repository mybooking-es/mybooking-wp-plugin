<?php
/**
 *   MYBOOKING ENGINE - PRODUCT SHIFT PICKER
 *   ---------------------------------------------------------------------------
 * 
 *   The Template for showing the shift picker to create a reservation
 * 
 *   This template can be overridden by copying it to your
 *   theme/mybooking-templates/mybooking-plugin-shift-picker.php
 *
 */
?>
<!-- ShiftPicker start -->
<div id="shift-picker-<?php echo isset($args['shift_picker_id']) ? esc_attr( $args['shift_picker_id'] ) : '' ?>" data-category-code="<?php echo isset($args['category_code']) ? esc_attr( $args['category_code'] ) : '' ?>"  data-sales-channel-code="<?php echo isset($args['sales_channel_code']) ? esc_attr( $args['sales_channel_code'] ) : '' ?>" data-rental-location-code="<?php echo isset($args['rental_location_code']) ? esc_attr( $args['rental_location_code'] ) : '' ?>" data-min-units="<?php echo isset($args['min_units']) ? esc_attr( $args['min_units'] ) : '' ?>" class="mybooking-rent-shift-picker-content">
		<h2 class="mb-sidebar_title">
			<?php echo esc_html_x( 'Select a shift', 'renting_shift_picker', 'mybooking-wp-plugin') ?>
		</h2>
		<p>
			<?php echo esc_html_x( 'Select the number of vehicles and the day you want to reserve to see the available shifts.', 'renting_shift_picker', 'mybooking-wp-plugin') ?>
		</p>
		<form
			name="mybooking-rent-shift-picker-form"
			method="get"
			enctype="application/x-www-form-urlencoded"
			class="mybooking-form">
			<div class="mybooking-rent-shift-picker-head">
				<div class="field">
					<label class="label">
					<?php echo esc_html_x( 'Select quantity', 'renting_shift_picker', 'mybooking-wp-plugin') ?>
					</label>
					<div class="control">
						<div class="select">
							<select class="form-control mb-form-control" name="shiftpicker-units"></select>
						</div>
					</div>
				</div>
				<div class="field">
					<label class="label">
						<?php echo esc_html_x( 'Pick a day', 'renting_shift_picker', 'mybooking-wp-plugin') ?>
					</label>
					<div class="control">
						<input type="text" class="form-control mb-form-control" name="shiftpicker-date" />
					</div>
				</div>
			</div>
			<div class="mybooking-rent-shift-picker-container">
				<div class="mybooking-shiftpicker_navigation">
					<button data-direction="back" class="mb-button navigation icon shiftpicker-arrow" disabled>
						<?php echo esc_html_x( '« Back', 'renting_shift_picker', 'mybooking-wp-plugin') ?>
					</button>
					<span class="mybooking-shiftpicker_date-selected shiftpicker-text-date"></span>
					<button data-direction="next" class="mb-button navigation icon shiftpicker-arrow">
						<?php echo esc_html_x( 'Next »', 'renting_shift_picker', 'mybooking-wp-plugin') ?>
					</button>
				</div>
				<ul class="mybooking-rent-shift-picker-container-list shiftpicker-turns list-group">
				</ul>
				<br>
				<div class="mybooking-shiftpicker_info shiftpicker-info">
				</div>
				<div class="mybooking-rent-shift-picker-container-buttons">
					<!-- // Reservation button -->
					<div class="mb-form-group">
						<input type="submit" class="mb-button block mybooking-shiftpicker_button btn btn-primary btn-block" disabled="disabled" value="<?php echo esc_html_x( 'Book it!', 'renting_shift_picker', 'mybooking-wp-plugin') ?>"  />
				 	</div>
				</div>
			</div>
		</form>
		<div class="mybooking-rent-shift-picker-error" style="display: none">
			<div class="alert alert-danger" role="alert">
				<?php echo esc_html_x( 'We are sorry, the minimum number of rentable units is higher than the maximum available.', 'renting_shift_picker', 'mybooking-wp-plugin') ?>
			</div>
		</div>
	</div>
	<!-- ShiftPicker end -->
		