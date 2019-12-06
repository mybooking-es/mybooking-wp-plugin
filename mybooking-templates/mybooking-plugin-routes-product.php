<?php get_header();?>

<h1><? echo $args->name ?></h1>
<? echo $args->description ?>

<div class="content">
	<div class="row">
    <div class="col-md-6">
			<div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
			  <div class="carousel-inner">
			  	<? foreach( $args->photos as $key => $photo ) { ?>
			    <div class="carousel-item <? if ($key == key($args->photos)) {?>active<?}?>">
			      <img class="d-block w-100" src="<?php echo $photo->full_photo_path?>" alt="<?php echo $args->name?>">
			    </div>
			    <? } ?>
			  </div>
			  <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
			    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
			    <span class="sr-only">Previous</span>
			  </a>
			  <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
			    <span class="carousel-control-next-icon" aria-hidden="true"></span>
			    <span class="sr-only">Next</span>
			  </a>
			</div>
		</div>
		<div class="col-md-6">
      <?php mybooking_engine_get_template('mybooking-plugin-product-widget.php', array('code' => $args->code)) ?>			
		</div>
	</div>
</div>

<?php get_footer();