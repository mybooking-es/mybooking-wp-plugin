<?php
/**
 *   MYBOOKING ENGINE - MY TRANSFER RESERVATION TEMPLATE
 *   ---------------------------------------------------------------------------
 *   The Template for showing the renting complete step - JS microtemplates
 *   This template can be overridden by copying it to your
 *   theme /mybooking-templates/mybooking-plugin-transfer-reservation-tmpl.php
 *
 *   @phpcs:disable PHPCompatibility.Miscellaneous.RemovedAlternativePHPTags.MaybeASPOpenTagFound
 *   @phpcs:disable Generic.PHP.DisallowAlternativePHPTags.MaybeASPOpenTagFound
 *   @phpcs:disable Generic.PHP.DisallowAlternativePHPTags.MaybeASPShortOpenTagFound
 */
?>

<!-- SUMMARY BLOCK ------------------------------------------------------------>

<script type="text/tmpl" id="script_transfer_reservation_summary">
  <div class="mb-row">
    <div class="mb-col-sm-12 mb-col-md-8 mb-col-center">
      <!-- // Reservation status message -->
      <div class="mybooking-summary_status">
        <%= booking.summary_status %>
      </div>

      <!-- // Summary details -->
      <div class="mb-section mb-panel-container mybooking-details_container">
        <div class="mybooking-summary_header">
          <div class="mybooking-summary_details-title">
            <?php echo esc_html_x( 'Reservation summary', 'renting_choose_product', 'mybooking-wp-plugin' ) ?>
          </div>

          <div class="mybooking-summary_locator">
            <?php echo esc_html_x( 'Reservation Id', 'renting_summary', 'mybooking-wp-plugin') ?>:
            <span class="mybooking-summary_locator-id"><%=booking.id%></span>
          </div>
        </div>

        <div class="mybooking-summary_detail">
          <span class="mybooking-summary_item">
            <span class="mybooking-summary_date">
              <%=booking.date%> <%=booking.time%>
            </span>
            <span class="mybooking-summary_place">
              <?php echo esc_html_x( 'Origin', 'transfer_choose_vehicle', 'mybooking-wp-plugin' ) ?> ⟶
              <%=booking.origin_point_name%>
            </span>
            <span class="mybooking-summary_place">
              <?php echo esc_html_x( 'Destination', 'transfer_choose_vehicle', 'mybooking-wp-plugin' ) ?> ⟶
              <%=booking.destination_point_name%>
            </span>
          </span>

          <% if (booking.round_trip) { %>
            <span class="mybooking-summary_item">
              <span class="mybooking-summary_date">
                <%=booking.date%> <%=booking.time%>
              </span>
              <span class="mybooking-summary_place">
                <?php echo esc_html_x( 'Origin', 'transfer_choose_vehicle', 'mybooking-wp-plugin' ) ?> ⟶
                <%=booking.origin_point_name%>
              </span>
              <span class="mybooking-summary_place">
                <?php echo esc_html_x( 'Destination', 'transfer_choose_vehicle', 'mybooking-wp-plugin' ) ?> ⟶
                <%=booking.destination_point_name%>
              </span>
            </span>
          <% } %>

          <span class="mybooking-summary_item">
            <?php echo esc_html_x( 'Adults', 'transfer_choose_vehicle', 'mybooking-wp-plugin' ) ?>: <%=booking.number_of_adults%></br>
            <?php echo esc_html_x( 'Children', 'transfer_choose_vehicle', 'mybooking-wp-plugin' ) ?>: <%=booking.number_of_children%></br>
            <?php echo esc_html_x( 'Infants', 'transfer_choose_vehicle', 'mybooking-wp-plugin' ) ?>: <%=booking.number_of_infants%>
          </span>
        </div>
      </div>

      <div class="mb-section mb-panel-container">
        <div class="mb-card">
          <div class="mb-col-md-10 mb-col-center">

            <!-- // Product photo -->
            <img class="mybooking-product_image" src="<%=booking.item_full_photo%>"/>
          </div>

        </div>

        <div class="mybooking-product_header">
          <div class="mybooking-product_price">

            <!-- // Product name -->
            <span class="mybooking-product_name">
              <%=booking.item_name_customer_translation%>
            </span>

            <!-- // Price -->
            <div class="mybooking-product_amount">
              <%=configuration.formatCurrency(booking.item_cost)%>
            </div>
          </div>
        </div>
        
        <!-- // Extras -->
        <% if (booking.extras.length > 0) { %>
          <div class="mb-section">
            <br/>
            <div class="mybooking-summary_details-title">
              <?php echo esc_html_x( 'Extras', 'renting_summary', 'mybooking-wp-plugin' ) ?>
            </div>

            <% for (var idx=0;idx<booking.extras.length;idx++) { %>
              <div class="mybooking-summary_extras">
                <div class="mybooking-summary_extra-item">
                  <span class="mb-badge info mybooking-summary_extra-quantity"><%=booking.extras[idx].quantity%></span>
                  <span class="mybooking-summary_extra-name"><%=booking.extras[idx].extra_name_customer_translation%></span>
                </div>
                <span class="mybooking-summary_extra-amount">
                  <%=configuration.formatCurrency(booking.extras[idx].extra_cost)%>
                </span>
              </div>
            <% } %>
          </div>
        <% } %>

        <!-- // Supplements -->
        <% if (booking.supplements.length > 0) { %>
          <div class="mb-section">
            <div class="mybooking-summary_details-title">
              <?php echo esc_html_x( 'Supplements', 'transfer_reservation', 'mybooking-wp-plugin' ) ?>
            </div>

            <% for (var idx=0;idx<booking.supplements.length;idx++) { %>
              <div class="mybooking-summary_extras">
                <div class="mybooking-summary_extra-item">
                  <span class="mb-badge info mybooking-summary_extra-quantity">
                    1
                  </span>
                  <span class="mybooking-summary_extra-name">
                    <%=booking.supplements[idx].supplement_name_customer_translation%>
                  </span>
                </div>
                <span class="mybooking-summary_extra-amount">
                  <%=configuration.formatCurrency(booking.supplements[idx].supplement_cost)%>
                </span>
              </div>
            <% } %>
          </div>
        <% } %>

        <!-- // Total -->
        <div class="mb-section">
          <div class="mybooking-summary_total">
            <div class="mybooking-summary_total-label">
              <?php echo esc_html_x( "Total", 'renting_complete', 'mybooking-wp-plugin' ) ?>
            </div>
            <div class="mybooking-summary_total-amount">
              <%=configuration.formatCurrency(booking.total_cost)%>
            </div>
          </div>

          <?php if ( array_key_exists('show_taxes_included', $args) && ( $args['show_taxes_included'] ) ): ?>
            <div class="mybooking-product_taxes">
              <?php echo esc_html_x( 'Taxes included', 'renting_choose_product', 'mybooking-wp-plugin') ?>
            </div>
          <?php endif; ?>
        </div>
      </div>

      <!-- // Customer details -->
      <div class="mb-section">
        <div class="mybooking-summary_details-title">
          <?php echo esc_html_x( "Customer's details", 'renting_summary', 'mybooking-wp-plugin') ?>
        </div>
        <ul class="mb-list border">
          <li class="mb-list-item">
            <span class="dashicons dashicons-businessperson"></span>
            &nbsp;
            <%=booking.customer_name%> <%=booking.customer_surname%>
          </li>

          <% if (booking.customer_phone && booking.customer_phone != '') { %>
            <li class="mb-list-item">
              <span class="dashicons dashicons-phone"></span>
              &nbsp;
              <%=booking.customer_phone%> <%=booking.customer_mobile_phone%>
            </li>
          <% } %>

          <% if (booking.customer_email && booking.customer_email != '') { %>
            <li class="mb-list-item">
              <span class="dashicons dashicons-email"></span>
              &nbsp;
              <%=booking.customer_email%>
            </li>
          <% } %>
        </ul>
      </div>

      <!-- // Payment -->
      <div id="transfer_payment_detail" class="process-section-box" style="display:none">
      </div>
    </div>
  </div>
