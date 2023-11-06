<?php
/**
 *   MYBOOKING ENGINE - ACTIVITIES SHOPPING CART
 *   ---------------------------------------------------------------------------
 *   The Template for showing the renting select product step
 *   This template can be overridden by copying it to your
 *   theme /mybooking-templates/mybooking-plugin-activities-shopping-cart.php
 *
 */
?>
<div class="mybooking-process-page">
<section class="mybooking mybooking-page-container mybooking-activity_complete <?php echo esc_attr( mybooking_engine_theme_align_width() )?>">
  <div class="mb-row invert">

    <!-- Selected products -->
    <div class="mybooking-sidebar mb-col-md-6 mb-col-lg-4">
      <div id="selected_products"></div>
    </div>

    <!-- Reservation form -->
    <div class="mb-col-md-6 mb-col-lg-8">
      <form id="form-reservation" name="reservation_form" class="form-delivery mybooking-form" method="post" autocomplete="off">
        <div id="reservation_container"></div>
        <div id="reservation_detail"></div>
        <div id="payment_detail"></div>
      </form>

      <!-- Reservation error -->
      <div class="mb-col-md-12" style="padding: 0;">
        <div id="reservation_error" class="mb-alert danger" style="display:none"></div>
        <div id="shopping_cart_empty"></div>
      </div>
    </div>
</section>
</div>
