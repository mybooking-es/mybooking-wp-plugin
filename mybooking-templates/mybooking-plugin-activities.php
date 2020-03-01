<section class="container-fluid">
		<!-- Products -->
		<div class="row">
			<?php foreach( $args['data']->data as $activity ) { ?>
			  <div class="col-lg-4">
					<div class="activity-card card mb-2">
					  <img class="activity-card-img card-img-top" src="<?php echo $activity->photo_url_full?>" alt="?php echo $activity->name?>">
					  <div class="card-body d-flex flex-column justify-content-center">
					    <h3 class="h6 card-title activity-card-title"><?php echo $activity->name ?></h3>
					    <p class="text-center"><span class="text-muted">Desde</span><span class="h5 text-primary mt-10"> <strong><?php echo $activity->from_price ?></strong></span></p>
					  </div>
					  <div class="card-body activity-more-information d-flex flex-column justify-content-center">
							
					    <a href="/<?php echo $args['url_detail']?>/<?php echo $activity->id?>" class="btn btn-primary">Más información</a>
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
				    	  <a class="page-link" href="/<?php echo $args['url']?>?offsetpage=<?php echo $args['current_page']-1 ?>">Previous</a>
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
				    	  <a class="page-link" href="/<?php echo $args['url']?>?offsetpage=<?php echo $args['current_page']+1 ?>">Next</a>
				    </li>
				  </ul>
				</nav>
			</div>
		</div>
		<?php } ?>

</section>