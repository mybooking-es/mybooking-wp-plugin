<?php
  /**
   * The Template for showing the activities search component
   *
   * This template can be overridden by copying it to yourtheme/mybooking-templates/mybooking-plugin-activities-search.php
   *
   */
?>

<section class="mybooking mybooking-search <?php echo esc_attr( mybooking_engine_theme_align_width() )?>">
  <form class="mybooking-form" name="search_activities_form" method="get"
    <?php if ( array_key_exists('search_path', $args) && $args['search_path'] != '') { ?>
      action="<?php esc_url( $args['search_path'] )?>"
    <?php } ?>>
    
    <?php wp_nonce_field( 'activities_list', 'activities_wponce' ); ?>

    <div class="mybooking-search_fields-container mb-form-row search_fields_container">
      <!-- Extra fields go here -->

      <input class="mybooking-search_serch-field mb-form-control" type="text" size="50"
         <?php if ( array_key_exists('q', $args) && $args['q'] != '') { ?>
           value="<?php echo esc_attr( $args['q'] )?>"
         <?php } ?>
         name="q" id="search_q" placeholder="<?php echo esc_attr_x( 'Search', 'activities_search', 'mybooking-wp-plugin' ) ?>">

      <button class="mybooking-search_button mb-button" type="submit">
        <!-- <?php echo esc_attr_x( 'Search', 'activities_search', 'mybooking-wp-plugin' ) ?> -->
        <span class="dashicons dashicons-search"></span>
      </button>

    </div>
  </form>
</section>
