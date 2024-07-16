<?php
/**
 *   MYBOOKING ENGINE - RESERVATION PAYMENT TEMPLATE
 *   ---------------------------------------------------------------------------
 * 
 *   The Template for showing the payment in the reservation process
 * 
 *   This template can be overridden by copying it to your
 *   theme/mybooking-templates/mybooking-plugin-reservation-payment-tmpl.php
 *
 *   @phpcs:disable PHPCompatibility.Miscellaneous.RemovedAlternativePHPTags.MaybeASPOpenTagFound
 *   @phpcs:disable Generic.PHP.DisallowAlternativePHPTags.MaybeASPOpenTagFound
 *   @phpcs:disable Generic.PHP.DisallowAlternativePHPTags.MaybeASPShortOpenTagFound
 */
?>
<script type="text/tmpl" id="script_payment_detail">
  <div class="mb-section mb-panel-container">
    <div class="mybooking-payment_amount">
      <%= i18next.t('myReservation.pay.total_payment', {amount:configuration.formatCurrency(amount) }) %>
    </div>

    <form name="payment_form">
      <% if (booking.status === 'pending_confirmation' && 
          booking.total_paid == 0 && 
          sales_process.can_pay_deposit) { %>   
        <div class="mb-alert warning" role="alert">    
          <%= i18next.t('myReservation.pay.booking_amount', {amount:configuration.formatCurrency(amount) }) %>   
        </div>     
      <% } else if (booking.status !== 'pending_confirmation' &&
                    booking.total_paid > 0) { %>   
        <div class="mb-alert warning" role="alert">                 
          <%= i18next.t('myReservation.pay.pending_amount', {amount:configuration.formatCurrency(amount) }) %> 
        </div>             
      <% } %>  
      <% if (sales_process.payment_methods.paypal_standard && sales_process.payment_methods.tpv_virtual) { %>
        <div class="mb-alert secondary" role="alert">
          <?php echo wp_kses_post( _x( 'You will be redirected to the <b>payment platform</b> to make the payment securely. You can use <u>Paypal</u> or <u>credit card</u> to make the payment.', 'renting_complete', 'mybooking-wp-plugin' ) )?>
        </div>
        <div class="mybooking-payment_confirmation-box">
        <label class="mybooking-payment_custom-label" for="payments_paypal_standard">
          <img src="<?php echo esc_url( plugin_dir_url(__DIR__).'/assets/images/pm-paypal.jpg') ?>"/>
          <input type="radio" id="payments_paypal_standard" name="payment_method_select" class="payment_method_select" value="paypal_standard"><?php echo esc_html_x( 'Paypal', 'renting_complete', 'mybooking-wp-plugin' ) ?>
        </label>

        <label class="mybooking-payment_custom-label" for="payments_credit_card">
          <img src="<?php echo esc_url( plugin_dir_url(__DIR__).'/assets/images/pm-visa.jpg') ?>"/>
          <img src="<?php echo esc_url( plugin_dir_url(__DIR__).'/assets/images/pm-mastercard.jpg') ?>"/>
          <input type="radio" id="payments_credit_card" name="payment_method_select" class="payment_method_select" value="<%=sales_process.payment_methods.tpv_virtual%>"><?php echo wp_kses_post( _x( 'Credit or debit card', 'renting_complete', 'mybooking-wp-plugin' ) ) ?>
        </label>
        </div>
        <div id="payment_method_select_error"></div>  

      <% } else if (sales_process.payment_methods.paypal_standard) { %>
        <div class="mb-alert secondary" role="alert">
          <?php echo wp_kses_post( _x( 'You will be redirected to <b>Paypal payment platform</b> to make the payment securely. You can use <u>Paypal</u> or <u>credit card</u> to make the payment.', 'renting_complete', 'mybooking-wp-plugin' ) ) ?>
        </div>
        <div class="mybooking-payment_confirmation-box">
          <img src="<?php echo esc_url( plugin_dir_url(__DIR__).'/assets/images/pm-paypal.jpg') ?>"/>
          <img src="<?php echo esc_url( plugin_dir_url(__DIR__).'/assets/images/pm-visa.jpg') ?>"/>
          <img src="<?php echo esc_url( plugin_dir_url(__DIR__).'/assets/images/pm-mastercard.jpg') ?>"/>
        </div>
        <input type="hidden" name="payment_method_id" value="paypal_standard"/>

      <% } else if (sales_process.payment_methods.tpv_virtual) { %>
        <div class="mb-alert secondary" role="alert">
          <?php echo wp_kses_post( _x( 'You will be redirected to the <b>credit card payment platform</b> to make the payment securely.', 'renting_complete', 'mybooking-wp-plugin' )  )?>
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

      <button class="mb-button block" id="btn_pay" type="submit">
        <%= i18next.t('myReservation.pay.payment_button', {amount:configuration.formatCurrency(amount) }) %>
      </button>

      <div id="payment_error" class="mb-alert danger" style="display:none"></div>
    </form>
  </div>
</script>