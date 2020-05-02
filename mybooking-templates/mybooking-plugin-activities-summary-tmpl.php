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
                      <% if (order.allow_select_places_for_reservation || order.use_rates) { %>
                        <br>
                        <div class="table-responsive">
                          <table class="table">
                            <tbody>
                              <% if (order.allow_select_places_for_reservation) { %>
                                <% if (order.use_rates) { %>
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
                                <% } else { %>
                                  <% for (var x=0; x<order.items[idx]['items'].length; x++) { %>
                                    <tr>
                                        <td><%=order.items[idx]['items'][x].quantity %>
                                            <%=order.items[idx]['items'][x].item_price_description %> 
                                        </td>
                                    </tr>
                                  <% } %>  
                                <% } %>
                              <% } %>   
                              <% if (order.use_rates) { %> 
                                <!-- Show the total -->
                                <tr>
                                  <td><strong><?php echo _x( 'Total', 'activity_order_item', 'mybooking-wp-plugin' ) ?></strong></td>
                                  <td class="text-right"><strong><%=configuration.formatCurrency(order.items[idx]['total'])%></strong></td>
                                </tr>
                              <% } %>
                            </tbody>
                          </table>
                        </div>
                      <% } %>
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
              <% if (order.use_rates) { %>
                <div class="jumbotron mb-3">
                  <h2 class="h5"><?php echo _x( 'Total', 'activity_summary', 'mybooking-wp-plugin' ) ?> <span class="pull-right"><%=configuration.formatCurrency(order.total_cost)%></span></h2>
                  <hr>
                  <p class="lead"><?php echo _x( 'Paid', 'activity_summary', 'mybooking-wp-plugin' ) ?> <span class="pull-right"><%=configuration.formatCurrency(order.total_paid)%></span></p>
                  <p class="lead"><?php echo _x( 'Pending', 'activity_summary', 'mybooking-wp-plugin' ) ?> <span class="pull-right"><%=configuration.formatCurrency(order.total_pending)%></span></p>
                </div>
              <% } %>
            </div>
          </div>
        </div>
      </section>


    </script>