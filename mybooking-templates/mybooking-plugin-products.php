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

		<div class="mybooking-product_grid">

			<!--
				TODO: Grid/list switch must go here
			-->

			<?php foreach( $args['data']->data as $mybooking_product ) { ?>
			  <?php
					$mybooking_productIdAnchor = $mybooking_product->code;
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
												<?php echo esc_html( number_format_i18n($mybooking_product->from_price) ) ?>€
											</span>

									</div>
								</div>
							<?php } ?>

							<div class="mybooking-product_body">
						    <h2 class="mybooking-product_name">
									<?php echo esc_html( $mybooking_product->name ) ?>
								</h2>

								<h3 class="mybooking-product_short-description">
									<?php echo esc_html( $mybooking_product->short_description ) ?>
								</h3>

								<!-- Characteristics -->
								<?php if (( property_exists( $mybooking_product, 'characteristic_length' ) && 
													  $mybooking_product->characteristic_length &&$mybooking_product->characteristic_length != 0) ||
                    			(property_exists( $mybooking_product, 'characteristic_width' ) && 
                    				$mybooking_product->characteristic_width && $mybooking_product->characteristic_width != 0) ||
                    			(property_exists( $mybooking_product, 'characteristic_height' ) && 
                    				$mybooking_product->characteristic_height && $mybooking_product->characteristic_height != 0) || 
                    			(property_exists( $mybooking_product, 'optional_external_driver' ) && 
                    			  $mybooking_product->optional_external_driver && $mybooking_product->optional_external_driver != '')) { ?>
								<div class="mybooking-product_characteristics-text">
									<!-- Length Eslora-->
									<?php if ( property_exists( $mybooking_product, 'characteristic_length' ) && $mybooking_product->characteristic_length &&
														 $mybooking_product->characteristic_length != 0) { ?>
										<span class="mybooking-product_characteristics-text-item"><small><?php echo esc_html(MyBookingEngineContext::getInstance()->getLength() ) ?> <?php echo number_format_i18n($mybooking_product->characteristic_length, 2)?> m.</small></span>
									<?php } ?>
									<!-- Width Manga -->
									<?php if ( property_exists( $mybooking_product, 'characteristic_width' ) && $mybooking_product->characteristic_width && 
														 $mybooking_product->characteristic_width != 0) { ?>
										<span class="mybooking-product_characteristics-text-item"><small><?php echo esc_html(MyBookingEngineContext::getInstance()->getWidth() ) ?> <?php echo number_format_i18n($mybooking_product->characteristic_width, 2)?> m.</small></span>
									<?php } ?>
									<!-- Height Calado -->
									<?php if ( property_exists( $mybooking_product, 'characteristic_width' ) && 
									          $mybooking_product->characteristic_height && $mybooking_product->characteristic_height != 0) { ?>
										<span class="mybooking-product_characteristics-text-item"><small><?php echo esc_html(MyBookingEngineContext::getInstance()->getHeight() ) ?> <?php echo number_format_i18n($mybooking_product->characteristic_height,2) ?> m.</small></span>
									<?php } ?>
								</div>
								<div class="mybooking-product_characteristics-text">
									<!-- Optional external driver (skipper) -->
									<?php if ( property_exists( $mybooking_product, 'optional_external_driver' ) && 
														!empty( $mybooking_product->optional_external_driver ) ) { ?>
										<span class="mybooking-product_characteristics-text-item mb-badge secondary"><?php echo $mybooking_product->optional_external_driver_name ?></span>
										&nbsp;
									<?php } ?>
									<!-- Driving license -->
									<?php if ( property_exists( $mybooking_product, 'optional_external_driver' ) && 
														 $mybooking_product->optional_external_driver != 'required' && 
											   !empty( $mybooking_product->driving_license_type_name ) ) { ?>
										<span class="mybooking-product_characteristics-text-item mb-badge secondary">
										<?php echo $mybooking_product->driving_license_type_name ?></span>
									<?php } ?>
								</div>
								<?php } ?>
							</div> 

						  <div class="mybooking-product_characteristics">
								<?php if ( isset( $mybooking_product->key_characteristics) && is_array( (array) $mybooking_product->key_characteristics ) && !empty( (array) $mybooking_product->key_characteristics ) ) { ?>
									<?php foreach ( $mybooking_product->key_characteristics as $mybooking_key => $mybooking_value) { ?>
										<div class="mybooking-product_characteristics-item">
											<img class="mybooking-product_characteristics-img" src="<?php echo esc_url( plugin_dir_url(__DIR__).'/assets/images/key_characteristics/'.$mybooking_key.'.svg' ) ?>" alt="<?php echo esc_attr( MyBookingEngineContext::getInstance()->getKeyCharacteristic( $mybooking_key ) ) ?>"/>
											<span class="mybooking-product_characteristics-key"><?php echo esc_html( $mybooking_value ) ?></span>
										</div>
									<?php } ?>
								<?php } ?>
						  </div>


							<?php if ( $args['use_detail_pages'] ) { ?>
							  <div class="mybooking-product_footer">
									<button class="mb-button">
										<?php if ( isset( $mybooking_product->external_detail_url ) && 
															!empty( $mybooking_product->external_detail_url ) ) { ?>
											<a href="<?php echo esc_url( $mybooking_product->external_detail_url ) ?>">
												<?php echo esc_html_x( 'More information', 'activities_list', 'mybooking-wp-plugin' ) ?>
											</a>											
										<?php } else { ?>	
											<a href="<?php echo esc_url( $args['url_detail'].'/'.$mybooking_productIdAnchor ) ?>">
												<?php echo esc_html_x( 'More information', 'activities_list', 'mybooking-wp-plugin' ) ?>
											</a>
										<?php } ?>
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

				<nav aria-label="<?php echo esc_attr_x( 'Page navigation', 'activities_list', 'mybooking-wp-plugin' ); ?>" class="mb-pagination_container">
				  <ul class="mb-pagination">

				  	<?php $mybooking_disabled_previous = ($args['current_page'] == 1 ? 'disabled' : '') ?>
				    <li class="mb-pagination_page-item <?php echo esc_attr( $mybooking_disabled_previous ) ?>">
				    	<?php if ( $mybooking_disabled_previous ): ?>
				    		<?php echo esc_html_x( 'Previous', 'activities_list', 'mybooking-wp-plugin' ) ?>
				      <?php else: ?>
				    	  <a class="mb-pagination_page-link" 
									 href="<?php echo esc_url( wp_nonce_url( $args['url'].'?offsetpage='.($args['current_page']-1).$mybooking_querystring, 'products_list', 'products_wponce' ) ) ?>">
				    	     <?php echo esc_html_x( 'Previous', 'activities_list', 'mybooking-wp-plugin' ) ?>
				    	  </a>
			    		<?php endif ?>
				    </li>

	          <?php foreach ($args['pages'] as $mybooking_page) { ?>
		          <?php if ($mybooking_page == $args['current_page']) { ?>
						    <li class="mb-pagination_page-item active" aria-current="page">
						      <span class="mb-pagination_page-link">
						        <?php echo esc_html( $mybooking_page ) ?>
						      </span>
						    </li>

		          <?php } else { ?>
		            <li class="mb-pagination_page-item">
		      	      <a class="mb-pagination_page-link"
		      	         href="<?php echo esc_url( wp_nonce_url( $args['url'].'?offsetpage='.($mybooking_page).$mybooking_querystring, 'products_list', 'products_wponce' ) )?>">
		      	      	<?php echo esc_html( $mybooking_page ) ?>
		      	      </a>
		      	    </li>
		      	  <?php } ?>
				    <?php } ?>

				    <?php $mybooking_disabled_next = ($args['current_page'] == $args['total_pages'] ? 'disabled' : '') ?>
				    <li class="mb-pagination_page-item <?php echo esc_attr( $mybooking_disabled_next ) ?>">
				    	<?php if ( $mybooking_disabled_next ): ?>
				    		<?php echo esc_html_x( 'Next', 'activities_list', 'mybooking-wp-plugin' ) ?>
				      <?php else: ?>
				    	  <a class="mb-pagination_page-link" 
									href="<?php echo esc_url( wp_nonce_url( $args['url'].'?offsetpage='.($args['current_page']+1).$mybooking_querystring, 'products_list', 'products_wponce' ) )?>">
				    	     <?php echo esc_html_x( 'Next', 'activities_list', 'mybooking-wp-plugin' ) ?>
				    	  </a>
			    	  <?php endif ?>
				    </li>
				  </ul>
				</nav>
			</div>
		 </div>
	  <?php } ?>

</section>
