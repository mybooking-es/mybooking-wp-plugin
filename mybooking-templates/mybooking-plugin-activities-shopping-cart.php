<?php
  /** 
   * The Template for showing the activity shopping cart
   *
   * This template can be overridden by copying it to yourtheme/mybooking-templates/mybooking-plugin-activities-shopping-cart.php
   *
   */
?>
    <!-- Activities : Shopping cart page -->
    <section class="section reservation-step">
      <div class="container">
        <div class="row mt-5">

          <!-- CONTENT -->
          <div class="col-md-7">
            <!-- Products -->
            <div id="selected_products"></div>
          </div>
          <!-- /CONTENT -->

          <!-- SIDEBAR -->
          <div class="col-md-5">

            <!-- Reservation form -->
            <form id="form-reservation" name="reservation_form" class="form-delivery" method="post" autocomplete="off">
              <div id="reservation_container"></div>
              <div id="reservation_detail">
              </div>
              <div id="payment_detail"></div>
            </form>
            <!-- Reservation error -->
            <div id="reservation_error" class="alert alert-danger" style="display:none">
            </div>
            <br>

          </div>
          <!-- /SIDEBAR -->
        </div>
      </div>  
    </section>
    <!-- /Activities : Shopping cart page -->