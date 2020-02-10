    <!-- Microtemplates -->

    <script type="text/tpml" id="script_shopping_cart_empty">
      <div class="alert alert-warning">
        <p>El carrito de la compra está vacío</p>
      </div>
    </script>

    <script type="text/tpml" id="script_products_detail">

      <% for (idx in shopping_cart.items) { %>
          <div class="card mb-3">
            <img class="card-img-top" src="<%=shopping_cart.items[idx].photo_full%>" alt="">
            <div class="card-body">
              <h5 class="card-title"><%=shopping_cart.items[idx].item_description_customer_translation%></h5>
              <p class="card-text text-muted"><%= configuration.formatDate(shopping_cart.items[idx].date) %> <%= shopping_cart.items[idx].time %></p>
              <br>
              <div class="table-responsive">
                <table class="table">
                  <tbody>
                    <% for (var x=0; x<shopping_cart.items[idx]['items'].length; x++) { %>
                      <tr>
                          <td><%=shopping_cart.items[idx]['items'][x].quantity %>
                              <%=shopping_cart.items[idx]['items'][x].item_price_description %> x
                              <%=configuration.formatCurrency(shopping_cart.items[idx]['items'][x].item_unit_cost) %>
                          </td>
                          <td class="text-right">
                              <%=configuration.formatCurrency(shopping_cart.items[idx]['items'][x].item_cost) %>
                          </td>
                      </tr>
                    <% } %>    
                    <tr>
                      <td><strong>Total</strong></td>
                      <td class="text-right"><strong><%=configuration.formatCurrency(shopping_cart.items[idx]['total'])%></strong></td>
                  </tbody>
                </table>
              </div>
            </div>
            <div class="card-footer">
                <button class="btn btn-danger btn-delete-shopping-cart-item pull-right"
                       data-item-id="<%=shopping_cart.items[idx].item_id%>"
                       data-date="<%=shopping_cart.items[idx].date%>"
                       data-time="<%=shopping_cart.items[idx].time%>">Eliminar</button>
              </div>              

            </div>
          </div>
       <% } %>

    </script>


    <!-- Script reservation form -->

    <script type="text/tmpl" id="script_reservation_form">

        <input type="hidden" name="customer_language" value="<%=language%>"/>
    
        <!-- Reservation complete -->

        <div class="form-group">
          <label for="customer_name">Nombre*</label>
          <input type="text" class="form-control" name="customer_name" id="customer_name" placeholder="Nombre:*">
        </div>

        <div class="form-group">  
          <label for="customer_surname">Apellidos*</label>
          <input type="text" class="form-control" name="customer_surname" id="customer_surname" placeholder="Apellidos:*">
          </div>
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
      
    </script>

    <!-- Script payment -->

    <script type="text/tmpl" id="script_payment_detail">

      <div class="jumbotron mb-3">
        <h2 class="h5">Importe total <span class="pull-right"><%=configuration.formatCurrency(shopping_cart.total_cost)%></span></h2>
        <hr>
      </div>

      <input type="hidden" name="payment" value="none">

      <% if (canRequestAndPay) { %>
        <hr>
        <div class="form-row">
           <% if (shopping_cart.can_make_request) { %>
             <div class="form-group col-md-12">
               <label>
                <input type="radio" name="complete_action" value="request_reservation" class="complete_action">&nbsp;Solicitd de reserva
               </label>
             </div>
           <% } %>
           <% if (canPay) { %>
           <div class="form-group col-md-12">
             <label>
              <input type="radio" name="complete_action" value="pay_now" class="complete_action">&nbsp;Pagar ahora
             </label>
           </div>
           <% } %>
        </div>
      <% } %>

      <!-- Request reservation -->

      <% if (shopping_cart.can_make_request) { %>
      <div id="request_reservation_container" <% if (canRequestAndPay) { %>style="display:none"<%}%>>
        <div class="border p-4">
          <div class="form-row">
            <div class="form-group col-md-12">
              <label>
                <input type="checkbox" id="conditions_read_request_reservation" name="conditions_read_request_reservation">&nbsp;Acepto los términos y condiciones y la política de privacidad
              </label>
            </div>
          </div>

          <div class="form-row">
            <div class="form-group col-md-12">
              <button type="submit" class="btn btn-success w-100">Solicitud de reserva</button>
            </div>
          </div>
        </div>
      </div>
      <% } %>

      <% if (canPay) { %>

        <div id="payment_now_container" <% if (canRequestAndPay) { %>style="display:none"<%}%>>

            <div class="border p-4">
                <h4><%=i18next.t('complete.reservationForm.total_payment', {amount: configuration.formatCurrency(paymentAmount)})%></h4>
                <br>

                <!-- Payment amount -->

                <div class="alert alert-info">
                   <p><%=i18next.t('complete.reservationForm.booking_amount',{amount: configuration.formatCurrency(paymentAmount)})%></p>
                </div>

                <% if (shopping_cart.payment_methods.paypal_standard &&
                       shopping_cart.payment_methods.tpv_virtual) { %>
                    <div class="form-row">
                       <div class="form-group col-md-12">
                         <label for="payments_paypal_standard">
                          <input type="radio" id="payments_paypal_standard" name="payment_method_select" class="payment_method_select" value="paypal_standard">&nbsp;Paypal
                          <img src="<?php echo plugin_dir_url(__DIR__) ?>/assets/images/pm-paypal.jpg"/>
                         </label>
                       </div>
                       <div class="form-group col-md-12">
                         <label for="payments_credit_card">
                          <input type="radio" id="payments_credit_card" name="payment_method_select" class="payment_method_select" value="<%=shopping_cart.payment_methods.tpv_virtual%>">&nbsp;Tarjeta de crédito/débito
                          <img src="<?php echo plugin_dir_url(__DIR__) ?>/assets/images/pm-visa.jpg"/>
                          <img src="<?php echo plugin_dir_url(__DIR__) ?>/assets/images/pm-mastercard.jpg"/>
                         </label>
                       </div>
                    </div>
                    <div id="payment_method_select_error" class="form-row">
                    </div>
                <% } else if (shopping_cart.payment_methods.paypal_standard) { %>
                    <img src="<?php echo plugin_dir_url(__DIR__) ?>/assets/images/pm-paypal.jpg"/>
                    <input type="hidden" id="payment_method_value" value="paypal_standard">
                <% } else if (shopping_cart.payment_methods.tpv_virtual) { %>
                    <img src="<?php echo plugin_dir_url(__DIR__) ?>/assets/images/pm-mastercard.jpg"/>
                    <img src="<?php echo plugin_dir_url(__DIR__) ?>/assets/images/pm-visa.jpg"/>
                    <input type="hidden" id="payment_method_value" value="<%=shopping_cart.payment_methods.tpv_virtual%>">
                <% } %>

                <hr>
                <div class="form-row">
                  <div class="form-group col-md-12">
                    <label for="payments_paypal_standard">
                      <input type="checkbox" id="conditions_read_pay_now" name="conditions_read_pay_now">&nbsp;Acepto los términos y condiciones y la política de privacidad
                    </label>
                  </div>
                </div>

                <div class="form-row">
                  <div class="form-group col-md-12">
                    <button type="submit" class="btn btn-success w-100"><%=i18next.t('complete.reservationForm.payment_button',{amount: configuration.formatCurrency(paymentAmount)})%></a>
                  </div>
                </div>
            </div>

        </div>

      <% } %>  

    </script>
