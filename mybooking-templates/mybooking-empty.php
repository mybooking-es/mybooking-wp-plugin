<?php

/**
*   Template Name: Mybooking Empty
*  	------------------------------
*/

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

get_header(); ?>

<div class="mybooking-empty_template" id="content">
	<?php while ( have_posts() ) : the_post(); ?>

		<?php the_content(); ?>

	<?php endwhile;?>
</div>

<?php get_footer();
