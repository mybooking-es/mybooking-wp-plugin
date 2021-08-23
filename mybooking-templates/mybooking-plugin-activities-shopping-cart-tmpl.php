<?php
  /**
   * The Template for showing the activity shopping cart - JS Microtemplates
   *
   * This template can be overridden by copying it to yourtheme/mybooking-templates/mybooking-plugin-activities-shopping-cart-tmpl.php
   *
   * @phpcs:disable PHPCompatibility.Miscellaneous.RemovedAlternativePHPTags.MaybeASPOpenTagFound
   * @phpcs:disable Generic.PHP.DisallowAlternativePHPTags.MaybeASPOpenTagFound
   * @phpcs:disable Generic.PHP.DisallowAlternativePHPTags.MaybeASPShortOpenTagFound
   */
?>

<!-- Microtemplates -->

<script type="text/tpml" id="script_shopping_cart_empty">
  <div class="mb-alert warning">
    <?php echo esc_html_x( 'Shopping cart is empty', 'activity_shopping_cart', 'mybooking-wp-plugin' ) ?>
  </div>
</script>

<script type="text/tpml" id="script_products_detail">

  <% for (idx in shopping_cart.items) { %>
    <div class="mb-section">

      <% if (shopping_cart.items[idx].photo_full != null) { %>
        <img class="mybooking-product_image" src="<%=shopping_cart.items[idx].photo_full%>" alt="<%=shopping_cart.items[idx].item_description_customer_translation%>">
      <% } %>

      <div class="mb-card">
        <div class="mb-card-body">
          <div class="mybooking-product_name">
            <%=shopping_cart.items[idx].item_description_customer_translation%>
          </div>

          <div class="mybooking-activity_date">
            <span class="mybooking-activity_date-item"><%= configuration.formatDate(shopping_cart.items[idx].date) %></span>
            <span class="mybooking-activity_date-item"><%= shopping_cart.items[idx].time %></span>
          </div>

          <% if (shopping_cart.allow_select_places_for_reservation || shopping_cart.use_rates) { %>

            <% if (shopping_cart.allow_select_places_for_reservation) { %>
              <% if (shopping_cart.use_rates) { %>
                <% for (var x=0; x<shopping_cart.items[idx]['items'].length; x++) { %>
                  <div class="mybooking-summary_activities">
                    <div class="mybooking-summary_activity-item">
                      <span class="mb-badge info mybooking-summary_activity-quantity">
                        <%=shopping_cart.items[idx]['items'][x].quantity %>
                      </span>
                      <span class="mybooking-summary_activity-name">
                        <%=shopping_cart.items[idx]['items'][x].item_price_description %> x
                      </span>
                      <span class="mybooking-summary_activity-amount">
                        <%=configuration.formatCurrency(shopping_cart.items[idx]['items'][x].item_unit_cost) %>
                      </span>
                    </div>
                    <span class="mybooking-summary_activity-amount">
                      <%=configuration.formatCurrency(shopping_cart.items[idx]['items'][x].item_cost) %>
                    </span>
                  </div>
                <% } %>

              <% } else { %>
                <% for (var x=0; x<shopping_cart.items[idx]['items'].length; x++) { %>
                  <div class="mybooking-summary_activities">
                    <span class="mybooking-summary_activity-quantity">
                      <%=shopping_cart.items[idx]['items'][x].quantity %>
                    </span>
                    <span class="mybooking-summary_activity-name">
                      <%=shopping_cart.items[idx]['items'][x].item_price_description %>
                    </span>
                  </div>
                <% } %>
              <% } %>
            <% } %>

            <% if (shopping_cart.use_rates) { %>

              <!-- Show the total -->
              <div class="mybooking-summary_activities-total">
                <span class="mybooking-summary_activity-total-label">
                  <?php echo esc_html_x( 'Total', 'activity_shopping_cart_item', 'mybooking-wp-plugin' ) ?>
                </span>
                <span class="mybooking-summary_activity-total-amount">
                  <%=configuration.formatCurrency(shopping_cart.items[idx]['total'])%>
                </span>
              </div>
            <% } %>
          <% } %>

          <% if (configuration.activityReservationMultipleItems) { %>
            <div class="mybooking-summary_edit btn-delete-shopping-cart-item" data-item-id="<%=shopping_cart.items[idx].item_id%>" data-date="<%=shopping_cart.items[idx].date%>" data-time="<%=shopping_cart.items[idx].time%>">
              <i class="fa fa-trash"></i><?php echo esc_html_x( 'Remove', 'activity_shopping_cart_item', 'mybooking-wp-plugin' ) ?>
            </div>
          <% } %>
        </div>
     </div>
   <% } %>

