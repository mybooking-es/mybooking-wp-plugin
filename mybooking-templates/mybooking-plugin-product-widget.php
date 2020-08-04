    <div id="product_selector" data-code="<?php echo $args['code']?>" 
                               <?php if ( array_key_exists('sales_channel_code', $args) && $args['sales_channel_code'] != '' ) : ?>
                               data-sales-channel-code="<?php echo $args['sales_channel_code']?>" 
                               <?php endif; ?> 
                               class="container is-desktop">
      <div class="row">
        <div class="col-12">
          <form
            name="search_form"
            method="get"
            enctype="application/x-www-form-urlencoded"
            class="form-horizontal">                           
          </form>
        </div>
      </div>
    </div>