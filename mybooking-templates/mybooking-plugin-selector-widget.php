    <section class="widget widget_mybooking_rent_engine_selector reservation-step has-background-grey-lighter">
      <form
        name="widget_search_form"
        method="get"
        enctype="application/x-www-form-urlencoded">
        
        <?php if ( $args['sales_channel_code'] != '' ) : ?>
        <input type="hidden" name="sales_channel_code" value="<?php echo $args['sales_channel_code']?>"/>
        <?php endif; ?>

        <?php if ( $args['family_id'] != '' ) : ?>
        <input type="hidden" name="family_id" value="<?php echo $args['family_id']?>"/>
        <?php endif; ?>
        
        <!-- Entrega -->
        <div class="form-row">
          <div class="form-group col-md-12">
              <label for="date_from"><?php _e( 'Pick-up place', 'mybooking-wp-plugin') ?></label>
              <select class="form-control" name="pickup_place" id="widget_pickup_place"></select>
          </div>
        </div>

        <div class="form-row">
          <div class="form-group col-md-6">
              <label for="date_from"><?php _e( 'Date', 'mybooking-wp-plugin' ) ?></label>
              <input type="text" class="form-control" name="date_from" id="widget_date_from" autocomplete="off">
          </div>
          <div class="form-group col-md-6">
              <label for="time_to"><?php _e( 'Time', 'mybooking-wp-plugin' ) ?></label>
              <select class="form-control" name="time_from" id="widget_time_from"></select>
          </div>
        </div>

        <!-- Devolución -->
        <div class="form-row">
          <div class="form-group col-md-12">
            <label for="date_from"><?php _e( 'Return place', 'mybooking-wp-plugin' ) ?></label>
            <select class="form-control" name="return_place" id="widget_return_place"></select>
          </div>
        </div>       

        <div class="form-row">
          <div class="form-group col-md-6">
              <label for="date_from"><?php _e( 'Date', 'mybooking-wp-plugin' ) ?></label>
              <input type="text" class="form-control" name="date_to" id="widget_date_to" autocomplete="off">
          </div>
          <div class="form-group col-md-6">
              <label for="time_to"><?php _e( 'Time', 'mybooking-wp-plugin' ) ?></label>
              <select class="form-control" name="time_to" id="widget_time_to"></select>
          </div>
        </div>
        
        <div class="form-row">
          <div class="form-group col-md-12">
            <input class="btn btn-success" type="submit" value="<?php _e( 'Search', 'mybooking-wp-plugin') ?>" />
          </div>
        </div>

      </form>
    </section>