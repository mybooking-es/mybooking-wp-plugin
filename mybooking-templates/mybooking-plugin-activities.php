<section class="container-fluid">
		<!-- Products -->
		<div class="row">
			<?php foreach( $args['data']->data as $activity ) { ?>
			  <div class="col-lg-4">
					<div class="activity-card card mb-2">
						<?php if ( !empty( $activity->photo_url_full ) ) { ?>
								  <img class="activity-card-img card-img-top" src="<?php echo $activity->photo_url_full?>" alt="<?php echo $activity->name?>">
						<?php } else { ?>
						      <div class="text-center no-product-photo pt-3"><i class="fa fa-camera" aria-hidden="true"></i></div>
						<?php } ?>
					  <div class="card-body d-flex flex-column justify-content-center">
					    <h3 class="h6 card-title activity-card-title"><?php echo $activity->name ?></h3>
				      <hr>
				      <?php if ($activity->address) { ?>
					      <div class="text-center"><i class="fa fa-map-marker" aria-hidden="true"></i>&nbsp;<?php echo $activity->address->street ?>, <?php echo $activity->address->city ?> <?php echo $activity->address->zip ?></div>
					    <?php } ?>
					    <?php if ( $activity->use_rates ) { ?>
					    <p class="text-center">
					    	<span class="text-muted"><?php echo _x( 'From', 'activities_list', 'mybooking-wp-plugin' ) ?></span>
					    	<span class="h5 text-primary mt-10"> <strong><?php echo $activity->from_price_formatted ?></strong></span>
					    </p>
					  	<?php } ?>
					  </div>
					  <div class="card-body activity-more-information d-flex flex-column justify-content-center">
					    <a href="/<?php echo $args['url_detail']?>/<?php echo $activity->id?>" class="btn btn-primary"><?php echo _x( 'More information', 'activities_list', 'mybooking-wp-plugin' ) ?></a>
					  </div>
					</div>
			  </div>
			<?php  } ?>
		</div>
	  
	  <!-- Pagination -->
	  <?php if ($args['total_pages'] > 1) { ?>
		<div class="row">
			<div class="col-md-12">
				<nav aria-label="Page navigation example" class="pull-right">
				  <ul class="pagination">
				    <li class="page-item <?php if ($args['current_page'] == 1) { ?>disabled<?php } ?>">
				    	  <a class="page-link" href="/<?php echo $args['url']?>?offsetpage=<?php echo $args['current_page']-1 ?>"><?php echo _x( 'Previous', 'activities_list', 'mybooking-wp-plugin' ) ?></a>
				    </li>
	          <?php foreach ($args['pages'] as $page) { ?>
		          <?php if ($page == $args['current_page']) { ?>
						    <li class="page-item active" aria-current="page">
						      <span class="page-link">
						        <?php echo $page ?>
						      </span>
						    </li>			          
		          <?php } else { ?> 
		            <li class="page-item">
		      	      <a class="page-link" href="/<?php echo $args['url']?>?offsetpage=<?php echo $page ?>"><?php echo $page ?></a>
		      	    </li>  
		      	  <?php } ?>
				    <?php } ?>	    
				    <li class="page-item <?php if ($args['current_page'] == $args['total_pages']) { ?>disabled<?php } ?>">
				    	  <a class="page-link" href="/<?php echo $args['url']?>?offsetpage=<?php echo $args['current_page']+1 ?>"><?php echo _x( 'Next', 'activities_list', 'mybooking-wp-plugin' ) ?></a>
				    </li>
				  </ul>
				</nav>
			</div>
		</div>
		<?php } ?>

</section>