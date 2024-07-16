
<?php
/**
 *   MYBOOKING ENGINE - RESERVATION STEPS TEMPLATE
 *   ---------------------------------------------------------------------------
 * 
 *   The Template for showing the steps of the reservation process
 * 
 *   This template can be overridden by copying it to your
 *   theme/mybooking-templates/mybooking-plugin-reservation-steps-tmpl.php
 *
 *   @phpcs:disable PHPCompatibility.Miscellaneous.RemovedAlternativePHPTags.MaybeASPOpenTagFound
 *   @phpcs:disable Generic.PHP.DisallowAlternativePHPTags.MaybeASPOpenTagFound
 *   @phpcs:disable Generic.PHP.DisallowAlternativePHPTags.MaybeASPShortOpenTagFound
 */
?>
<script type="text/tmpl" id="script_reservation_steps">

    <div class="mb-row-flex">
        <div class="mb-col-md-12 mb-col-lg-12">
          <% if (booking.engine_sign_contract) { %>
            <h4 class="mb--txt-fw_light"><?php echo esc_html_x( 'Please follow the steps and complete the booking process.', 'renting_my_reservation', 'mybooking-wp-plugin') ?></h4>
            <h6 class="mb--txt-fw_light"><?php echo esc_html_x( 'By providing the necessary information, we will ensure everything is ready for the delivery day.', 'renting_my_reservation', 'mybooking-wp-plugin') ?></h6>
          <% } %>
          <ul class="mb--steps-wrapper">
            <li class="mb--step <% if (!booking.required_data_completed) { %>mb--active<% } else { %>mb--completed<% } %>">
              <a href="#reservation_customer_container">
              <% if (booking.engine_sign_contract) { %><span class="mb--step-number">1</span><% } %>
                <span class="mb--step-text"><?php echo esc_html_x( 'Complete data', 'renting_my_reservation', 'mybooking-wp-plugin') ?></span>
              </a>
            </li>
            <% if (booking.engine_sign_contract) { %>   
              <li class="mb--step <% if (booking.can_edit_online && booking.required_data_completed && !booking.customer_documents_uploaded) { %>mb--active<% } else if (booking.customer_documents_uploaded) { %>mb--completed<% } else { %>mb--disabled<% } %>">
                <a href="#documents_upload_container">
                  <span class="mb--step-number">2</span>
                  <span class="mb--step-text"><?php echo esc_html_x( 'Upload documentation', 'renting_my_reservation', 'mybooking-wp-plugin') ?></span>
                </a>
              </li>
              <li class="mb--step <% if (booking.can_edit_online && booking.required_data_completed && booking.customer_documents_uploaded && !booking.contract_signed) { %>mb--active<% } else if (booking.contract_signed) { %>mb--completed<% } else { %>mb--disabled<% } %>">
                <a href="#contract_signature_container">
                  <span class="mb--step-number">3</span>
                  <span class="mb--step-text"><?php echo esc_html_x( 'Firm contract', 'renting_my_reservation', 'mybooking-wp-plugin') ?></span>
                </a>
              </li>
            <% } %>
            <% if (sales_process && sales_process.can_pay) { %>
              <li class="mb--step">
                <a href="#payment_view"  id="btn_payment_detail">
                  <span class="mb--step-number"><span class="dashicons dashicons-money"></span></span>
                  <span class="mb--step-text">
                    <% if (booking.status === 'pending_confirmation' && 
                           booking.total_paid == 0 && 
                           sales_process.can_pay_deposit) { %>
                      <?php echo esc_html_x( 'Pay deposit', 'renting_my_reservation', 'mybooking-wp-plugin') ?> 
                    <% } else if (booking.status !== 'pending_confirmation' &&
                                  booking.total_paid > 0) { %>    
                      <?php echo esc_html_x( 'Prepay the rest', 'renting_my_reservation', 'mybooking-wp-plugin') ?>               
                    <% } else { %>
                      <?php echo esc_html_x( 'Pay now', 'renting_my_reservation', 'mybooking-wp-plugin') ?>
                    <% } %>
                  </span>
                </a>
              </li>
            <% } %>
          </ul>
        </div>
    </div>
</script>