<?php get_header();?>
<br>
<div class="container">
	<div class="row">
    <div class="col-md-8">
			<div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
			  <div class="carousel-inner">
			  	<?php foreach( $args->photos as $key => $photo ) { ?>
			    <div class="carousel-item <?php if ($key == key($args->photos)) { ?>active<?php } ?>">
			      <img class="d-block w-100" src="<?php echo $photo->full_photo_path?>" alt="<?php echo $args->name?>">
			    </div>
			    <?php } ?>
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
			<h1 class="h2 mt-3"><?php echo $args->name ?></h1>
			<h2 class="h4 mt-2">Acerca de</h2>
      <?php echo $args->description ?>
		</div>
		<div class="col-md-4">
      <?php mybooking_engine_get_template('mybooking-plugin-activities-activity-widget.php', array('activity_id' => $args->id)) ?>			
		</div>
	</div>
</div>

<?php get_footer();