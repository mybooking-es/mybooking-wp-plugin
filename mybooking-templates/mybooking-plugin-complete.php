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

<!-- Modify reservation wizard : take into account the theme due to HTML elements -->
<?php mybooking_engine_get_template('mybooking-plugin-selector-wizard-container.php') ?>

<!-- Modify reservation form -->
<?php mybooking_engine_get_template('mybooking-plugin-modify-reservation.php') ?>

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
    <h4 class="mb-2 p-4 complete-section-bg">Datos del cliente</h4>
    <form id="form-reservation" name="reservation_form" autocomplete="off">
              
        <div class="form-group">
          <label for="customer_name">Nombre*</label>
          <input type="text" class="form-control" name="customer_name" id="customer_name" placeholder="Nombre:*">
        </div>

        <div class="form-group">  
          <label for="customer_surname">Apellidos*</label>
          <input type="text" class="form-control" name="customer_surname" id="customer_surname" placeholder="Apellidos:*">
        </div>

        <div class="form-group">
          <label for="customer_email">Correo electrónico*</label>
          <input type="text" class="form-control" name="customer_email" id="customer_email" placeholder="Correo electrónico:*">
        </div>

        <div class="form-group">  
          <label for="customer_email">Confirmar correo electrónico*</label>
          <input type="text" class="form-control" name="confirm_customer_email" id="confirm_customer_email" placeholder="Confirmar correo electrónico:*">
        </div>

        <div class="form-group">
            <label for="customer_phone">Teléfono*</label>
            <input type="text" class="form-control" name="customer_phone" id="customer_phone" placeholder="Teléfono:*">
        </div>
        
        <div class="form-group">            
            <label for="customer_mobile_phone">Teléfono alternativo</label>
            <input type="text" class="form-control" name="customer_mobile_phone" id="customer_mobile_phone" placeholder="Teléfono alternativo:">
        </div>                

        <div class="form-group">
          <label for="comments">Comentarios</label>
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