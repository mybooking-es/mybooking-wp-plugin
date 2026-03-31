<?php
if ( ! defined( 'ABSPATH' ) ) exit;
/**
 *   MYBOOKING ENGINE - RESERVATION DEPOSIT PAYMENT TEMPLATE
 *   ---------------------------------------------------------------------------
 * 
 *   The Template for showing the deposit payment in the reservation
 * 
 *   This template can be overridden by copying it to your
 *   theme/mybooking-templates/mybooking-plugin-reservation-deposit-tmpl.php
 *
 *   @phpcs:disable PHPCompatibility.Miscellaneous.RemovedAlternativePHPTags.MaybeASPOpenTagFound
 *   @phpcs:disable Generic.PHP.DisallowAlternativePHPTags.MaybeASPOpenTagFound
 *   @phpcs:disable Generic.PHP.DisallowAlternativePHPTags.MaybeASPShortOpenTagFound
 */
?>
<script type="text/tmpl" id="script_deposit_detail">
  <div class="mb-section mb-panel-container">
    <div class="mybooking-payment_amount">
      <%= i18next.t('myReservation.deposit.total_deposit', {amount:configuration.formatCurrency(amount) }) %>
    </div>

    <form name="deposit_form">
      <% if (deposit_process.payment_methods && deposit_process.payment_methods.paypal_standard && deposit_process.payment_methods.tpv_virtual) { %>
        <div class="mb-alert secondary" role="alert">
          <?php echo wp_kses_post( _x( 'You will be redirected to the <b>payment platform</b> to make the deposit payment securely. You can use <u>Paypal</u> or <u>credit card</u> to make the payment.', 'renting_deposit', 'mybooking-reservation-engine' ) )?>
        </div>
        <div class="mybooking-payment_confirmation-box">
        <label class="mybooking-payment_custom-label" for="deposit_payments_paypal_standard">
          <img src="<?php echo esc_url( plugin_dir_url(__DIR__).'/assets/images/pm-paypal.jpg') ?>"/>
          <input type="radio" id="deposit_payments_paypal_standard" name="deposit_payment_method_select" class="deposit_payment_method_select" value="paypal_standard"><?php echo esc_html_x( 'Paypal', 'renting_deposit', 'mybooking-reservation-engine' ) ?>
        </label>

        <label class="mybooking-payment_custom-label" for="deposit_payments_credit_card">
          <img src="<?php echo esc_url( plugin_dir_url(__DIR__).'/assets/images/pm-visa.jpg') ?>"/>
          <img src="<?php echo esc_url( plugin_dir_url(__DIR__).'/assets/images/pm-mastercard.jpg') ?>"/>
          <input type="radio" id="deposit_payments_credit_card" name="deposit_payment_method_select" class="deposit_payment_method_select" value="<%=deposit_process.payment_methods.tpv_virtual%>"><?php echo wp_kses_post( _x( 'Credit or debit card', 'renting_deposit', 'mybooking-reservation-engine' ) ) ?>
        </label>
        </div>
        <div id="deposit_payment_method_select_error"></div>

      <% } else if (deposit_process.payment_methods && deposit_process.payment_methods.paypal_standard) { %>
        <div class="mb-alert secondary" role="alert">
          <?php echo wp_kses_post( _x( 'You will be redirected to <b>Paypal payment platform</b> to make the deposit payment securely.', 'renting_deposit', 'mybooking-reservation-engine' ) ) ?>
        </div>
        <div class="mybooking-payment_confirmation-box">
          <img src="<?php echo esc_url( plugin_dir_url(__DIR__).'/assets/images/pm-paypal.jpg') ?>"/>
          <img src="<?php echo esc_url( plugin_dir_url(__DIR__).'/assets/images/pm-visa.jpg') ?>"/>
          <img src="<?php echo esc_url( plugin_dir_url(__DIR__).'/assets/images/pm-mastercard.jpg') ?>"/>
        </div>
        <input type="hidden" name="deposit_payment_method_id" value="paypal_standard"/>

      <% } else if (deposit_process.payment_methods && deposit_process.payment_methods.tpv_virtual) { %>
        <div class="mb-alert secondary" role="alert">
          <?php echo wp_kses_post( _x( 'You will be redirected to the <b>credit card payment platform</b> to make the deposit payment securely.', 'renting_deposit', 'mybooking-reservation-engine' )  )?>
        </div>
        <div class="mybooking-payment_confirmation-box">
          <img src="<?php echo esc_url( plugin_dir_url(__DIR__).'/assets/images/pm-visa.jpg') ?>"/>
          <img src="<?php echo esc_url( plugin_dir_url(__DIR__).'/assets/images/pm-mastercard.jpg') ?>"/>
        </div>
        <input type="hidden" name="deposit_payment_method_id" value="<%=deposit_process.payment_methods.tpv_virtual%>"/>
      <% } %>

      <button class="mb-button block" id="btn_pay_deposit" type="submit">
        <%= i18next.t('myReservation.deposit.deposit_button', {amount:configuration.formatCurrency(amount) }) %>
      </button>

      <div id="deposit_error" class="mb-alert danger" style="display:none"></div>
    </form>
  </div>
</script>