</script>

<!-- Script reservation form -->

<script type="text/tmpl" id="script_reservation_form">
  <input type="hidden" name="customer_language" value="<%=language%>"/>

  <!-- Reservation complete -->
  <div class="mb-section">
    <div class="reservation_form_container">
      <h2 class="complete-section-title customer_component"><?php echo esc_html_x( "Customer's details", 'renting_complete', 'mybooking-wp-plugin') ?></h2>
      <form id="form-reservation" name="reservation_form" autocomplete="off">
        <div class="mb-form-group mb-form-row customer_component">
          <div class="mb-col-md-6 mb-col-sm-12">
            <label for="customer_name"><?php echo esc_html_x( 'Name', 'renting_complete', 'mybooking-wp-plugin') ?>*</label>
            <input type="text" class="form-control" name="customer_name" id="customer_name" autocomplete="off" placeholder="<?php echo esc_attr_x( 'Name', 'renting_complete', 'mybooking-wp-plugin') ?>:*" maxlength="40">
          </div>
          <div class="mb-col-md-6 mb-col-sm-12">
            <label for="customer_surname"><?php echo esc_html_x( 'Surname', 'renting_complete', 'mybooking-wp-plugin') ?>*</label>
            <input type="text" class="form-control" name="customer_surname" id="customer_surname" autocomplete="off" placeholder="<?php echo esc_attr_x( 'Surname', 'renting_complete', 'mybooking-wp-plugin') ?>:*" maxlength="40">
          </div>
        </div>

        <div class="mb-form-group mb-form-row customer_component">
          <div class="mb-col-md-6 mb-col-sm-12">
            <label for="customer_email"><?php echo esc_html_x( 'E-mail', 'renting_complete', 'mybooking-wp-plugin') ?>*</label>
            <input type="text" class="form-control" name="customer_email" id="customer_email" autocomplete="off" placeholder="<?php echo esc_attr_x( 'E-mail', 'renting_complete', 'mybooking-wp-plugin') ?>:*" maxlength="50">
          </div>
          <div class="mb-col-md-6 mb-col-sm-12">
            <label for="customer_email"><?php echo esc_html_x( 'Confirm E-mail', 'renting_complete', 'mybooking-wp-plugin') ?>*</label>
            <input type="text" class="form-control" name="confirm_customer_email" autocomplete="off" id="confirm_customer_email" placeholder="<?php echo esc_attr_x( 'Confirm E-mail', 'renting_complete', 'mybooking-wp-plugin') ?>:*" maxlength="50">
          </div>
        </div>

        <div class="mb-form-group mb-form-row customer_component">
          <div class="mb-col-md-6 mb-col-sm-12">
            <label for="customer_phone"><?php echo esc_html_x( 'Phone number', 'renting_complete', 'mybooking-wp-plugin') ?>*</label>
            <input type="text" class="form-control" name="customer_phone" id="customer_phone" autocomplete="off" placeholder="<?php echo esc_attr_x( 'Phone number', 'renting_complete', 'mybooking-wp-plugin') ?>:*" maxlength="15">
          </div>
          <div class="mb-col-md-6 mb-col-sm-12">
            <label for="customer_mobile_phone"><?php echo esc_html_x( 'Alternative phone number', 'renting_complete', 'mybooking-wp-plugin') ?></label>
            <input type="text" class="form-control" name="customer_mobile_phone" id="customer_mobile_phone" autocomplete="off" placeholder="<?php echo esc_attr_x( 'Alternative phone number', 'renting_complete', 'mybooking-wp-plugin') ?>:" maxlength="15">
          </div>
        </div>

        <h3 class="mb-4 complete-section-title"><?php echo esc_html_x( "Additional information", 'renting_complete', 'mybooking-wp-plugin') ?></h3>

        <div class="mb-form-group">
          <label for="comments"><?php echo esc_html_x( 'Comments', 'renting_complete', 'mybooking-wp-plugin') ?></label>
          <textarea class="form-control" name="comments" id="comments" placeholder="<?php echo esc_attr_x( 'Comments', 'renting_complete', 'mybooking-wp-plugin') ?>"></textarea>
        </div>
        <br>

        <!-- Reservation : payment (script_payment_detail) -->
        <div id="payment_detail"></div>
      </form>
    </div>
  </div>
