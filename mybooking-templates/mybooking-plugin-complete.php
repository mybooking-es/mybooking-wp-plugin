<?php
/**
*   PLUGIN COMPLETE PAGE
*   --------------------
*
*   Versión: 0.5.5
*   @package WordPress
*   @subpackage Mybooking WordPress Plugin
*   @since Mybooking WordPress Theme 0.0.1
*
*   Areas managed by the Reservation engine
*
*   Container                        Script
*   ----------------------------     ------------------------
*   id=reservation_detail_sticky ->  script_reservation_summary_sticky 
*   id=reservation_detail        ->  script_reservation_summary
*   id=extras_listing            ->  script_detailed_extra
*   id=payment_detail            ->  script_payment_detail
*/
?>
<div class="row">
  <aside class="col-lg-4">
    <div id="reservation_detail">
    </div>
  </aside>
  <div class="col-lg-8">
    <!-- Products -->
    <!--div id="selected_product">
    </div-->
    <!-- Extras -->
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

        <!-- Reservation : payment -->
        <div id="payment_detail">
        </div>
    </form>
  </div>
  <?php mybooking_engine_get_template('mybooking-plugin-modify-reservation.php') ?>
</div>
