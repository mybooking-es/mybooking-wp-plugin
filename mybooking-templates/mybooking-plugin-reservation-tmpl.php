    <!-- Reservation summary -->
    <script type="text/tmpl" id="script_reservation_summary">
      <div class="jumbotron mb-3">
        <h2 class="h3 text-center"><%= booking.summary_status %></h2>
      </div>

      <div class="row">
        <div class="col-md-4">
          <div class="card mb-3">
            <div class="card-header">
              <b>Su reserva</b>
            </div>
            <ul class="list-group list-group-flush">
              <li class="list-group-item reservation-summary-card-detail h3"><%=booking.id%></li>
              <% if (configuration.pickupReturnPlace) {%>
              <li class="list-group-item reservation-summary-card-detail"><%=booking.pickup_place_customer_translation%></li>
              <% } %>
              <li class="list-group-item reservation-summary-card-detail">
                <i class="fa fa-calendar-o"></i>&nbsp;
                <%=booking.date_from_full_format%>
                <% if (configuration.timeToFrom) { %>
                  <%=booking.time_from%>
                <% } %>  
              </li>
              <% if (configuration.pickupReturnPlace) {%>
              <li class="list-group-item reservation-summary-card-detail"><%=booking.return_place_customer_translation%></li>
              <% } %>
              <li class="list-group-item reservation-summary-card-detail">
                <i class="fa fa-calendar-o"></i>&nbsp;
                <%=booking.date_to_full_format%>
                <% if (configuration.timeToFrom) { %>
                  <%=booking.time_to%>
                <% } %> 
              </li>
              <li class="list-group-item reservation-summary-card-detail">Duración del alquiler: <%=booking.days%> día/s</li>
            </ul>
          </div>
        </div>
        
        <div class="col-md-4">
          <div class="card mb-3">
            <div class="card-header">
              <b>Datos del cliente</b>
            </div>
            <ul class="list-group list-group-flush">
              <li class="list-group-item reservation-summary-card-detail"><%=booking.customer_name%> <%=booking.customer_surname%></li>
              <li class="list-group-item reservation-summary-card-detail"><%=booking.customer_phone%> <%=booking.customer_mobile_phone%></li>
              <li class="list-group-item reservation-summary-card-detail"><%=booking.customer_email%></li>
            </ul>
          </div>

        </div>

        <div class="col-md-4">
          <div class="card mb-3">
            <div class="card-header">
              <b>Productos</b>
            </div>  
            <ul class="list-group list-group-flush">
              <% for (var idx=0;idx<booking.booking_lines.length;idx++) { %>
              <li class="list-group-item reservation-summary-card-detail">
                 <img class="product-img" style="width: 120px" src="<%=booking.booking_lines[idx].photo_medium%>"/>
                 <br>
                 <span class="product-name"><b><%=booking.booking_lines[idx].item_description_customer_translation%></b></span>
                 <% if (configuration.multipleProductsSelection) { %>
                 <span class="badge badge-info"><%=booking.booking_lines[idx].quantity%></span>
                 <% } %>
                 <span class="product-amount pull-right"><%=configuration.formatCurrency(booking.booking_lines[idx].item_cost)%></span>
              </li>
              <% } %>
            </ul>
          </div>
          <% if (booking.booking_extras.length > 0) { %>
          <div class="card mb-3">
            <div class="card-header">
              <b>Extras</b>
            </div>  
            <ul class="list-group list-group-flush">
              <% for (var idx=0;idx<booking.booking_extras.length;idx++) { %>
              <li class="list-group-item reservation-summary-card-detail">
                  <span class="extra-name"><b><%=booking.booking_extras[idx].extra_description%></b></span>
                  <span class="badge badge-info"><%=booking.booking_extras[idx].quantity%></span>
                  <span class="product-amount pull-right"><%=configuration.formatCurrency(booking.booking_extras[idx].extra_cost)%></span>
              </li>
              <% } %>       
            </ul>
          </div>
          <% } %>   
          <div class="jumbotron mb-3">
            <h2 class="h5 text-center">Importe total</h2>
            <h2 class="h3 text-center"><%=configuration.formatCurrency(booking.total_cost)%></h2>
          </div>            
        </div>
        
      </div>

      <div class="row">
        <div class="col-md-6">
          <div id="reservation_form_container" style="display:none">
        </div>
        <div class="col-md-6">
          <div id="payment_detail" class="col bg-white shadow-bottom py-3 px-3" style="display:none"></div>
        </div>
      </div>

    </script>

    <!-- Reservation form -->
    <script type="text/tmpl" id="script_reservation_form">
    </script>

    <!-- Payment detail -->
    <script type="text/tmpl" id="script_payment_detail">
      <h4 class="brand-primary my-3">Pagar</h4>
      <% if (booking.total_paid == 0) {%>
        <div id="payment_amount_container" class="alert alert-info">
          <%= i18next.t('complete.reservationForm.booking_amount', {amount:configuration.formatCurrency(booking.booking_amount) }) %>
        </div>
      <% } %>
      <form name="payment_form">
        <% if (sales_process.payment_methods.paypal_standard && sales_process.payment_methods.tpv_virtual) { %>
        <div class="form-row">
           <div class="form-group col-md-12">
             <label for="payments_paypal_standard">
              <input type="radio" name="payment_method_id" value="paypal_standard">&nbsp;Paypal
              <img src="<?php echo plugin_dir_url(__DIR__) ?>/assets/images/pm-paypal.jpg"/>
             </label>
           </div>
           <div class="form-group col-md-12">
             <label for="payments_paypal_standard">
              <input type="radio" name="payment_method_id" value="<%=sales_process.payment_methods.tpv_virtual%>">&nbsp;Tarjeta de crédito/débito
              <img src="<?php echo plugin_dir_url(__DIR__) ?>/assets/images/pm-visa.jpg"/>
              <img src="<?php echo plugin_dir_url(__DIR__) ?>/assets/images/pm-mastercard.jpg"/>
             </label>
           </div>
        </div>
        <% } else if (sales_process.payment_methods.paypal_standard) {%>
          <div class="form-row">
            <div class="form-group col-md-12">
              <img src="<?php echo plugin_dir_url(__DIR__) ?>/assets/images/pm-paypal.jpg"/>
            </div>
          </div>
          <input type="hidden" name="payment_method_id" value="paypal_standard" data-payment-method="paypal_standard">
        <% } else if (sales_process.payment_methods.tpv_virtual) {%>
          <div class="form-row">
            <div class="form-group col-md-12">
              <img src="<?php echo plugin_dir_url(__DIR__) ?>/assets/images/pm-visa.jpg"/>
              <img src="<?php echo plugin_dir_url(__DIR__) ?>/assets/images/pm-mastercard.jpg"/>
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
            <button class="btn btn-outline-dark" id="btn_pay" type="submit"><?php _e('Pagar', 'mybooking') ?></button>
          </div>
        </div>
      </div>

    </script>
    