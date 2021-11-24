<?php
/**
 *   MYBOOKING ENGINE - TRANSFER SELECTOR
 *   ---------------------------------------------------------------------------
 *   The Template for showing the renting complete step
 *   This template can be overridden by copying it to your
 *   theme /mybooking-templates/mybooking-plugin-transfer-selector-widget.php
 *
 */
?>

<section class="mybooking mybooking-selector mybooking-selector_transfer widget widget_mybooking_engine_transfer_selector widget_mybooking_rent_engine_selector has-background-grey-lighter <?php if ( array_key_exists('layout', $args) && $args['layout'] == 'vertical' ) : ?>mybooking-selector_vertical<?php endif;?>   <?php echo esc_attr( mybooking_engine_theme_align_width() )?>">
  <form
    class="mybooking-selector_form"
    name="mybooking_widget_transfer_search_form"
    method="get"
    enctype="application/x-www-form-urlencoded">
  </form>
</section>
