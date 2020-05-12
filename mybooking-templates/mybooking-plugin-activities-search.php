<form class="form-inline" method="get" <?php if ( array_key_exists('search_path', $args) && $args['search_path'] != '') { ?>
      action="<?php $args['search_path']?>"
      <?php } ?>>
  <input type="text" size="50" class="form-control mb-2 mr-sm-2" 
         <?php if ( array_key_exists('q', $args) && $args['q'] != '') { ?>value="<?php echo $args['q']?>"<?php } ?>
         name="q" id="search_q" placeholder="<?php echo _x( 'Search', 'activities_search', 'mybooking-wp-plugin' ) ?>">
  <button type="submit" class="btn btn-primary mb-2"><i class="fa fa-search"></i>&nbsp;</button>
</form>