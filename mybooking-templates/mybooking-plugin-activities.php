<?php
  /** 
   * The Template for showing the index of activities
   *
   * This template can be overridden by copying it to yourtheme/mybooking-templates/mybooking-plugin-activities.php
   *
   */
?>
<section>
	<?php if ( $args['total'] == 0 ) { ?>
	  <div class="row">
	  	<div class="col-lg-12">
			  <div class="alert alert-info">
			  	<?php echo esc_html_x( 'No results found', 'activities_list', 'mybooking-wp-plugin' ) ?>
			  </div>
			</div>
		</div>
	<?php } else { ?>
		<!-- Products -->
		<div class="row">
			<?php foreach( $args['data']->data as $mybooking_activity ) { ?>
			  <div class="col-lg-4">
					<div class="activity-card card mb-2">
						<?php if ( !empty( $mybooking_activity->photo_url_full ) ) { ?>
								  <img class="activity-card-img card-img-top" src="<?php echo esc_url( $mybooking_activity->photo_url_full )?>" alt="<?php echo esc_attr( $mybooking_activity->name )?>">
						<?php } else { ?>
						      <div class="text-center no-product-photo pt-3"><i class="fa fa-camera" aria-hidden="true"></i></div>
						<?php } ?>
					  <div class="card-body d-flex flex-column justify-content-center">
					    <h3 class="h6 card-title activity-card-title"><?php echo esc_html( $mybooking_activity->name ) ?></h3>
				      <hr>
				      <?php if ( isset( $mybooking_activity->address) ) { ?>
					      <div class="text-center"><i class="fa fa-map-marker" aria-hidden="true"></i>&nbsp;<?php echo esc_html( $mybooking_activity->address->street ) ?> <?php echo esc_html( $mybooking_activity->address->city ) ?> <?php echo esc_html( $mybooking_activity->address->zip ) ?></div>
					  <?php } ?>
					    <?php if ( $mybooking_activity->use_rates ) { ?>
					    <p class="text-center">
					    	<span class="text-muted"><?php echo esc_html_x( 'From', 'activities_list', 'mybooking-wp-plugin' ) ?></span>
					    	<span class="h5 text-primary mt-10"> <strong><?php echo esc_html( $mybooking_activity->from_price_formatted ) ?></strong></span>
					    </p>
					  	<?php } ?>
					  </div>
					  <div class="card-body activity-more-information d-flex flex-column justify-content-center">
					  	<?php  $mybooking_activityIdAnchor = $mybooking_activity->id;
					  	    if ( !empty( $mybooking_activity->slug) ) {
					  			  $mybooking_activityIdAnchor = $mybooking_activity->slug;
  			  				}
					  		?>
					    	<a href="<?php echo esc_url( '/'.$args['url_detail'].'/'.$mybooking_activityIdAnchor ) ?>" class="btn btn-primary"><?php echo esc_html_x( 'More information', 'activities_list', 'mybooking-wp-plugin' ) ?></a>
					  </div>
					</div>
			  </div>
			<?php  } ?>
		</div>
		<div class="row">
			<div class="col-lg-12">
				<p class="text-right">
					<?php /* translators: 1: Number of results, 2: Number of results */ ?>
					<?php echo wp_kses( sprintf( _nx( '<b>%s</b> result found', '<b>%s</b> results found', intval( $args['total'] ), 'activity_shopping_cart', 'mybooking-wp-plugin' ), 
				                               number_format_i18n( $args['total'] ) ),
                              array( 'b' => array() ) ) ?>                                   
				</p>
			</div>
		</div>
	  
	  <!-- Pagination -->
	  <?php if ($args['total_pages'] > 1) { ?>
	  	<?php $mybooking_querystring = array_key_exists('querystring', $args) ? $args['querystring'] : '' ?>
		<div class="row">
			<div class="col-md-12">
				<nav aria-label="<?php echo esc_attr_x( 'Page navigation', 'activities_list', 'mybooking-wp-plugin' ); ?>" class="pull-right">
				  <ul class="pagination">
				  	<?php $mybooking_disabled_previous = ($args['current_page'] == 1 ? 'disabled' : '') ?> 
				    <li class="page-item <?php echo esc_attr( $mybooking_disabled_previous ) ?>">
				    	  <a class="page-link" 
				    	     href="<?php echo esc_url( '/'.$args['url'].'?offsetpage='.($args['current_page']-1).$mybooking_querystring ) ?>">
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
		      	         href="<?php echo esc_url( '/'.$args['url'].'?offsetpage='.($mybooking_page).$mybooking_querystring )?>">
		      	      	<?php echo esc_html( $mybooking_page ) ?>
		      	      </a>
		      	    </li>  
		      	  <?php } ?>
				    <?php } ?>	    
				    <?php $mybooking_disabled_next = ($args['current_page'] == $args['total_pages'] ? 'disabled' : '') ?>
				    <li class="page-item <?php echo esc_attr( $mybooking_disabled_next ) ?>">
				    	  <a class="page-link" 
				    	     href="<?php echo esc_url( '/'.$args['url'].'?offsetpage='.($args['current_page']+1).$mybooking_querystring )?>">
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