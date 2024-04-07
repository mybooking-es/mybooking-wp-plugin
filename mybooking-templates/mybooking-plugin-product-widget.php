<?php
  /**
   * The Template for showing the product calendar widget
   *
   * This template can be overridden by copying it to yourtheme/mybooking-templates/mybooking-plugin-product-widget.php
   *
   */
?>
    <div id="product_selector"
          data-code="<?php echo esc_attr( $args['code'] )?>"
           <?php if ( array_key_exists('sales_channel_code', $args) && $args['sales_channel_code'] != '' ) : ?>
             data-sales-channel-code="<?php echo esc_attr( $args['sales_channel_code'] )?>"
           <?php endif; ?>
           <?php if ( array_key_exists('rental_location_code', $args) && $args['rental_location_code'] != '' ) : ?>
             data-rental-location-code="<?php echo esc_attr( $args['rental_location_code'] )?>"
           <?php endif; ?>
           <?php if ( array_key_exists('check_hourly_occupation', $args) && $args['check_hourly_occupation'] == 'yes' ) : ?>
             data-check-hourly-occupation="true"
           <?php endif; ?>  
           <?php if ( array_key_exists('performance_id', $args) && $args['performance_id'] != '' ) : ?>
             data-performance-id="<?php echo esc_attr( $args['performance_id'] )?>"
           <?php endif; ?>
           class="mybooking mybooking-product_calendar_container <?php echo esc_attr( mybooking_engine_theme_align_width() )?>">
      <form
        name="search_form"
        method="get"
        enctype="application/x-www-form-urlencoded"
        class="mybooking-form mybooking-product_calendar">                           
      </form>
    </div>

    <!-- DETAILS MODAL ------------------------------------------------------------>

    <div class="mybooking mybooking-detail_modal mybooking-modal modal-mybooking" tabindex="-1" role="dialog" id="modalDailyOccupation_MBM">
      <h3 class="mybooking-modal_title modal-product-detail-title"></h3>
      <div class="mybooking-modal_body modal-product-detail-content"></div>
    </div>
