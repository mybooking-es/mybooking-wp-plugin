<?php
  /** 
   * The Template for showing the sticky bar in renting choose product
   * This template can be overridden by copying it to your
   * theme /mybooking-templates/mybooking-plugin-reservation-summary-tmpl.php
   *
   * @phpcs:disable PHPCompatibility.Miscellaneous.RemovedAlternativePHPTags.MaybeASPOpenTagFound
   * @phpcs:disable Generic.PHP.DisallowAlternativePHPTags.MaybeASPOpenTagFound
   * @phpcs:disable Generic.PHP.DisallowAlternativePHPTags.MaybeASPShortOpenTagFound   
   */
?>
<script type="text/tmpl" id="script_reservation_summary">

  <!-- // Summary details -->

  <div class="mybooking-details_container mybooking-page-container">
    <div class="mb-row">
      <div class="mb-col-md-12">
        <div class="mybooking-summary_header">
          <div class="mybooking-summary_details-title">
            <?php echo esc_html_x( 'Reservation summary', 'renting_choose_product', 'mybooking-reservation-engine' ) ?>
          </div>

          <div class="mybooking-summary_edit" id="modify_reservation_button" role="link">
            <i class="mb-button icon"><span class="dashicons dashicons-edit"></span></i>
          </div>
        </div>

        <% if (configuration.rentDateSelector === 'date_from_duration') { %>
          <div class="mybooking-summary_detail">
            <span class="mybooking-summary_item">
              <span class="mybooking-summary_date">
                <%=shopping_cart.date_from_full_format%>
                <% if (typeof halfDayTurns === 'undefined' || !halfDayTurns || halfDayTurns.length === 0) { %>
                  <% if (configuration.timeToFrom) { %>
                    ,&nbsp;<%= shopping_cart.time_from %>
                  <% } %>
                  &nbsp;(<%=shopping_cart.renting_duration_literal%>)
                <% } %>
              </span>
              <% if (configuration.pickupReturnPlace) { %>
                <span class="mybooking-summary_place">
                  <%=shopping_cart.pickup_place_customer_translation%>
                </span>
              <% } %>
            </span>
            <span class="mybooking-summary_item">
              <span class="mybooking-summary_duration">
                <%=shopping_cart.renting_duration_literal%>
              </span>
            </span>
          </div>
          <!-- Show the turns -->
          <% if (halfDayTurns && halfDayTurns.length > 0) { %>
            <div>
              <form name="mybooking-choose-product_duration-form" class="mybooking-choose-product_duration-form">
                <% for (var idx=0; idx<halfDayTurns.length; idx++) { %>
                  <input type="radio" class="mybooking-summary-duration-turn"
                        name="turn" value="<%=halfDayTurns[idx].time_from%>-<%=halfDayTurns[idx].time_to%>"
                    <% if (shopping_cart.time_from === halfDayTurns[idx].time_from &&
                          shopping_cart.time_to === halfDayTurns[idx].time_to) {%>checked<%}%>>
                    <% if (halfDayTurns[idx].name && halfDayTurns[idx].name !== '') { %>
                      &nbsp;<%=halfDayTurns[idx].name%>
                    <% } else { %>        
                      <%=halfDayTurns[idx].time_from%>-<%=halfDayTurns[idx].time_to%>
                    <% } %>  
                  </input>
                <% } %>
              </form>
            </div>
          <% } %>

        <% } else { %>
          <div class="mybooking-summary_detail">
            <span class="mybooking-summary_item">
              <span class="mybooking-summary_date">
                <%=shopping_cart.date_from_full_format%>
                <% if (configuration.timeToFrom) { %>
                  <%=shopping_cart.time_from%>
                <% } %>
              </span>
              <% if (configuration.pickupReturnPlace) { %>
                <span class="mybooking-summary_place">
                  <%=shopping_cart.pickup_place_customer_translation%>
                </span>
              <% } %>
            </span>

            <span class="mybooking-summary_item">
              <span class="mybooking-summary_date">
                <%=shopping_cart.date_to_full_format%>
                <% if (configuration.timeToFrom) { %>
                  <%=shopping_cart.time_to%>
                <% } %>
              </span>
              <% if (configuration.pickupReturnPlace) { %>
                <span class="mybooking-summary_place">
                  <%=shopping_cart.return_place_customer_translation%>
                </span>
              <% } %>
            </span>

            <% if (shopping_cart.days > 0) { %>
              <span class="mybooking-summary_item">
                <span class="mybooking-summary_duration"><%=shopping_cart.days%> <?php echo esc_html( MyBookingEngineContext::getInstance()->getDuration() ) ?></span>
              </span>
            <% } else if (shopping_cart.hours > 0) { %>
              <span class="mybooking-summary_item">
                <span class="mybooking-summary_duration"><%=shopping_cart.hours%> <?php echo esc_html_x( 'hour(s)', 'renting_choose_product', 'mybooking-reservation-engine' ) ?></span>
              </span>
            <% } %>
          </div>
        <% } %>

      </div>
    </div>
  </div>
</script>