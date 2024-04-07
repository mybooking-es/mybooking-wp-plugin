<?php
/**
 *   MYBOOKING ENGINE - PRODUCT CALENDAR TEMPLATE
 *   ---------------------------------------------------------------------------
 *   The Template for showing the renting complete step
 *   This template can be overridden by copying it to your
 *   theme/mybooking-templates/mybooking-plugin-widget-tmpl.php
 *
 *   @phpcs:disable PHPCompatibility.Miscellaneous.RemovedAlternativePHPTags.MaybeASPOpenTagFound
 *   @phpcs:disable Generic.PHP.DisallowAlternativePHPTags.MaybeASPOpenTagFound
 *   @phpcs:disable Generic.PHP.DisallowAlternativePHPTags.MaybeASPShortOpenTagFound
 */
?>

<script type="text/tmpl" id="form_calendar_selector_tmpl">

  <ol class="mybooking-product_calendar-step-list mb-section">

    <% if (configuration.pickupReturnPlace) { %>

      <li class="mybooking-product_calendar-step">
        <?php echo esc_html_x('Choose delivery and return places', 'renting_product_detail', 'mybooking-wp-plugin' ) ?>
      </li>

      <!-- // Delivery -->
      <div class="mb-form-row">
        <div class="mb-form-group">
          <label for="pickup_place">
						<?php echo esc_html_x( 'Pick-up place', 'renting_product_calendar', 'mybooking-wp-plugin') ?>
					</label>
          <select id="pickup_place" name="pickup_place" placeholder="<?php echo esc_attr_x( 'Select pick-up place', 'renting_product_calendar', 'mybooking-wp-plugin') ?>" class="mb-form-control"> </select>
        </div>
      </div>

      <!-- // Collection -->
      <div class="mb-form-row mb--mt-1">
        <div class="mb-form-group">
          <label for="return_place">
						<?php echo esc_html_x( 'Return place', 'renting_product_calendar', 'mybooking-wp-plugin' ) ?>
					</label>
          <select id="return_place" name="return_place" placeholder="<?php echo esc_attr_x( 'Select return place', 'renting_product_calendar', 'mybooking-wp-plugin' )?>" class="mb-form-control" disabled> </select>
        </div>
      </div>
    <% } %>

    <!-- // Rental location selector -->
    <% if (not_hidden_rental_location_code && configuration.selectRentalLocation) { %>
      <li class="mybooking-product_calendar-step">
        <?php echo wp_kses_post ( sprintf( _x( 'Select %s', 'renting_product_calendar', 'mybooking-wp-plugin' ), MyBookingEngineContext::getInstance()->getRentalLocation() ) )?>
      </li>
      <div class="mb-form-row">
        <div class="mb-form-group">
          <select name="rental_location" id="rental_location" class="mb-form-control"
                placeholder="<?php echo esc_attr( MyBookingEngineContext::getInstance()->getRentalLocation() ) ?>"></select>
        </div>
      </div>
    <% } %>


    <li class="mybooking-product_calendar-step">
      <?php echo esc_html_x('Select dates', 'renting_product_detail', 'mybooking-wp-plugin' ) ?>
    </li>

    <% if (configuration.rentingProductOneJournal &&
           configuration.rentingProductMultipleJournals) { %>
      <div class="mb-form-row">
        <div class="mb-form-group">
          <input type="radio" name="duration_scope" value="in_one_day" checked/>&nbsp;<?php echo esc_html_x('Hours or one full day', 'renting_product_detail', 'mybooking-wp-plugin' ) ?><br>
          <input type="radio" name="duration_scope" value="days"/>&nbsp;<?php echo esc_html_x('Period of dates', 'renting_product_detail', 'mybooking-wp-plugin' ) ?>
        </div>
      </div>
    <% } else if (configuration.rentingProductOneJournal) { %>
      <input type="hidden" name="duration_scope" value="in_one_day">
    <% } else { %>
      <input type="hidden" name="duration_scope" value="days">
    <% } %>

    <!-- // Date Selector -->
    <div class="mb-form-group">
      <input id="date" type="hidden" name="date"/>
      <br/>
      <div id="mb-date-container-header" style="display:none"></div>
      <div id="date-container" class="mb-date-container-content disabled-picker"></div>
    </div>

    <% if (configuration.timeToFrom || configuration.timeToFromInOneDay) { %>

        <li class="mybooking-product_calendar-step js-mybooking-product_calendar-time-hours js-mybooking-product_calendar-time-ranges" style="display:none">
          <?php echo esc_html_x('Select time', 'renting_product_detail', 'mybooking-wp-plugin' ) ?>
        </li>

        <div id="mybooking_product_widget_occupation_container" class="mb-form-row" style="display: none">
          <div id="mybooking_product_widget_occupation_detail_container" class="mb-form-group mb-col-md-12"></div>
        </div>

        <!-- // Delivery time -->
        <div class="mb-form-row js-mybooking-product_calendar-time-hours" style="display: none">
          <div class="mb-form-group mb-col-md-12">
            <label class="">
              <?php echo esc_html_x( 'Delivery time', 'renting_product_detail', 'mybooking-wp-plugin') ?>
            </label>
            <select id="time_from" name="time_from" placeholder="hh:mm" class="mb-form-control" disabled> </select>
          </div>
        </div>

        <!-- // Collection time -->
        <div class="mb-form-row js-mybooking-product_calendar-time-hours" style="display: none">
          <div class="mb-form-group mb-col-md-12">
            <label class="">
              <?php echo esc_html_x( 'Return time', 'renting_product_detail', 'mybooking-wp-plugin') ?>
            </label>
            <select id="time_to" name="time_to" placeholder="hh:mm" class="mb-form-control" disabled> </select>
          </div>
        </div>

        <div class="mb-form-row js-mybooking-product_calendar-time-ranges" style="display: none">
          <div id="mb_product_calendar_time_ranges_container" class="mb-form-group mb-col-md-12">
          </div>
        </div>

    <% } else { %>
      <input type="hidden" name="time_from" value="<%=configuration.defaultTimeStart%>"/>
      <input type="hidden" name="time_to" value="<%=configuration.defaultTimeEnd%>"/>
    <% } %>
  </ol>

  <div id="reservation_detail" class="mb-form-group"></div>
