<section>
	<?php if ( $args['total'] == 0 ) { ?>
	  <div class="row">
	  	<div class="col-lg-12">
			  <div class="alert alert-info">
			  	<?php echo _x( 'No results found', 'activities_list', 'mybooking-wp-plugin' ) ?>
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
								  <img class="activity-card-img card-img-top" src="<?php echo $mybooking_activity->photo_url_full?>" alt="<?php echo $mybooking_activity->name?>">
						<?php } else { ?>
						      <div class="text-center no-product-photo pt-3"><i class="fa fa-camera" aria-hidden="true"></i></div>
						<?php } ?>
					  <div class="card-body d-flex flex-column justify-content-center">
					    <h3 class="h6 card-title activity-card-title"><?php echo $mybooking_activity->name ?></h3>
				      <hr>
				      <?php if ($mybooking_activity->address) { ?>
					      <div class="text-center"><i class="fa fa-map-marker" aria-hidden="true"></i>&nbsp;<?php echo $mybooking_activity->address->street ?>, <?php echo $mybooking_activity->address->city ?> <?php echo $mybooking_activity->address->zip ?></div>
					    <?php } ?>
					    <?php if ( $mybooking_activity->use_rates ) { ?>
					    <p class="text-center">
					    	<span class="text-muted"><?php echo _x( 'From', 'activities_list', 'mybooking-wp-plugin' ) ?></span>
					    	<span class="h5 text-primary mt-10"> <strong><?php echo $mybooking_activity->from_price_formatted ?></strong></span>
					    </p>
					  	<?php } ?>
					  </div>
					  <div class="card-body activity-more-information d-flex flex-column justify-content-center">
					  	<?php if ( !empty( $mybooking_activity->slug) ) {
					  					$mybooking_activityIdAnchor = $mybooking_activity->slug;
					  				} else {
					  					$mybooking_activityIdAnchor = $mybooking_activity->id;
					  				}
					  		?>
					    	<a href="/<?php echo $args['url_detail']?>/<?php echo $mybooking_activityIdAnchor?>" class="btn btn-primary"><?php echo _x( 'More information', 'activities_list', 'mybooking-wp-plugin' ) ?></a>
					  </div>
					</div>
			  </div>
			<?php  } ?>
		</div>
		<div class="row">
			<div class="col-lg-12">
				<p class="text-right"><?php printf( _nx( '<b>%s</b> result found', '<b>%s</b> results found', intval( $args['total'] ), 'activity_shopping_cart', 'mybooking-wp-plugin' ), 
				                                    number_format_i18n( $args['total'] ) ) ?></p>
			</div>
		</div>
	  
	  <!-- Pagination -->
	  <?php if ($args['total_pages'] > 1) { ?>
		<div class="row">
			<div class="col-md-12">
				<nav aria-label="Page navigation example" class="pull-right">
				  <ul class="pagination">
				    <li class="page-item <?php if ($args['current_page'] == 1) { ?>disabled<?php } ?>">
				    	  <a class="page-link" href="/<?php echo $args['url']?>?offsetpage=<?php echo $args['current_page']-1 ?><?php echo $args['querystring']?>"><?php echo _x( 'Previous', 'activities_list', 'mybooking-wp-plugin' ) ?></a>
				    </li>
	          <?php foreach ($args['pages'] as $mybooking_page) { ?>
		          <?php if ($mybooking_page == $args['current_page']) { ?>
						    <li class="page-item active" aria-current="page">
						      <span class="page-link">
						        <?php echo $mybooking_page ?>
						      </span>
						    </li>			          
		          <?php } else { ?> 
		            <li class="page-item">
		      	      <a class="page-link" href="/<?php echo $args['url']?>?offsetpage=<?php echo $mybooking_page ?><?php echo $args['querystring']?>"><?php echo $mybooking_page ?></a>
		      	    </li>  
		      	  <?php } ?>
				    <?php } ?>	    
				    <li class="page-item <?php if ($args['current_page'] == $args['total_pages']) { ?>disabled<?php } ?>">
				    	  <a class="page-link" href="/<?php echo $args['url']?>?offsetpage=<?php echo $args['current_page']+1 ?><?php echo $args['querystring']?>"><?php echo _x( 'Next', 'activities_list', 'mybooking-wp-plugin' ) ?></a>
				    </li>
				  </ul>
				</nav>
			</div>
		</div>
		<?php } ?>
	<?php } ?>	

</section>