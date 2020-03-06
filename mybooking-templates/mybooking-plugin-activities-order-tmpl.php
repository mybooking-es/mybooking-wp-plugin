    <script type="text/tpml" id="script_order">

      <!-- Status -->

      <div class="jumbotron">
        <h1 class="display-6 text-center"><%= order.summary_status %></h1>
      </div>

      <section class="section">
        <div class="container">
          <div class="row mt-5">
            <div class="col-md-7">
              <!-- Products -->
              <div id="selected_products">
              <% for (idx in order.items) { %>
                  <div class="card mb-3">
                    <img class="card-img-top" src="<%=order.items[idx].photo_full%>" alt="">
                    <div class="card-body">
                      <h5 class="card-title"><%=order.items[idx].item_description_customer_translation%></h5>
                      <p class="card-text text-muted"><%= configuration.formatDate(order.items[idx].date) %> <%= order.items[idx].time %></p>
                      <br>
                      <div class="table-responsive">
                        <table class="table">
                          <tbody>
                            <% for (var x=0; x<order.items[idx]['items'].length; x++) { %>
                              <tr>
                                  <td><%=order.items[idx]['items'][x].quantity %>
                                      <%=order.items[idx]['items'][x].item_price_description %> x
                                      <%=configuration.formatCurrency(order.items[idx]['items'][x].item_unit_cost) %>
                                  </td>
                                  <td class="text-right">
                                      <%=configuration.formatCurrency(order.items[idx]['items'][x].item_cost) %>
                                  </td>
                              </tr>
                            <% } %>    
                            <tr>
                              <td><strong>Total</strong></td>
                              <td class="text-right"><strong><%=configuration.formatCurrency(order.items[idx]['total'])%></strong></td>
                          </tbody>
                        </table>
                      </div>
                    </div>
                  </div>
               <% } %>
              </div>
            </div>
            <!-- /CONTENT -->

            <!-- SIDEBAR -->
            <div class="col-md-5">

              <div class="card mb-3">
                <div class="card-header">
                  <%=order.customer_name%> <%=order.customer_surname%>
                </div>
                <ul class="list-group list-group-flush">
                  <li class="list-group-item"><%=order.customer_email%></li>
                  <li class="list-group-item"><%=order.customer_phone%></li>
                </ul>
              </div>

              <div class="jumbotron mb-3">
                <h2 class="h5">Importe total <span class="pull-right"><%=configuration.formatCurrency(order.total_cost)%></span></h2>
                <hr>
                <p class="lead">Pagado <span class="pull-right"><%=configuration.formatCurrency(order.total_paid)%></span></p>
                <p class="lead">Pendiente <span class="pull-right"><%=configuration.formatCurrency(order.total_pending)%></span></p>
              </div>


              <% if (canPay && paymentAmount > 0) { %>

                <form name="payment_form">  
                  <div id="payment_now_container">

                      <div class="border p-4">
                          <h4><%=i18next.t('complete.reservationForm.total_payment', {amount: configuration.formatCurrency(paymentAmount)})%></h4>
                          <br>

                          <!-- Payment amount -->

                          <div class="alert alert-info">
                             <p><%=i18next.t('complete.reservationForm.booking_amount',{amount: configuration.formatCurrency(paymentAmount)})%></p>
                          </div>

                          <% if (order.payment_methods.paypal_standard &&
                                 order.payment_methods.tpv_virtual) { %>
                              <div class="form-row">
                                 <div class="form-group col-md-12">
                                   <label for="payments_paypal_standard">
                                    <input type="radio" id="payments_paypal_standard" name="payment_method_value" class="payment_method_select" value="paypal_standard">&nbsp;Paypal
                                    <img src="<?php echo plugin_dir_url(__DIR__) ?>/assets/images/pm-paypal.jpg"/>
                                   </label>
                                 </div>
                                 <div class="form-group col-md-12">
                                   <label for="payments_credit_card">
                                    <input type="radio" id="payments_credit_card" name="payment_method_value" class="payment_method_select" value="<%=order.payment_methods.tpv_virtual%>">&nbsp;Tarjeta de crédito/débito
                                    <img src="<?php echo plugin_dir_url(__DIR__) ?>/assets/images/pm-visa.jpg"/>
                                    <img src="<?php echo plugin_dir_url(__DIR__) ?>/assets/images/pm-mastercard.jpg"/>
                                   </label>
                                 </div>
                              </div>
                              <div id="payment_method_select_error" class="form-row">
                              </div>
                          <% } else if (order.payment_methods.paypal_standard) { %>
                              <img src="<?php echo plugin_dir_url(__DIR__) ?>/assets/images/pm-paypal.jpg"/>
                              <input type="hidden" name="payment_method_value" value="paypal_standard">
                          <% } else if (order.payment_methods.tpv_virtual) { %>
                              <img src="<?php echo plugin_dir_url(__DIR__) ?>/assets/images/pm-mastercard.jpg"/>
                              <img src="<?php echo plugin_dir_url(__DIR__) ?>/assets/images/pm-visa.jpg"/>
                              <input type="hidden" name="payment_method_value" value="<%=order.payment_methods.tpv_virtual%>">
                          <% } %>

                          <hr>

                          <div class="form-row">
                            <div class="form-group col-md-12">
                              <button type="submit" class="btn btn-success w-100"><%=i18next.t('complete.reservationForm.payment_button',{amount: configuration.formatCurrency(paymentAmount)})%></a>
                            </div>
                          </div>
                      </div>

                  </div>

                  <div id="payment_error" class="alert alert-danger mt-1" style="display:none">
                  </div>

                </form>

              <% } %>  

            </div>
          </div>
        </div>
      </section>


    </script>