<div class="row">
  <div class="col-lg-12">
    <form name="mybooking_password_forgotten_form" autocomplete="off">
      <div class="form-group">
          <label for="mybooking_password_forgotten_username"><?php echo esc_html_x( "Username or email", 'password_forgotten', 'mybooking-wp-plugin') ?></label>
          <input type="text" name="username" class="form-control" id="mybooking_password_forgotten_username" placeholder="<?php echo esc_html_x( "Enter username or email", 'password_forgotten', 'mybooking-wp-plugin') ?>">
      </div>
      <button type="submit" class="btn btn-primary"><?php echo esc_html_x( "Send", 'password_forgotten', 'mybooking-wp-plugin') ?></button>      
    </form>
  </div>
</div>