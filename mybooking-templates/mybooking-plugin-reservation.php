<?php
/**
 *   MYBOOKING ENGINE - MY RESERVATION
 *   ---------------------------------------------------------------------------
 *   The Template for showing the renting reservation step
 *   This template can be overridden by copying it to your theme
 *   /mybooking-templates/mybooking-plugin-reservation.php
 */
?>

<div class="mybooking-process-page <?php echo esc_attr( mybooking_engine_theme_align_width() )?>">
  <section class="mybooking mybooking-process_reservation mybooking-page-container">
    <!-- Reservation steps -->
    <div id="mybooking_reservation_steps"></div>
    <!-- // Multiple products items (script_mybooking-summary_product_detail_table) -->
    <div id="mybooking_summary_product_detail_table"></div>

    <!-- Reservation summary -->
    <div id="reservation_detail"></div>
  </section>
</div>

<!-- Modal ------------------------------------------------------------>

<div class="mybooking mybooking-detail_modal mybooking-modal modal-mybooking" tabindex="-1" role="dialog" id="modalSignatureValidation_MBM">
  <h3 class="mybooking-modal_title mb-modal_title"></h3>
  <div class="mybooking-modal_body mb-modal_body"></div>
</div>
