
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
 */
?>
<script type="text/tmpl" id="script_reservation_steps">
  <div class="mb-row-flex">
    <div class="mb-col-md-6 mb-col-lg-8">
      <h4 class="mb--txt-fw_light"><?php echo esc_html_x( 'Please follow the steps and complete the booking process.', 'renting_my_reservation', 'mybooking-wp-plugin') ?></h4>
      <h6 class="mb--txt-fw_light"><?php echo esc_html_x( 'This way we will have everything ready for the scheduled date.', 'renting_my_reservation', 'mybooking-wp-plugin') ?></h6>
      <ul class="mb--steps-wrapper">
        <li class="mb--step <% if (!booking.required_data_completed) { %>mb--active<% } else { %>mb--completed<% } %>">
          <a href="#reservation_customer_container">
            <span class="mb--step-number">1</span>
            <span class="mb--step-text"><?php echo esc_html_x( 'Complete personal data', 'renting_my_reservation', 'mybooking-wp-plugin') ?></span>
          </a>
        </li>
        <li class="mb--step <% if (booking.required_data_completed && !booking.customer_documents_uploaded) { %>mb--active<% } else if (booking.customer_documents_uploaded) { %>mb--completed<% } else { %>mb--disabled<% } %>">
          <a href="#documents_upload_container">
            <span class="mb--step-number">2</span>
            <span class="mb--step-text"><?php echo esc_html_x( 'Upload documentation', 'renting_my_reservation', 'mybooking-wp-plugin') ?></span>
          </a>
        </li>
        <% if (booking.engine_sign_contract) { %>
          <li class="mb--step <% if (booking.required_data_completed && booking.customer_documents_uploaded && !booking.contract_signed) { %>mb--active<% } else if (booking.contract_signed) { %>mb--completed<% } else { %>mb--disabled<% } %>">
            <a href="#contract_signature_container">
              <span class="mb--step-number">3</span>
              <span class="mb--step-text"><?php echo esc_html_x( 'Firm contract', 'renting_my_reservation', 'mybooking-wp-plugin') ?></span>
            </a>
          </li>
        <% } %>
      </ul>
    </div>
    <div class="mb-col-md-6 mb-col-lg-4 mb--flex-align_end">
      <button  id="btn_payment_detail" class="mb-button mb-accent-color mb-width-100">
        <?php echo esc_html_x( 'Pay now!', 'renting_my_reservation', 'mybooking-wp-plugin') ?>
      </button>
    </div>
  </div>
</script>