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
<div id="shift-picker-<?php echo isset($args['shift_picker_id']) ? esc_attr( $args['shift_picker_id'] ) : '' ?>" data-category-code="<?php echo isset($args['category_code']) ? esc_attr( $args['category_code'] ) : '' ?>" data-rental-location-code="<?php echo isset($args['rental_location_code']) ? esc_attr( $args['rental_location_code'] ) : '' ?>" class="mybooking-rent-shift-picker-content">
		<form name="mybooking-rent-shift-picker-form" method="POST">
			<div class="mybooking-rent-shift-picker-head">
				<h1 class="h1">
					<?php echo esc_html_x( 'Booking a turn', 'renting_shift_picker', 'mybooking-wp-plugin') ?>
				</h1>
				<p>
					<?php echo esc_html_x( 'Select the number of vehicles and the day you want to reserve to see the available shifts.', 'renting_shift_picker', 'mybooking-wp-plugin') ?>
				</p>
				<div class="field">
					<label class="label">
					<?php echo esc_html_x( 'Select quantity', 'renting_shift_picker', 'mybooking-wp-plugin') ?>
					</label>
					<div class="control">
						<div class="select">
							<select name="shiftpicker-units">
							</select>
						</div>
					</div>
				</div>
				<div class="field">
					<label class="label">
						<?php echo esc_html_x( 'Pick a day', 'renting_shift_picker', 'mybooking-wp-plugin') ?>
					</label>
					<div class="control">
						<input type="text" name="shiftpicker-date" />
					</div>
				</div>
			</div>
			<div class="mybooking-rent-shift-picker-container">
				<div class="mybooking-rent-shift-picker-container-head">
					<span class="shiftpicker-text-date"></span>
				</div>
				<div class="mybooking-rent-shift-picker-container-arrows">
					<button data-direction="back" class="button shiftpicker-arrow" disabled>
						<i class="fa fa-arrow-left"></i>
						&nbsp;
						<?php echo esc_html_x( 'Back', 'renting_shift_picker', 'mybooking-wp-plugin') ?>
					</button>
					<button data-direction="next" class="button shiftpicker-arrow">
						<?php echo esc_html_x( 'Next', 'renting_shift_picker', 'mybooking-wp-plugin') ?>
						&nbsp;
						<i class="fa fa-arrow-right"></i>
					</button>
				</div>
				<ul class="mybooking-rent-shift-picker-container-list shiftpicker-turns">
				</ul>
				<div class="mybooking-rent-shift-picker-container-info shiftpicker-info">
				</div>
				<div class="mybooking-rent-shift-picker-container-buttons">
					<!-- // Reservation button -->
					<div class="mb-form-group">
						<input type="submit" class="button" disabled="disabled" value="<?php echo esc_html_x( 'Book it!', 'renting_shift_picker', 'mybooking-wp-plugin') ?>"  />
				 </div>
				</div>
			</div>
		</form>
	</div>
	<!-- ShiftPicker end -->
		