    <script type="text/tpml" id="script_order">

      <section class="hero is-primary">
        <div class="hero-body">
          <div class="container">
            <h1 class="title">
              <%= order.summary_status %>
            </h1>
          </div>
        </div>
      </section>

      <!-- Activities : Order page -->
      <section class="section">

        <div class="columns">
            <!-- CONTENT -->
            <div class="column is-two-thirds">
              <!-- Products -->
              <div id="selected_products">
                <% for (idx in order.items) { %>
                   <div class="columns">
                      <div class="column is-one-third">
                        <figure class="image is-4by3 is-fullwidth">
                          <img src="<%=order.items[idx].photo_full%>" alt=""/>
                        </figure>
                      </div>
                      <div class="column is-two-thirds">
                        <h3 class="has-text-weight-bold is-4"><%=order.items[idx].item_description_customer_translation%></h3>
                        <h4 class="is-5 has-text-gray"><%= configuration.formatDate(order.items[idx].date) %> <%= order.items[idx].time %></h4>
                        <hr>
                        <table class="table is-striped is-fullwidth">
                          <tbody>
                            <% for (var x=0; x<order.items[idx]['items'].length; x++) { %>
                              <tr>
                                  <td><%=order.items[idx]['items'][x].quantity %>
                                      <%=order.items[idx]['items'][x].item_price_description %> x
                                      <%=configuration.formatCurrency(order.items[idx]['items'][x].item_unit_cost) %>
                                  </td>
                                  <td class="has-text-right">
                                      <%=configuration.formatCurrency(order.items[idx]['items'][x].item_cost) %>
                                  </td>
                              </tr>
                            <% } %>    
                            <tr>
                              <td class="has-text-weight-bold">Total</td>
                              <td class="has-text-weight-bold has-text-right"><%=configuration.formatCurrency(order.items[idx]['total'])%></td>
                          </tbody>
                        </table>
                        <br>
                        <br>  
                        <div>
                          <button class="button is-danger btn-delete-shopping-cart-item is-pulled-right"
                                 data-item-id="<%=order.items[idx].item_id%>"
                                 data-date="<%=order.items[idx].date%>"
                                 data-time="<%=order.items[idx].time%>"
                                 style="position:relative;top:-50px">Eliminar</button>
                        </div>       
                      </div>  
                   </div>
                   <br>
                 <% } %>
              </div>

              <!-- Reservation data -->
              <form id="form-reservation" name="reservation_form" class="form-delivery" method="post" autocomplete="off">
              </form>

              <!-- Payment -->
              <% if (order.can_pay_deposit || order.can_pay_total)  { %>
                <br>  
                <form id="form-payment" name="payment_form" class="form-delivery" method="post" autocomplete="off">
                  <br>
                  <h3 class="is-size-4 has-text-weight-semibold has-background-warning">&nbsp;Pagar</h3>
                  
                  <input type="hidden" name="payment" value="redsys256" data-payment-method="redsys256">
                  <div class="field is-grouped">
                    <div class="control">
                      <button id="btn_reservation" type="button" class="button is-primary">Pagar</a>
                    </div>
                  </div>  
                </form>
              <% } %>

              <!-- Reservation buttons -->

              <div id="reservation_error" class="alert alert-danger" style="display:none">
              </div>

            </div>
            <!-- /CONTENT -->

            <!-- SIDEBAR -->
            <div class="column is-one-third">
              <div class="widget shadow widget-details-reservation">
                <div id="reservation_detail">

                  <div class="tile is-parent is-vertical">
                    <div class="tile is-child notification has-background-light">
                      <p class="title is-4">Detalle de la reserva</h4>

                      <div class="tile is-child notification has-background-light">
                        <p class="title is-5">Importe total</p>
                        <p class="subtitle is-3 has-text-weight-bold"><span class="is-pulled-right"><%= configuration.formatCurrency(order.total_cost)%></span></p>
                      </div>

                      <br>
                      <div class="tile is-child notification has-background-light">
                        <p class="title is-6">Total pagado</p>
                        <p class="subtitle is-4 has-text-weight-bold"><span class="is-pulled-right"><%= configuration.formatCurrency(order.total_paid)%></span></p>
                      </div>
                      <br>
                      <div class="tile is-child notification has-background-light">
                        <p class="title is-6">Total pendiente</p>
                        <p class="subtitle is-4 has-text-weight-bold"><span class="is-pulled-right"><%= configuration.formatCurrency(order.total_pending)%></span></p>
                      </div>

                    </div> 
                  </div>

                </div>
              </div>
            </div>
            <!-- /SIDEBAR -->
        </div>  
      </section>
      <!-- /Activities : Order page -->


    </script>