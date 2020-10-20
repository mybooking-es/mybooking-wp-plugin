<?php
  /** 
   * The Template for showing the contact form widget
   *
   * This template can be overridden by copying it to yourtheme/mybooking-templates/mybooking-plugin-contact-widget.php
   *
   */
?>
    <section class="widget widget_mybooking_engine_contact">
      <form id="widget_contact_form" name="widget_contact_form" autocomplete="off">

              <div class="form-row">
                <div class="form-group col-md-6">
                  <label for="customer_name"><?php echo esc_html_x( 'Name', 'contact_form', 'mybooking-wp-plugin') ?>*</label>
                  <input type="text" class="form-control" name="customer_name" id="customer_name" placeholder="<?php echo esc_attr_x( 'Name', 'contact_form', 'mybooking-wp-plugin') ?>:*">
                </div>
                <div class="form-group col-md-6">
                  <label for="customer_surname"><?php echo esc_html_x( 'Surname', 'contact_form', 'mybooking-wp-plugin') ?>*</label>
                  <input type="text" class="form-control" name="customer_surname" id="customer_surname" placeholder="<?php echo esc_attr_x( 'Surname', 'contact_form', 'mybooking-wp-plugin') ?>:*">
                </div>
              </div>

              <div class="form-row">
                <div class="form-group col-md-12">
                  <label for="customer_email"><?php echo esc_html_x( 'E-mail', 'contact_form', 'mybooking-wp-plugin') ?>*</label>
                  <input type="text" class="form-control" name="customer_email" id="customer_email" placeholder="<?php echo esc_attr_x( 'E-mail', 'contact_form', 'mybooking-wp-plugin') ?>:*">
                </div>
              </div>

              <div class="form-row">
                <div class="form-group col-md-12">
                  <label for="customer_phone"><?php echo esc_html_x( 'Phone number', 'contact_form', 'mybooking-wp-plugin') ?>*</label>
                  <input type="text" class="form-control" name="customer_phone" id="customer_phone" placeholder="<?php echo esc_attr_x( 'Phone number', 'contact_form', 'mybooking-wp-plugin') ?>:*">
                </div>
              </div>                    

              <div class="form-row">
                <div class="form-group col-md-12">
                  <label for="customer_name"><?php echo esc_html_x( 'Message', 'contact_form', 'mybooking-wp-plugin') ?>*</label>
                  <textarea class="form-control" name="comments" id="comments" rows="10" placeholder="<?php echo esc_attr_x( 'Message', 'contact_form', 'mybooking-wp-plugin') ?>"></textarea>
                </div>
              </div>   

              <div class="form-row">
                <div class="form-group col-md-12">
                  <div class="alert alert-danger" id="contact_form_errors" style="display: none"></div>
                </div>
              </div>

              <div class="form-row">
                <div class="form-group col-md-12">
                  <input id="send_message_button" type="submit" class="btn btn-primary" value="<?php echo esc_attr_x( 'Send', 'contact_form', 'mybooking-wp-plugin') ?>">
                </div>
              </div>  

      </form>
    </section>