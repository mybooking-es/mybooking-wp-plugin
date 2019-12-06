<?php get_header();?>

<br>
<section class="container-fluid">
		<!-- Products -->
		<div class="row">
			<? foreach( $args['data']->data as $product ) { ?>
			  <div class="col-md-3">
					<div class="card text-center">
					  <img class="card-img-top" src="<?php echo $product->photo_path?>" alt="?php echo $product->name?>">
					  <div class="card-body">
					    <h5 class="card-title"><? echo $product->name ?></h5>
					    <p class="card-text"><? echo $product->short_description ?></p>
					    <a href="/products/<?php echo $product->code?>" class="btn btn-primary">Más información</a>
					  </div>
					</div>
			  </div>
			<?  } ?>
		</div>
	  
	  <!-- Pagination -->
	  <? if ($args['total_pages'] > 1) { ?>
		<div class="row">
			<div class="col-md-12">
				<nav aria-label="Page navigation example" class="pull-right">
				  <ul class="pagination">
				    <li class="page-item <? if ($args['current_page'] == 1) { ?>disabled<? } ?>">
				    	  <a class="page-link" href="/products?page=<? echo $args['current_page']-1 ?>">Previous</a>
				    </li>
	          <? foreach ($args['pages'] as $page) { ?>
		          <? if ($page == $args['current_page']) { ?>
						    <li class="page-item active" aria-current="page">
						      <span class="page-link">
						        <? echo $page ?>
						      </span>
						    </li>			          
		          <? } else { ?> 
		            <li class="page-item">
		      	      <a class="page-link" href="/products?page=<? echo $page ?>"><? echo $page ?></a>
		      	    </li>  
		      	  <? } ?>
				    <? } ?>	    
				    <li class="page-item <? if ($args['current_page'] == $args['total_pages']) { ?>disabled<? } ?>">
				    	  <a class="page-link" href="/products?page=<? echo $args['current_page']+1 ?>">Next</a>
				    </li>
				  </ul>
				</nav>
			</div>
		</div>
		<? } ?>

</section>

<?php get_footer();