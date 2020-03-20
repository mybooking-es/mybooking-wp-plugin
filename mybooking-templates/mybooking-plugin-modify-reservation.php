<?php
/**
*   Renting Modify Reservation Form Template
*   -----------------------------------------
*
*   Versión: 0.0.1
*   @package WordPress
*   @subpackage Mybooking WordPress Plugin
*   @since Mybooking WordPress Plugin 0.0.1
*/
?>
<!-- Modify reservation modal -->
<div style="position:absolute">
  <div class="modal fade" 
       id="choose_productModal" tabindex="-1" role="dialog" aria-labelledby="choose_productModal"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title"><?php echo _x( 'Modify reservation', 'renting_form_modify_reservation', 'mybooking-wp-plugin') ?></h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form
            name="search_form"
            method="get"
            enctype="application/x-www-form-urlencoded"
            class="flex-form-horizontal">
          </form>
        </div>
      </div>
    </div>
  </div>
</div>