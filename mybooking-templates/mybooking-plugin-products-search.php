<?php
  /** 
   * The Template for showing the products search component
   *
   * This template can be overridden by copying it to yourtheme/mybooking-templates/mybooking-plugin-products-search.php
   *
   */
?>
<div class="jumbotron jumbotron-fluid">
  <div class="container-fluid">
    <form name="search_products_form" class="form-horizontal" method="get" <?php if ( array_key_exists('search_path', $args) && $args['search_path'] != '') { ?>
          action="<?php esc_url( $args['search_path'] )?>"
          <?php } ?>>
      <div class="row">
        <div class="col-md-12">
          <div class="form-row search_fields_container">
            <div class="form-group col-md-1">
              <button type="submit" class="btn btn-primary mb-2 w-100"><i class="fa fa-search"></i>&nbsp;</button>
            </div>
          </div>
        </div>
      </div>
    </form>
  </div>
</div>