<?php
/**
 *   MYBOOKING ENGINE - PRODUCTS CATALOG
 *   ---------------------------------------------------------------------------
 *   The Template for showing the renting select product step
 *   This template can be overridden by copying it to your
 *   theme /mybooking-templates/mybooking-plugin-products.php
 *
 */
?>

<section class="mybooking mybooking-products_catalog <?php echo esc_attr( mybooking_engine_theme_align_width() )?>">

		<!-- PRODUCT LOOP ------------------------------------------------------------->

		<div class="mybooking-product_list">

			<div class="mybooking-product_filter">
	      <div class="mybooking-product_filter-btn-group">
	        <span class="mybooking-product_filter-legend"><?php echo esc_html_x( 'Order', 'renting_choose_product', 'mybooking-wp-plugin') ?></span>
	        <span class="mybooking-product_filter-btn grid js-mb-grid" title="Grid view"><i class="mb-button icon"><span class="dashicons dashicons-grid-view"></span></i></span>
	        <span class="mybooking-product_filter-btn list js-mb-list" title="List view"><i class="mb-button icon"><span class="dashicons dashicons-list-view"></span></i></span>
	      </div>
	    </div>

			<?php foreach( $args['data']->data as $mybooking_product ) { ?>
			  <?php
					$mybooking_productIdAnchor = $mybooking_product->id;
	  	    if ( !empty( $mybooking_product->slug) ) { $mybooking_productIdAnchor = $mybooking_product->slug; }
			  ?>
			  <div class="mybooking-product_column">
					<div class="mybooking-product">

						<div class="mybooking-product_block">
	            <div class="mybooking-product_image-container">
								<?php if ( !empty( $mybooking_product->full_photo_path ) ) { ?>
									<img class="mybooking-product_image" src="<?php echo esc_url( $mybooking_product->full_photo_path )?>" alt="<?php echo esc_attr( $mybooking_product->name )?>">
								<?php } else { ?>
									<img class="mybooking-product_image" src="<?php echo esc_url( plugin_dir_url(__DIR__).'/assets/images/default-image-product.png' ) ?>" alt="<?php echo esc_attr( $mybooking_product->name )?>">
								<?php } ?>
							</div>
						</div>


					  <div class="mybooking-product_block">
							<?php if ( $mybooking_product->from_price > 0 ) { ?>
							<div class="mybooking-product_header">
                <div class="mybooking-product_price">

										<span class="mybooking-product_price-from">
											<?php echo esc_html_x( 'From', 'activities_list', 'mybooking-wp-plugin' ) ?>
										</span>
										<span class="mybooking-product_amount">
											<?php echo esc_html( $mybooking_product->from_price ) ?>€
										</span>

								</div>
							</div>
							<?php } ?>

							<div class="mybooking-product_body">
						    	<div class="mybooking-product_name">
									<?php echo esc_html( $mybooking_product->name ) ?>
								</div>

								<div class="mybooking-product_short-description">
									<?php echo esc_html( $mybooking_product->short_description ) ?>
								</div>

	              <div class="mybooking-product_description mybooking-truncate-overflow-3lines">
									<?php echo wp_kses_post( $mybooking_product->description ) ?>
								</div>
	              
							</div>

							<?php if ( isset( $mybooking_product->key_characteristics) && is_array( (array) $mybooking_product->key_characteristics ) && !empty( (array) $mybooking_product->key_characteristics ) ) { ?>
							  <div class="mybooking-product_characteristics">
									<?php foreach ( $mybooking_product->key_characteristics as $mybooking_key => $mybooking_value) { ?>
										<div class="mybooking-product_characteristics-item">
											<img class="mybooking-product_characteristics-img" src="<?php echo esc_url( plugin_dir_url(__DIR__).'/assets/images/key_characteristics/'.$mybooking_key.'.svg' ) ?>" alt="<?php echo esc_attr( MyBookingEngineContext::getInstance()->getKeyCharacteristic( $mybooking_key ) ) ?>"/>
											<span class="mybooking-product_characteristics-key"><?php echo esc_html( $mybooking_value ) ?></span>
										</div>
									<?php } ?>
							  </div>
				      <?php } ?>

							<?php if ( $args['use_detail_pages'] ) { ?>
							  <div class="mybooking-product_footer">
									<button class="mb-button btn-choose-product">
							    	<a href="<?php echo esc_url( $args['url_detail'].'/'.$mybooking_productIdAnchor ) ?>">
											<?php echo esc_html_x( 'More information', 'activities_list', 'mybooking-wp-plugin' ) ?>
										</a>
									</button>
							  </div>
							<?php } ?>

						</div>
					</div>
			  </div>
			<?php  } ?>
		</div>

	  <!-- PRODUCT PAGINATION ------------------------------------------------------------->

	  <?php if ($args['total_pages'] > 1) { ?>
	  	<?php $mybooking_querystring = array_key_exists('querystring', $args) ? $args['querystring'] : '' ?>
		<div class="mb-row">
			<div class="mb-col-md-12">

				<nav aria-label="<?php echo esc_attr_x( 'Page navigation', 'activities_list', 'mybooking-wp-plugin' ); ?>" class="pull-right">
				  <ul class="pagination">

				  	<?php $mybooking_disabled_previous = ($args['current_page'] == 1 ? 'disabled' : '') ?>
				    <li class="page-item <?php echo esc_attr( $mybooking_disabled_previous ) ?>">
			    	  <a class="page-link" href="<?php echo esc_url( $args['url'].'?offsetpage='.($args['current_page']-1).$mybooking_querystring ) ?>">
			    	     <?php echo esc_html_x( 'Previous', 'activities_list', 'mybooking-wp-plugin' ) ?>
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
		      	         href="<?php echo esc_url( $args['url'].'?offsetpage='.($mybooking_page).$mybooking_querystring )?>">
		      	      	<?php echo esc_html( $mybooking_page ) ?>
		      	      </a>
		      	    </li>
		      	  <?php } ?>
				    <?php } ?>

				    <?php $mybooking_disabled_next = ($args['current_page'] == $args['total_pages'] ? 'disabled' : '') ?>
				    <li class="page-item <?php echo esc_attr( $mybooking_disabled_next ) ?>">
			    	  <a class="page-link" href="<?php echo esc_url( $args['url'].'?offsetpage='.($args['current_page']+1).$mybooking_querystring )?>">
			    	     <?php echo esc_html_x( 'Next', 'activities_list', 'mybooking-wp-plugin' ) ?>
			    	  </a>
				    </li>
				  </ul>
				</nav>
			</div>
		 </div>
	  <?php } ?>

</section>