</script>

<!-- Script payment -->

<script type="text/tmpl" id="script_payment_detail">

  <!-- Total -->

  <div class="mb-section">
    <div class="mybooking-summary_total">
      <div class="mybooking-summary_total-label">

        <?php echo esc_html_x( 'Total', 'activity_shopping_cart', 'mybooking-wp-plugin' ) ?>
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

  <!-- Payment hidden inputs -->

  <% if (canPay) { %>

    <% if (shopping_cart.payment_methods.paypal_standard && shopping_cart.payment_methods.tpv_virtual) { %>
      <!-- The payment method will be selected later -->
      <input type="hidden" name="payment" value="none">
    <% } else if (shopping_cart.payment_methods.paypal_standard) { %>
      <!-- Fixed paypal standard -->
      <input type="hidden" name="payment" value="paypal_standard">
    <% } else  if (shopping_cart.payment_methods.tpv_virtual) { %>
      <!-- Fixed tpv -->
      <input type="hidden" name="payment" value="<%=shopping_cart.payment_methods.tpv_virtual%>">
    <% } %>
  <% } else { %>
    <input type="hidden" name="payment" value="none">
  <% } %>

  <!-- Payment options -->

  <% if (canRequestAndPay) { %>
    <div class="mb-section mybooking-payment_options">

       <% if (shopping_cart.can_make_request) { %>
         <label class="mybooking-payment_option-label" for="complete_action_request_reservation">
           <input class="mybooking-payment_option-input" type="radio" id="complete_action_request_reservation" name="complete_action" value="request_reservation" class="complete_action">
           <?php echo esc_html_x( 'Request reservation', 'activity_shopping_cart', 'mybooking-wp-plugin' ) ?>
         </label>
       <% } %>

       <% if (canPay) { %>
         <label class="mybooking-payment_option-label" for="complete_action_pay_now">
           <input class="mybooking-payment_option-input" type="radio" id="complete_action_pay_now" name="complete_action" value="pay_now" class="complete_action">
           <?php echo esc_html_x( 'Pay now', 'activity_shopping_cart', 'mybooking-wp-plugin' ) ?>
         </label>
       <% } %>
    </div>
  <% } %>

  <!-- Request reservation -->

  <% if (shopping_cart.can_make_request) { %>
    <div class="mybooking-payment_confirmation-box" id="request_reservation_container" <% if (canRequestAndPay) { %>style="display:none"<%}%>>
      <label for="payments_paypal_standard">
        <input type="checkbox" id="conditions_read_request_reservation" name="conditions_read_request_reservation">&nbsp;

        <?php if ( empty($args['terms_and_conditions']) ) { ?>
          <?php echo esc_html_x( 'I have read and hereby accept the terms and conditions', 'activity_shopping_cart', 'mybooking-wp-plugin' ) ?>
        <?php } else { ?>
          <?php echo wp_kses_post ( sprintf( _x( 'I have read and hereby accept the <a href="%s" target="_blank">terms and conditions</a>', 'activity_shopping_cart', 'mybooking-wp-plugin' ), $args['terms_and_conditions'] ) ) ?>
        <?php } ?>
      </label>
      <button type="submit" class="mb-button btn-confirm-reservation">
        <?php echo esc_html_x( 'Request reservation', 'activity_shopping_cart', 'mybooking-wp-plugin' ) ?>
        <i class="fas fa-arrow-right"></i>
      </button>
    </div>
  <% } %>

  <% if (canPay) { %>

    <div id="payment_now_container" <% if (canRequestAndPay) { %>style="display:none"<%}%>>
      <div class="mybooking-payment_confirmation-info">

        <!-- Payment amount -->
        <div class="mybooking-payment_amount">
          <%=i18next.t('activities.payment.total_payment', {amount: configuration.formatCurrency(paymentAmount)})%>
        </div>

        <!-- Payment info -->
        <div class="mb-alert info highlight">
          <%=i18next.t('activities.payment.deposit_amount',{amount: configuration.formatCurrency(paymentAmount)})%>
        </div>

        <% if (shopping_cart.payment_methods.paypal_standard && shopping_cart.payment_methods.tpv_virtual) { %>
          <div class="mb-alert secondary" role="alert">
            <?php echo wp_kses_post( _x( 'You will be redirected to the <b>payment platform</b> to make the confirmation payment securely. You can use <u>Paypal</u> or <u>credit card</u> to make the payment.', 'renting_complete', 'mybooking-wp-plugin' ) )?>
          </div>
          <div class="mybooking-payment_confirmation-box">
           <label class="mybooking-payment_custom-label" for="payments_paypal_standard">
            <img src="<?php echo esc_url( plugin_dir_url(__DIR__).'/assets/images/pm-paypal.jpg') ?>"/>
            <input type="radio" id="payments_paypal_standard" name="payment_method_select" class="payment_method_select" value="paypal_standard"><?php echo esc_html_x( 'Paypal', 'renting_complete', 'mybooking-wp-plugin' ) ?>
           </label>

           <label class="mybooking-payment_custom-label" for="payments_credit_card">
            <img src="<?php echo esc_url( plugin_dir_url(__DIR__).'/assets/images/pm-visa.jpg') ?>"/>
            <img src="<?php echo esc_url( plugin_dir_url(__DIR__).'/assets/images/pm-mastercard.jpg') ?>"/>
            <input type="radio" id="payments_credit_card" name="payment_method_select" class="payment_method_select" value="<%=sales_process.payment_methods.tpv_virtual%>"><?php echo _x( 'Credit or debit card', 'renting_complete', 'mybooking-wp-plugin' ) ?>
           </label>
          </div>
          <div id="payment_method_select_error"></div>

        <% } else if (shopping_cart.payment_methods.paypal_standard) { %>
          <div class="mb-alert secondary" role="alert">
            <?php echo wp_kses_post( _x( 'You will be redirected to <b>Paypal payment platform</b> to make the confirmation payment securely. You can use <u>Paypal</u> or <u>credit card</u> to make the payment.', 'renting_complete', 'mybooking-wp-plugin' ) ) ?>
          </div>
          <div class="mybooking-payment_confirmation-box">
            <img src="<?php echo esc_url( plugin_dir_url(__DIR__).'/assets/images/pm-paypal.jpg') ?>"/>
            <img src="<?php echo esc_url( plugin_dir_url(__DIR__).'/assets/images/pm-visa.jpg') ?>"/>
            <img src="<?php echo esc_url( plugin_dir_url(__DIR__).'/assets/images/pm-mastercard.jpg') ?>"/>
          </div>

        <% } else if (shopping_cart.payment_methods.tpv_virtual) { %>
          <div class="mb-alert secondary" role="alert">
            <?php echo wp_kses_post( _x( 'You will be redirected to the <b>credit card payment platform</b> to make the confirmation payment securely.', 'renting_complete', 'mybooking-wp-plugin' )  )?>
          </div>
          <div class="mybooking-payment_confirmation-box">
            <img src="<?php echo esc_url( plugin_dir_url(__DIR__).'/assets/images/pm-visa.jpg') ?>"/>
            <img src="<?php echo esc_url( plugin_dir_url(__DIR__).'/assets/images/pm-mastercard.jpg') ?>"/>
          </div>
        <% } %>
      </div>

      <div class="mybooking-payment_confirmation-box">
        <label for="payments_paypal_standard">
          <input type="checkbox" id="conditions_read_pay_now" name="conditions_read_pay_now">

              <?php if ( empty($args['terms_and_conditions']) ) { ?>
                <?php echo esc_html_x( 'I have read and hereby accept the terms and conditions', 'activity_shopping_cart', 'mybooking-wp-plugin' ) ?>
              <?php } else { ?>
                <?php echo wp_kses_post ( sprintf( _x( 'I have read and hereby accept the <a href="%s" target="_blank">terms and conditions</a>', 'activity_shopping_cart', 'mybooking-wp-plugin' ), $args['terms_and_conditions'] ) ) ?>
              <?php } ?>
        </label>
        <button type="submit" class="mb-button btn-confirm-reservation">
          <%=i18next.t('activities.payment.payment_button',{amount: configuration.formatCurrency(paymentAmount)})%>
          <i class="fas fa-arrow-right"></i>
        </button>
      </div>
    </div>
  <% } %>
</script>
