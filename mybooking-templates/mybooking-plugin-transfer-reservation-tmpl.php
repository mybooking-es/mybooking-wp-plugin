<?php
  /** 
   * The Template for showing the transfer summary step - JS Microtemplates
   *
   * This template can be overridden by copying it to yourtheme/mybooking-templates/mybooking-plugin-transfer-reservation-tmpl.php
   *
   * @phpcs:disable PHPCompatibility.Miscellaneous.RemovedAlternativePHPTags.MaybeASPOpenTagFound 
   * @phpcs:disable Generic.PHP.DisallowAlternativePHPTags.MaybeASPOpenTagFound
   * @phpcs:disable Generic.PHP.DisallowAlternativePHPTags.MaybeASPShortOpenTagFound   
   */
?>
<!-- Reservation summary -->
<script type="text/tmpl" id="script_transfer_reservation_summary">

  <div class="jumbotron mb-3">
    <h2 class="h5 text-center"><%= booking.summary_status %></h2>
  </div>

  <div class="complete-reservation-summary-card ">

    <!-- Customer -->
    <div class="card mb-3">
      <div class="card-header">
        <b><?php echo esc_html_x( 'Customer', 'transfer_my_reservation', 'mybooking-wp-plugin' ) ?></b>
      </div>
      <ul class="list-group list-group-flush">
        <li class="list-group-item reservation-summary-card-detail">
           <!-- Name -->
           <span><%=booking.customer_name%> <%=booking.customer_name%></span>
        </li>
        <li class="list-group-item reservation-summary-card-detail">
           <!-- Email -->
           <span><i class="fa fa-envelope-o"></i>&nbsp;<%=booking.customer_email%></b></span>
        </li>
        <li class="list-group-item reservation-summary-card-detail">
           <!-- Email -->
           <span><i class="fa fa-phone"></i>&nbsp;<%=booking.customer_phone%></b></span>
        </li>
      </ul>
    </div>

    <!-- Information -->
    <div class="card mb-3">
      <div class="card-header">
        <b><?php echo esc_html_x( 'Reservation summary', 'transfer_my_reservation', 'mybooking-wp-plugin') ?></b>
      </div>
      <ul class="list-group list-group-flush">
        <li class="list-group-item reservation-summary-card-detail"><i class="fa fa-car"></i>&nbsp;<%=booking.origin_point_name_customer_translation%></li>
        <li class="list-group-item reservation-summary-card-detail"><i class="fa fa-map-marker"></i>&nbsp;<%=booking.destination_point_name_customer_translation%></li>
        <li class="list-group-item reservation-summary-card-detail">
          <i class="fa fa-calendar-o"></i>&nbsp;<%=booking.date%>&nbsp;<%=booking.time%>
        </li>
        <li class="list-group-item reservation-summary-card-detail">
          <i class="fa fa-user"></i>&nbsp;<%=booking.number_of_adults%>
          <i class="fa fa-child"></i>&nbsp;<%=booking.number_of_children%>
        </li>        
        <% if (booking.engine_modify_dates) { %>
          <li class="list-group-item">
            <button id="modify_reservation_button" class="btn btn-primary w-100"><?php echo esc_html_x( 'Edit', 'transfer_my_reservation', 'mybooking-wp-plugin' ) ?></button>
          </li>
        <% } %>
      </ul>
    </div>

    <!-- Product -->
    <div class="card mb-3">
      <div class="card-header">
        <b><?php echo esc_html_x( 'Vehicle', 'transfer_my_reservation', 'mybooking-wp-plugin' ) ?></b>
      </div>
      <ul class="list-group list-group-flush">
        <li class="list-group-item reservation-summary-card-detail">
           <!-- Photo -->
           <img class="product-img" style="width: 120px" src="<%=booking.item_full_photo%>"/>
           <br>
           <!-- Description -->
           <span class="h6"><b><%=booking.item_name_customer_translation%></b></span>
           <!-- Price -->             
           <span class="product-amount pull-right">
             <%=configuration.formatCurrency(booking.item_cost)%>
           </span>
        </li>
      </ul>
    </div>

    <!-- Extras -->
    <% if (booking.extras.length > 0) { %>
      <div class="card mb-3">
        <div class="card-header">
          <b><?php echo esc_html_x( 'Extras', 'transfer_my_reservation', 'mybooking-wp-plugin' ) ?></b>
        </div>
        <ul class="list-group list-group-flush">
          <% for (var idx=0;idx<booking.extras.length;idx++) { %>
          <li class="list-group-item reservation-summary-card-detail">
              <span class="extra-name"><b><%=booking.extras[idx].extra_name_customer_translation%></b></span>
              <span class="badge badge-info"><%=booking.extras[idx].quantity%></span>
              <span class="product-amount pull-right"><%=configuration.formatCurrency(booking.extras[idx].extra_cost)%></span>
          </li>
          <% } %>
        </ul>
      </div>
    <% } %>

    <!-- Total -->
    <div class="jumbotron mb-3">
      <h2 class="h5 text-center"><?php echo esc_html_x( "Total", 'transfer_my_reservation', 'mybooking-wp-plugin' ) ?></h2>
      <h2 class="h3 text-center"><%=configuration.formatCurrency(booking.total_cost)%></h2>
    </div>

    <!-- Payment -->
    <div id="transfer_payment_detail" class="col process-section-box" style="display:none">
    </div>

  </div>
