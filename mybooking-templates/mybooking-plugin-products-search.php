<?php
  /** 
   * The Template for showing the products search component
   *
   * This template can be overridden by copying it to yourtheme/mybooking-templates/mybooking-plugin-products-search.php
   *
   */
?>
<div class="mb-section">
  <form name="search_products_form" class="mybooking-form" method="get" <?php if ( array_key_exists('search_path', $args) && $args['search_path'] != '') { ?>
        action="<?php esc_url( $args['search_path'] )?>"
        <?php } ?>>
    <div class="mb-row">
      <div class="mb-col-md-12 search_fields_container">
        <div class="mb-form-group mb-col-md-1">
          <button type="submit" class="btn btn-primary mb-2 w-100"><?php echo esc_html_x( 'Search', 'renting_product_search', 'mybooking-wp-plugin') ?></button>
        </div>
      </div>
    </div>
  </form>
</div>
