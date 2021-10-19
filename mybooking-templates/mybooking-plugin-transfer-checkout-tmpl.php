<?php
  /**
   * The Template for showing the transfer checkout step - JS microtemplates
   *
   * This template can be overridden by copying it to yourtheme/mybooking-templates/mybooking-plugin-transfer-checkout-tmpl.php
   *
   * @phpcs:disable PHPCompatibility.Miscellaneous.RemovedAlternativePHPTags.MaybeASPOpenTagFound
   * @phpcs:disable Generic.PHP.DisallowAlternativePHPTags.MaybeASPOpenTagFound
   * @phpcs:disable Generic.PHP.DisallowAlternativePHPTags.MaybeASPShortOpenTagFound
   */
?>
<!-- Extra representation -->
<script type="text/template" id="script_transfer_detailed_extra">

  <% if (extras && extras.length > 0) {%>
    <h4 class="complete-section-title"><?php echo esc_html_x( 'Extras', 'transfer_checkout', 'mybooking-wp-plugin') ?></h4>
    <div class="extra-wrapper">
      <% for (var idx=0;idx<extras.length;idx++) { %>
        <% var extra = extras[idx]; %>
        <% var value = (extrasInShoppingCart[extra.id]) ? extrasInShoppingCart[extra.id] : 0; %>
        <% var bg = ((idx % 2 == 0) ? 'bg-light' : ''); %>
        <div class="row extra-card <%=bg%>" data-extra="<%=extra.id%>">
          <% if (extra.photo_url) { %>
            <div class="col-md-2">
              <img class="extra-img js-extra-info-btn"
                    src="<%=extra.photo_url%>"
                    alt="<%=extra.name%>"
                    data-extra="<%=extra.id%>">
            </div>
            <div class="col-md-4">
              <div class="extra-name"><b><%=extra.name%></b></div>
            </div>
          <% } else { %>
            <div class="col-md-6">
              <div class="extra-name"><b><%=extra.name%></b></div>
            </div>
          <% } %>
          <div class="col-md-3">
            <% if (extra.max_quantity > 1) { %>
              <div class="extra-plus-minus">
                <button class="btn btn-primary btn-minus-extra"
                        data-value="<%=extra.id%>"
                        data-max-quantity="<%=extra.max_quantity%>">-</button>
                <input type="text" id="extra-<%=extra.id%>-quantity"
                       class="form-control disabled text-center extra-input" value="<%=value%>" data-extra-code="<%=extra.id%>" readonly/>
                <button class="btn btn-primary btn-plus-extra"
                        data-value="<%=extra.id%>"
                        data-max-quantity="<%=extra.max_quantity%>">+</button>
              </div>
            <% } else { %>
              <div class="extra-check">
                <div class="custom-control custom-switch">
                  <input type="checkbox" class="custom-control-input extra-checkbox" id="checkboxl<%=extra.id%>" data-value="<%=extra.id%>"
                  <% if (extrasInShoppingCart[extra.id] &&  extrasInShoppingCart[extra.id] > 0) { %> checked="checked" <% } %>>
                  <label class="custom-control-label" for="checkboxl<%=extra.id%>"></label>
                </div>
              </div>
            <% } %>
          </div>
          <div class="col-md-3">
           <p class="extra-price">
              <b><%= configuration.formatCurrency(extra.price)%></b>
           </p>
          </div>
        </div>
      <% } %>
    </div>
  <% } %>

</script>


<!-- Script that shows the extra detail -->
<script type="text/tmpl" id="script_transfer_extra_modal">

  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
          <div class="carousel-inner">
            <% for (var idx=0; idx<extra.photos.length; idx++) { %>
            <div class="carousel-item <% if (idx==0) {%>active<%}%>">
              <img class="d-block w-100" src="<%=extra.photos[idx].full_photo_path%>" alt="<%=extra.name%>">
            </div>
            <% } %>
          </div>
          <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">&lt;</span>
          </a>
          <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">&gt;</span>
          </a>
        </div>
        <div class="mt-3 text-muted"><%=extra.description%></div>
      </div>
    </div>
  </div>

</script>

