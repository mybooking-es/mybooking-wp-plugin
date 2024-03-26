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

<div class="mybooking-process-page <?php echo esc_attr( mybooking_engine_theme_align_width() )?>">
  <!-- Reservation detail sticky -->
  <div id="reservation_detail_sticky" class="sticky-top"></div>

  <section class="mybooking mybooking-process_complete mybooking-page-container">
    <!-- // Multiple products items (script_mybooking-summary_product_detail_table) -->
    <div id="mybooking_summary_product_detail_table"></div>
  
    <div class="mb-row invert">
      <div class="mybooking-sidebar mb-col-md-6 mb-col-lg-4">
        <!-- Reservation detail/summary (script_reservation_summary) -->
        <div id="reservation_detail"></div>
      </div>
      
      <div class="mb-col-md-6 mb-col-lg-8">
        <!-- Extras Selection (script_detailed_extra) -->
        <div id="extras_listing"></div>

        <!-- Reservation complete form -->
        <div class="reservation_form_container mb-section mb-panel-container">
          <form class="mybooking-form" id="form-reservation" name="reservation_form" autocomplete="off">
            <!-- Customer data -->
            <h3 class="mb-section_title complete-section-title customer_component">
              <?php echo esc_html_x( "Customer's details", 'renting_complete', 'mybooking-wp-plugin') ?>
            </h3>

            <div class="mb-form-group mb-form-row customer_component">
              <div class="mb-col-md-6 mb-col-sm-12">
                <label for="customer_name"><?php echo esc_html_x( 'Name', 'renting_complete', 'mybooking-wp-plugin') ?>*</label>
                <input class="mb-form-control" type="text" name="customer_name" id="customer_name" autocomplete="off" placeholder="<?php echo esc_attr_x( 'Name', 'renting_complete', 'mybooking-wp-plugin') ?>:*" maxlength="40">
              </div>
              <div class="mb-col-md-6 mb-col-sm-12">
                <label for="customer_surname"><?php echo esc_html_x( 'Surname', 'renting_complete', 'mybooking-wp-plugin') ?>*</label>
                <input class="mb-form-control" type="text" name="customer_surname" id="customer_surname" autocomplete="off" placeholder="<?php echo esc_attr_x( 'Surname', 'renting_complete', 'mybooking-wp-plugin') ?>:*" maxlength="40">
              </div>
            </div>

            <div class="mb-form-group mb-form-row customer_component">
              <div class="mb-col-md-6 mb-col-sm-12">
                <label for="customer_email"><?php echo esc_html_x( 'E-mail', 'renting_complete', 'mybooking-wp-plugin') ?>*</label>
                <input class="mb-form-control" type="text" name="customer_email" id="customer_email" autocomplete="off" placeholder="<?php echo esc_attr_x( 'E-mail', 'renting_complete', 'mybooking-wp-plugin') ?>:*" maxlength="50">
              </div>
              <div class="mb-col-md-6 mb-col-sm-12">
                <label for="customer_email"><?php echo esc_html_x( 'Confirm E-mail', 'renting_complete', 'mybooking-wp-plugin') ?>*</label>
                <input class="mb-form-control" type="text" name="confirm_customer_email" autocomplete="off" id="confirm_customer_email" placeholder="<?php echo esc_attr_x( 'Confirm E-mail', 'renting_complete', 'mybooking-wp-plugin') ?>:*" maxlength="50">
              </div>
            </div>

            <div class="mb-form-group mb-form-row customer_component">
              <div class="mb-col-md-6 mb-col-sm-12">
                <label for="customer_phone"><?php echo esc_html_x( 'Phone number', 'renting_complete', 'mybooking-wp-plugin') ?>*</label>
                <input class="mb-form-control" type="text" name="customer_phone" id="customer_phone" autocomplete="off" placeholder="<?php echo esc_attr_x( 'Phone number', 'renting_complete', 'mybooking-wp-plugin') ?>:*" maxlength="15">
              </div>
              <div class="mb-col-md-6 mb-col-sm-12">
                <label for="customer_mobile_phone"><?php echo esc_html_x( 'Alternative phone number', 'renting_complete', 'mybooking-wp-plugin') ?></label>
                <input class="mb-form-control" type="text" name="customer_mobile_phone" id="customer_mobile_phone" autocomplete="off" placeholder="<?php echo esc_attr_x( 'Alternative phone number', 'renting_complete', 'mybooking-wp-plugin') ?>:" maxlength="15">
              </div>
            </div>

            <br/>

            <!-- Aditional info -->
            <h3 class="mb-section_title complete-section-title">
              <?php echo esc_html_x( "Additional information", 'renting_complete', 'mybooking-wp-plugin') ?>
            </h3>

            <div class="mb-form-group mb-form-row js-mb-delivery-slot-skipper-container" style="display: none">
              <div class="mb-col-md-6 mb-col-sm-12 js-mb-delivery-slot" style="display: none">
                <label
                  for="slot_time_from"><?php echo esc_html_x( 'Select the schedule that suits your needs', 'renting_complete', 'mybooking-wp-plugin') ?></label>
                <select class="mb-form-control" id="slot_time_from" name="slot_time_from"></select>
              </div>
              <div class="mb-col-md-6 mb-col-sm-12 js-mb-optional-external-driver" style="display: none">
                <label
                  for="slot_time_from"><?php echo esc_html_x( 'Will you need a skipper?', 'renting_complete', 'mybooking-wp-plugin') ?></label>
                <select class="mb-form-control" id="with_optional_external_driver" name="with_optional_external_driver">
                  <option value=""></option>
                  <option value="false"><?php echo esc_html_x( 'No', 'renting_complete', 'mybooking-wp-plugin') ?></option>
                  <option value="true"><?php echo esc_html_x( 'Yes', 'renting_complete', 'mybooking-wp-plugin') ?></option>
                </select>
              </div>
            </div>

            <div class="mb-form-group">
              <label for="comments"><?php echo esc_html_x( 'Comments', 'renting_complete', 'mybooking-wp-plugin') ?></label>
              <textarea class="mb-form-control" name="comments" id="comments" placeholder="<?php echo esc_attr_x( 'Comments', 'renting_complete', 'mybooking-wp-plugin') ?>"></textarea>
            </div>

            <br/>

            <!-- Reservation : payment (script_payment_detail) -->
            <div id="payment_detail"></div>
          </form>
        </div>
      </div>
    </div>
  </section>
</div>

<!-- Show extra detail modal -->
<div class="mybooking mybooking-detail_modal mybooking-modal modal-mybooking" tabindex="-1" role="dialog" id="modalExtraDetail_MBM">
  <h2 class="mybooking-modal_title modal-extra-detail-title"></h2>
  <div class="mybooking-modal_body modal-extra-detail-content"></div>
</div>