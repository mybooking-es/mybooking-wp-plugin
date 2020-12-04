<?php
  /**
   * The Template for showing the renting complete step
   *
   * This template can be overridden by copying it to yourtheme/mybooking-templates/mybooking-plugin-complete.php
   *
   *   Areas managed by the Reservation engine
   *
   *   Container                        Script
   *   ----------------------------     ------------------------
   *   id=reservation_detail_sticky ->  script_reservation_summary_sticky
   *   id=reservation_detail        ->  script_reservation_summary
   *   id=extras_listing            ->  script_detailed_extra
   *   id=payment_detail            ->  script_payment_detail
   *
   */
?>

<div class="row">
  <aside class="col-lg-4">
    <!-- Reservation detail/summary (script_reservation_summary) -->
    <div id="reservation_detail">
    </div>
  </aside>
  <div class="col-lg-8">
    <!-- Extras Selection (script_detailed_extra) -->
    <div id="extras_listing">
    </div>
    <!-- Reservation complete -->
    <h4 class="complete-section-title"><?php echo esc_html_x( "Customer's details", 'renting_complete', 'mybooking-wp-plugin') ?></h4>
    <form id="form-reservation" name="reservation_form" autocomplete="off">

        <div class="form-group">
          <label for="customer_name"><?php echo esc_html_x( 'Name', 'renting_complete', 'mybooking-wp-plugin') ?>*</label>
          <input type="text" class="form-control" name="customer_name" id="customer_name" placeholder="<?php echo esc_attr_x( 'Name', 'renting_complete', 'mybooking-wp-plugin') ?>:*" maxlength="40">
        </div>

        <div class="form-group">
          <label for="customer_surname"><?php echo esc_html_x( 'Surname', 'renting_complete', 'mybooking-wp-plugin') ?>*</label>
          <input type="text" class="form-control" name="customer_surname" id="customer_surname" placeholder="<?php echo esc_attr_x( 'Surname', 'renting_complete', 'mybooking-wp-plugin') ?>:*" maxlength="40">
        </div>

        <div class="form-group">
          <label for="customer_email"><?php echo esc_html_x( 'E-mail', 'renting_complete', 'mybooking-wp-plugin') ?>*</label>
          <input type="text" class="form-control" name="customer_email" id="customer_email" placeholder="<?php echo esc_attr_x( 'E-mail', 'renting_complete', 'mybooking-wp-plugin') ?>:*" maxlength="50">
        </div>

        <div class="form-group">
          <label for="customer_email"><?php echo esc_html_x( 'Confirm E-mail', 'renting_complete', 'mybooking-wp-plugin') ?>*</label>
          <input type="text" class="form-control" name="confirm_customer_email" id="confirm_customer_email" placeholder="<?php echo esc_attr_x( 'Confirm E-mail', 'renting_complete', 'mybooking-wp-plugin') ?>:*" maxlength="50">
        </div>

        <div class="form-group">
            <label for="customer_phone"><?php echo esc_html_x( 'Phone number', 'renting_complete', 'mybooking-wp-plugin') ?>*</label>
            <input type="text" class="form-control" name="customer_phone" id="customer_phone" placeholder="<?php echo esc_attr_x( 'Phone number', 'renting_complete', 'mybooking-wp-plugin') ?>:*" maxlength="15">
        </div>

        <div class="form-group">
            <label for="customer_mobile_phone"><?php echo esc_html_x( 'Alternative phone number', 'renting_complete', 'mybooking-wp-plugin') ?></label>
            <input type="text" class="form-control" name="customer_mobile_phone" id="customer_mobile_phone" placeholder="<?php echo esc_attr_x( 'Alternative phone number', 'renting_complete', 'mybooking-wp-plugin') ?>:" maxlength="15">
        </div>
        <br>

        <h5 class="mb-4 complete-section-title"><?php echo esc_html_x( "Additional information", 'renting_complete', 'mybooking-wp-plugin') ?></h5>

        <div class="form-group">
          <label for="comments"><?php echo esc_html_x( 'Comments', 'renting_complete', 'mybooking-wp-plugin') ?></label>
          <textarea class="form-control" name="comments" id="comments" placeholder="<?php echo esc_attr_x( 'Comments', 'renting_complete', 'mybooking-wp-plugin') ?>"></textarea>
        </div>
        <br>

        <!-- Reservation : payment (script_payment_detail) -->
        <div id="payment_detail">
        </div>
    </form>
  </div>
</div>

<!-- Show extra detail modal -->
<div class="modal fade modal-mybooking" tabindex="-1" role="dialog" id="modalExtraDetail">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title modal-extra-detail-title"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="<?php echo esc_attr_x( 'Close', 'renting_complete', 'mybooking-wp-plugin' ); ?>">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body modal-extra-detail-content">
      </div>
    </div>
  </div>
</div>
