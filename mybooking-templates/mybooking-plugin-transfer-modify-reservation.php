<?php
/**
 *   MYBOOKING ENGINE - MODIFY TRANSFER MODAL
 *   ---------------------------------------------------------------------------
 *   The Template for showing the renting complete step
 *   This template can be overridden by copying it to your
 *   theme /mybooking-templates/mybooking-plugin-modify-reservation-tmpl.php
 *
 */
?>

<!-- MODIFY TRANSFER MODAL ------------------------------------------------------------->

<div class="mybooking mybooking-selector mybooking-detail_modal mybooking-modal modal-mybooking" tabindex="-1" role="dialog" id="mybooking_transfer_modify_reservation_modal_MBM" aria-labelledby="modifyTransferReservationModal">
  <h3 class="mybooking-modal_title"><?php echo esc_html_x( 'Modify reservation', 'renting_form_modify_reservation', 'mybooking-wp-plugin') ?></h3>
  <div class="mybooking-modal_body">
    <form
      name="mybooking_transfer_search_form"
      method="get"
      enctype="application/x-www-form-urlencoded"
      class="flex-form-horizontal">
    </form>
  </div>
</div>
