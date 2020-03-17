<?php
/**
*   PLUGIN RENTING MODULE COMPLETE PAGE
*   -----------------------------------
*
*   Versión: 0.5.5
*   @package WordPress
*   @subpackage Mybooking WordPress Plugin
*   @since Mybooking WordPress Theme 0.0.1
*
*   Description:
*   ------------
*
*   This template renders the complete step page. It manages the following:
*
*      - Select the coverage 
*      - Select the extras
*      - Fill in the reservation from
*      - Request reservation or pay
*
*   Elements & Scripts:
*   -------------------
*
*   Container                        Script
*   ----------------------------     ---------------------------------
*   id=reservation_detail_sticky ->  script_reservation_summary_sticky 
*   id=reservation_detail        ->  script_reservation_summary
*   id=extras_listing            ->  script_detailed_extra
*   id=payment_detail            ->  script_payment_detail
*
*   Notes:
*   ------
*
*   The scripts are defined in mybooking-plugin-complete-tmpl.php
*/
?>

<!-- Complement to modify reservation dates -->
<?php if ( $args['selector_in_process'] == 'wizard' ) { ?>
  <?php mybooking_engine_get_template('mybooking-plugin-selector-wizard-container.php') ?>
<?php } else { ?>
  <?php mybooking_engine_get_template('mybooking-plugin-modify-reservation.php') ?>
<?php } ?>

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
    <h4 class="mb-2 p-4 complete-section-bg"><?php echo _x( "Customer's details", 'renting_complete', 'mybooking-wp-plugin') ?></h4>
    <form id="form-reservation" name="reservation_form" autocomplete="off">
              
        <div class="form-group">
          <label for="customer_name"><?php echo _x( 'Name', 'renting_complete', 'mybooking-wp-plugin') ?>*</label>
          <input type="text" class="form-control" name="customer_name" id="customer_name" placeholder="<?php echo _x( 'Name', 'renting_complete', 'mybooking-wp-plugin') ?>:*">
        </div>

        <div class="form-group">  
          <label for="customer_surname"><?php echo _x( 'Surname', 'renting_complete', 'mybooking-wp-plugin') ?>*</label>
          <input type="text" class="form-control" name="customer_surname" id="customer_surname" placeholder="<?php echo _x( 'Surname', 'renting_complete', 'mybooking-wp-plugin') ?>:*">
        </div>

        <div class="form-group">
          <label for="customer_email"><?php echo _x( 'E-mail', 'renting_complete', 'mybooking-wp-plugin') ?>*</label>
          <input type="text" class="form-control" name="customer_email" id="customer_email" placeholder="<?php echo _x( 'E-mail', 'renting_complete', 'mybooking-wp-plugin') ?>:*">
        </div>

        <div class="form-group">  
          <label for="customer_email"><?php echo _x( 'Confirm E-mail', 'renting_complete', 'mybooking-wp-plugin') ?>*</label>
          <input type="text" class="form-control" name="confirm_customer_email" id="confirm_customer_email" placeholder="<?php echo _x( 'Confirm E-mail', 'renting_complete', 'mybooking-wp-plugin') ?>:*">
        </div>

        <div class="form-group">
            <label for="customer_phone"><?php echo _x( 'Phone number', 'renting_complete', 'mybooking-wp-plugin') ?>*</label>
            <input type="text" class="form-control" name="customer_phone" id="customer_phone" placeholder="<?php echo _x( 'Phone number', 'renting_complete', 'mybooking-wp-plugin') ?>:*">
        </div>
        
        <div class="form-group">            
            <label for="customer_mobile_phone"><?php echo _x( 'Alternative phone number', 'renting_complete', 'mybooking-wp-plugin') ?></label>
            <input type="text" class="form-control" name="customer_mobile_phone" id="customer_mobile_phone" placeholder="<?php echo _x( 'Alternative phone number', 'renting_complete', 'mybooking-wp-plugin') ?>:">
        </div>                

        <div class="form-group">
          <label for="comments"><?php echo _x( 'Comments', 'renting_complete', 'mybooking-wp-plugin') ?></label>
          <textarea class="form-control" name="comments" id="comments" placeholder="Comentarios"></textarea>
        </div>   

        <!-- Reservation : payment (script_payment_detail) -->
        <div id="payment_detail">
        </div>
    </form>
  </div>
</div>

<!-- Show extra detail modal -->
<div class="modal" tabindex="-1" role="dialog" id="modalExtraDetail">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title modal-extra-detail-title"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body modal-extra-detail-content">
      </div>
    </div>
  </div>
</div>