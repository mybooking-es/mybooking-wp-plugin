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

  <ol class="mybooking-product_calendar-step-list mb-section">

    <% if (configuration.pickupReturnPlace) { %>

<<<<<<< HEAD
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

            <!-- Hide the price if it is zero and hide is price zero is configured -->
            <% if (!(configuration.hidePriceIfZero && shopping_cart.item_cost == 0)) { %>
              <!-- Product -->
              <p class="lead"><?php echo MyBookingEngineContext::getInstance()->getProduct() ?>: <span class="pull-right"><%=configuration.formatCurrency(shopping_cart.item_cost)%></span></p>
            <% } %>
            
            <!-- Extras -->
            <% if (shopping_cart.extras.length > 0) { %>
              <% for (var idx=0;idx<shopping_cart.extras.length;idx++) { %>
                <p class="lead"><%=shopping_cart.extras[idx].extra_description%> <% if (shopping_cart.extras[idx].quantity > 1) { %><span class="badge badge-info"><%=shopping_cart.extras[idx].quantity%></span> <% } %>: 
                <!-- Hide the price if it is zero and hide is price zero is configured -->  
                <% if (!(configuration.hidePriceIfZero && shopping_cart.extras[idx].extra_cost == 0)) { %>  
                  <span class="pull-right"> <%=configuration.formatCurrency(shopping_cart.extras[idx].extra_cost)%></span></p>
                <% } %>  
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

            <!-- Hide the price if it is zero and hide is price zero is configured -->
            <% if (!(configuration.hidePriceIfZero && shopping_cart.total_cost == 0)) { %>
              <!-- Total -->
              <p class="lead"><?php echo esc_html_x( 'Total', 'renting_product_calendar', 'mybooking-wp-plugin' ) ?>: <span class="pull-right"><%=configuration.formatCurrency(shopping_cart.total_cost)%></span></p>
            <% } %>

=======
      <li class="mybooking-product_calendar-step">
        <?php echo esc_html_x('Choose delivery and return places', 'renting_product_detail', 'mybooking-wp-plugin' ) ?>
      </li>

      <!-- Delivery -->
      <div class="mb-form-group">
        <select id="pickup_place" name="pickup_place" placeholder="<?php echo esc_attr_x( 'Select pick-up place', 'renting_product_calendar', 'mybooking-wp-plugin') ?>" class="form-control w-100"> </select>
      </div>

      <!-- Collection -->
      <div class="mb-form-group">
        <select id="return_place" name="return_place" placeholder="<?php echo esc_attr_x( 'Select return place', 'renting_product_calendar', 'mybooking-wp-plugin' )?>" class="form-control w-100" disabled> </select>
      </div>
    <% } %>

    <li class="mybooking-product_calendar-step">
      <?php echo esc_html_x('Select delivery and return dates', 'renting_product_detail', 'mybooking-wp-plugin' ) ?>
    </li>

    <!-- Date Selector -->
    <div class="mb-form-group">
      <input id="date" type="hidden" name="date"/>
      <div id="date-container" class="disabled-picker"></div>
    </div>

    <% if (configuration.timeToFrom) { %>

      <li class="mybooking-product_calendar-step">
        <?php echo esc_html_x('Select delivery and return time', 'renting_product_detail', 'mybooking-wp-plugin' ) ?>
      </li>

      <!-- Delivery time -->
      <div class="mb-form-group">
        <label class="">
          <?php echo esc_html_x('Delivery', 'renting_product_detail', 'mybooking-wp-plugin' ) ?>
        </label>
        <select id="time_from" name="time_from" placeholder="hh:mm" class="form-control" disabled> </select>
      </div>

      <!-- Collection time -->
      <div class="mb-form-group">
        <label class="">
          <?php echo esc_html_x('Return', 'renting_product_detail', 'mybooking-wp-plugin' ) ?>
        </label>
        <select id="time_to" name="time_to" placeholder="hh:mm" class="form-control" disabled> </select>
      </div>

    <% } else { %>
      <input type="hidden" name="time_from" value="<%=configuration.defaultTimeStart%>"/>
      <input type="hidden" name="time_to" value="<%=configuration.defaultTimeEnd%>"/>
    <% } %>
  </ol>

  <div id="reservation_detail" class="mb-form-group"></div>
</script>

<script type="text/tmpl" id="script_reservation_summary">

    <!-- Exceeds max duration -->
    <% if (product && product.exceeds_max) { %>
       <div class="mb-alert danger">
          <span><%= i18next.t('chooseProduct.max_duration', {duration: i18next.t('common.'+product.price_units, {count: product.max_value, interpolation: {escapeValue: false}} ), interpolation: {escapeValue: false}}) %></span>
       </div>

    <!-- Less than min duration -->
    <% } else if (product && product.be_less_than_min) { %>
       <div class="mb-alert danger">
          <span><%= i18next.t('chooseProduct.min_duration', {duration: i18next.t('common.'+product.price_units, {count: product.min_value, interpolation: {escapeValue: false}} ), interpolation: {escapeValue: false}}) %></span>
       </div>

    <!-- Available -->
    <% } else if (product_available) { %>
      <h2 class="mybooking-summary_details-title">
        <?php echo esc_html_x( 'Reservation summary', 'renting_product_calendar', 'mybooking-wp-plugin') ?>
      </h2>

      <div class="mybooking-summary_detail">

        <!-- Duration -->
        <% if (shopping_cart.days > 0) { %>
          <div class="mybooking-summary_extras">
            <span class="mybooking-summary_item">
              <span class="mybooking-summary_duration">
                <%=shopping_cart.days%> <?php echo MyBookingEngineContext::getInstance()->getDuration() ?>
              </span>
            </span>
>>>>>>> fb-refactor
          </div>

        <% } else if (shopping_cart.hours > 0) { %>
          <div class="mybooking-summary_extras">
            <span class="mybooking-summary_item">
              <span class="mybooking-summary_duration">
                <%=shopping_cart.hours%> <?php echo esc_html_x( 'hour(s)', 'renting_choose_product', 'mybooking-wp-plugin' ) ?>
              </span>
            </span>
          </div>
        <% } %>
      </div>

      <!-- Product -->
      <div class="mybooking-summary_extras">
        <span class="mybooking-summary_item">
          <?php echo MyBookingEngineContext::getInstance()->getProduct() ?>:
        </span>
        <span class="mybooking-summary_extra-amount">
          <%=configuration.formatCurrency(shopping_cart.item_cost)%>
        </span>
      </div>

      <!-- Extras -->

      <% if (shopping_cart.extras.length > 0) { %>
        <div class="mb-section">
          <div class="mybooking-summary_details-title">
            <?php echo esc_html_x( 'Extras', 'renting_complete', 'mybooking-wp-plugin' ) ?>
          </div>

          <% for (var idx=0;idx<shopping_cart.extras.length;idx++) { %>
            <div class="mybooking-summary_extras">
              <div class="mybooking-summary_extra-item">
                <span class="mb-badge info mybooking-summary_extra-quantity">
                  <%=shopping_cart.extras[idx].quantity%>
                </span>
                <span class="mybooking-summary_extra-name">
                  <%=shopping_cart.extras[idx].extra_description%>
                </span>
              </div>
              <span class="mybooking-summary_extra-amount">
                <%=configuration.formatCurrency(shopping_cart.extras[idx].extra_cost)%>
              </span>
            </div>
          <% } %>
        </div>
      <% } %>

      <!-- Supplements -->
      <div class="mybooking-summary_extras">

        <!-- Pick-up time -->
        <% if (shopping_cart.time_from_cost > 0) { %>
          <div class="mybooking-summary_extra-item">
            <span class="mybooking-summary_extra-name">
              <?php echo esc_html_x( 'Pick-up time supplement', 'renting_complete', 'mybooking-wp-plugin' ) ?>
            </span>
          </div>
          <span class="mybooking-summary_extra-amount">
            <%=configuration.formatCurrency(shopping_cart.time_from_cost)%>
          </span>
        <% } %>
      </div>

      <div class="mybooking-summary_extras">

        <!-- Pick-up place -->
        <% if (shopping_cart.pickup_place_cost > 0) { %>
          <div class="mybooking-summary_extra-item">
            <span class="mybooking-summary_extra-name">
              <?php echo esc_html_x( 'Pick-up place supplement', 'renting_complete', 'mybooking-wp-plugin' ) ?>
            </span>
          </div>
          <span class="mybooking-summary_extra-amount">
            <%=configuration.formatCurrency(shopping_cart.pickup_place_cost)%>
          </span>
        <% } %>
      </div>

      <div class="mybooking-summary_extras">

        <!-- Return time -->
        <% if (shopping_cart.time_to_cost > 0) { %>
          <div class="mybooking-summary_extra-item">
          <span class="mybooking-summary_extra-name">
            <?php echo esc_html_x( 'Return time supplement', 'renting_complete', 'mybooking-wp-plugin' ) ?>
          </span>
          </div>
          <span class="mybooking-summary_extra-amount">
            <%=configuration.formatCurrency(shopping_cart.time_to_cost)%>
          </span>
        <% } %>
      </div>

      <div class="mybooking-summary_extras">

        <!-- Return place -->
        <% if (shopping_cart.return_place_cost > 0) { %>
          <div class="mybooking-summary_extra-item">
            <span class="mybooking-summary_extra-name">
              <?php echo esc_html_x( 'Return place supplement', 'renting_complete', 'mybooking-wp-plugin' ) ?>
            </span>
          </div>
          <span class="mybooking-summary_extra-amount">
            <%=configuration.formatCurrency(shopping_cart.return_place_cost)%>
          </span>
        <% } %>
      </div>

      <!-- Total -->

      <div class="mb-section">
        <div class="mybooking-summary_total">
          <div class="mybooking-summary_total-label">
            <?php echo esc_html_x( "Total", 'renting_complete', 'mybooking-wp-plugin' ) ?>
          </div>
          <div class="mybooking-summary_total-amount">
            <%=configuration.formatCurrency(shopping_cart.total_cost)%>
          </div>
        </div>

        <?php if ( array_key_exists('show_taxes_included', $args) && ( $args['show_taxes_included'] ) ): ?>
          <div class="mybooking-product_taxes">
            <?php echo esc_html_x( 'Taxes included', 'renting_choose_product', 'mybooking-wp-plugin') ?>
          </div>
        <?php endif; ?>
      </div>

      <!-- Button -->

      <div class="mb-form-group">
         <input id="add_to_shopping_cart_btn" class="mb-button block btn-choose-product" type="submit" value="<?php echo esc_attr_x( 'Book Now!', 'renting_product_calendar', 'mybooking-wp-plugin') ?>"/>
      </div>

    <% } else { %>
      <% if (product_type == 'resource') { %>
        <div class="mb-alert danger">
          <?php echo esc_html_x( 'Book Now!', 'renting_product_calendar', 'mybooking-wp-plugin') ?>
          <?php echo esc_html_x( 'Sorry, there is no availability during these hours', 'renting_product_calendar', 'mybooking-wp-plugin') ?>
        </div>

      <% } else if (product_type == 'category_of_resources') { %>
        <div class="mb-alert warning">
          <?php echo esc_html_x( 'Sorry, there is no availability for the entire period. The calendar shows those days when there is availability, but it may not be available for certain consecutive dates.', 'renting_product_calendar', 'mybooking-wp-plugin') ?>
        </div>
      <% } %>
    <% } %>
</script>