<!-- Reservation form -->
<script type="text/tmpl" id="script_transfer_complete_form_tmpl">
  <div class="form-row customer-component">
    <div class="form-group customer_component col-md-6">
      <label for="customer_name"><?php echo esc_html_x( 'Name', 'transfer_checkout', 'mybooking-wp-plugin') ?>*</label>
      <input type="text" class="form-control" name="customer_name" id="customer_name" autocomplete="off" placeholder="<?php echo esc_attr_x( 'Name', 'transfer_checkout', 'mybooking-wp-plugin') ?>:*" maxlength="40">
    </div>

    <div class="form-group customer_component col-md-6">
      <label for="customer_surname"><?php echo esc_html_x( 'Surname', 'transfer_checkout', 'mybooking-wp-plugin') ?>*</label>
      <input type="text" class="form-control" name="customer_surname" id="customer_surname" autocomplete="off" placeholder="<?php echo esc_attr_x( 'Surname', 'transfer_checkout', 'mybooking-wp-plugin') ?>:*" maxlength="40">
    </div>

    <div class="form-group customer_component col-md-6">
      <label for="customer_email"><?php echo esc_html_x( 'E-mail', 'transfer_checkout', 'mybooking-wp-plugin') ?>*</label>
      <input type="text" class="form-control" name="customer_email" id="customer_email" autocomplete="off" placeholder="<?php echo esc_attr_x( 'E-mail', 'transfer_checkout', 'mybooking-wp-plugin') ?>:*" maxlength="50">
    </div>

    <div class="form-group customer_component col-md-6">
      <label for="customer_email"><?php echo esc_html_x( 'Confirm E-mail', 'transfer_checkout', 'mybooking-wp-plugin') ?>*</label>
      <input type="text" class="form-control" name="confirm_customer_email" autocomplete="off" id="confirm_customer_email" placeholder="<?php echo esc_attr_x( 'Confirm E-mail', 'transfer_checkout', 'mybooking-wp-plugin') ?>:*" maxlength="50">
    </div>

    <div class="form-group customer_component col-md-6">
        <label for="customer_phone"><?php echo esc_html_x( 'Phone number', 'transfer_checkout', 'mybooking-wp-plugin') ?>*</label>
        <input type="text" class="form-control" name="customer_phone" id="customer_phone" autocomplete="off" placeholder="<?php echo esc_attr_x( 'Phone number', 'transfer_checkout', 'mybooking-wp-plugin') ?>:*" maxlength="15">
    </div>

    <div class="form-group customer_component col-md-6">
        <label for="customer_mobile_phone"><?php echo esc_html_x( 'Alternative phone number', 'transfer_checkout', 'mybooking-wp-plugin') ?></label>
        <input type="text" class="form-control" name="customer_mobile_phone" id="customer_mobile_phone" autocomplete="off" placeholder="<?php echo esc_attr_x( 'Alternative phone number', 'transfer_checkout', 'mybooking-wp-plugin') ?>:" maxlength="15">
    </div>
    <br>
  </div>

  <hr>

  <% if (configuration.transfer_origin_destination_detailed_info_mode === 'only_address') { %>
    <!-- Only Text detailed information -->
    <div class="form-group">
      <label for="detailed_origin_address"><?php echo esc_html_x( 'Pickup address (hotel, resource, address, terminal)', 'transfer_checkout', 'mybooking-wp-plugin') ?>*</label>
      <textarea class="form-control" name="detailed_origin_address" id="detailed_origin_address" rows="5" placeholder="<?php echo esc_attr_x( 'Pickup address (hotel, resource, address, terminal)', 'transfer_checkout', 'mybooking-wp-plugin') ?>"></textarea>
    </div>

    <% if (shopping_cart.round_trip) { %>
      <div class="form-group">
        <label for="detailed_origin_address"><?php echo esc_html_x( 'Dropoff address (hotel, resource, address, terminal)', 'transfer_checkout', 'mybooking-wp-plugin') ?>*</label>
        <textarea class="form-control" name="detailed_return_origin_address" id="detailed_return_origin_address" rows="5" placeholder="<?php echo esc_attr_x( 'Dropoff address (hotel, resource, address, terminal)', 'transfer_checkout', 'mybooking-wp-plugin') ?>"></textarea>
      </div>
    <% } %>  
  <% } else if (configuration.transfer_origin_destination_detailed_info_mode === 'flight_address') { %>
    <!-- Standard pickup/dropoff -->
    <h5 class="mb-4 complete-section-title"><?php echo esc_html_x( "Transfer details", 'transfer_checkout', 'mybooking-wp-plugin') ?></h5>
    <h6><?php echo esc_html_x( "Outward Journey Details", 'transfer_checkout', 'mybooking-wp-plugin') ?></h6>
    <div class="form-row">
      <div class="form-group customer_component col-md-6">
        <label for="detailed_origin_flight_number"><?php echo esc_html_x( 'Flight or vessel number', 'transfer_checkout', 'mybooking-wp-plugin') ?>*</label>
        <input type="text" class="form-control" name="detailed_origin_flight_number" id="detailed_origin_flight_number" autocomplete="off" placeholder="<?php echo esc_attr_x( 'Flight number', 'transfer_checkout', 'mybooking-wp-plugin') ?>:*" maxlength="50">
      </div>
      <div class="form-group customer_component col-md-6">
          <label for="detailed_origin_flight_estimated_time"><?php echo esc_html_x( 'Flight or vessel estimated time', 'transfer_checkout', 'mybooking-wp-plugin') ?>*</label>
          <input type="text" class="form-control" name="detailed_origin_flight_estimated_time" autocomplete="off" id="detailed_origin_flight_estimated_time" placeholder="<?php echo esc_attr_x( 'Flight estimated time', 'transfer_checkout', 'mybooking-wp-plugin') ?>:*" maxlength="50">
      </div>
    </div>   
    <% if (shopping_cart.round_trip) { %>
      <h6><?php echo esc_html_x( "Return Journey Details", 'transfer_checkout', 'mybooking-wp-plugin') ?></h6>
      <div class="form-row">
        <div class="form-group customer_component col-md-6">
          <label for="detailed_return_origin_flight_number"><?php echo esc_html_x( 'Flight or Vessel number', 'transfer_checkout', 'mybooking-wp-plugin') ?>*</label>
          <input type="text" class="form-control" name="detailed_return_origin_flight_number" id="detailed_return_origin_flight_number" autocomplete="off" placeholder="<?php echo esc_attr_x( 'Flight number', 'transfer_checkout', 'mybooking-wp-plugin') ?>:*" maxlength="50">
        </div>
        <div class="form-group customer_component col-md-6">
          <label for="detailed_return_origin_flight_estimated_time"><?php echo esc_html_x( 'Flight or Vessel estimated time', 'transfer_checkout', 'mybooking-wp-plugin') ?>*</label>
          <input type="text" class="form-control" name="detailed_return_origin_flight_estimated_time" autocomplete="off" id="detailed_return_origin_flight_estimated_time" placeholder="<?php echo esc_attr_x( 'Flight estimated time', 'transfer_checkout', 'mybooking-wp-plugin') ?>:*" maxlength="50">
        </div>
      </div>    
    <% } %>
    <h6><?php echo esc_html_x( "Accommodation", 'transfer_checkout', 'mybooking-wp-plugin') ?></h6>
    <div class="form-group">
      <label for="detailed_origin_address"><?php echo esc_html_x( 'Name of Hotel / Complex / Villa and address', 'transfer_checkout', 'mybooking-wp-plugin') ?>*</label>
      <textarea class="form-control" name="detailed_origin_address" id="detailed_origin_address" rows="5" placeholder="<?php echo esc_attr_x( 'Name of Hotel / Complex / Villa and address', 'transfer_checkout', 'mybooking-wp-plugin') ?>"></textarea>
    </div>      
  <% } else { %>
      <!-- Trip -->
      <h5 class="complete-section-title"><?php echo esc_html_x( "Trip details", 'transfer_checkout', 'mybooking-wp-plugin') ?></h5>

      <!-- Going Origin -->
      <div><u><b><i class="fa fa-car"></i>&nbsp;<?php echo esc_html_x( "Pickup", 'transfer_checkout', 'mybooking-wp-plugin') ?></b> <%= shopping_cart.origin_point_name_customer_translation%></u></div>

      <% if (shopping_cart.origin_point_detailed_info) { %> 
        <% if (shopping_cart.origin_point_type === 'location') { %>
          <div class="form-group">
            <label for="detailed_origin_address"><?php echo esc_html_x( 'Address or hotel name', 'transfer_checkout', 'mybooking-wp-plugin') ?>*</label>
            <textarea class="form-control" name="detailed_origin_address" id="detailed_origin_address" rows="5" placeholder="<?php echo esc_attr_x( 'Address or hotel name', 'transfer_checkout', 'mybooking-wp-plugin') ?>"></textarea>
          </div>
        <% } else { %>
          <div class="form-row">
            <div class="form-group customer_component col-md-6">
              <label for="detailed_origin_flight_number"><?php echo esc_html_x( 'Flight or vessel number', 'transfer_checkout', 'mybooking-wp-plugin') ?>*</label>
              <input type="text" class="form-control" name="detailed_origin_flight_number" id="detailed_origin_flight_number" autocomplete="off" placeholder="<?php echo esc_attr_x( 'Flight number', 'transfer_checkout', 'mybooking-wp-plugin') ?>:*" maxlength="50">
            </div>
            <div class="form-group customer_component col-md-6">
              <label for="detailed_origin_flight_estimated_time"><?php echo esc_html_x( 'Flight or vessel estimated time', 'transfer_checkout', 'mybooking-wp-plugin') ?>*</label>
              <input type="text" class="form-control" name="detailed_origin_flight_estimated_time" autocomplete="off" id="detailed_origin_flight_estimated_time" placeholder="<?php echo esc_attr_x( 'Flight estimated time', 'transfer_checkout', 'mybooking-wp-plugin') ?>:*" maxlength="50">
            </div>
          </div>
        <% } %>
      <% } %>  

      <!-- Going Destination -->
      
      <div><u><b><i class="fa fa-map-marker"></i>&nbsp;<?php echo esc_html_x( "Drop off", 'transfer_checkout', 'mybooking-wp-plugin') ?></b> <%= shopping_cart.destination_point_name_customer_translation%></u></div>

      <% if (shopping_cart.destination_point_detailed_info) { %> 
        <% if (shopping_cart.destination_point_type === 'location') { %>
          <div class="form-group">
            <label for="detailed_destination_address"><?php echo esc_html_x( 'Address or hotel name', 'transfer_checkout', 'mybooking-wp-plugin') ?>*</label>
            <textarea class="form-control" name="detailed_destination_address" id="detailed_destination_address" rows="5" placeholder="<?php echo esc_attr_x( 'Address or hotel name', 'transfer_checkout', 'mybooking-wp-plugin') ?>"></textarea>
          </div>
        <% } else { %>
          <div class="form-row">
            <div class="form-group customer_component col-md-6">
              <label for="detailed_destination_flight_number"><?php echo esc_html_x( 'Flight or vessel number', 'transfer_checkout', 'mybooking-wp-plugin') ?>*</label>
              <input type="text" class="form-control" name="detailed_destination_flight_number" id="detailed_destination_flight_number" autocomplete="off" placeholder="<?php echo esc_attr_x( 'Flight number', 'transfer_checkout', 'mybooking-wp-plugin') ?>:*" maxlength="50">
            </div>
            <div class="form-group customer_component col-md-6">
              <label for="detailed_destination_flight_estimated_time"><?php echo esc_html_x( 'Flight or vessel estimated time', 'transfer_checkout', 'mybooking-wp-plugin') ?>*</label>
              <input type="text" class="form-control" name="detailed_destination_flight_estimated_time" autocomplete="off" id="detailed_destination_flight_estimated_time" placeholder="<?php echo esc_attr_x( 'Flight estimated time', 'transfer_checkout', 'mybooking-wp-plugin') ?>:*" maxlength="50">
            </div>
          </div>
        <% } %>
      <% } %>  

      <% if (shopping_cart.round_trip) { %>
        <hr>
        <h5 class="complete-section-title"><?php echo esc_html_x( "Round trip details", 'transfer_checkout', 'mybooking-wp-plugin') ?></h5>

        <!-- Return Origin -->

        <div><u><b><i class="fa fa-car"></i>&nbsp;<?php echo esc_html_x( "Pickup", 'transfer_checkout', 'mybooking-wp-plugin') ?></b> <%= shopping_cart.return_origin_point_name_customer_translation%></u></div>
        
        <% if (shopping_cart.return_origin_point_detailed_info) { %> 
          <% if (shopping_cart.return_origin_point_type === 'location') { %>
            <div class="form-group">
              <label for="detailed_return_origin_address"><?php echo esc_html_x( 'Address or hotel name', 'transfer_checkout', 'mybooking-wp-plugin') ?>*</label>
              <textarea class="form-control" name="detailed_return_origin_address" id="detailed_return_origin_address" rows="5" placeholder="<?php echo esc_attr_x( 'Address or hotel name', 'transfer_checkout', 'mybooking-wp-plugin') ?>"></textarea>
            </div>
          <% } else { %>
            <div class="form-row">
              <div class="form-group customer_component col-md-6">
                <label for="detailed_return_origin_flight_number"><?php echo esc_html_x( 'Flight or Vessel number', 'transfer_checkout', 'mybooking-wp-plugin') ?>*</label>
                <input type="text" class="form-control" name="detailed_return_origin_flight_number" id="detailed_return_origin_flight_number" autocomplete="off" placeholder="<?php echo esc_attr_x( 'Flight number', 'transfer_checkout', 'mybooking-wp-plugin') ?>:*" maxlength="50">
              </div>
              <div class="form-group customer_component col-md-6">
                <label for="detailed_return_origin_flight_estimated_time"><?php echo esc_html_x( 'Flight or Vessel estimated time', 'transfer_checkout', 'mybooking-wp-plugin') ?>*</label>
                <input type="text" class="form-control" name="detailed_return_origin_flight_estimated_time" autocomplete="off" id="detailed_return_origin_flight_estimated_time" placeholder="<?php echo esc_attr_x( 'Flight estimated time', 'transfer_checkout', 'mybooking-wp-plugin') ?>:*" maxlength="50">
              </div>
            </div>
          <% } %>
        <% } %>

        <!-- Return Destination -->
        
        <div><u><b><i class="fa fa-map-marker"></i>&nbsp;<?php echo esc_html_x( "Drop off", 'transfer_checkout', 'mybooking-wp-plugin') ?></b> <%= shopping_cart.return_destination_point_name_customer_translation%></u></div>

        <% if (shopping_cart.return_destination_point_detailed_info) { %> 
          <% if (shopping_cart.return_destination_point_type === 'location') { %>
            <div class="form-group">
              <label for="detailed_return_destination_address"><?php echo esc_html_x( 'Address or hotel name', 'transfer_checkout', 'mybooking-wp-plugin') ?>*</label>
              <textarea class="form-control" name="detailed_return_destination_address" id="detailed_return_destination_address" rows="5" placeholder="<?php echo esc_attr_x( 'Address or hotel name', 'transfer_checkout', 'mybooking-wp-plugin') ?>"></textarea>
            </div>
          <% } else { %>
            <div class="form-row">
              <div class="form-group customer_component col-md-6">
                <label for="detailed_return_destination_flight_number"><?php echo esc_html_x( 'Flight or Vessel number', 'transfer_checkout', 'mybooking-wp-plugin') ?>*</label>
                <input type="text" class="form-control" name="detailed_return_destination_flight_number" id="detailed_return_destination_flight_number" autocomplete="off" placeholder="<?php echo esc_attr_x( 'Flight number', 'transfer_checkout', 'mybooking-wp-plugin') ?>:*" maxlength="50">
              </div>
              <div class="form-group customer_component col-md-6">
                <label for="detailed_return_destination_flight_estimated_time"><?php echo esc_html_x( 'Flight or Vessel estimated time', 'transfer_checkout', 'mybooking-wp-plugin') ?>*</label>
                <input type="text" class="form-control" name="detailed_return_destination_flight_estimated_time" autocomplete="off" id="detailed_return_destination_flight_estimated_time" placeholder="<?php echo esc_attr_x( 'Flight estimated time', 'transfer_checkout', 'mybooking-wp-plugin') ?>:*" maxlength="50">
              </div>
            </div>
          <% } %>
        <% } %>  

      <% } %>

  <% } %>    

  <hr>

  <h5 class="complete-section-title"><?php echo esc_html_x( "Additional information", 'transfer_checkout', 'mybooking-wp-plugin') ?></h5>

  <div class="form-group">
    <label for="comments"><?php echo esc_html_x( 'Comments', 'transfer_checkout', 'mybooking-wp-plugin') ?></label>
    <textarea class="form-control" name="comments" id="comments" rows="5" placeholder="<?php echo esc_attr_x( 'Comments', 'transfer_checkout', 'mybooking-wp-plugin') ?>"></textarea>
  </div>
  <br>

  <!-- Reservation : payment (script_payment_detail) -->
  <div id="mybooking_transfer_payment_detail">
  </div>