</script>

<!-- Payment detail -->
<script type="text/tmpl" id="script_payment_detail">
  <hr>
  <h4 class="brand-primary my-3"><%= i18next.t('myReservation.pay.total_payment', {amount:configuration.formatCurrency(amount) }) %></h4>
  <% if (booking.total_paid == 0) {%>
    <div id="payment_amount_container" class="alert alert-info">
      <%= i18next.t('complete.reservationForm.booking_amount', {amount:configuration.formatCurrency(amount) }) %>
    </div>
  <% } %>
  <form name="payment_form">
    <% if (sales_process.payment_methods.paypal_standard && sales_process.payment_methods.tpv_virtual) { %>
    <div class="alert alert-secondary" role="alert">
      <?php echo wp_kses_post( _x( 'You will be redirected to the <b>payment platform</b> to make the confirmation payment securely. You can use <u>Paypal</u> or <u>credit card</u> to make the payment.',                           'transfer_my_reservation', 'mybooking-wp-plugin' ) )?>
    </div>        
    <div class="form-row">
       <div class="form-group col-md-12">
         <label for="payments_paypal_standard">
          <input type="radio" name="payment_method_id" value="paypal_standard">&nbsp<?php echo esc_html_x( 'Paypal', 'transfer_my_reservation', 'mybooking-wp-plugin' ) ?>
          <img src="<?php echo esc_url( plugin_dir_url(__DIR__).'/assets/images/pm-paypal.jpg') ?>"/>
         </label>
       </div>
       <div class="form-group col-md-12">
         <label for="payments_paypal_standard">
          <input type="radio" name="payment_method_id" value="<%=sales_process.payment_methods.tpv_virtual%>">&nbsp;<?php echo esc_html_x( 'Credit or debit card', 'transfer_my_reservation', 'mybooking-wp-plugin' ) ?>
          <img src="<?php echo esc_url( plugin_dir_url(__DIR__).'/assets/images/pm-visa.jpg') ?>"/>
          <img src="<?php echo esc_url( plugin_dir_url(__DIR__).'/assets/images/pm-mastercard.jpg') ?>"/>
         </label>
       </div>
    </div>
    <% } else if (sales_process.payment_methods.paypal_standard) {%>
      <div class="alert alert-secondary" role="alert">
        <?php echo wp_kses_post( _x( 'You will be redirected to <b>Paypal payment platform</b> to make the confirmation payment securely. You can use <u>Paypal</u> or <u>credit card</u> to make the payment.', 'transfer_my_reservation', 'mybooking-wp-plugin' ) )?>
      </div>     
      <div class="form-row">
        <div class="form-group col-md-12">
          <img src="<?php echo esc_url( plugin_dir_url(__DIR__).'/assets/images/pm-paypal.jpg') ?>"/>
          <img src="<?php echo esc_url( plugin_dir_url(__DIR__).'/assets/images/pm-visa.jpg') ?>"/>
          <img src="<?php echo esc_url( plugin_dir_url(__DIR__).'/assets/images/pm-mastercard.jpg') ?>"/>              
        </div>
      </div>
      <input type="hidden" name="payment_method_id" value="paypal_standard" data-payment-method="paypal_standard">
    <% } else if (sales_process.payment_methods.tpv_virtual) {%>
      <div class="alert alert-secondary" role="alert">
        <?php echo wp_kses_post( _x( 'You will be redirected to the <b>credit card payment platform</b> to make the confirmation payment securely.',
                                     'transfer_my_reservation', 'mybooking-wp-plugin' ) )?>
      </div>
      <div class="form-row">
        <div class="form-group col-md-12">
          <img src="<?php echo esc_url( plugin_dir_url(__DIR__).'/assets/images/pm-visa.jpg') ?>"/>
          <img src="<?php echo esc_url( plugin_dir_url(__DIR__).'/assets/images/pm-mastercard.jpg') ?>"/>
        </div>
      </div>

      <input type="hidden" name="payment_method_id" value="<%=sales_process.payment_methods.tpv_virtual%>"/>
    <% } %>
    <% if (sales_process.can_pay_deposit) { %>
      <input type="hidden" name="payment" value="deposit"/>
    <% } else if (booking.total_paid == 0) {%>
      <input type="hidden" name="payment" value="total"/>
    <% } else { %>
      <input type="hidden" name="payment" value="pending"/>
    <% } %>
    <div class="form-row">
      <div class="form-group col-md-12">
        <button class="btn btn-success" id="btn_pay" type="submit"><%= i18next.t('myReservation.pay.payment_button', {amount:configuration.formatCurrency(amount) }) %></button>
      </div>
    </div>
  </div>

</script>
