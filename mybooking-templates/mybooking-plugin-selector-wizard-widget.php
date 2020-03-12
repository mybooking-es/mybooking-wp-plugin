    <section class="section">
      <!-- Take into account the theme due to HTML elements -->
      <?php mybooking_engine_get_template('mybooking-plugin-selector-wizard-container.php') ?>
      <!-- Search form -->
      <div class="container">
        <form name="wizard_search_form" class="mt-5">
            <input type="hidden" name="pickup_place">
            <input type="hidden" name="return_place">
            <input type="hidden" name="date_from">
            <input type="hidden" name="time_from">
            <input type="hidden" name="time_to">
            <div class="row">
              <div class="col-md-3">
                  <label for="place_holder"><?php _e( 'Where?', 'mybooking-wp-plugin') ?></label>
                  <input type="text" class="form-control form-control-lg bg-white" id="place_holder" 
                         aria-describedby="pickupPlaceHolder" placeholder="<?php _e( 'Select a location', 'mybooking-wp-plugin') ?>" readonly="true">
              </div>
              <div class="col-md-3">
                  <label for="from_holder"><?php _e( 'When?', 'mybooking-wp-plugin') ?></label>
                  <input type="text" class="form-control form-control-lg bg-white" id="from_holder" 
                         aria-describedby="FromHolder" placeholder="<?php _e( 'Date', 'mybooking-wp-plugin') ?>" readonly="true">
              </div>    
              <br>
              <div class="col-md-1 d-flex align-items-end">
                  <button id="btn_reservation" type="button" class="btn btn-success"><?php _e( 'Book', 'mybooking-wp-plugin') ?></button> 
              </div>                                     
            </div>           
          </div>
        </form>
      </div>
    </section>