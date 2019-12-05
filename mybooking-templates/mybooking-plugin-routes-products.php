<?php get_header();?>

Total: <? echo $args->total ?>
<br>
Página: <? echo $args->offset ?>
<br>
Tamaño: <? echo $args->limit ?>
<br>
Registros actuales: <? echo sizeOf($args->data) ?>
<br>

<? foreach( $args->data as $product ) { ?>

	<?   echo $product->code ?>
	<?   echo $product->name ?>
	<?   echo $product->short_description ?>

	<img src="<?php echo $product->photo_path?>" alt="<?php echo $product->name?>"/>

<?  } ?>
	

<?php get_footer();