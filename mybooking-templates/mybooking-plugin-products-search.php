<?php
  /**
   * The Template for showing the products search component
   *
   * This template can be overridden by copying it to your theme /mybooking-templates/mybooking-plugin-products-search.php
   *
   */
?>


<section class="mybooking mybooking-search <?php echo esc_attr( mybooking_engine_theme_align_width() )?>">
  <form class="mybooking-form" name="search_products_form" method="get"
    <?php if ( array_key_exists('search_path', $args) && $args['search_path'] != '') { ?>
      action="<?php esc_url( $args['search_path'] )?>"
    <?php } ?>>
    <?php wp_nonce_field( 'products_list', 'products_wponce' ); ?>
    <div class="mybooking-search_fields-container mb-form-row search_fields_container">

      <button class="mybooking-search_button mb-button" type="submit">
        <!-- <?php echo esc_attr_x( 'Search', 'activities_search', 'mybooking-wp-plugin' ) ?> -->
        <span class="dashicons dashicons-search"></span>
      </button>
    </div>
  </form>
</section>
