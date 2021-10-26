<?php
/**
 *   MYBOOKING ENGINE - ACTIVITIES CATALOG
 *   ---------------------------------------------------------------------------
 *   The Template for showing the renting select product step
 *   This template can be overridden by copying it to your
 *   theme /mybooking-templates/mybooking-plugin-activities.php
 *
 */
?>

<section class="mybooking mybooking-activity_catalog <?php echo esc_attr( mybooking_engine_theme_align_width() )?>">

	<?php if ( $args['total'] == 0 ) { ?>
	  <div class="mb-row">
	  	<div class="mb-col-md-12">
			  <div class="mb-alert info">
			  	<?php echo esc_html_x( 'No results found', 'activities_list', 'mybooking-wp-plugin' ) ?>
			  </div>
			</div>
		</div>

	<?php } else { ?>

		<!-- PRODUCT LOOP ------------------------------------------------------------->

		<div class="mybooking-product_list">

			<div class="mybooking-product_filter">
	      <div class="mybooking-product_filter-btn-group">
	        <span class="mybooking-product_filter-legend"><?php echo esc_html_x( 'Order', 'renting_choose_product', 'mybooking-wp-plugin') ?></span>
	        <span class="mybooking-product_filter-btn grid js-mb-grid" title="Grid view"><i class="fa fa-th"></i></span>
	        <span class="mybooking-product_filter-btn list js-mb-list" title="List view"><i class="fa fa-th-list"></i></span>
	      </div>
	    </div>

			<?php foreach( $args['data']->data as $mybooking_activity ) { ?>
			  <?php
					$mybooking_activityIdAnchor = $mybooking_activity->id;
	  	    if ( !empty( $mybooking_activity->slug) ) { $mybooking_activityIdAnchor = $mybooking_activity->slug; }
			  ?>
			  <div class="mybooking-product_column">
					<div class="mybooking-product">

						<div class="mybooking-product_block">
	            <div class="mybooking-product_image-container">
								<?php if ( !empty( $mybooking_activity->photo_url_full ) ) { ?>
									<?php if ( $args['use_detail_pages'] ) { ?>
									  <a href="<?php echo esc_url( $args['url_detail'].'/'.$mybooking_activityIdAnchor ) ?>">
									  	<img class="mybooking-product_image" src="<?php echo esc_url( $mybooking_activity->photo_url_full )?>" alt="<?php echo esc_attr( $mybooking_activity->name )?>">
									  </a>
									<?php } else { ?>
									  <img class="mybooking-product_image" src="<?php echo esc_url( $mybooking_activity->photo_url_full )?>" alt="<?php echo esc_attr( $mybooking_activity->name )?>">
									<?php } ?>

								<?php } else { ?>
									<?php if ( $args['use_detail_pages'] ) { ?>
										<a href="<?php echo esc_url( $args['url_detail'].'/'.$mybooking_activityIdAnchor ) ?>">
										  <img class="mybooking-product_image" src="<?php echo esc_url( plugin_dir_url(__DIR__).'/assets/images/default-image-product.png' ) ?>" alt="<?php echo esc_attr( $mybooking_activity->name )?>">
										</a>
									<?php } else { ?>
										<img class="mybooking-product_image" src="<?php echo esc_url( plugin_dir_url(__DIR__).'/assets/images/default-image-product.png' ) ?>" alt="<?php echo esc_attr( $mybooking_activity->name )?>">
									<?php } ?>
								<?php } ?>
							</div>
						</div>


					  <div class="mybooking-product_block">
							<div class="mybooking-product_header">
                <div class="mybooking-product_price">
									<?php if ( $mybooking_activity->use_rates ) { ?>
										<span class="mybooking-product_price-from">
											<?php echo esc_html_x( 'From', 'activities_list', 'mybooking-wp-plugin' ) ?>
										</span>
										<span class="mybooking-product_amount">
											<?php echo esc_html( $mybooking_activity->from_price_formatted ) ?>
										</span>
							  	<?php } ?>
								</div>
							</div>

							<div class="mybooking-product_body">
						    <h2 class="mybooking-product_name">
									<?php echo esc_html( $mybooking_activity->name ) ?>
								</h2>

								<div class="mybooking-product_short-description mybooking-truncate-overflow-3lines">
									<?php echo esc_html( $mybooking_activity->short_description ) ?>
								</div>

					      <?php if ( isset( $mybooking_activity->address) ) { ?>
									<div class="mybooking-activity_adress">
							      <i class="fa fa-map-marker" aria-hidden="true"></i>&nbsp;
										<span class="mybooking-activity_adress-item"><?php echo esc_html( $mybooking_activity->address->street ) ?>
										<span class="mybooking-activity_adress-item"><?php echo esc_html( $mybooking_activity->address->city ) ?>
										<span class="mybooking-activity_adress-item"><?php echo esc_html( $mybooking_activity->address->zip ) ?>
									</div>
						  	<?php } ?>
							</div>

							<?php if ( $args['use_detail_pages'] ) { ?>
							  <div class="mybooking-product_footer">
									<button class="mb-button btn-choose-product">
							    	<a href="<?php echo esc_url( $args['url_detail'].'/'.$mybooking_activityIdAnchor ) ?>">
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
  <?php } ?>
</section>
