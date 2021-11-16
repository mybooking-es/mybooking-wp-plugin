<div class="mb-row">
  <div class="mb-col-md-12">
    <form name="mybooking_password_forgotten_form" autocomplete="off" class="mybooking-form">
      <div class="mb-form-group">
          <label for="mybooking_password_forgotten_username"><?php echo esc_html_x( "Username or email", 'password_forgotten', 'mybooking-wp-plugin') ?></label>
          <input type="text" name="username" class="form-control" id="mybooking_password_forgotten_username" placeholder="<?php echo esc_html_x( "Enter username or email", 'password_forgotten', 'mybooking-wp-plugin') ?>">
      </div>
      <div class="mybooking-selector_footer">
        <button type="submit" class="mb-button"><?php echo esc_html_x( "Send", 'password_forgotten', 'mybooking-wp-plugin') ?></button>      
      </div>
    </form>
  </div>
</div>