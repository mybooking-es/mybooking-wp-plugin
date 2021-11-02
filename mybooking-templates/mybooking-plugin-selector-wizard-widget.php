<?php
  /**
   * The Template for showing the renting selector widget
   *
   * This template can be overridden by copying it to yourtheme/mybooking-templates/mybooking-plugin-wizard-widget.php
   */
?>

<section class="mybooking mybooking-selector <?php echo esc_attr( mybooking_engine_theme_align_width() )?>">

  <!-- Search form -->

    <form name="wizard_search_form" class="mybooking-selector_form">
      <div class="mybooking-selector_group mb-inline">

        <!-- Pickup -->
        <div class="mybooking-selector_wizard-field">
          <i class="mybooking-selector_field-icon">
						<span class="dashicons dashicons-location"></span>
					</i>
          <label for="place_holder">
            <?php echo esc_html_x( 'Where?', 'renting_form_selector_wizard', 'mybooking-wp-plugin') ?>
          </label>
          <input type="text" class="mb-form-control" id="place_holder" aria-describedby="pickupPlaceHolder" placeholder="<?php echo esc_attr_x( 'Select a location', 'renting_form_selector_wizard', 'mybooking-wp-plugin') ?>" readonly="true">
        </div>

        <!-- Date -->
        <div class="mybooking-selector_wizard-field">
          <i class="mybooking-selector_field-icon">
						<span class="dashicons dashicons-calendar-alt"></span>
					</i>
          <label for="from_holder">
            <?php echo esc_html_x( 'When?', 'renting_form_selector_wizard', 'mybooking-wp-plugin') ?>
          </label>
          <input type="text" class="mb-form-control" id="from_holder" aria-describedby="FromHolder" placeholder="<?php echo esc_attr_x( 'Select dates', 'renting_form_selector_wizard', 'mybooking-wp-plugin') ?>" readonly="true">
        </div>
        <input  class="mb-button mybooking-selector_button" id="btn_reservation" type="submit" value="<?php echo esc_attr_x( 'Book', 'renting_form_selector_wizard', 'mybooking-wp-plugin') ?>">
      </div>

      <input type="hidden" name="pickup_place">
      <input type="hidden" name="return_place">
      <input type="hidden" name="date_from">
      <input type="hidden" name="time_from">
      <input type="hidden" name="time_to">

      <?php if ( array_key_exists('sales_channel_code', $args) && $args['sales_channel_code'] != '' ) : ?>
        <input type="hidden" name="sales_channel_code" value="<?php echo esc_attr( $args['sales_channel_code'] )?>" />
      <?php endif; ?>

      <?php if ( array_key_exists('family_id', $args) && $args['family_id'] != '' ) : ?>
        <input type="hidden" name="family_id" value="<?php echo esc_attr(  $args['family_id'] )?>" />
      <?php endif; ?>

      <?php if ( array_key_exists('rental_location_code', $args) && $args['rental_location_code'] != '' ) : ?>
        <input type="hidden" name="rental_location_code" value="<?php echo esc_attr( $args['rental_location_code'] )?>"/>
      <?php endif; ?>
    </form>
</section>