</script>


<!-- PAYMENT BLOCK ------------------------------------------------------------>

<script type="text/tmpl" id="script_transfer_payment_detail">
  <div class="mybooking-payment_amount">
    <%= i18next.t('myReservation.pay.total_payment', {amount:configuration.formatCurrency(amount) }) %>
  </div>

  <% if (booking.total_paid == 0) {%>
    <div id="payment_amount_container" class="mb-alert info highlight">
      <%= i18next.t('complete.reservationForm.booking_amount', {amount:configuration.formatCurrency(amount) }) %>
    </div>
  <% } %>

  <form name="payment_form">
    <% if (sales_process.payment_methods.paypal_standard && sales_process.payment_methods.tpv_virtual) { %>
      <div class="mb-alert secondary" role="alert">
        <?php echo wp_kses_post( _x( 'You will be redirected to the <b>payment platform</b> to make the confirmation payment securely. You can use <u>Paypal</u> or <u>credit card</u> to make the payment.', 'renting_complete', 'mybooking-wp-plugin' ) )?>
      </div>
      <div class="mybooking-payment_confirmation-box">
      <label class="mybooking-payment_custom-label" for="payments_paypal_standard">
        <img src="<?php echo esc_url( plugin_dir_url(__DIR__).'/assets/images/pm-paypal.jpg') ?>"/>
        <input type="radio" id="payments_paypal_standard" name="payment_method_id" class="payment_method_select" value="paypal_standard"><?php echo esc_html_x( 'Paypal', 'renting_complete', 'mybooking-wp-plugin' ) ?>
      </label>

      <label class="mybooking-payment_custom-label" for="payments_credit_card">
        <img src="<?php echo esc_url( plugin_dir_url(__DIR__).'/assets/images/pm-visa.jpg') ?>"/>
        <img src="<?php echo esc_url( plugin_dir_url(__DIR__).'/assets/images/pm-mastercard.jpg') ?>"/>
        <input type="radio" id="payments_credit_card" name="payment_method_id" class="payment_method_select" value="<%=sales_process.payment_methods.tpv_virtual%>"><?php echo wp_kses_post( _x( 'Credit or debit card', 'renting_complete', 'mybooking-wp-plugin' ) ) ?>
      </label>
      </div>
      <div id="payment_method_select_error"></div>

    <% } else if (sales_process.payment_methods.paypal_standard) { %>
      <div class="mb-alert secondary" role="alert">
        <?php echo wp_kses_post( _x( 'You will be redirected to <b>Paypal payment platform</b> to make the confirmation payment securely. You can use <u>Paypal</u> or <u>credit card</u> to make the payment.', 'renting_complete', 'mybooking-wp-plugin' ) ) ?>
      </div>
      <div class="mybooking-payment_confirmation-box">
        <img src="<?php echo esc_url( plugin_dir_url(__DIR__).'/assets/images/pm-paypal.jpg') ?>"/>
        <img src="<?php echo esc_url( plugin_dir_url(__DIR__).'/assets/images/pm-visa.jpg') ?>"/>
        <img src="<?php echo esc_url( plugin_dir_url(__DIR__).'/assets/images/pm-mastercard.jpg') ?>"/>
      </div>
      <input type="hidden" name="payment_method_id" value="paypal_standard" data-payment-method="paypal_standard">
    <% } else if (sales_process.payment_methods.tpv_virtual) { %>
      <div class="mb-alert secondary" role="alert">
        <?php echo wp_kses_post( _x( 'You will be redirected to the <b>credit card payment platform</b> to make the confirmation payment securely.', 'renting_complete', 'mybooking-wp-plugin' )  )?>
      </div>
      <div class="mybooking-payment_confirmation-box">
        <img src="<?php echo esc_url( plugin_dir_url(__DIR__).'/assets/images/pm-visa.jpg') ?>"/>
        <img src="<?php echo esc_url( plugin_dir_url(__DIR__).'/assets/images/pm-mastercard.jpg') ?>"/>
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

    <div class="mb-form-row">
      <div class="mb-form-group mb-col-md-12">
        <button class="mb-button block" id="btn_pay" type="submit">
          <%= i18next.t('myReservation.pay.payment_button', {amount:configuration.formatCurrency(amount) }) %>
        </button>
      </div>
    </div>
  </form>
</script>
