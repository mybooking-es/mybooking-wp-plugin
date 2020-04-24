    <section class="widget widget_mybooking_engine_contact">
      <form id="widget_contact_form" name="widget_contact_form" autocomplete="off">

              <div class="form-row">
                <div class="form-group col-md-6">
                  <label for="customer_name"><?php echo _x( 'Name', 'contact_form', 'mybooking-wp-plugin') ?>*</label>
                  <input type="text" class="form-control" name="customer_name" id="customer_name" placeholder="<?php echo _x( 'Name', 'contact_form', 'mybooking-wp-plugin') ?>:*">
                </div>
                <div class="form-group col-md-6">
                  <label for="customer_surname"><?php echo _x( 'Surname', 'contact_form', 'mybooking-wp-plugin') ?>*</label>
                  <input type="text" class="form-control" name="customer_surname" id="customer_surname" placeholder="<?php echo _x( 'Surname', 'contact_form', 'mybooking-wp-plugin') ?>:*">
                </div>
              </div>

              <div class="form-row">
                <div class="form-group col-md-12">
                  <label for="customer_email"><?php echo _x( 'E-mail', 'contact_form', 'mybooking-wp-plugin') ?>*</label>
                  <input type="text" class="form-control" name="customer_email" id="customer_email" placeholder="<?php echo _x( 'E-mail', 'contact_form', 'mybooking-wp-plugin') ?>:*">
                </div>
              </div>

              <div class="form-row">
                <div class="form-group col-md-12">
                  <label for="customer_phone"><?php echo _x( 'Phone number', 'contact_form', 'mybooking-wp-plugin') ?>*</label>
                  <input type="text" class="form-control" name="customer_phone" id="customer_phone" placeholder="<?php echo _x( 'Phone number', 'contact_form', 'mybooking-wp-plugin') ?>:*">
                </div>
              </div>                    

              <div class="form-row">
                <div class="form-group col-md-12">
                  <label for="customer_name"><?php echo _x( 'Message', 'contact_form', 'mybooking-wp-plugin') ?>*</label>
                  <textarea class="form-control" name="comments" id="comments" rows="10" placeholder="<?php echo _x( 'Message', 'contact_form', 'mybooking-wp-plugin') ?>"></textarea>
                </div>
              </div>   

              <div class="form-row">
                <div class="form-group col-md-12">
                  <div class="alert alert-danger" id="contact_form_errors" style="display: none"></div>
                </div>
              </div>

              <div class="form-row">
                <div class="form-group col-md-12">
                  <input id="send_message_button" type="submit" class="btn btn-primary" value="Enviar">
                </div>
              </div>  

      </form>
    </section>