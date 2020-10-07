    <!-- Reservation summary -->
    <script type="text/tmpl" id="script_reservation_summary">
      <div class="jumbotron mb-3">
        <h2 class="h3 text-center"><%= booking.summary_status %></h2>
      </div>

      <div class="row">
        <div class="col-md-8">
          <div class="row">
            <!-- Reservation summary -->
            <div class="col-md-6">
              <div class="card mb-3">
                <div class="card-header">
                  <b><?php echo _x( 'My reservation', 'renting_my_reservation', 'mybooking-wp-plugin') ?></b>
                </div>
                <ul class="list-group list-group-flush">
                  <!-- Reservation ID -->
                  <li class="list-group-item reservation-summary-card-detail"><small><?php echo _x( 'Reservation Id', 'renting_my_reservation', 'mybooking-wp-plugin') ?></small><br><span class="h3"><%=booking.id%></span></li>
                  <!-- Pickup place -->
                  <% if (configuration.pickupReturnPlace) {%>
                  <li class="list-group-item reservation-summary-card-detail"><%=booking.pickup_place_customer_translation%></li>
                  <% } %>
                  <!-- Delivery dates -->
                  <li class="list-group-item reservation-summary-card-detail">
                    <i class="fa fa-calendar-o"></i>&nbsp;
                    <%=booking.date_from_full_format%>
                    <% if (configuration.timeToFrom) { %>
                      <%=booking.time_from%>
                    <% } %>  
                  </li>
                  <!-- Return place -->
                  <% if (configuration.pickupReturnPlace) {%>
                  <li class="list-group-item reservation-summary-card-detail"><%=booking.return_place_customer_translation%></li>
                  <% } %>
                  <!-- Collection dates -->
                  <li class="list-group-item reservation-summary-card-detail">
                    <i class="fa fa-calendar-o"></i>&nbsp;
                    <%=booking.date_to_full_format%>
                    <% if (configuration.timeToFrom) { %>
                      <%=booking.time_to%>
                    <% } %> 
                  </li>
                  <!-- Duration -->
                  <% if (booking.days > 0) { %>                  
                    <li class="list-group-item reservation-summary-card-detail">
                       <?php echo _x( 'Rental duration', 'renting_my_reservation', 'mybooking-wp-plugin' ) ?>: <%=booking.days%> <?php echo _x( 'day(s)', 'renting_my_reservation', 'mybooking-wp-plugin' ) ?>
                    </li>
                  <% } else if (booking.hours > 0) { %>
                    <li class="list-group-item reservation-summary-card-detail">
                       <?php echo _x( 'Rental duration', 'renting_my_reservation', 'mybooking-wp-plugin' ) ?>: <%=booking.hours%> <?php echo _x( 'hour(s)', 'renting_my_reservation', 'mybooking-wp-plugin' ) ?> 
                    </li>                 
                  <% } %>
                </ul>
              </div>
            </div>
            <!-- Customer -->
            <div class="col-md-6">
              <div class="card mb-3">
                <div class="card-header">
                  <b><?php echo _x( "Customer's details", 'renting_my_reservation', 'mybooking-wp-plugin') ?></b>
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
          </div>
          <div class="row">
            <div class="col-md-12">
              <div id="reservation_form_container" style="display:none"></div>
            </div>
          </div>
        </div>

        <!-- Sidebar summary -->
        <div class="col-md-4">
          <div class="card mb-3">
            <!-- Products -->
            <div class="card-header">
              <b><?php echo _x( 'Products', 'renting_my_reservation', 'mybooking-wp-plugin' ) ?></b>
            </div>  
            <ul class="list-group list-group-flush">
              <% for (var idx=0;idx<booking.booking_lines.length;idx++) { %>
                <li class="list-group-item reservation-summary-card-detail">
                   <!-- Photo -->
                   <img class="product-img" style="width: 120px" src="<%=booking.booking_lines[idx].photo_medium%>"/>
                   <br>
                   <!-- Description -->
                   <span class="product-name"><b><%=booking.booking_lines[idx].item_description_customer_translation%></b></span>
                   <!-- Quantity -->
                   <% if (configuration.multipleProductsSelection) { %>
                   <span class="badge badge-info"><%=booking.booking_lines[idx].quantity%></span>
                   <% } %>
                   <!-- Price -->
                   <span class="product-amount pull-right"><%=configuration.formatCurrency(booking.booking_lines[idx].item_cost)%></span>
                   <!-- Offer/Promotion Code Appliance -->
                   <% if (booking.booking_lines[idx].item_unit_cost_base != booking.booking_lines[idx].item_unit_cost) { %>
                     <br>
                     <div class="pull-right">
                       <!-- Offer -->
                       <% if (typeof booking.booking_lines[idx].offer_name !== 'undefined' && 
                              booking.booking_lines[idx].offer_name !== null && booking.booking_lines[idx].offer_name !== '') { %>
                          <span class="badge badge-info"><%=booking.booking_lines[idx].offer_name%></span>
                          <% if (booking.booking_lines[idx].offer_discount_type === 'percentage' && booking.booking_lines[idx].offer_value !== '') {%>
                            <span class="text-danger"><%=parseInt(booking.booking_lines[idx].offer_value)%>&#37;</span>
                          <% } %>
                       <% } %>
                       <!-- Promotion Code -->
                       <% if (typeof booking.promotion_code !== 'undefined' && booking.promotion_code !== '' && 
                              typeof booking.booking_lines[idx].promotion_code_value !== 'undefined' && booking.booking_lines.promotion_code_value !== '' &&
                              booking.booking_lines[idx].promotion_code_value !== '0.0') { %>
                          <span class="badge badge-success"><%=booking.promotion_code%></span>
                          <% if (booking.booking_lines[idx].promotion_code_discount_type === 'percentage' && booking.booking_lines[idx].promotion_code !== '') {%>
                            <span class="text-danger"><%=parseInt(booking.booking_lines[idx].promotion_code_value)%>&#37;</span>
                          <% } %>
                       <% } %>
                       <span class="text-muted">
                         <del><%=configuration.formatCurrency(booking.booking_lines[idx].item_unit_cost_base * booking.booking_lines[idx].quantity)%></del>
                       </span>
                     </div>   
                   <% } %> 
                </li>
              <% } %>
            </ul>
          </div>
          <!-- Extras -->
          <% if (booking.booking_extras.length > 0) { %>
          <div class="card mb-3">
            <div class="card-header">
              <b><?php echo _x( 'Extras', 'renting_my_reservation', 'mybooking-wp-plugin' ) ?></b>
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
          <!-- Supplements -->
          <% if (booking.time_from_cost > 0 ||
                booking.pickup_place_cost > 0 ||
                booking.time_to_cost > 0 ||
                booking.return_place_cost > 0 ||
                booking.driver_age_cost > 0 ||
                booking.category_supplement_1_cost > 0) { %>
            <!-- Supplements -->
            <div class="card mb-3">
              <div class="card-header">
                <b><?php echo _x( 'Supplements', 'renting_my_reservation', 'mybooking-wp-plugin' ) ?></b>
              </div>     
              <ul class="list-group list-group-flush">
                <!-- Supplements -->
                <% if (booking.time_from_cost > 0) { %>
                <li class="list-group-item">
                  <span class="extra-name"><?php echo _x( 'Pick-up time supplement', 'renting_my_reservation', 'mybooking-wp-plugin' ) ?></span>
                  <span class="product-amount pull-right"><%=configuration.formatCurrency(booking.time_from_cost)%></span>
                </li>
                <% } %>
                <% if (booking.pickup_place_cost > 0) { %>
                <li class="list-group-item">
                  <span class="extra-name"><?php echo _x( 'Pick-up place supplement', 'renting_my_reservation', 'mybooking-wp-plugin' ) ?></span>
                  <span class="product-amount pull-right"><%=configuration.formatCurrency(booking.pickup_place_cost)%></span>
                </li>
                <% } %>
                <% if (booking.time_to_cost > 0) { %>
                <li class="list-group-item">
                  <span class="extra-name"><?php echo _x( 'Return time supplement', 'renting_my_reservation', 'mybooking-wp-plugin' ) ?></span>
                  <span class="product-amount pull-right"><%=configuration.formatCurrency(booking.time_to_cost)%></span>
                </li>
                <% } %>
                <% if (booking.return_place_cost > 0) { %>
                <li class="list-group-item">
                  <span class="extra-name"><?php echo _x( 'Return place supplement', 'renting_my_reservation', 'mybooking-wp-plugin' ) ?></span>
                  <span class="product-amount pull-right"><%=configuration.formatCurrency(booking.return_place_cost)%></span>
                </li>
                <% } %>
                <% if (booking.driver_age_cost > 0) { %>
                <li class="list-group-item">
                  <span class="extra-name"><?php echo _x( "Driver's age supplement", 'renting_my_reservation', 'mybooking-wp-plugin' ) ?></span>
                  <span class="product-amount pull-right"><%=configuration.formatCurrency(booking.driver_age_cost)%></span>
                </li>
                <% } %>
                <% if (booking.category_supplement_1_cost > 0) { %>
                <li class="list-group-item">
                  <span class="product-amount pull-right"><?php echo _x( "Petrol supplement", 'renting_my_reservation', 'mybooking-wp-plugin' ) ?></span>
                  <span
                    class="extra-price"><%=configuration.formatCurrency(booking.category_supplement_1_cost)%></span>
                </li>
                <% } %>
              </ul>
            </div>
          <% } %>
          <!-- Deposit -->
          <% if (booking.total_deposit > 0) { %>
            <!-- Deposit -->
            <div class="card mb-3">
              <div class="card-header">
                <b><?php echo _x( "Deposit", 'renting_my_reservation', 'mybooking-wp-plugin' ) ?></b>
              </div>     
              <ul class="list-group list-group-flush">
                <!-- Deposit -->
                <% if (booking.total_deposit > 0) { %>
                <li class="list-group-item">
                  <span class="extra-name"><?php echo _x('Deposit', 'renting_my_reservation', 'mybooking-wp-plugin') ?></span>
                  <span class="product-amount pull-right"><%=configuration.formatCurrency(booking.total_deposit)%></span>
                </li>
                <% } %>
              </ul>
            </div>
          <% } %>
          <!-- Total -->
          <div class="jumbotron mb-3">
            <h2 class="h5 text-center"><?php echo _x( 'Total', 'renting_my_reservation', 'mybooking-wp-plugin' ) ?></h2>
            <h2 class="h3 text-center"><%=configuration.formatCurrency(booking.total_cost)%></h2>
          </div>  
          <table class="table">
            <tr class="table-success">
              <td><?php echo _x( 'Total', 'renting_my_reservation', 'mybooking-wp-plugin' ) ?></td>
              <td class="text-right"><b><%=configuration.formatCurrency(booking.total_cost)%></b></td>
            </tr>  
            <tr>
              <td><?php echo _x( 'Paid', 'renting_my_reservation', 'mybooking-wp-plugin' ) ?></td>
              <td class="text-right"><%=configuration.formatCurrency(booking.total_paid)%></td>
            </tr>  
            <tr>
              <td><?php echo _x( 'Pending', 'renting_my_reservation', 'mybooking-wp-plugin' ) ?></td>
              <td class="text-right <% if (booking.total_pending > 0) {%>text-danger<% } %>"><%=configuration.formatCurrency(booking.total_pending)%></td>
            </tr>  
          </table>

          <div id="payment_detail" class="bg-white shadow-bottom py-3" style="display:none"></div>          
        </div>      
      </div>

    </script>

    <!-- Reservation form -->
    <script type="text/tmpl" id="script_reservation_form">

      <% if (configuration.rentingFormFillDataAddress || configuration.rentingFormFillDataDriverDetail || configuration.rentingFormFillDataNamedResources) { %>
        <form id="form-reservation" name="booking_information_form" autocomplete="off">
        <div class="card">
          <div class="card-header">
             <?php echo _x( 'Complete reservation', 'renting_my_reservation', 'mybooking-wp-plugin') ?>
          </div>
          <div class="card-body">
            <div class="alert alert-info">
              <p><?php echo _x( 'Please complete the information to speed up the delivery process on the scheduled date', 'renting_my_reservation', 'mybooking-wp-plugin') ?></p>
            </div> 
            <!-- Address -->
            <% if (configuration.rentingFormFillDataAddress) { %>
              <h3 class="h4 card-title border p-3 bg-light"><?php echo _x( 'Customer address', 'renting_my_reservation', 'mybooking-wp-plugin') ?></h3>
              <div class="form-row">
                <div class="form-group col-md-6">
                  <label for="street"><?php echo _x( 'Address', 'renting_my_reservation', 'mybooking-wp-plugin') ?></label>
                  <input class="form-control" id="street" name="customer_address[street]" type="text"
                    placeholder="<%=configuration.escapeHtml("<?php echo _x( 'Address', 'renting_my_reservation', 'mybooking-wp-plugin') ?>")%>" value="<%=booking.address_street%>" maxlength="60">
                </div>
                <div class="form-group col-md-3">
                  <label for="number"><?php echo _x( 'Number', 'renting_my_reservation', 'mybooking-wp-plugin') ?></label>
                  <input class="form-control" id="number" name="customer_address[number]" type="text"
                    placeholder="<%=configuration.escapeHtml("<?php echo _x( 'Number', 'renting_my_reservation', 'mybooking-wp-plugin') ?>")%>" value="<%=booking.address_number%>" maxlength="10">
                </div>
                <div class="form-group col-md-3">
                  <label for="complement"><?php echo _x( 'Complement', 'renting_my_reservation', 'mybooking-wp-plugin') ?></label>
                  <input class="form-control" id="complement" name="customer_address[complement]" type="text"
                    placeholder="<%=configuration.escapeHtml("<?php echo _x( 'Complement', 'renting_my_reservation', 'mybooking-wp-plugin') ?>")%>" value="<%=booking.address_complement%>"  max_length="20">
                </div>
              </div> 
              <div class="form-row"> 
                <div class="form-group col-md-6">
                  <label for="city"><?php echo _x( 'City', 'renting_my_reservation', 'mybooking-wp-plugin') ?></label>
                  <input class="form-control" id="city" name="customer_address[city]" type="text"
                    placeholder="<%=configuration.escapeHtml("<?php echo _x( 'City', 'renting_my_reservation', 'mybooking-wp-plugin') ?>")%>" value="<%=booking.address_city%>" max_length="60">
                </div>
                <div class="form-group col-md-6">
                  <label for="state"><?php echo _x( 'State', 'renting_my_reservation', 'mybooking-wp-plugin') ?></label>
                  <input class="form-control" id="state" name="customer_address[state]" type="text"
                    placeholder="<%=configuration.escapeHtml("<?php echo _x( 'State', 'renting_my_reservation', 'mybooking-wp-plugin') ?>")%>" value="<%=booking.address_state%>"  max_length="60">
                </div>
              </div>
              <div class="form-row">
                <div class="form-group col-md-6">
                  <label for="country"><?php echo _x( 'Country', 'renting_my_reservation', 'mybooking-wp-plugin') ?></label>
                  <select name="customer_address[country]" id="country" class="form-control">
                  </select>                  
                </div>  
                <div class="form-group col-md-6">
                  <label for="zip"><?php echo _x( 'Postal Code', 'renting_my_reservation', 'mybooking-wp-plugin') ?></label>
                  <input class="form-control" id="zip" name="customer_address[zip]" type="text"
                    placeholder="<%=configuration.escapeHtml("<?php echo _x( 'Postal Code', 'renting_my_reservation', 'mybooking-wp-plugin') ?>")%>" value="<%=booking.address_zip%>"  max_length="10">
                </div>
              </div>
            <% } %>
            <!-- Drivers -->
            <% if (configuration.rentingFormFillDataDriverDetail) { %>
              <!-- Driver information -->
              <h3 class="h4 card-title border p-3 bg-light"><?php echo _x('Main driver', 'renting_my_reservation', 'mybooking-wp-plugin') ?></h3>
              <div class="form-row">
                <div class="form-group col-md-6">
                  <label for="driver_name"><?php echo  _x("Name", 'renting_my_reservation', 'mybooking-wp-plugin') ?></label>
                  <input class="form-control" id="driver_name" name="driver_name" type="text"
                    placeholder="<%=configuration.escapeHtml("<?php echo _x("Name", 'renting_my_reservation', 'mybooking-wp-plugin') ?>")%>" value="<%=booking.driver_name%>"
                    maxlength="40">
                </div>
                <div class="form-group col-md-6">
                  <label for=""><?php echo _x("Surname", 'renting_my_reservation', 'mybooking-wp-plugin') ?></label>
                  <input class="form-control" id="driver_surname" name="driver_surname" type="text"
                    placeholder="<%=configuration.escapeHtml("<?php  echo _x("Surname", 'renting_my_reservation', 'mybooking-wp-plugin') ?>")%>" value="<%=booking.driver_surname%>"
                    maxlength="40">
                </div>
              </div>
              <div class="form-row">
                <div class="form-group col-md-6">
                  <label for="driver_document_id"><?php echo  _x("ID card or passport", 'renting_my_reservation', 'mybooking-wp-plugin') ?></label>
                  <input class="form-control" id="driver_document_id" name="driver_document_id" type="text"
                    placeholder="<%=configuration.escapeHtml("<?php echo  _x("ID card or passport", 'renting_my_reservation', 'mybooking-wp-plugin') ?>")%>" value="<%=booking.driver_document_id%>"
                    maxlength="50">
                </div>
                <div class="form-group col-md-6">
                  <label
                    for="driver_document_id_date"><?php echo  _x('Date of Issue', 'renting_my_reservation', 'mybooking-wp-plugin') ?></label>
                  <div class="custom-date-form">
                    <div class="custom-date-item">
                      <select name="driver_document_id_date_day" id="driver_document_id_date_day"
                        class="form-control"></select>
                    </div>
                    <div class="custom-date-item">
                      <select name="driver_document_id_date_month" id="driver_document_id_date_month"
                        class="form-control"></select>
                    </div>
                    <div class="custom-date-item">
                      <select name="driver_document_id_date_year" id="driver_document_id_date_year"
                        class="form-control"></select>
                    </div>
                  </div>
                  <input type="hidden" name="driver_document_id_date" id="driver_document_id_date"></input>
                </div>
              </div>
              <div class="form-row">
                <div class="form-group col-md-6">
                  <label
                    for="driver_driving_license_number"><?php echo  _x('Driving license number', 'renting_my_reservation', 'mybooking-wp-plugin') ?></label>
                  <input class="form-control" id="driver_driving_license_number" name="driver_driving_license_number"
                    type="text" placeholder="<%=configuration.escapeHtml("<?php  echo  _x('Driving license number', 'renting_my_reservation', 'mybooking-wp-plugin') ?>")%>"
                    value="<%=booking.driver_driving_license_number%>"
                    maxlength="50">
                </div>
                <div class="form-group col-md-6">
                  <label
                    for="driver_driving_license_date"><?php echo _x('Driving license date of issue', 'renting_my_reservation', 'mybooking-wp-plugin') ?></label>
                  <div class="custom-date-form">
                    <div class="custom-date-item">
                      <select name="driver_driving_license_date_day" id="driver_driving_license_date_day"
                        class="form-control"></select>
                    </div>
                    <div class="custom-date-item">
                      <select name="driver_driving_license_date_month" id="driver_driving_license_date_month"
                        class="form-control"></select>
                    </div>
                    <div class="custom-date-item">
                      <select name="driver_driving_license_date_year" id="driver_driving_license_date_year"
                        class="form-control"></select>
                    </div>
                  </div>
                  <input type="hidden" name="driver_driving_license_date" id="driver_driving_license_date"></input>
                </div>
              </div>
              <div class="form-row">
                <div class="form-group col-md-6">
                  <label for="driver_driving_license_country"><?php echo  _x('Driving license expedition country', 'renting_my_reservation', 'mybooking-wp-plugin') ?></label>
                  <select name="driver_driving_license_country" id="driver_driving_license_country" class="form-control">
                  </select>
                </div>
                <div class="form-group col-md-6">
                  <label
                    for="driver_date_of_birth"><?php echo  _x('Date of birth', 'renting_my_reservation', 'mybooking-wp-plugin') ?></label>
                  <div class="custom-date-form">
                    <div class="custom-date-item">
                      <select name="driver_date_of_birth_day" id="driver_date_of_birth_day"
                        class="form-control"></select>
                    </div>
                    <div class="custom-date-item">
                      <select name="driver_date_of_birth_month" id="driver_date_of_birth_month"
                        class="form-control"></select>
                    </div>
                    <div class="custom-date-item">
                      <select name="driver_date_of_birth_year" id="driver_date_of_birth_year"
                        class="form-control"></select>
                    </div>
                  </div>
                  <input type="hidden" name="driver_date_of_birth" id="driver_date_of_birth"></input>
                </div>
              </div>  

              <!-- Additional drivers information -->
              <h3 class="h4 card-title border p-3 bg-light"><?php echo _x('Additional drivers', 'renting_my_reservation', 'mybooking-wp-plugin') ?></h3>
              <div class="form-row">
                <div class="form-group col-md-6">
                  <label for="driver_name"><?php echo _x("Name", 'renting_my_reservation', 'mybooking-wp-plugin') ?></label>
                  <input class="form-control" id="additional_driver_1_name" name="additional_driver_1_name" type="text"
                    placeholder="<%=configuration.escapeHtml("<?php echo _x("Name", 'renting_my_reservation', 'mybooking-wp-plugin') ?>")%>"
                    value="<%=booking.additional_driver_1_name%>"
                    maxlength="40">
                </div>
                <div class="form-group col-md-6">
                  <label for=""><?php echo _x("Surname", 'renting_my_reservation', 'mybooking-wp-plugin') ?></label>
                  <input class="form-control" id="additional_driver_1_surname" name="additional_driver_1_surname" type="text"
                    placeholder="<%=configuration.escapeHtml("<?php echo _x("Surname", 'renting_my_reservation', 'mybooking-wp-plugin') ?>")%>"
                    value="<%=booking.additional_driver_1_surname%>"
                    maxlength="40">
                </div>
              </div>
              <div class="form-row">
                <div class="form-group col-md-6">
                  <label
                    for="driver_driving_license_number"><?php echo _x('Driving license number', 'renting_my_reservation', 'mybooking-wp-plugin') ?></label>
                  <input class="form-control" id="additional_driver_1_driving_license_number" name="additional_driver_1_driving_license_number"
                    type="text" placeholder="<%=configuration.escapeHtml("<?php echo _x('Driving license number', 'renting_my_reservation', 'mybooking-wp-plugin') ?>")%>"
                    value="<%=booking.additional_driver_1_driving_license_number%>"
                    maxlength="50">
                </div>
                <div class="form-group col-md-6">
                  <label
                    for="driver_driving_license_date"><?php echo _x('Driving license date of issue', 'renting_my_reservation', 'mybooking-wp-plugin') ?></label>
                  <div class="custom-date-form">
                    <div class="custom-date-item">
                      <select name="additional_driver_1_driving_license_date_day" id="additional_driver_1_driving_license_date_day"
                        class="form-control"></select>
                    </div>
                    <div class="custom-date-item">
                      <select name="additional_driver_1_driving_license_date_month" id="additional_driver_1_driving_license_date_month"
                        class="form-control"></select>
                    </div>
                    <div class="custom-date-item">
                      <select name="additional_driver_1_driving_license_date_year" id="additional_driver_1_driving_license_date_year"
                        class="form-control"></select>
                    </div>
                  </div>
                  <input type="hidden" name="additional_driver_1_driving_license_date" id="additional_driver_1_driving_license_date"></input>
                </div>
                <div class="form-group col-md-6">
                  <label
                    for="driver_driving_license_country"><?php echo _x('Driving license expedition country', 'renting_my_reservation', 'mybooking-wp-plugin') ?></label>
                  <select name="additional_driver_1_driving_license_country" id="additional_driver_1_driving_license_country"
                      class="form-control">
                  </select>
                </div>
              </div>
              <hr>
              <div class="form-row">
                <div class="form-group col-md-6">
                  <label for="driver_name"><?php echo _x("Name", 'renting_my_reservation', 'mybooking-wp-plugin') ?></label>
                  <input class="form-control" id="additional_driver_2_name" name="additional_driver_2_name" type="text"
                    placeholder="<%=configuration.escapeHtml("<?php echo _x("Name", 'renting_my_reservation', 'mybooking-wp-plugin') ?>")%>"
                    value="<%=booking.additional_driver_2_name%>"
                    maxlength="40">
                </div>
                <div class="form-group col-md-6">
                  <label for=""><?php echo _x("Surname", 'renting_my_reservation', 'mybooking-wp-plugin') ?></label>
                  <input class="form-control" id="additional_driver_2_surname" name="additional_driver_2_surname" type="text"
                    placeholder="<%=configuration.escapeHtml("<?php echo _x("Surname", 'renting_my_reservation', 'mybooking-wp-plugin') ?>")%>"
                    value="<%=booking.additional_driver_2_surname%>"
                    maxlength="40">
                </div>
              </div>
              <div class="form-row">
                <div class="form-group col-md-6">
                  <label
                    for="driver_driving_license_number"><?php echo _x('Driving license number', 'renting_my_reservation', 'mybooking-wp-plugin') ?></label>
                  <input class="form-control" id="additional_driver_2_driving_license_number" name="additional_driver_2_driving_license_number"
                    type="text" placeholder="<%=configuration.escapeHtml("<?php echo _x('Driving license number', 'renting_my_reservation', 'mybooking-wp-plugin') ?>")%>"
                    value="<%=booking.additional_driver_2_driving_license_number%>"
                    maxlength="50">
                </div>
                <div class="form-group col-md-6">
                  <label
                    for="driver_driving_license_date"><?php echo _x('Driving license date of issue', 'renting_my_reservation', 'mybooking-wp-plugin') ?></label>
                  <div class="custom-date-form">
                    <div class="custom-date-item">
                      <select name="additional_driver_2_driving_license_date_day" id="additional_driver_2_driving_license_date_day"
                        class="form-control"></select>
                    </div>
                    <div class="custom-date-item">
                      <select name="additional_driver_2_driving_license_date_month" id="additional_driver_2_driving_license_date_month"
                        class="form-control"></select>
                    </div>
                    <div class="custom-date-item">
                      <select name="additional_driver_2_driving_license_date_year" id="additional_driver_2_driving_license_date_year"
                        class="form-control"></select>
                    </div>
                  </div>
                  <input type="hidden" name="additional_driver_2_driving_license_date" id="additional_driver_2_driving_license_date"></input>
                </div>
                <div class="form-group col-md-6">
                  <label
                    for="driver_driving_license_country"><?php echo _x('Driving license expedition country', 'renting_my_reservation', 'mybooking-wp-plugin') ?></label>
                  <select name="additional_driver_2_driving_license_country" id="additional_driver_2_driving_license_country"
                      class="form-control">
                  </select>
                </div>
              </div>
            <% } %>
            <!-- Flight -->
            <% if (configuration.rentingFromFillDataFlight) { %>
              <h3 class="h4 card-title border p-3 bg-light"><?php echo _x('Flight', 'renting_my_reservation', 'mybooking-wp-plugin') ?></h3>
              <div class="form-row">
                <div class="form-group col-md-4">
                  <label for="flight_company"><?php echo _x('Company', 'renting_my_reservation', 'mybooking-wp-plugin') ?></label>
                  <input class="form-control" id="flight_company" name="flight_company" type="text"
                    placeholder="<%=configuration.escapeHtml("<?php echo _x('Company', 'renting_my_reservation', 'mybooking-wp-plugin') ?>")%>" value="<%=booking.flight_company%>" maxlength="80">
                </div>
                <div class="form-group col-md-4">
                  <label for="flight_number"><?php echo _x('Flight Number', 'renting_my_reservation', 'mybooking-wp-plugin') ?></label>
                  <input class="form-control" id="flight_number" name="flight_number" type="text"
                    placeholder="<%=configuration.escapeHtml("<?php echo _x('Flight Number', 'renting_my_reservation', 'mybooking-wp-plugin') ?>")%>" value="<%=booking.flight_number%>" maxlength="10">
                </div>
                <div class="form-group col-md-4">
                  <label for="flight_time"><?php echo _x('Estimated Time', 'renting_my_reservation', 'mybooking-wp-plugin') ?></label>
                  <input class="form-control" id="flight_time" name="flight_time" type="text"
                    placeholder="<%=configuration.escapeHtml("<?php echo _x('Estimated Time', 'renting_my_reservation', 'mybooking-wp-plugin') ?>")%>" value="<%=booking.flight_time%>" maxlength="5">
                </div>
              </div>
              <h3 class="h4 card-title border p-3 bg-light"><?php echo _x('Return flight', 'renting_my_reservation', 'mybooking-wp-plugin') ?></h3>
              <div class="form-row">
                <div class="form-group col-md-4">
                  <label for="flight_company_departure"><?php echo _x('Company', 'renting_my_reservation', 'mybooking-wp-plugin') ?></label>
                  <input class="form-control" id="flight_company_departure" name="flight_company_departure" type="text"
                    placeholder="<%=configuration.escapeHtml("<?php echo _x('Company', 'renting_my_reservation', 'mybooking-wp-plugin') ?>")%>" value="<%=booking.flight_company_departure%>">
                </div>
                <div class="form-group col-md-4">
                  <label for="flight_number_departure"><?php echo _x('Flight Number', 'renting_my_reservation', 'mybooking-wp-plugin') ?></label>
                  <input class="form-control" id="flight_number_departure" name="flight_number_departure" type="text"
                    placeholder="<%=configuration.escapeHtml("<?php echo _x('Flight Number', 'renting_my_reservation', 'mybooking-wp-plugin') ?>")%>" value="<%=booking.flight_number_departure%>">
                </div>
                <div class="form-group col-md-4">
                  <label for="flight_time_departure"><?php echo _x('Estimated Time', 'renting_my_reservation', 'mybooking-wp-plugin') ?></label>
                  <input class="form-control" id="flight_time_departure" name="flight_time_departure" type="text"
                    placeholder="<%=configuration.escapeHtml("<?php echo _x('Estimated Time', 'renting_my_reservation', 'mybooking-wp-plugin') ?>")%>" value="<%=booking.flight_time_departure%>">
                </div>
              </div>
            <% } %>
            <!-- Named resources -->
            <% if (configuration.rentingFormFillDataNamedResources) { %>
              <% for (var idx=0; idx<booking.booking_lines.length; idx++) { %>
                 <% var booking_line = booking.booking_lines[idx]; %>
                 <h3 class="h4 card-title border p-3 bg-light"><%=booking_line.quantity%> x <%=booking_line.item_description%></h3>
                 <% for (var idxResource=0; idxResource<booking.booking_lines[idx].booking_line_resources.length; idxResource++) { %>
                    <% var booking_line_resource = booking.booking_lines[idx].booking_line_resources[idxResource]; %>
                    <input type="hidden" name="booking_line_resources[<%=booking_line_resource.id%>][id]" value="<%=booking_line_resource.id%>"/>
                    <% if (booking_line_resource.pax == 1) { %>
                      <h5 class="h5 border p-2"><?php echo _x( 'Participant', 'renting_my_reservation', 'mybooking-wp-plugin') ?> #<%=idxResource+1%></h5>
                    <% } else if (booking_line_resource.pax == 2) { %>
                      <h5 class="h5 border p-2"><?php echo _x( 'Participants', 'renting_my_reservation', 'mybooking-wp-plugin') ?> #<%=idxResource+1%></h5>
                      <h6 class="h6 border p-1 text-right"><?php echo _x( 'Pax 1', 'renting_my_reservation', 'mybooking-wp-plugin') ?></h6>
                    <% } %>
                    <div class="form-row">
                      <div class="form-group col-md-4">
                        <label for="customer_name"><?php echo _x( 'Name', 'renting_my_reservation', 'mybooking-wp-plugin') ?></label>
                        <input name="booking_line_resources[<%=booking_line_resource.id%>][resource_user_name]"
                               title="<?php echo _x( 'Name', 'renting_my_reservation', 'mybooking-wp-plugin') ?>" data-toggle="tooltip"
                               class="form-control alt" type="text"
                               placeholder="<?php echo _x( 'Name', 'renting_my_reservation', 'mybooking-wp-plugin') ?>:" maxlength="80"
                               value="<%=booking_line_resource.resource_user_name%>">
                      </div>
                      <div class="form-group col-md-4">
                        <label for="customer_name"><?php echo _x( 'Surname', 'renting_my_reservation', 'mybooking-wp-plugin') ?></label>
                        <input name="booking_line_resources[<%=booking_line_resource.id%>][resource_user_surname]"
                               title="<?php echo _x( 'Surname', 'renting_my_reservation', 'mybooking-wp-plugin') ?>" data-toggle="tooltip"
                               class="form-control alt" type="text"
                               placeholder="<?php echo _x( 'Surname', 'renting_my_reservation', 'mybooking-wp-plugin') ?>:" maxlength="80"
                               value="<%=booking_line_resource.resource_user_surname%>">
                      </div>
                      <div class="form-group col-md-4">
                        <label for="customer_name"><?php echo _x( 'Document ID', 'renting_my_reservation', 'mybooking-wp-plugin') ?></label>
                        <input name="booking_line_resources[<%=booking_line_resource.id%>][resource_user_document_id]"
                               title="<?php echo _x( 'Document ID', 'renting_my_reservation', 'mybooking-wp-plugin') ?>" data-toggle="tooltip"
                               class="form-control alt" type="text"
                               placeholder="<?php echo _x( 'Document ID', 'renting_my_reservation', 'mybooking-wp-plugin') ?>:" maxlength="50"
                               value="<%=booking_line_resource.resource_user_document_id%>">
                      </div>
                    </div>
                    <div class="form-row">
                      <div class="form-group col-md-4">
                        <label for="customer_name"><?php echo _x( 'Phone number', 'renting_my_reservation', 'mybooking-wp-plugin') ?></label>
                        <input name="booking_line_resources[<%=booking_line_resource.id%>][resource_user_phone]"
                               title="<?php echo _x( 'Phone number', 'renting_my_reservation', 'mybooking-wp-plugin') ?>" data-toggle="tooltip"
                               class="form-control alt" type="text"
                               placeholder="<?php echo _x( 'Phone number', 'renting_my_reservation', 'mybooking-wp-plugin') ?>:" maxlength="15"
                               value="<%=booking_line_resource.resource_user_phone%>">
                      </div>
                      <div class="form-group col-md-4">
                        <label for="customer_name"><?php echo _x( 'E-mail', 'renting_my_reservation', 'mybooking-wp-plugin') ?></label>
                        <input name="booking_line_resources[<%=booking_line_resource.id%>][resource_user_email]"
                               title="<?php echo _x( 'E-mail', 'renting_my_reservation', 'mybooking-wp-plugin') ?>" data-toggle="tooltip"
                               class="form-control alt" type="text"
                               placeholder="<?php echo _x( 'E-mail', 'renting_my_reservation', 'mybooking-wp-plugin') ?>:" maxlength="40"
                               value="<%=booking_line_resource.resource_user_email%>">
                      </div>             
                      <% if (configuration.rentingFormFillDataNamedResourcesHeight) { %>   
                        <div class="form-group col-md-2">
                          <label for="customer_name"><?php echo _x( 'Height (cm)', 'renting_my_reservation', 'mybooking-wp-plugin') ?></label>
                          <input name="booking_line_resources[<%=booking_line_resource.id%>][customer_height]"
                                 title="<?php echo _x( 'Height (cm)', 'renting_my_reservation', 'mybooking-wp-plugin') ?>" data-toggle="tooltip"
                                 class="form-control alt" type="number"
                                 placeholder="<?php echo _x( 'Height (cm)', 'renting_my_reservation', 'mybooking-wp-plugin') ?>:" min="0" max="250"
                                 value="<%=booking_line_resource.customer_height%>">
                        </div>
                      <% } %>
                      <% if (configuration.rentingFormFillDataNamedResourcesWeight) { %>                        
                        <div class="form-group col-md-2">
                          <label for="customer_name"><?php echo _x( 'Weight (kg)', 'renting_my_reservation', 'mybooking-wp-plugin') ?></label>
                          <input name="booking_line_resources[<%=booking_line_resource.id%>][customer_weight]"
                                 title="<?php echo _x( 'Weight (kg)', 'renting_my_reservation', 'mybooking-wp-plugin') ?>" data-toggle="tooltip"
                                 class="form-control alt" type="number"
                                 placeholder="<?php echo _x( 'Weight (kg)', 'renting_my_reservation', 'mybooking-wp-plugin') ?>:"  min="0" max="200"
                                 value="<%=booking_line_resource.customer_weight%>">
                        </div>
                      <% } %>
                    </div>    
                    <% if (booking_line_resource.pax == 2) { %>
                      <h6 class="h6 border p-1 text-right"><?php echo _x( 'Pax 2', 'renting_my_reservation', 'mybooking-wp-plugin') ?></h5>
                      <div class="form-row">
                        <div class="form-group col-md-4">
                          <label for="customer_name"><?php echo _x( 'Name', 'renting_my_reservation', 'mybooking-wp-plugin') ?></label>
                          <input name="booking_line_resources[<%=booking_line_resource.id%>][resource_user_2_name]"
                                 title="<?php echo _x( 'Name', 'renting_my_reservation', 'mybooking-wp-plugin') ?>" data-toggle="tooltip"
                                 class="form-control alt" type="text"
                                 placeholder="<?php echo _x( 'Name', 'renting_my_reservation', 'mybooking-wp-plugin') ?>:" maxlength="80"
                                 value="<%=booking_line_resource.resource_user_2_name%>">
                        </div>
                        <div class="form-group col-md-4">
                          <label for="customer_name"><?php echo _x( 'Surname', 'renting_my_reservation', 'mybooking-wp-plugin') ?></label>
                          <input name="booking_line_resources[<%=booking_line_resource.id%>][resource_user_2_surname]"
                                 title="<?php echo _x( 'Surname', 'renting_my_reservation', 'mybooking-wp-plugin') ?>" data-toggle="tooltip"
                                 class="form-control alt" type="text"
                                 placeholder="<?php echo _x( 'Surname', 'renting_my_reservation', 'mybooking-wp-plugin') ?>:" maxlength="80"
                                 value="<%=booking_line_resource.resource_user_2_surname%>">
                        </div>
                        <div class="form-group col-md-4">
                          <label for="customer_name"><?php echo _x( 'Document ID', 'renting_my_reservation', 'mybooking-wp-plugin') ?></label>
                          <input name="booking_line_resources[<%=booking_line_resource.id%>][resource_user_2_document_id]"
                                 title="<?php echo _x( 'Document ID', 'renting_my_reservation', 'mybooking-wp-plugin') ?>" data-toggle="tooltip"
                                 class="form-control alt" type="text"
                                 placeholder="<?php echo _x( 'Document ID', 'renting_my_reservation', 'mybooking-wp-plugin') ?>:" maxlength="50"
                                 value="<%=booking_line_resource.resource_user_2_document_id%>">
                        </div>
                      </div>
                      <div class="form-row">
                        <div class="form-group col-md-4">
                          <label for="customer_name"><?php echo _x( 'Phone number', 'renting_my_reservation', 'mybooking-wp-plugin') ?></label>
                          <input name="booking_line_resources[<%=booking_line_resource.id%>][resource_user_2_phone]"
                                 title="<?php echo _x( 'Phone number', 'renting_my_reservation', 'mybooking-wp-plugin') ?>" data-toggle="tooltip"
                                 class="form-control alt" type="text"
                                 placeholder="<?php echo _x( 'Phone number', 'renting_my_reservation', 'mybooking-wp-plugin') ?>:" maxlength="15"
                                 value="<%=booking_line_resource.resource_user_2_phone%>">
                        </div>
                        <div class="form-group col-md-4">
                          <label for="customer_name"><?php echo _x( 'E-mail', 'renting_my_reservation', 'mybooking-wp-plugin') ?></label>
                          <input name="booking_line_resources[<%=booking_line_resource.id%>][resource_user_2_email]"
                                 title="<?php echo _x( 'E-mail', 'renting_my_reservation', 'mybooking-wp-plugin') ?>" data-toggle="tooltip"
                                 class="form-control alt" type="text"
                                 placeholder="<?php echo _x( 'E-mail', 'renting_my_reservation', 'mybooking-wp-plugin') ?>:" maxlength="40"
                                 value="<%=booking_line_resource.resource_user_2_email%>">
                        </div>        
                        <% if (configuration.rentingFormFillDataNamedResourcesHeight) { %>           
                          <div class="form-group col-md-2">
                            <label for="customer_name"><?php echo _x( 'Height (cm)', 'renting_my_reservation', 'mybooking-wp-plugin') ?></label>
                            <input name="booking_line_resources[<%=booking_line_resource.id%>][customer_2_height]"
                                   title="<?php echo _x( 'Height (cm)', 'renting_my_reservation', 'mybooking-wp-plugin') ?>" data-toggle="tooltip"
                                   class="form-control alt" type="number"
                                   placeholder="<?php echo _x( 'Height (cm)', 'renting_my_reservation', 'mybooking-wp-plugin') ?>:" min="0" max="250"
                                   value="<%=booking_line_resource.customer_2_height%>">
                          </div>
                        <% } %>
                        <% if (configuration.rentingFormFillDataNamedResourcesWeight) { %>                             
                          <div class="form-group col-md-2">
                            <label for="customer_name"><?php echo _x( 'Weight (kg)', 'renting_my_reservation', 'mybooking-wp-plugin') ?></label>
                            <input name="booking_line_resources[<%=booking_line_resource.id%>][customer_2_weight]"
                                   title="<?php echo _x( 'Weight (kg)', 'renting_my_reservation', 'mybooking-wp-plugin') ?>" data-toggle="tooltip"
                                   class="form-control alt" type="number"
                                   placeholder="<?php echo _x( 'Weight (kg)', 'renting_my_reservation', 'mybooking-wp-plugin') ?>:" min="0" max="200"
                                   value="<%=booking_line_resource.customer_2_weight%>">
                          </div>
                        <% } %>
                      </div>  
                    <% } %>            
                 <% } %>
                 <hr>
              <% } %>
            <% } %>
          </div>
          <div class="card-footer">
            <button class="btn btn-primary pull-right" id="btn_update_reservation"><?php echo _x( 'Update', 'renting_my_reservation', 'mybooking-wp-plugin') ?></button>
          </div>  
        </div>  

        </form> 
      <% } %> 
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
        <div class="form-row">
           <div class="form-group col-md-12">
             <label for="payments_paypal_standard">
              <input type="radio" name="payment_method_id" value="paypal_standard">&nbsp<?php echo _x( 'Paypal', 'renting_my_reservation', 'mybooking-wp-plugin' ) ?>
              <img src="<?php echo plugin_dir_url(__DIR__) ?>/assets/images/pm-paypal.jpg"/>
             </label>
           </div>
           <div class="form-group col-md-12">
             <label for="payments_paypal_standard">
              <input type="radio" name="payment_method_id" value="<%=sales_process.payment_methods.tpv_virtual%>">&nbsp;<?php echo _x( 'Credit or debit card', 'renting_my_reservation', 'mybooking-wp-plugin' ) ?>
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
            <button class="btn btn-success" id="btn_pay" type="submit"><%= i18next.t('myReservation.pay.payment_button', {amount:configuration.formatCurrency(amount) }) %></button>
          </div>
        </div>
      </div>

    </script>
    