</script>  



<!-- Reservation summary -->
<script type="text/tmpl" id="script_transfer_reservation_summary">
  <div class="complete-reservation-summary-card ">
    <div class="card mb-3">
      <div class="card-header">
        <b><?php echo esc_html_x( 'Reservation summary', 'transfer_checkout', 'mybooking-wp-plugin') ?></b>
      </div>
      <ul class="list-group list-group-flush">
        <li class="list-group-item reservation-summary-card-detail"><i class="fa fa-car"></i>&nbsp;<%=shopping_cart.origin_point_name_customer_translation%></li>
        <li class="list-group-item reservation-summary-card-detail"><i class="fa fa-map-marker"></i>&nbsp;<%=shopping_cart.destination_point_name_customer_translation%></li>
        <li class="list-group-item reservation-summary-card-detail">
          <i class="fa fa-calendar-o"></i>&nbsp;<%=shopping_cart.date%>&nbsp;<%=shopping_cart.time%>
        </li>
        <li class="list-group-item reservation-summary-card-detail">
          <i class="fa fa-user"></i>&nbsp;<%=shopping_cart.number_of_adults%>
          <i class="fa fa-child"></i>&nbsp;<%=shopping_cart.number_of_children%>
        </li>        
        <% if (shopping_cart.engine_modify_dates) { %>
          <li class="list-group-item">
            <button id="mybooking_transfer_modify_reservation_button" class="btn btn-primary w-100"><?php echo esc_html_x( 'Edit', 'transfer_checkout', 'mybooking-wp-plugin' ) ?></button>
          </li>
        <% } %>
      </ul>
    </div>

    <!-- Product -->
    <div class="card mb-3">
      <div class="card-header">
        <b><?php echo esc_html_x( 'Vehicle', 'transfer_checkout', 'mybooking-wp-plugin' ) ?></b>
      </div>
      <ul class="list-group list-group-flush">
        <li class="list-group-item reservation-summary-card-detail">
           <!-- Photo -->
           <img class="product-img" style="width: 120px" src="<%=shopping_cart.item_full_photo%>"/>
           <br>
           <!-- Description -->
           <span class="h6"><b><%=shopping_cart.item_name_customer_translation%></b></span>
           <!-- Price -->             
           <span class="product-amount pull-right">
             <%=configuration.formatCurrency(shopping_cart.item_cost)%>
           </span>
        </li>
      </ul>
    </div>

    <!-- Extras -->
    <% if (shopping_cart.extras.length > 0) { %>
      <div class="card mb-3">
        <div class="card-header">
          <b><?php echo esc_html_x( 'Extras', 'transfer_checkout', 'mybooking-wp-plugin' ) ?></b>
        </div>
        <ul class="list-group list-group-flush">
          <% for (var idx=0;idx<shopping_cart.extras.length;idx++) { %>
          <li class="list-group-item reservation-summary-card-detail">
              <span class="extra-name"><b><%=shopping_cart.extras[idx].extra_name_customer_translation%></b></span>
              <span class="badge badge-info"><%=shopping_cart.extras[idx].quantity%></span>
              <span class="product-amount pull-right"><%=configuration.formatCurrency(shopping_cart.extras[idx].extra_cost)%></span>
          </li>
          <% } %>
        </ul>
      </div>
    <% } %>
    <!-- Total -->
    <div class="jumbotron mb-3">
      <h2 class="h5 text-center"><?php echo esc_html_x( "Total", 'transfer_checkout', 'mybooking-wp-plugin' ) ?></h2>
      <h2 class="h3 text-center"><%=configuration.formatCurrency(shopping_cart.total_cost)%></h2>
    </div>
  </div>
