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

    <?php if ( array_key_exists('subject', $args) && $args['subject'] != '' ) : ?>
      <input type="hidden" name="subject" value="<?php echo esc_attr( $args['subject'] )?>" />
    <?php endif; ?>

    <?php if ( array_key_exists('source', $args) && $args['source'] != '' ) : ?>
      <input type="hidden" name="source" value="<?php echo esc_attr( $args['source'] )?>" />
    <?php endif; ?>

    <?php if ( array_key_exists('sales_channel_code', $args) && $args['sales_channel_code'] != '' ) : ?>
      <input type="hidden" name="sales_channel_code" value="<?php echo esc_attr( $args['sales_channel_code'] )?>" />
    <?php endif; ?>

    <?php if ( array_key_exists('rental_location_code', $args) && $args['rental_location_code'] != '' ) : ?>
      <input type="hidden" name="rental_location_code" value="<?php echo esc_attr( $args['rental_location_code'] )?>" />
    <?php endif; ?>

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

    <?php if ( array_key_exists('google_captcha_api_key', $args) && !empty( $args['google_captcha_api_key'] ) ): ?>
      <div class="g-recaptcha mt-1 mb-3" data-sitekey="<?php echo esc_attr( $args['google_captcha_api_key'] )?>"></div>
    <?php endif; ?>

    <div class="form-row">
      <div class="form-group col-md-12">
        <input id="send_message_button" type="submit" class="btn btn-primary" value="<?php echo esc_attr_x( 'Send', 'contact_form', 'mybooking-wp-plugin') ?>">
      </div>
    </div>

  </form>
</section>
