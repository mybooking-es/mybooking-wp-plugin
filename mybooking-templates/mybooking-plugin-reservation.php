<?php
/**
 *   MYBOOKING ENGINE - MY RESERVATION
 *   ---------------------------------------------------------------------------
 *   The Template for showing the renting summary step
 *   This template can be overridden by copying it to your theme
 *   /mybooking-templates/mybooking-plugin-summary.php
 */
?>

<div class="mybooking-process-page <?php echo esc_attr( mybooking_engine_theme_align_width() )?>">
  <section class="mybooking mybooking-process_reservation mybooking-page-container">
    <div class="mb-row">

      <!-- Reservation summary -->
      <div class="mb-col-md-12" id="reservation_detail"></div>
    </div>
  </section>
</div>

<!-- Modal ------------------------------------------------------------>

<div class="mybooking mybooking-detail_modal mybooking-modal modal-mybooking" tabindex="-1" role="dialog" id="modalSignatureValidation_MBM">
  <h3 class="mybooking-modal_title mb-modal_title"></h3>
  <div class="mybooking-modal_body mb-modal_body"></div>
</div>

