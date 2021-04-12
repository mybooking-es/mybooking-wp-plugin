<?php
  /** 
   * The Template for showing the index of products
   *
   * This template can be overridden by copying it to yourtheme/mybooking-templates/mybooking-plugin-products.php
   *
   */
?>
<section class="container-fluid">
		<!-- Products -->
		<div class="row">
			<?php foreach( $args['data']->data as $mybooking_product ) { ?>

			  <?php  $mybooking_productIdAnchor = $mybooking_product->id;
	  	    if ( !empty( $mybooking_product->slug) ) {
	  			  $mybooking_productIdAnchor = $mybooking_product->slug;
  				}
			  ?>

			  <div class="col-md-4">
					<div class="resource-product-card card d-flex flex-column mb-2 shadow mb-5 bg-white rounded-0">
						<?php if ( !empty( $mybooking_product->photo_path ) ) { ?>
							<a href="<?php echo esc_url( '/'.$args['url_detail'].'/'.$mybooking_productIdAnchor ) ?>">
					  	  <img class="resource-product-card-img card-img-top rounded-0" src="<?php echo esc_url( $mybooking_product->photo_path )?>" alt="<?php echo esc_attr( $mybooking_product->name )?>">
					    </a>
						<?php } else { ?>
							<a href="<?php echo esc_url( '/'.$args['url_detail'].'/'.$mybooking_productIdAnchor ) ?>">
	 					    <img class="resource-product-card-img card-img-top rounded-0" src="<?php echo esc_url( plugin_dir_url(__DIR__).'/assets/images/default-image-product.png' ) ?>" alt="<?php echo esc_attr( $mybooking_product->name )?>">
	 					  </a>  							
						<?php } ?>
					  <div class="card-body d-flex flex-column justify-content-center">
					    <h5 class="h6 card-title text-left resource-product-card-title"><b><?php echo esc_html( $mybooking_product->name ) ?></b></h5>
					    <p class="card-text text-muted"><?php echo wp_kses_post( $mybooking_product->short_description ) ?></p>
			          <!-- From price -->
			          <?php if ($mybooking_product->from_price > 0) { ?>
			            <p class="card-text text-danger font-weight-normal"><?php echo wp_kses( sprintf( _x('From <b>%s</b>', 'renting_products', 'mybooking-wp-plugin' ), 
			                                                                                             number_format_i18n( $mybooking_product->from_price ) ),
			                                                                                    array( 'b' => array() ) ) ?>€</p>
			        	<?php } else { ?>
			        	  <br>	
			          <?php } ?>
					  </div>
				    <?php if ( isset( $mybooking_product->key_characteristics) && is_array( (array) $mybooking_product->key_characteristics ) && !empty( (array) $mybooking_product->key_characteristics ) ) { ?>
						  <div class="card-body key-characteristics">
							<ul class="icon-list-items">
                <?php if ( isset( $mybooking_product->characteristic_length ) && !empty( $mybooking_product->characteristic_length ) ) { ?>
                  <li class="icon-list-item">
                      <span class="icon-list-icon">
                      	<img src="<?php echo esc_url( plugin_dir_url(__DIR__).'/assets/images/characteristics/length.svg' ) ?>"
                      	     alt="<?php echo esc_attr( MyBookingEngineContext::getInstance()->getCharacteristic( 'length' ) ) ?>"/>
                      </span>
                      <span class="icon-list-text text-muted"><?php echo wp_kses( sprintf( _x('<b>%.2f</b> m.', 'renting_products', 'mybooking-wp-plugin' ), 
                      	                                                                   $mybooking_product->characteristic_length ),
                      	                                                          array( 'b' => array() ) ) ?></span>
                  </li>
                <?php } ?>  							
								<?php foreach ( $mybooking_product->key_characteristics as $mybooking_key => $mybooking_value) { ?>
									<li class="icon-list-item">
											<span class="icon-list-icon">
												<img src="<?php echo esc_url( plugin_dir_url(__DIR__).'/assets/images/key_characteristics/'.$mybooking_key.'.svg' ) ?>"
												     alt="<?php echo esc_attr( MyBookingEngineContext::getInstance()->getKeyCharacteristic( $mybooking_key ) ) ?>"/>
											</span>
											<span class="icon-list-text text-muted"><?php echo esc_html( $mybooking_value ) ?></span>
									</li>
								<?php } ?>
							</ul>
						  </div>	
			      <?php } ?>
					  <div class="card-body d-flex flex-column justify-content-end">
					    <a href="<?php echo esc_url( '/'.$args['url_detail'].'/'.$mybooking_productIdAnchor ) ?>" class="btn btn-primary w-100"><?php echo esc_html_x('More information', 'renting_products', 'mybooking-wp-plugin' ) ?></a>
					  </div>
					</div>
			  </div>
			<?php  } ?>
		</div>
	  
	  <!-- Pagination -->
	  <?php if ($args['total_pages'] > 1) { ?>
	  	<?php $mybooking_querystring = array_key_exists('querystring', $args) ? $args['querystring'] : '' ?>
			<div class="row">
				<div class="col-md-12">
					<nav aria-label="Page navigation example" class="pull-right">
					  <ul class="pagination">
					  	<?php $mybooking_disabled_previous = ($args['current_page'] == 1 ? 'disabled' : '') ?>
					    <li class="page-item <?php echo esc_attr( $mybooking_disabled_previous ) ?>">
					    	  <a class="page-link" 
					    	     href="<?php echo esc_url( '/'.$args['url'].'?offsetpage='.($args['current_page']-1).$mybooking_querystring ) ?>">
					    	     <?php echo esc_html_x('Previous', 'renting_products', 'mybooking-wp-plugin' ) ?>
					    	  </a>
					    </li>
		          <?php foreach ($args['pages'] as $mybooking_page) { ?>
			          <?php if ($mybooking_page == $args['current_page']) { ?>
							    <li class="page-item active" aria-current="page">
							      <span class="page-link">
							        <?php echo esc_html( $mybooking_page ) ?>
							      </span>
							    </li>			          
			          <?php } else { ?> 
			            <li class="page-item">
			      	      <a class="page-link" 
			      	         href="<?php echo esc_url( '/'.$args['url'].'?offsetpage='.($mybooking_page).$mybooking_querystring ) ?>">
			      	      	 <?php echo esc_html( $mybooking_page ) ?>
			      	      </a>
			      	    </li>  
			      	  <?php } ?>
					    <?php } ?>	    
					    <?php $mybooking_disabled_next = ($args['current_page'] == $args['total_pages'] ? 'disabled' : '') ?>
					    <li class="page-item <?php echo esc_attr( $mybooking_disabled_next ) ?>">
					    	  <a class="page-link" 
					    	     href="<?php echo esc_url( '/'.$args['url'].'?offsetpage='.($args['current_page']+1).$mybooking_querystring ) ?>">
					    	  	 <?php echo esc_html_x('Next', 'renting_products', 'mybooking-wp-plugin' ) ?>
					    	  </a>
					    </li>
					  </ul>
					</nav>
				</div>
			</div>
		<?php } ?>

</section>