</script>

<script type="text/tmpl" id="script_reservation_summary">

    <!-- // Exceeds max duration -->
    <% if (product && product.exceeds_max) { %>
       <div class="mb-alert danger">
          <span><%= i18next.t('chooseProduct.max_duration', {duration: i18next.t('common.'+product.price_units, {count: product.max_value, interpolation: {escapeValue: false}} ), interpolation: {escapeValue: false}}) %></span>
       </div>

    <!-- // Less than min duration -->
    <% } else if (product && product.be_less_than_min) { %>
       <div class="mb-alert danger">
          <span><%= i18next.t('chooseProduct.min_duration', {duration: i18next.t('common.'+product.price_units, {count: product.min_value, interpolation: {escapeValue: false}} ), interpolation: {escapeValue: false}}) %></span>
       </div>

    <!-- // Available -->
    <% } else if (product_available) { %>
      <h2 class="mybooking-summary_details-title">
        <?php echo esc_html_x( 'Reservation summary', 'renting_product_calendar', 'mybooking-wp-plugin') ?>
      </h2>

      <div class="mybooking-summary_detail">

        <!-- // Duration -->
        <% if (shopping_cart.days > 0) { %>
          <div class="mybooking-summary_extras">
            <span class="mybooking-summary_item">
              <span class="mybooking-summary_duration">
                <%=shopping_cart.days%> <?php echo MyBookingEngineContext::getInstance()->getDuration() ?>
              </span>
            </span>
          </div>

        <% } else if (shopping_cart.hours > 0) { %>
          <div class="mybooking-summary_extras">
            <span class="mybooking-summary_item">
              <span class="mybooking-summary_duration">
                <%=shopping_cart.hours%> <?php echo esc_html_x( 'hour(s)', 'renting_choose_product', 'mybooking-wp-plugin' ) ?>
              </span>
            </span>
          </div>

        <% } else if (shopping_cart.minutes > 0) { %>
          <div class="mybooking-summary_extras">
            <span class="mybooking-summary_item">
              <span class="mybooking-summary_duration">
                <%=shopping_cart.minutes%> <?php echo esc_html_x( 'minutes(s)', 'renting_choose_product', 'mybooking-wp-plugin' ) ?>
              </span>
            </span>
          </div>
        <% } %>

      </div>

      <!-- // Product -->
      <% if (!configuration.hidePriceIfZero || shopping_cart.item_cost > 0) { %>
        <% if (shopping_cart.items.length > 0) { %>
          <div class="mb-section">
            <% for (var idx=0;idx<shopping_cart.items.length;idx++) { %>
              <div class="mybooking-summary_extras mb-section">
                <span class="mybooking-summary_item">
                  <% if (shopping_cart.items[idx].item_performance_id !== null) { %>
                    <%= shopping_cart.items[idx].item_performance_description_customer_translation %>
                  <% } else { %>
                    <%= shopping_cart.items[idx].item_description_customer_translation %>
                  <% } %>   
                </span>
                <span class="mybooking-summary_extra-amount">
                  <%=configuration.formatCurrency(shopping_cart.item_cost)%>
                </span>
              </div>
            <% } %>  
        <% } %>
      <% } %>

      <!-- // Extras -->

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

      <!-- // Supplements -->
      <div class="mybooking-summary_extras">

        <!-- // Pick-up time -->
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

        <!-- // Pick-up place -->
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

        <!-- // Return time -->
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

        <!-- // Return place -->
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

      <% if (!configuration.hidePriceIfZero || shopping_cart.total_cost > 0) { %>
        <!-- // Total -->
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
      <% } %>

      <!-- // Reservation button -->

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

<script type="text/tmpl" id="script_daily_occupation">
  <div class="mybooking-product_calendar-daily_container">
    <% for (var idx=0; idx < data.length; idx++) { %>
      <div class="mybooking-product_calendar-daily_item mb-alert danger">
        <div><%= moment(data[idx].date_from).tz(timezone).format(format) %> <%= data[idx].time_from %></div>
        <div><%= moment(data[idx].date_to).tz(timezone).format(format) %> <%= data[idx].time_to %></div>
      </div>
    <% } %>
  </div>
</script>

<script type="text/tmpl" id="form_calendar_selector_turns_tmpl">
  <% if (turns.length == 0) { %>
    <div class="mb-alert danger">
      <?php echo esc_html_x('We are sorry. There are not defined times. Please, configure them at the calendar', 'renting_product_detail', 'mybooking-wp-plugin' ) ?>
    </div>
  <% } else { %>

    <% if (turns.length == 1 && turns[0].full_day) { %>
      <input type="hidden" name="turn" value="<%=turns[0].time_from%>-<%=turns[0].time_to%>"/>
    <% } else { %>
      <% for (var idx=0; idx<turns.length; idx++) { %>
        <input type="radio" name="turn" value="<%=turns[idx].time_from%>-<%=turns[idx].time_to%>" <% if (!turns[idx].availability){%>disabled<% } %>
               class="<% if (turns[idx].availability){%>mybooking-product_calendar-available_turn<% } else {%>mybooking-product_calendar-not_available_turn<% } %>">
          <span class="<% if (turns[idx].availability){%>mybooking-product_calendar-available_turn<% } else {%>mybooking-product_calendar-not_available_turn<% } %>">
            <% if ( typeof turns[idx].name !== 'undefined' && turns[idx].name !== null && turns[idx].name !== '') { %>
              <%=turns[idx].name%>
            <% } else { %>
              <%=turns[idx].time_from%>-<%=turns[idx].time_to%>&nbsp;
            <% } %>
          </span>
      <% } %>
    <% } %>
  <% } %>

</script>
