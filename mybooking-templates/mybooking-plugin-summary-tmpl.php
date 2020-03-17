    <!-- Reservation summary -->
    <script type="text/tmpl" id="script_reservation_summary">
      <div class="jumbotron mb-3">
        <h2 class="h3 text-center"><%= booking.summary_status %></h2>
      </div>

      <div class="row">
        <div class="col-md-4">
          <div class="card mb-3">
            <div class="card-header">
              <b><?php echo _x( 'Reservation summary', 'renting_summary', 'mybooking-wp-plugin') ?></b>
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
              <li class="list-group-item reservation-summary-card-detail"><?php echo _x( 'Rental duration', 'renting_summary', 'mybooking-wp-plugin' ) ?>: <%=booking.days%> <?php echo _x( 'day(s)', 'renting_summary', 'mybooking-wp-plugin' ) ?></li>
            </ul>
          </div>
        </div>
        
        <div class="col-md-4">
          <div class="card mb-3">
            <div class="card-header">
              <b><?php echo _x( "Customer's details", 'renting_summary', 'mybooking-wp-plugin') ?></b>
            </div>
            <ul class="list-group list-group-flush">
              <li class="list-group-item reservation-summary-card-detail"><%=booking.customer_name%> <%=booking.customer_surname%></li>
              <% if (booking.customer_phone && booking.customer_phone != '') { %>
              <li class="list-group-item reservation-summary-card-detail"><%=booking.customer_phone%> <%=booking.customer_mobile_phone%></li>
              <% } %>
              <% if (booking.customer_email && booking.customer_email != '') { %>
              <li class="list-group-item reservation-summary-card-detail"><%=booking.customer_email%></li>
              <% } %>
            </ul>
          </div>

        </div>

        <div class="col-md-4">
          <div class="card mb-3">
            <div class="card-header">
              <b><?php echo _x( 'Products', 'renting_summary', 'mybooking-wp-plugin' ) ?></b>
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
              <b><?php echo _x( 'Extras', 'renting_summary', 'mybooking-wp-plugin' ) ?></b>
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
          <% if (booking.time_from_cost > 0 ||
                booking.pickup_place_cost > 0 ||
                booking.time_to_cost > 0 ||
                booking.return_place_cost > 0 ||
                booking.driver_age_cost > 0 ||
                booking.category_supplement_1_cost > 0) { %>
            <!-- Supplements -->
            <div class="card mb-3">
              <div class="card-header">
                <b><?php echo _x( 'Supplements', 'renting_summary', 'mybooking-wp-plugin' ) ?></b>
              </div>     
              <ul class="list-group list-group-flush">
                <!-- Supplements -->
                <% if (booking.time_from_cost > 0) { %>
                <li class="list-group-item">
                  <span class="extra-name"><?php echo _x( 'Pick-up time supplement', 'renting_summary', 'mybooking-wp-plugin' ) ?></span>
                  <span class="product-amount pull-right"><%=configuration.formatCurrency(booking.time_from_cost)%></span>
                </li>
                <% } %>
                <% if (booking.pickup_place_cost > 0) { %>
                <li class="list-group-item">
                  <span class="extra-name"><?php echo _x( 'Pick-up place supplement', 'renting_summary', 'mybooking-wp-plugin' ) ?></span>
                  <span class="product-amount pull-right"><%=configuration.formatCurrency(booking.pickup_place_cost)%></span>
                </li>
                <% } %>
                <% if (booking.time_to_cost > 0) { %>
                <li class="list-group-item">
                  <span class="extra-name"><?php echo _x( 'Return time supplement', 'renting_summary', 'mybooking-wp-plugin' ) ?></span>
                  <span class="product-amount pull-right"><%=configuration.formatCurrency(booking.time_to_cost)%></span>
                </li>
                <% } %>
                <% if (booking.return_place_cost > 0) { %>
                <li class="list-group-item">
                  <span class="extra-name"><?php echo _x( 'Return place supplement', 'renting_summary', 'mybooking-wp-plugin' ) ?></span>
                  <span class="product-amount pull-right"><%=configuration.formatCurrency(booking.return_place_cost)%></span>
                </li>
                <% } %>
                <% if (booking.driver_age_cost > 0) { %>
                <li class="list-group-item">
                  <span class="extra-name"><?php echo _x( "Driver's age supplement", 'renting_summary', 'mybooking-wp-plugin' ) ?></span>
                  <span class="product-amount pull-right"><%=configuration.formatCurrency(booking.driver_age_cost)%></span>
                </li>
                <% } %>
                <% if (booking.category_supplement_1_cost > 0) { %>
                <li class="list-group-item">
                  <span class="product-amount pull-right"><?php echo _x( "Petrol supplement", 'renting_summary', 'mybooking-wp-plugin' ) ?></span>
                  <span
                    class="extra-price"><%=configuration.formatCurrency(booking.category_supplement_1_cost)%></span>
                </li>
                <% } %>
              </ul>
            </div>
          <% } %>
          <% if (booking.total_deposit > 0) { %>
            <!-- Deposit -->
            <div class="card mb-3">
              <div class="card-header">
                <b><?php echo _x( "Deposit", 'renting_summary', 'mybooking-wp-plugin' ) ?></b>
              </div>     
              <ul class="list-group list-group-flush">
                <!-- Deposit -->
                <% if (booking.total_deposit > 0) { %>
                <li class="list-group-item">
                  <span class="extra-name"><?php echo _x('Deposit', 'renting_summary', 'mybooking') ?></span>
                  <span class="product-amount pull-right"><%=configuration.formatCurrency(booking.total_deposit)%></span>
                </li>
                <% } %>
              </ul>
            </div>
          <% } %>

          <div class="jumbotron mb-3">
            <h2 class="h5 text-center"><?php echo _x( 'Total', 'renting_summary', 'mybooking-wp-plugin' ) ?></h2>
            <h2 class="h3 text-center"><%=configuration.formatCurrency(booking.total_cost)%></h2>
          </div>            
        </div>
        
      </div>

    </script>