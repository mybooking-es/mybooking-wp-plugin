<section class="container-fluid">
		<!-- Products -->
		<div class="row">
			<?php foreach( $args['data']->data as $mybooking_product ) { ?>
			  <div class="col-md-4">
					<div class="resource-product-card card d-flex flex-column mb-2 shadow mb-5 bg-white rounded-0">
					  <img class="resource-product-card-img card-img-top rounded-0" src="<?php echo $mybooking_product->photo_path?>" alt="?php echo $mybooking_product->name?>">
					  <div class="card-body d-flex flex-column justify-content-center">
					    <h5 class="h6 card-title text-left resource-product-card-title"><b><?php echo $mybooking_product->name ?></b></h5>
					    <p class="card-text text-muted"><?php echo $mybooking_product->short_description ?></p>
			            <!-- From price -->
			            <?php if ($mybooking_product->from_price > 0) { ?>
			            <p class="card-text text-danger font-weight-normal"><?php printf( _x('From <b>%s</b>', 'renting_products', 'mybooking-wp-plugin' ), number_format_i18n( $mybooking_product->from_price ) ) ?>€</p>
			        	<?php } else { ?>
			        	<br>	
			            <?php } ?>
					  </div>
				      <?php if ( isset( $mybooking_product->key_characteristics) && is_array( (array) $mybooking_product->key_characteristics ) && !empty( (array) $mybooking_product->key_characteristics ) ) { ?>
					  <div class="card-body key-characteristics">
						<ul class="icon-list-items">
			                <?php if ( isset( $mybooking_product->characteristic_length ) && !empty( $mybooking_product->characteristic_length ) ) { ?>
			                  <li class="icon-list-item">
			                      <span class="icon-list-icon">
			                      	<img src="<?php echo plugin_dir_url(__DIR__) ?>/assets/images/characteristics/length.svg"/>
			                      </span>
			                      <span class="icon-list-text text-muted"><?php printf( _x('<b>%.2f</b> m.', 'renting_products', 'mybooking-wp-plugin' ), $mybooking_product->characteristic_length ) ?></span>
			                  </li>
			                <?php } ?>  							
							<?php foreach ( $mybooking_product->key_characteristics as $key => $value) { ?>
							<li class="icon-list-item">
									<span class="icon-list-icon">
										<img src="<?php echo plugin_dir_url(__DIR__) ?>/assets/images/key_characteristics/<?php echo $key ?>.svg"/>
									</span>
									<span class="icon-list-text text-muted"><?php echo $value ?></span>
							</li>
							<?php } ?>
						</ul>
					  </div>	
			          <?php } ?>
					  <div class="card-body d-flex flex-column justify-content-end">
					    <a href="/<?php echo $args['url_detail']?>/<?php echo $mybooking_product->code?>" class="btn btn-primary w-100"><?php echo esc_html_x('More information', 'renting_products', 'mybooking-wp-plugin' ) ?></a>
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
				    	  <a class="page-link" href="/<?php echo $args['url']?>?offsetpage=<?php echo $args['current_page']-1 ?>"><?php echo esc_html_x('Previous', 'renting_products', 'mybooking-wp-plugin' ) ?></a>
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
		      	      <a class="page-link" href="/<?php echo $args['url']?>?offsetpage=<?php echo $mybooking_page ?>"><?php echo $mybooking_page ?></a>
		      	    </li>  
		      	  <?php } ?>
				    <?php } ?>	    
				    <li class="page-item <?php if ($args['current_page'] == $args['total_pages']) { ?>disabled<?php } ?>">
				    	  <a class="page-link" href="/<?php echo $args['url']?>?offsetpage=<?php echo $args['current_page']+1 ?>"><?php echo esc_html_x('Next', 'renting_products', 'mybooking-wp-plugin' ) ?></a>
				    </li>
				  </ul>
				</nav>
			</div>
		</div>
		<?php } ?>

</section>