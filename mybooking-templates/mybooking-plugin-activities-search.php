<?php
  /**
   * The Template for showing the activities search component
   *
   * This template can be overridden by copying it to yourtheme/mybooking-templates/mybooking-plugin-activities-search.php
   *
   */
?>

<section class="mybooking mybooking-search">
  <form class="mybooking-form" name="search_activities_form" method="get"
    <?php if ( array_key_exists('search_path', $args) && $args['search_path'] != '') { ?>
      action="<?php esc_url( $args['search_path'] )?>"
    <?php } ?>>

    <div class="mb-form-row search_fields_container">
      <input class="mb-form-control" type="text" size="50"
         <?php if ( array_key_exists('q', $args) && $args['q'] != '') { ?>
           value="<?php echo esc_attr( $args['q'] )?>"
         <?php } ?>
         name="q" id="search_q" placeholder="<?php echo esc_attr_x( 'Search', 'activities_search', 'mybooking-wp-plugin' ) ?>">

      <button class="mb-button search" type="submit">
        <span class="dashicons dashicons-search"></span>
      </button>
    </div>
  </form>
</section>