</script>

<!-- Payment detail -->
<script type="text/tmpl" id="script_transfer_payment_detail">
    <%
       var paymentAmount = 0;
       var selectionOptions = 0;

       if (sales_process.can_request) {
         selectionOptions += 1;
       }

       if (sales_process.can_pay_on_delivery) {
         selectionOptions += 1;
       }

       if (sales_process.can_pay) {
         selectionOptions += 1;
         if (sales_process.can_pay_deposit) {
            paymentAmount = shopping_cart.booking_amount;
         }
         else {
            paymentAmount = shopping_cart.total_cost;
         }
       }
    %>

    <!-- Payment -->

    <% if (sales_process.can_pay) { %>
      <% if (sales_process.payment_methods.paypal_standard && sales_process.payment_methods.tpv_virtual) { %>
        <!-- The payment method will be selected later -->
        <input type="hidden" name="payment" value="none">
      <% } else if (sales_process.payment_methods.paypal_standard) { %>
        <!-- Fixed paypal standard -->
        <input type="hidden" name="payment" value="paypal_standard">
      <% } else  if (sales_process.payment_methods.tpv_virtual) { %>
        <!-- Fixed tpv -->
        <input type="hidden" name="payment" value="<%=sales_process.payment_methods.tpv_virtual%>">
      <% } %>
    <% } else { %>
      <input type="hidden" name="payment" value="none">
    <% } %>

    <% if (selectionOptions > 1) { %>
      <hr>
      <div class="form-row">
         <% if (sales_process.can_request) { %>
           <div class="form-group col-md-12">
             <label for="complete_action_request_reservation">
               <input type="radio" id="complete_action_request_reservation" name="complete_action" value="request_reservation" class="complete_action">&nbsp;
                 <?php echo esc_html_x( 'Request reservation', 'transfer_checkout', 'mybooking-wp-plugin' ) ?>
             </label>
           </div>
         <% } %>
         <% if (sales_process.can_pay_on_delivery) { %>
           <div class="form-group col-md-12">
             <label for="payments_paypal_standard">
               <input type="radio" id="complete_action_pay_on_delivery" name="complete_action" value="pay_on_delivery" class="complete_action">&nbsp;
                 <?php echo esc_html_x( 'Book now and pay on arrival', 'transfer_checkout', 'mybooking-wp-plugin' ) ?>
             </label>
           </div>
         <% } %>
         <% if (sales_process.can_pay) { %>
           <div class="form-group col-md-12">
             <label for="complete_action_pay_now">
               <input type="radio" id="complete_action_pay_now" name="complete_action" value="pay_now" class="complete_action">&nbsp;
                 <?php echo esc_html_x( 'Book now and pay now', 'transfer_checkout', 'mybooking-wp-plugin' ) ?>
             </label>
           </div>
         <% } %>
      </div>
    <% } %>

    <!-- Request reservation -->

    <% if (sales_process.can_request) { %>
      <div id="request_reservation_container" <% if (selectionOptions > 1 || !sales_process.can_request) { %>style="display:none"<%}%>>

          <div class="border p-4">
            <div class="form-row">
              <div class="form-group col-md-12">
                <label for="payments_paypal_standard">
                  <input type="checkbox" id="conditions_read_request_reservation" name="conditions_read_request_reservation">&nbsp;
                  <?php if ( empty($args['terms_and_conditions']) ) { ?>
                    <?php echo esc_html_x( 'I have read and hereby accept the conditions of rental', 'transfer_checkout', 'mybooking-wp-plugin' ) ?>
                  <?php } else { ?>
                    <?php echo wp_kses_post ( sprintf( _x( 'I have read and hereby accept the <a href="%s" target="_blank">conditions</a> of rental',
                                                           'transfer_checkout', 'mybooking-wp-plugin' ),
                                                       $args['terms_and_conditions'] ) )?>
                  <?php } ?>
                </label>
              </div>
            </div>

            <div class="form-row">
              <div class="form-group col-md-12">
                <button type="submit" class="btn btn-primary"><?php echo esc_html_x( 'Request reservation', 'transfer_checkout', 'mybooking-wp-plugin' ) ?></button>
              </div>
            </div>
          </div>

      </div>
    <% } %>

    <% if (sales_process.can_pay_on_delivery) { %>
      <!-- Pay on delivery -->
      <div id="payment_on_delivery_container" <% if (selectionOptions > 1 || !sales_process.can_pay_on_delivery) { %>style="display:none"<%}%>>

          <div class="border p-4">
              <div class="form-row">
                <div class="form-group col-md-12">
                  <label for="conditions_read_payment_on_delivery">
                    <input type="checkbox" id="conditions_read_payment_on_delivery" name="conditions_read_payment_on_delivery">&nbsp;
                    <?php if ( empty($args['terms_and_conditions']) ) { ?>
                      <?php echo esc_html_x( 'I have read and hereby accept the conditions of rental', 'transfer_checkout', 'mybooking-wp-plugin' ) ?>
                    <?php } else { ?>
                      <?php echo wp_kses_post ( sprintf( _x( 'I have read and hereby accept the <a href="%s" target="_blank">conditions</a> of rental',
                                                             'transfer_checkout', 'mybooking-wp-plugin' ),
                                                         $args['terms_and_conditions'] ) ) ?>
                    <?php } ?>
                  </label>
                </div>
              </div>

              <div class="form-row">
                <div class="form-group col-md-12">
                  <button type="submit" class="btn btn-primary"><?php echo esc_html_x( 'Confirm', 'transfer_checkout', 'mybooking-wp-plugin' ) ?></button>
                </div>
              </div>
          </div>

      </div>
    <% } %>

    <% if (sales_process.can_pay) { %>

      <!-- Pay now -->

      <div id="payment_now_container" <% if (selectionOptions > 1 || !sales_process.can_pay) { %>style="display:none"<%}%>>

        <div class="border p-4">
            <h4><%=i18next.t('complete.reservationForm.total_payment', {amount: configuration.formatCurrency(paymentAmount)})%></h4>
            <br>

            <!-- Payment amount -->

            <div class="alert alert-info">
               <p><%=i18next.t('complete.reservationForm.booking_amount',{amount: configuration.formatCurrency(paymentAmount)})%></p>
            </div>

            <% if (sales_process.payment_methods.paypal_standard &&
                   sales_process.payment_methods.tpv_virtual) { %>
                <div class="alert alert-secondary" role="alert">
                  <?php echo wp_kses_post( _x( 'You will be redirected to the <b>payment platform</b> to make the confirmation payment securely. You can use <u>Paypal</u> or <u>credit card</u> to make the payment.', 'transfer_checkout', 'mybooking-wp-plugin' ) )?>
                </div>
                <div class="form-row">
                   <div class="form-group col-md-12">
                     <label for="payments_paypal_standard">
                      <input type="radio" id="payments_paypal_standard" name="payment_method_select" class="payment_method_select" value="paypal_standard">&nbsp;<?php echo esc_html_x( 'Paypal', 'transfer_checkout', 'mybooking-wp-plugin' ) ?>
                      <img src="<?php echo esc_url( plugin_dir_url(__DIR__).'/assets/images/pm-paypal.jpg') ?>"/>
                     </label>
                   </div>
                   <div class="form-group col-md-12">
                     <label for="payments_credit_card">
                      <input type="radio" id="payments_credit_card" name="payment_method_select" class="payment_method_select" value="<%=sales_process.payment_methods.tpv_virtual%>">&nbsp;<?php echo _x( 'Credit or debit card', 'transfer_checkout', 'mybooking-wp-plugin' ) ?>
                      <img src="<?php echo esc_url( plugin_dir_url(__DIR__).'/assets/images/pm-visa.jpg') ?>"/>
                      <img src="<?php echo esc_url( plugin_dir_url(__DIR__).'/assets/images/pm-mastercard.jpg') ?>"/>
                     </label>
                   </div>
                </div>
                <div id="payment_method_select_error" class="form-row">
                </div>
            <% } else if (sales_process.payment_methods.paypal_standard) { %>
                <div class="alert alert-secondary" role="alert">
                  <?php echo wp_kses_post( _x( 'You will be redirected to <b>Paypal payment platform</b> to make the confirmation payment securely. You can use <u>Paypal</u> or <u>credit card</u> to make the payment.', 'transfer_checkout', 'mybooking-wp-plugin' ) ) ?>
                </div>
                <img src="<?php echo esc_url( plugin_dir_url(__DIR__).'/assets/images/pm-paypal.jpg') ?>"/>
                <img src="<?php echo esc_url( plugin_dir_url(__DIR__).'/assets/images/pm-visa.jpg') ?>"/>
                <img src="<?php echo esc_url( plugin_dir_url(__DIR__).'/assets/images/pm-mastercard.jpg') ?>"/>                    
            <% } else if (sales_process.payment_methods.tpv_virtual) { %>
                <div class="alert alert-secondary" role="alert">
                  <?php echo wp_kses_post( _x( 'You will be redirected to the <b>credit card payment platform</b> to make the confirmation payment securely.' ,
                    'transfer_checkout', 'mybooking-wp-plugin' )  )?>
                </div>
                <img src="<?php echo esc_url( plugin_dir_url(__DIR__).'/assets/images/pm-visa.jpg') ?>"/>
                <img src="<?php echo esc_url( plugin_dir_url(__DIR__).'/assets/images/pm-mastercard.jpg') ?>"/>
            <% } %>

            <hr>
            <div class="form-row">
              <div class="form-group col-md-12">
                <label for="payments_paypal_standard">
                  <input type="checkbox" id="conditions_read_pay_now" name="conditions_read_pay_now">&nbsp;
                      <?php if ( empty($args['terms_and_conditions']) ) { ?>
                        <?php echo esc_html_x( 'I have read and hereby accept the conditions of rental', 'transfer_checkout', 'mybooking-wp-plugin' ) ?>
                      <?php } else { ?>
                        <?php echo wp_kses_post ( sprintf( _x( 'I have read and hereby accept the <a href="%s" target="_blank">conditions</a> of rental',
                                                               'transfer_checkout', 'mybooking-wp-plugin' ),
                                                           $args['terms_and_conditions'] ) )?>
                      <?php } ?>
                </label>
              </div>
            </div>

            <div class="form-row">
              <div class="form-group col-md-12">
                <button type="submit" class="btn btn-primary"><%=i18next.t('complete.reservationForm.payment_button',{amount: configuration.formatCurrency(paymentAmount)})%></a>
              </div>
            </div>
        </div>

      </div>
    <% } %>
</script>
