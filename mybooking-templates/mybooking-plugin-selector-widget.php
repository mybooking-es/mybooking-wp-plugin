<?php
/**
 *   MYBOOKING ENGINE - RENTING SELECTOR
 *   ---------------------------------------------------------------------------
 *   The Template for showing the renting complete step
 *   This template can be overridden by copying it to your
 *   theme /mybooking-templates/mybooking-plugin-selector.php
 *
 */
?>

<section class="mybooking mybooking-selector widget widget_mybooking_renting_engine_selector reservation-step <?php if ( array_key_exists('layout', $args) && $args['layout'] == 'vertical' ) : ?>mybooking-selector_vertical<?php endif;?> <?php echo esc_attr( mybooking_engine_theme_align_width() )?>">
  <form
    id="form-selector"
    class="mybooking-selector_form"
    name="widget_search_form"
    method="get"
    enctype="application/x-www-form-urlencoded">

    <?php if ( array_key_exists('sales_channel_code', $args) && $args['sales_channel_code'] != '' ) : ?>
      <input type="hidden" name="sales_channel_code" value="<?php echo esc_attr( $args['sales_channel_code'] )?>"/>
    <?php endif; ?>

    <?php if ( array_key_exists('family_id', $args) && $args['family_id'] != '' ) : ?>
      <input type="hidden" name="family_id" value="<?php echo esc_attr( $args['family_id'] )?>"/>
      <input type="hidden" name="engine_fixed_family" value="true"/>
    <?php endif; ?>

    <?php if ( array_key_exists('category_code', $args) && $args['category_code'] != '' ) : ?>
      <input type="hidden" name="category_code" value="<?php echo esc_attr( $args['category_code'] )?>"/>
      <input type="hidden" name="engine_fixed_product" value="true"/>
    <?php endif; ?>

    <?php if ( array_key_exists('rental_location_code', $args) && $args['rental_location_code'] != '' ) : ?>
      <input type="hidden" name="rental_location_code" value="<?php echo esc_attr( $args['rental_location_code'] )?>"/>
      <input type="hidden" name="engine_fixed_rental_location" value="true"/>
    <?php endif; ?>
  </form>
</section>
