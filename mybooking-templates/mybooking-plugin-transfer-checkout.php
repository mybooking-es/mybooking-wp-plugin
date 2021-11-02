<?php
  /**
   * The Template for showing the transfer complete step
   *
   * This template can be overridden by copying it to yourtheme/mybooking-templates/mybooking-plugin-transfer-checkout.php
   *
   *   Areas managed by the Reservation engine
   *
   *   Container                                 Script
   *   ----------------------------              ------------------------
   *   id=mybooking_transfer_reservation_detail  ->  script_transfer_reservation_summary
   *   id=mybooking_transfer_extras_listing      ->  script_transfer_detailed_extra
   *   id=mybooking_transfer_payment_detail      ->  script_transfer_payment_detail
   *
   */
?>
<section class="mybooking mybooking-process_complete <?php echo esc_attr( mybooking_engine_theme_align_width() )?>">
  <div class="mb-row">

    <div class="mb-col-md-4 mb-col-right">

      <!-- Reservation detail/summary (script_reservation_summary) -->
      <div id="mybooking_transfer_reservation_detail"></div>
    </div>
    <div class="mb-col-md-8">

      <!-- Extras Selection (script_detailed_extra) -->
      <div id="mybooking_transfer_extras_listing">
      </div>

      <!-- Reservation complete -->
      <div class="mb-section">
        <div class="reservation_form_container">
          <h2 class="complete-section-title customer_component"><?php echo esc_html_x( "Customer's details", 'transfer_checkout', 'mybooking-wp-plugin') ?></h2>
          <form class="mybooking-form" id="mybooking_transfer_form-reservation" name="mybooking_transfer_reservation_form" autocomplete="off">

          </form>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Show extra detail modal -->
<!-- <div class="modal fade modal-mybooking" tabindex="-1" role="dialog" id="mybooking_transfer_modalExtraDetail_MBM">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title modal-extra-detail-title"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="<?php echo esc_attr_x( 'Close', 'transfer_checkout', 'mybooking-wp-plugin' ); ?>">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body modal-extra-detail-content">
      </div>
    </div>
  </div>
</div> -->
