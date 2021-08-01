<?php
  /** 
   * The Template for showing the renting summary step - JS Microtemplates
   *
   * This template can be overridden by copying it to yourtheme/mybooking-templates/mybooking-plugin-summary-tmpl.php
   *
   * @phpcs:disable PHPCompatibility.Miscellaneous.RemovedAlternativePHPTags.MaybeASPOpenTagFound 
   * @phpcs:disable Generic.PHP.DisallowAlternativePHPTags.MaybeASPOpenTagFound
   * @phpcs:disable Generic.PHP.DisallowAlternativePHPTags.MaybeASPShortOpenTagFound   
   */
?>
<!-- Reservation summary -->
<script type="text/tmpl" id="script_reservation_summary">
  <div class="jumbotron mb-3">
    <h2 class="h3 text-center"><%= booking.summary_status %></h2>
  </div>

  <div class="row">
    <div class="col-md-4">
      <div class="card mb-3">
        <div class="card-header">
          <b><?php echo esc_html_x( 'My reservation', 'renting_summary', 'mybooking-wp-plugin') ?></b>
        </div>
        <ul class="list-group list-group-flush">
          <li class="list-group-item reservation-summary-card-detail"><small><?php echo esc_html_x( 'Reservation Id', 'renting_summary', 'mybooking-wp-plugin') ?></small><br><span class="h3"><%=booking.id%></span></li>
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
          <% if (booking.days > 0) { %>                  
            <li class="list-group-item reservation-summary-card-detail">
               <%=booking.days%> <?php echo MyBookingEngineContext::getInstance()->getDuration() ?>
            </li>
          <% } else if (booking.hours > 0) { %>
            <li class="list-group-item reservation-summary-card-detail">
               <%=booking.hours%> <?php echo esc_html_x( 'hour(s)', 'renting_summary', 'mybooking-wp-plugin' ) ?>  
            </li>                   
          <% } %>
        </ul>
      </div>
    </div>
    
    <div class="col-md-4">
      <div class="card mb-3">
        <div class="card-header">
          <b><?php echo esc_html_x( "Customer's details", 'renting_summary', 'mybooking-wp-plugin') ?></b>
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
          <b><?php echo MyBookingEngineContext::getInstance()->getProduct() ?></b>
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
               <!-- Hide the price if it is zero and hide is price zero is configured -->
               <% if (!(configuration.hidePriceIfZero && booking.booking_lines[idx].item_cost == 0)) { %> 
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
                            typeof booking.booking_lines[idx].promotion_code_value !== 'undefined' && booking.booking_lines.promotion_code_value !== '') { %>
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
               <% } %>  
               <?php if ( array_key_exists('show_taxes_included', $args) && ( $args['show_taxes_included'] ) ): ?>
               <p class="text-right"><small><?php echo esc_html_x( 'Taxes included', 'renting_choose_product', 'mybooking-wp-plugin') ?></small></p>
               <?php endif; ?>              
            </li>
          <% } %>
        </ul>
      </div>
      <% if (booking.booking_extras.length > 0) { %>
      <div class="card mb-3">
        <div class="card-header">
          <b><?php echo esc_html_x( 'Extras', 'renting_summary', 'mybooking-wp-plugin' ) ?></b>
        </div>  
        <ul class="list-group list-group-flush">
          <% for (var idx=0;idx<booking.booking_extras.length;idx++) { %>
          <li class="list-group-item reservation-summary-card-detail">
              <span class="extra-name"><b><%=booking.booking_extras[idx].extra_description%></b></span>
              <span class="badge badge-info"><%=booking.booking_extras[idx].quantity%></span>
              <!-- Hide the price if it is zero and hide is price zero is configured -->
              <% if (!(configuration.hidePriceIfZero && booking.booking_extras[idx].extra_cost == 0)) { %>
                <span class="product-amount pull-right"><%=configuration.formatCurrency(booking.booking_extras[idx].extra_cost)%></span>
              <% } %>
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
            <b><?php echo esc_html_x( 'Supplements', 'renting_summary', 'mybooking-wp-plugin' ) ?></b>
          </div>     
          <ul class="list-group list-group-flush">
            <!-- Supplements -->
            <% if (booking.time_from_cost > 0) { %>
            <li class="list-group-item">
              <span class="extra-name"><?php echo esc_html_x( 'Pick-up time supplement', 'renting_summary', 'mybooking-wp-plugin' ) ?></span>
              <span class="product-amount pull-right"><%=configuration.formatCurrency(booking.time_from_cost)%></span>
            </li>
            <% } %>
            <% if (booking.pickup_place_cost > 0) { %>
            <li class="list-group-item">
              <span class="extra-name"><?php echo esc_html_x( 'Pick-up place supplement', 'renting_summary', 'mybooking-wp-plugin' ) ?></span>
              <span class="product-amount pull-right"><%=configuration.formatCurrency(booking.pickup_place_cost)%></span>
            </li>
            <% } %>
            <% if (booking.time_to_cost > 0) { %>
            <li class="list-group-item">
              <span class="extra-name"><?php echo esc_html_x( 'Return time supplement', 'renting_summary', 'mybooking-wp-plugin' ) ?></span>
              <span class="product-amount pull-right"><%=configuration.formatCurrency(booking.time_to_cost)%></span>
            </li>
            <% } %>
            <% if (booking.return_place_cost > 0) { %>
            <li class="list-group-item">
              <span class="extra-name"><?php echo esc_html_x( 'Return place supplement', 'renting_summary', 'mybooking-wp-plugin' ) ?></span>
              <span class="product-amount pull-right"><%=configuration.formatCurrency(booking.return_place_cost)%></span>
            </li>
            <% } %>
            <% if (booking.driver_age_cost > 0) { %>
            <li class="list-group-item">
              <span class="extra-name"><?php echo esc_html_x( "Driver's age supplement", 'renting_summary', 'mybooking-wp-plugin' ) ?></span>
              <span class="product-amount pull-right"><%=configuration.formatCurrency(booking.driver_age_cost)%></span>
            </li>
            <% } %>
            <% if (booking.category_supplement_1_cost > 0) { %>
            <li class="list-group-item">
              <span class="product-amount pull-right"><?php echo esc_html_x( "Petrol supplement", 'renting_summary', 'mybooking-wp-plugin' ) ?></span>
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
            <b><?php echo esc_html_x( "Deposit", 'renting_summary', 'mybooking-wp-plugin' ) ?></b>
          </div>     
          <ul class="list-group list-group-flush">
            <!-- Deposit -->
            <% if (booking.total_deposit > 0) { %>
            <li class="list-group-item">
              <span class="extra-name"><?php echo esc_html_x('Deposit', 'renting_summary', 'mybooking-wp-plugin') ?></span>
              <span class="product-amount pull-right"><%=configuration.formatCurrency(booking.total_deposit)%></span>
            </li>
            <% } %>
          </ul>
        </div>
      <% } %>

      <!-- Hide the price if it is zero and hide is price zero is configured -->
      <% if (!(configuration.hidePriceIfZero && booking.total_cost == 0)) { %>
        <div class="jumbotron mb-3">
          <p class="lead"><?php echo esc_html_x( 'Total', 'renting_summary', 'mybooking-wp-plugin' ) ?> <span class="pull-right"><b><%=configuration.formatCurrency(booking.total_cost)%></b></span></p>
          <?php if ( array_key_exists('show_taxes_included', $args) && ( $args['show_taxes_included'] ) ): ?>
          <p class="text-right"><small><?php echo esc_html_x( 'Taxes included', 'renting_choose_product', 'mybooking-wp-plugin') ?></small></p>
          <?php endif; ?>          
          <% if (booking.total_paid > 0) { %>
            <p class="lead"><?php echo esc_html_x( 'Total paid', 'renting_summary', 'mybooking-wp-plugin' ) ?> <span class="pull-right"><%=configuration.formatCurrency(booking.total_paid)%></span></p>
          <% } %>
          <% if (booking.total_pending < booking.total_cost) { %>
            <p class="lead"><?php echo esc_html_x( 'Total pending', 'renting_summary', 'mybooking-wp-plugin' ) ?> <span class="text-danger pull-right"><%=configuration.formatCurrency(booking.total_pending)%></span></p>        
          <% } %>
        </div>
      <% } %>              
    </div>
    
  </div>

</script>