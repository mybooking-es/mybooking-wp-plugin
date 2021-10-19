<?php
/**
 *   MYBOOKING ENGINE - COMPLETE
 *   ---------------------------------------------------------------------------
 *   The Template for showing the renting complete step
 *   This template can be overridden by copying it to your
 *   theme/mybooking-templates/mybooking-plugin-complete.php
 *
 *   Areas managed by the Reservation Engine
 *
 *   Container                        Script
 *   ----------------------------     ------------------------
 *   id=reservation_detail        ->  script_reservation_summary
 *   id=extras_listing            ->  script_detailed_extra
 *   id=payment_detail            ->  script_payment_detail
 *
 */
?>

<?php $theme = wp_get_theme(); // gets the current theme
if (
  'Twenty Twenty' == $theme->name ||
  'Twenty Twenty' == $theme->parent_theme ||
  'Twenty Twenty-One' == $theme->name ||
  'Twenty Twenty-One' == $theme->parent_theme )
  {
    $alignwide = 'alignwide';
  } ?>

<section class="mybooking mybooking-process_complete <?php echo $alignwide ?>">
  <div class="mb-row">
    <div class="mb-col-md-4 mb-col-right">

      <!-- Reservation detail/summary (script_reservation_summary) -->
      <div id="reservation_detail"></div>
    </div>
    <div class="mb-col-md-8">

      <!-- Extras Selection (script_detailed_extra) -->
      <div id="extras_listing"></div>

      <!-- Reservation complete form -->
      <div class="mb-section">
        <div class="reservation_form_container">
          <h2 class="complete-section-title customer_component"><?php echo esc_html_x( "Customer's details", 'renting_complete', 'mybooking-wp-plugin') ?></h2>
          <form id="form-reservation" name="reservation_form" autocomplete="off">
            <div class="mb-form-group mb-form-row customer_component">
              <div class="mb-col-md-6 mb-col-sm-12">
                <label for="customer_name"><?php echo esc_html_x( 'Name', 'renting_complete', 'mybooking-wp-plugin') ?>*</label>
                <input type="text" class="form-control" name="customer_name" id="customer_name" autocomplete="off" placeholder="<?php echo esc_attr_x( 'Name', 'renting_complete', 'mybooking-wp-plugin') ?>:*" maxlength="40">
              </div>
              <div class="mb-col-md-6 mb-col-sm-12">
                <label for="customer_surname"><?php echo esc_html_x( 'Surname', 'renting_complete', 'mybooking-wp-plugin') ?>*</label>
                <input type="text" class="form-control" name="customer_surname" id="customer_surname" autocomplete="off" placeholder="<?php echo esc_attr_x( 'Surname', 'renting_complete', 'mybooking-wp-plugin') ?>:*" maxlength="40">
              </div>
            </div>

            <div class="mb-form-group mb-form-row customer_component">
              <div class="mb-col-md-6 mb-col-sm-12">
                <label for="customer_email"><?php echo esc_html_x( 'E-mail', 'renting_complete', 'mybooking-wp-plugin') ?>*</label>
                <input type="text" class="form-control" name="customer_email" id="customer_email" autocomplete="off" placeholder="<?php echo esc_attr_x( 'E-mail', 'renting_complete', 'mybooking-wp-plugin') ?>:*" maxlength="50">
              </div>
              <div class="mb-col-md-6 mb-col-sm-12">
                <label for="customer_email"><?php echo esc_html_x( 'Confirm E-mail', 'renting_complete', 'mybooking-wp-plugin') ?>*</label>
                <input type="text" class="form-control" name="confirm_customer_email" autocomplete="off" id="confirm_customer_email" placeholder="<?php echo esc_attr_x( 'Confirm E-mail', 'renting_complete', 'mybooking-wp-plugin') ?>:*" maxlength="50">
              </div>
            </div>

            <div class="mb-form-group mb-form-row customer_component">
              <div class="mb-col-md-6 mb-col-sm-12">
                <label for="customer_phone"><?php echo esc_html_x( 'Phone number', 'renting_complete', 'mybooking-wp-plugin') ?>*</label>
                <input type="text" class="form-control" name="customer_phone" id="customer_phone" autocomplete="off" placeholder="<?php echo esc_attr_x( 'Phone number', 'renting_complete', 'mybooking-wp-plugin') ?>:*" maxlength="15">
              </div>
              <div class="mb-col-md-6 mb-col-sm-12">
                <label for="customer_mobile_phone"><?php echo esc_html_x( 'Alternative phone number', 'renting_complete', 'mybooking-wp-plugin') ?></label>
                <input type="text" class="form-control" name="customer_mobile_phone" id="customer_mobile_phone" autocomplete="off" placeholder="<?php echo esc_attr_x( 'Alternative phone number', 'renting_complete', 'mybooking-wp-plugin') ?>:" maxlength="15">
              </div>
            </div>

            <h3 class="mb-4 complete-section-title"><?php echo esc_html_x( "Additional information", 'renting_complete', 'mybooking-wp-plugin') ?></h3>

            <div class="mb-form-group">
              <label for="comments"><?php echo esc_html_x( 'Comments', 'renting_complete', 'mybooking-wp-plugin') ?></label>
              <textarea class="form-control" name="comments" id="comments" placeholder="<?php echo esc_attr_x( 'Comments', 'renting_complete', 'mybooking-wp-plugin') ?>"></textarea>
            </div>
            <br>

            <!-- Reservation : payment (script_payment_detail) -->
            <div id="payment_detail"></div>
          </form>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Show extra detail modal -->
<div class="mybooking-modal modal-mybooking" tabindex="-1" role="dialog" id="modalExtraDetail_MBM">
  <h5 class="mb-modal-title modal-extra-detail-title"></h5>
  <hr>
  <div class="mb-modal-body modal-extra-detail-content">
  </div>
</div>
