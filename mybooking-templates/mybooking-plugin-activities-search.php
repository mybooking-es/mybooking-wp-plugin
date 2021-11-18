<?php
  /** 
   * The Template for showing the activities search component
   *
   * This template can be overridden by copying it to yourtheme/mybooking-templates/mybooking-plugin-activities-search.php
   *
   */
?>
<div class="mb-section">
  <form name="search_activities_form" class="mybooking-form" method="get" <?php if ( array_key_exists('search_path', $args) && $args['search_path'] != '') { ?>
        action="<?php esc_url( $args['search_path'] )?>"
        <?php } ?>>
    <div class="mb-row">
      <div class="mb-col-md-12 search_fields_container">
        <div class="mb-form-group mb-col-md-5">
          <input type="text" size="50" class="mb-form-control"  
                 <?php if ( array_key_exists('q', $args) && $args['q'] != '') { ?>value="<?php echo esc_attr( $args['q'] )?>"<?php } ?>
                 name="q" id="search_q" placeholder="<?php echo esc_attr_x( 'Search', 'activities_search', 'mybooking-wp-plugin' ) ?>">
        </div>
        <div class="mb-form-group mb-col-md-1">
          <button type="submit" class="mb-button"><?php echo esc_html_x( 'Search', 'activities_search', 'mybooking-wp-plugin') ?></button>
        </div>
      </div>
    </div>
  </form>
</div>
