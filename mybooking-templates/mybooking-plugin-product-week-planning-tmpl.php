<?php
/**
 *   MYBOOKING ENGINE - PRODUCT WEEK PLANNING TEMPLATE
 *   ---------------------------------------------------------------------------
 *   The Template for showing the week planning to create a reservation
 * 
 *   This template can be overridden by copying it to your
 *   theme/mybooking-templates/mybooking-plugin-product-week-planning-tmpl.php
 *
 *   @phpcs:disable PHPCompatibility.Miscellaneous.RemovedAlternativePHPTags.MaybeASPOpenTagFound
 *   @phpcs:disable Generic.PHP.DisallowAlternativePHPTags.MaybeASPOpenTagFound
 *   @phpcs:disable Generic.PHP.DisallowAlternativePHPTags.MaybeASPShortOpenTagFound
 */
?>
<script type="text/tmpl" id="script_mybooking_product_week_planning_reservation_summary">

    <!-- // Exceeds max duration -->
    <% if (product && product.exceeds_max) { %>
       <div class="mb-alert danger text-center">
          <span><%= i18next.t('chooseProduct.max_duration', {duration: i18next.t('common.'+product.price_units, {count: product.max_value, interpolation: {escapeValue: false}} ), interpolation: {escapeValue: false}}) %></span>
       </div>

    <!-- // Less than min duration -->
    <% } else if (product && product.be_less_than_min) { %>
       <div class="mb-alert danger text-center">
          <span><%= i18next.t('chooseProduct.min_duration', {duration: i18next.t('common.'+product.price_units, {count: product.min_value, interpolation: {escapeValue: false}} ), interpolation: {escapeValue: false}}) %></span>
       </div>

    <!-- // Available -->
    <% } else if (product_available) { %>
      <h2 class="mybooking-summary_details-title text-center">
        <?php echo esc_html_x( 'Reservation summary', 'renting_product_calendar', 'mybooking-wp-plugin') ?>
      </h2>

      <hr>

      <div class="text-center">
        <b>
          <% if (shopping_cart.items) { %>
            <%=shopping_cart.items[0]['item_description_customer_translation']%>
          <% } %>
          <%=shopping_cart.date_from_extended_format%> - <%=shopping_cart.time_from%> - 
          <%=shopping_cart.time_to%>
        </b>

        <div class="mybooking-summary_detail text-center">
          <!-- // Duration -->
          <% if (shopping_cart.days > 0) { %>
            <div class="mybooking-summary_extras text-center">
              <span class="mybooking-summary_item">
                <span class="mybooking-summary_duration text-center">
                  <%=shopping_cart.days%> <?php echo MyBookingEngineContext::getInstance()->getDuration() ?>
                </span>
              </span>
            </div>

          <% } else if (shopping_cart.hours > 0) { %>
            <div class="mybooking-summary_extras text-center">
              <span class="mybooking-summary_item">
                <span class="mybooking-summary_duration">
                  <%=shopping_cart.hours%> <?php echo esc_html_x( 'hour(s)', 'renting_choose_product', 'mybooking-wp-plugin' ) ?>
                </span>
              </span>
            </div>
          <% } %>
        </div>
      </div>


      <!-- // Product -->
      <% if (!configuration.hidePriceIfZero || shopping_cart.item_cost > 0) { %>
        <div class="mybooking-summary_extras text-center">
          <span class="mybooking-summary_item">
            <?php echo MyBookingEngineContext::getInstance()->getProduct() ?>:
          </span>
          <span class="mybooking-summary_extra-amount">
            <%=configuration.formatCurrency(shopping_cart.item_cost)%>
          </span>
        </div>
      <% } %>

      <!-- // Extras -->

      <% if (shopping_cart.extras.length > 0) { %>
        <div class="mb-section">
          <div class="mybooking-summary_details-title text-center">
            <?php echo esc_html_x( 'Extras', 'renting_complete', 'mybooking-wp-plugin' ) ?>
          </div>

          <% for (var idx=0;idx<shopping_cart.extras.length;idx++) { %>
            <div class="mybooking-summary_extras text-center">
              <div class="mybooking-summary_extra-item">
                <span class="mb-badge info mybooking-summary_extra-quantity">
                  <%=shopping_cart.extras[idx].quantity%>
                </span>
                <span class="mybooking-summary_extra-name">
                  <%=shopping_cart.extras[idx].extra_description%>
                </span>
                <span class="mybooking-summary_extra-amount">
                  <%=configuration.formatCurrency(shopping_cart.extras[idx].extra_cost)%>
                </span>
              </div>
            </div>
          <% } %>
        </div>
      <% } %>

      <!-- // Supplements -->
      <div class="mybooking-summary_extras text-center">
        <!-- // Pick-up time -->
        <% if (shopping_cart.time_from_cost > 0) { %>
          <div class="mybooking-summary_extra-item">
            <span class="mybooking-summary_extra-name">
              <?php echo esc_html_x( 'Pick-up time supplement', 'renting_complete', 'mybooking-wp-plugin' ) ?>
            </span>
            <span class="mybooking-summary_extra-amount">
              <%=configuration.formatCurrency(shopping_cart.time_from_cost)%>
            </span>
          </div>
        <% } %>
      </div>

      <div class="mybooking-summary_extras text-center">
        <!-- // Pick-up place -->
        <% if (shopping_cart.pickup_place_cost > 0) { %>
          <div class="mybooking-summary_extra-item">
            <span class="mybooking-summary_extra-name">
              <?php echo esc_html_x( 'Pick-up place supplement', 'renting_complete', 'mybooking-wp-plugin' ) ?>
            </span>
            <span class="mybooking-summary_extra-amount">
              <%=configuration.formatCurrency(shopping_cart.pickup_place_cost)%>
            </span>
          </div>
        <% } %>
      </div>

      <div class="mybooking-summary_extras text-center">
        <!-- // Return time -->
        <% if (shopping_cart.time_to_cost > 0) { %>
          <div class="mybooking-summary_extra-item">
            <span class="mybooking-summary_extra-name">
              <?php echo esc_html_x( 'Return time supplement', 'renting_complete', 'mybooking-wp-plugin' ) ?>
            </span>
            <span class="mybooking-summary_extra-amount">
              <%=configuration.formatCurrency(shopping_cart.time_to_cost)%>
            </span>
          </div>
        <% } %>
      </div>

      <div class="mybooking-summary_extras text-center">
        <!-- // Return place -->
        <% if (shopping_cart.return_place_cost > 0) { %>
          <div class="mybooking-summary_extra-item">
            <span class="mybooking-summary_extra-name">
              <?php echo esc_html_x( 'Return place supplement', 'renting_complete', 'mybooking-wp-plugin' ) ?>
            </span>
            <span class="mybooking-summary_extra-amount">
              <%=configuration.formatCurrency(shopping_cart.return_place_cost)%>
            </span>
          </div>
        <% } %>
      </div>

      <% if (!configuration.hidePriceIfZero || shopping_cart.total_cost > 0) { %>
        <!-- // Total -->
        <div class="mb-section">
          <div class="mybooking-summary_total text-center">
            <span class="mybooking-summary_total-label">
              <b><?php echo esc_html_x( "Total", 'renting_complete', 'mybooking-wp-plugin' ) ?>:</b>
            </span>
            <span class="mybooking-summary_total-amount">
              <b><%=configuration.formatCurrency(shopping_cart.total_cost)%></b>
            </span>
          </div>

          <?php if ( array_key_exists('show_taxes_included', $args) && ( $args['show_taxes_included'] ) ): ?>
            <div class="mybooking-product_taxes">
              <?php echo esc_html_x( 'Taxes included', 'renting_choose_product', 'mybooking-wp-plugin') ?>
            </div>
          <?php endif; ?>
        </div>
      <% } %>

      <!-- // Reservation button -->
      <br />
      <div class="mb-form-group text-center">
         <input id="add_to_shopping_cart_btn" class="btn btn-primary btn-choose-product" type="submit" value="<?php echo esc_attr_x( 'Book Now!', 'renting_product_calendar', 'mybooking-wp-plugin') ?>"/>
      </div>

    <% } else { %>
      <% if (product_type == 'resource') { %>
        <div class="mb-alert danger  text-center">
          <?php echo esc_html_x( 'Book Now!', 'renting_product_calendar', 'mybooking-wp-plugin') ?>
          <?php echo esc_html_x( 'Sorry, there is no availability during these hours', 'renting_product_calendar', 'mybooking-wp-plugin') ?>
        </div>

      <% } else if (product_type == 'category_of_resources') { %>
        <div class="mb-alert warning  text-center">
          <?php echo esc_html_x( 'Sorry, there is no availability for the entire period. The calendar shows those days when there is availability, but it may not be available for certain consecutive dates.', 'renting_product_calendar', 'mybooking-wp-plugin') ?>
        </div>
      <% } %>
    <% } %>
</script>