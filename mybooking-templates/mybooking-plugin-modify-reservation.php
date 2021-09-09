<?php
  /** 
   * The Template for showing the renting modify reservation form
   *
   * This template can be overridden by copying it to yourtheme/mybooking-templates/mybooking-plugin-modify-reservation.php
   *
   */
?>
<!-- Modify reservation modal -->
<div class="mybooking-modal mybooking-modal-lg modal-mybooking" tabindex="-1" role="dialog" id="modify_reservation_modal_MBM">
  <h3 class="mb-modal-title"><?php echo esc_html_x( 'Modify reservation', 'renting_form_modify_reservation', 'mybooking-wp-plugin') ?></h3>
  <hr>
  <div class="mb-modal-body">
    <form
      name="search_form"
      method="get"
      enctype="application/x-www-form-urlencoded"
      class="flex-form-horizontal">
    </form>    
  </div>
</div>

