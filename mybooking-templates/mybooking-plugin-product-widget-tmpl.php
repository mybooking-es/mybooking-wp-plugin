<?php
  /** 
   * The Template for showing the product calendar widget - JS Microtemplates
   *
   * This template can be overridden by copying it to yourtheme/mybooking-templates/mybooking-plugin-widget-tmpl.php
   *
   * @phpcs:disable PHPCompatibility.Miscellaneous.RemovedAlternativePHPTags.MaybeASPOpenTagFound 
   * @phpcs:disable Generic.PHP.DisallowAlternativePHPTags.MaybeASPOpenTagFound
   * @phpcs:disable Generic.PHP.DisallowAlternativePHPTags.MaybeASPShortOpenTagFound   
   */
?>
    <script type="text/tmpl" id="form_calendar_selector_tmpl">

            <% if (configuration.pickupReturnPlace) { %> 
              <!-- Delivery -->
              <div class="form-group">
                <select id="pickup_place" name="pickup_place" 
                        placeholder="<?php echo esc_attr_x( 'Select pick-up place', 'renting_product_calendar', 'mybooking-wp-plugin') ?>" class="form-control w-100"> </select>
                </select>
              </div>
              <!-- Collection -->
              <div class="form-group">
                <select id="return_place" name="return_place" 
                        placeholder="<?php echo esc_attr_x( 'Select return place', 'renting_product_calendar', 'mybooking-wp-plugin' )?>" class="form-control w-100" disabled> </select>
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
        <!-- Exceeds max duration -->
        <% if (product && product.exceeds_max) { %>
           <div class="alert alert-danger">
              <p class="text-center"><%= i18next.t('chooseProduct.max_duration', {duration: i18next.t('common.'+product.price_units, {count: product.max_value, interpolation: {escapeValue: false}} ), interpolation: {escapeValue: false}}) %></p>
           </div>  
        <!-- Less than min duration -->  
        <% } else if (product && product.be_less_than_min) { %>
           <div class="alert alert-danger">
              <p class="text-center"><%= i18next.t('chooseProduct.min_duration', {duration: i18next.t('common.'+product.price_units, {count: product.min_value, interpolation: {escapeValue: false}} ), interpolation: {escapeValue: false}}) %></p>
           </div>  
        <!-- Available --> 
        <% } else if (product_available) { %>
          <div class="jumbotron mb-3">
            <h2 class="h4"><?php echo esc_html_x( 'Reservation summary', 'renting_product_calendar', 'mybooking-wp-plugin') ?></h2>
            <hr>
            <!-- Duration -->
            <% if (shopping_cart.days) { %>
              <p class="lead"><span><%=shopping_cart.days%> <?php echo MyBookingEngineContext::getInstance()->getDuration() ?></span></p>
            <% } else if (shopping_cart.hours) { %>
  					 <p class="lead"><span><%=shopping_cart.hours%> <?php echo esc_html_x( 'hours(s)', 'renting_product_calendar', 'mybooking-wp-plugin' ) ?></span></p>
            <% } %>
            
            <!-- Product -->
            <p class="lead"><?php echo MyBookingEngineContext::getInstance()->getProduct() ?>: <span class="pull-right"><%=configuration.formatCurrency(shopping_cart.item_cost)%></span></p>
            
            <!-- Extras -->
            <% if (shopping_cart.extras.length > 0) { %>
              <% for (var idx=0;idx<shopping_cart.extras.length;idx++) { %>
                <p class="lead"><%=shopping_cart.extras[idx].extra_description%> <% if (shopping_cart.extras[idx].quantity > 1) { %><span class="badge badge-info"><%=shopping_cart.extras[idx].quantity%></span> <% } %>: <span class="pull-right"> <%=configuration.formatCurrency(shopping_cart.extras[idx].extra_cost)%></span></p>
              <% } %>
            <% } %>

            <!-- Supplements -->
            <% if (shopping_cart.time_from_cost > 0) { %>
              <p class="lead"><?php echo esc_html_x( 'Pick-up time supplement', 'renting_product_calendar', 'mybooking-wp-plugin' ) ?>: <span class="pull-right"><%=configuration.formatCurrency(shopping_cart.time_from_cost)%></span></p>
            <% } %>

            <% if (shopping_cart.pickup_place_cost > 0) { %>
              <p class="lead"><?php echo esc_html_x( 'Pick-up place supplement', 'renting_product_calendar', 'mybooking-wp-plugin' ) ?>: <span class="pull-right"><%=configuration.formatCurrency(shopping_cart.pickup_place_cost)%></span></p>            
            <% } %>

            <% if (shopping_cart.time_to_cost > 0) { %>
              <p class="lead"><?php echo esc_html_x( 'Return time supplement', 'renting_product_calendar', 'mybooking-wp-plugin' ) ?>: <span class="pull-right"><%=configuration.formatCurrency(shopping_cart.time_to_cost)%></span></p>                
            <% } %>

            <% if (shopping_cart.return_place_cost > 0) { %>
              <p class="lead"><?php echo esc_html_x( 'Return place supplement', 'renting_product_calendar', 'mybooking-wp-plugin' ) ?>: <span class="pull-right"><%=configuration.formatCurrency(shopping_cart.return_place_cost)%></span></p>                
            <% } %>
            
            <!-- Total -->
            <p class="lead"><?php echo esc_html_x( 'Total', 'renting_product_calendar', 'mybooking-wp-plugin' ) ?>: <span class="pull-right"><%=configuration.formatCurrency(shopping_cart.total_cost)%></span></p>
          </div>
          <div class="form-group">
             <input id="add_to_shopping_cart_btn" 
                    class="btn btn-primary w-100" 
                    type="submit" value="<?php echo esc_attr_x( 'Book Now!', 'renting_product_calendar', 'mybooking-wp-plugin') ?>"/>
          </div>   
        <% } else { %>
          <% if (product_type == 'resource') { %>
            <div class="alert alert-danger">
              <p><?php echo esc_html_x( 'Book Now!', 'renting_product_calendar', 'mybooking-wp-plugin') ?></p>
              <p><?php echo esc_html_x( 'Sorry, there is no availability during these hours', 'renting_product_calendar', 'mybooking-wp-plugin') ?></p>
            </div>
          <% } else if (product_type == 'category_of_resources') { %>
            <div class="alert alert-warning">
              <p><?php echo esc_html_x( 'Sorry, there is no availability for the entire period. The calendar shows those days when there is availability, but it may not be available for certain consecutive dates.', 'renting_product_calendar', 'mybooking-wp-plugin') ?></p>
            </div>
          <% } %>
        <% } %>  
    </script>