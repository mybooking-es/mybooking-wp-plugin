    <script type="text/tmpl" id="form_calendar_selector_tmpl">
            <% if (configuration.pickupReturnPlace) { %> 
              <!-- Delivery -->
              <div class="form-group">
                <select id="pickup_place" name="pickup_place" 
                        placeholder="<?php echo _x( 'Select pick-up place', 'renting_product_calendar', 'mybooking-wp-plugin') ?>" class="form-control w-100"> </select>
                </select>
              </div>
              <!-- Collection -->
              <div class="form-group">
                <select id="return_place" name="return_place" 
                        placeholder="<?php echo _x( 'Select return place', 'renting_product_calendar', 'mybooking-wp-plugin' ) ?>" class="form-control w-100" disabled> </select>
                </select>
              </div>
            <% } %>

            <!-- Date Selector -->            
            <div class="form-group">
              <input id="date" type="hidden" name="date"/>
              <div id="date-container" class="disabled-picker"></div>
            </div>

            <% if (configuration.timeToFrom) { %>
              <!-- Delivery time -->
              <div class="form-group">
                <select id="time_from" name="time_from" 
                        placeholder="hh:mm" class="form-control" disabled> </select>
                </select>
              </div>
              <!-- Collection time -->
              <div class="form-group">
                <select id="time_to" name="time_to" 
                        placeholder="hh:mm" class="form-control" disabled> </select>
                </select>
              </div>
            <% } else { %>
              <input type="hidden" name="time_from" value="<%=configuration.defaultTimeStart%>"/>
              <input type="hidden" name="time_to" value="<%=configuration.defaultTimeEnd%>"/>   
            <% } %>  

            <div id="reservation_detail" class="form-group">
            </div>
   
    </script>

    <script type="text/tmpl" id="script_reservation_summary">
        <hr>
        <% if (product_available) { %>
          <div class="jumbotron mb-3">
            <h2 class="h4"><?php echo _x( 'Reservation summary', 'renting_product_calendar', 'mybooking-wp-plugin') ?></h2>
            <hr>
            <% if (shopping_cart.days) { %>
            <p class="lead"><?php echo _x( 'Rental duration', 'renting_product_calendar', 'mybooking-wp-plugin' ) ?>: <span class="pull-right"><%=shopping_cart.days%> <?php echo _x( 'day(s)', 'renting_product_calendar', 'mybooking-wp-plugin' ) ?></span></p>
            <% } else if (shopping_cart.hours) { %>
  					<p class="lead"><?php echo _x( 'Rental duration', 'renting_product_calendar', 'mybooking-wp-plugin' ) ?>: <span class="pull-right"><%=shopping_cart.hours%> <?php echo _x( 'hours(s)', 'renting_product_calendar', 'mybooking-wp-plugin' ) ?></span></p>
            <% } %>
            <p class="lead"><?php echo _x( 'Total', 'renting_product_calendar', 'mybooking-wp-plugin' ) ?>: <span class="pull-right"><%=configuration.formatCurrency(shopping_cart.total_cost)%></span></p>
          </div>
          <div class="form-group">
             <input id="add_to_shopping_cart_btn" 
                    class="btn btn-primary w-100" 
                    type="submit" value="<?php echo _x( 'Book Now!', 'renting_product_calendar', 'mybooking-wp-plugin') ?>"/>
          </div>   
        <% } else { %>
          <% if (product_type == 'resource') { %>
            <div class="alert alert-danger">
              <p><?php echo _x( 'Book Now!', 'renting_product_calendar', 'mybooking-wp-plugin') ?></p>
              <p><?php echo _x( 'Sorry, there is no availability during these hours', 'renting_product_calendar', 'mybooking-wp-plugin') ?></p>
            </div>
          <% } else if (product_type == 'category_of_resources') { %>
            <div class="alert alert-warning">
              <p><?php echo _x( 'Sorry, there is no availability for the entire period. The calendar shows those days when there is availability, but it may not be available for certain consecutive dates.', 'renting_product_calendar', 'mybooking-wp-plugin') ?></p>
            </div>
          <% } %>
        <% } %>  
    </script>