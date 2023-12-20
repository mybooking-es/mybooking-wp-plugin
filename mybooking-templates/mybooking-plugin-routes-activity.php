<?php
/**
 *   MYBOOKING ENGINE - ACTIVITY DETAIL
 *   ---------------------------------------------------------------------------
 *   The Template for showing the renting select product step
 *   This template can be overridden by copying it to your
 *   theme /mybooking-templates/mybooking-plugin-routes-activity.php
 *
 */
?>

<?php get_header();?>

<div class="page">
<div class="entry">
  <div class="entry-content">
		<section class="mybooking mybooking-activity mybooking-activity_container">

		  <div class="mb-row">
		    <div class="mb-col-md-12 mb-col-lg-12">
					<div class="mybooking-activity_header">
						<h1 class="mybooking-activity_title">
							<?php echo esc_html( $args->name ) ?>
						</h1>
						<?php if ( $args->from_price > 0 ): ?>
						<span class="mybooking-product_amount">
							<?php echo esc_html( $args->from_price_formatted ) ?>
						</span>
					<?php endif ?>
					</div>
				</div>
			</div>		
			
		  <div class="mb-row">
			  <div class="mb-col-md-6 mb-col-lg-8">
					<?php if (sizeof($args->photos) > 1) { ?>
		        <div class="mybooking-activity-carousel-inner">
		          <?php foreach( $args->photos as $mybooking_key => $mybooking_photo ) { ?>  
		            <div class="mybooking-carousel-item">
		              <img class="d-block w-100" src="<?php echo esc_url ( $mybooking_photo->full_photo_path ) ?>" alt="<?php echo esc_attr( $args->name )?>">
		            </div>
		          <?php } ?>  
		        </div>

					<?php } else if (sizeof($args->photos) == 1) { ?>
						<img class="mybooking-activity_image" src="<?php echo esc_url( $args->photos[0]->full_photo_path )?>" alt="<?php echo esc_attr( $args->name )?>">
					<?php } ?>

			    <?php if ( isset( $args->address ) && !empty( $args->address->street) ) { ?>
						<div class="mybooking-activity_adress">
							<i class="dashicons dashicons-location" aria-hidden="true"></i>&nbsp;
							<span class="mybooking-activity_adress-item"><?php echo esc_html( $args->address->street ) ?>
							<span class="mybooking-activity_adress-item"><?php echo esc_html( $args->address->city ) ?>
							<span class="mybooking-activity_adress-item"><?php echo esc_html( $args->address->zip ) ?>
						</div>
			    <?php } ?>

			    <div class="mybooking-activity_description">
						<?php echo wp_kses_post( $args->description ) ?>
					</div>

					<?php if (!empty($args->detailed_info_price)) { ?>
		      	<div class="mybooking-activity_detail">
				      <div class="mybooking-activity_detail-name">
								<?php echo esc_html_x('Prices', 'activity_detail', 'mybooking-wp-plugin'); ?>
							</div>
				      <div class="mybooking-activity_detail-description">
								<?php echo wp_kses_post( $args->detailed_info_price ) ?>
							</div>
				    </div>
		      <?php } ?>

					<?php if (!empty($args->detailed_info_timetable_duration)) { ?>
		      	<div class="mybooking-activity_detail">
				      <div class="mybooking-activity_detail-name">
								<?php echo esc_html_x('Dates and timetables', 'activity_detail', 'mybooking-wp-plugin'); ?>
							</div>
				      <div class="mybooking-activity_detail-description">
								<?php echo wp_kses_post( $args->detailed_info_timetable_duration ) ?>
							</div>
				    </div>
			    <?php } ?>

		      <?php if (!empty($args->detailed_info_ages)) { ?>
						<div class="mybooking-activity_detail">
				      <div class="mybooking-activity_detail-name">
								<?php echo esc_html_x('Ages', 'activity_detail', 'mybooking-wp-plugin'); ?>
							</div>
				      <div class="mybooking-activity_detail-description">
								<?php echo wp_kses_post( $args->detailed_info_ages ) ?>
							</div>
			    	</div>
		      <?php } ?>

		      <?php if (!empty($args->detailed_info_difficulty_level)) { ?>
		      	<div class="mybooking-activity_detail">
				      <div class="mybooking-activity_detail-name">
								<?php echo esc_html_x('Difficulty', 'activity_detail', 'mybooking-wp-plugin'); ?>
							</div>
				      <div class="mybooking-activity_detail-description">
								<?php echo wp_kses_post( $args->detailed_info_difficulty_level ) ?>
							</div>
				    </div>
		      <?php } ?>

		      <?php if (!empty($args->detailed_info_meeting_point)) { ?>
		      	<div class="mybooking-activity_detail">
				      <div class="mybooking-activity_detail-name">
								<?php echo esc_html_x('Meeting point', 'activity_detail', 'mybooking-wp-plugin'); ?>
							</div>
				     	<div class="mybooking-activity_detail-description">
								<?php echo wp_kses_post( $args->detailed_info_meeting_point ) ?>
							</div>
				    </div>
		      <?php } ?>

		      <?php if (!empty($args->detailed_info_what_includes)) { ?>
		        <div class="mybooking-activity_detail">
				      <div class="mybooking-activity_detail-name">
								<?php echo esc_html_x('What\'s included?', 'activity_detail', 'mybooking-wp-plugin'); ?>
							</div>
				      <div class="mybooking-activity_detail-description">
								<?php echo wp_kses_post( $args->detailed_info_what_includes ) ?>
							</div>
			    	</div>
		      <?php } ?>

					<?php if (!empty($args->detailed_info_what_to_bring)) { ?>
		      	<div class="mybooking-activity_detail">
				      <div class="mybooking-activity_detail-name">
								<?php echo esc_html_x('What to bring?', 'activity_detail', 'mybooking-wp-plugin'); ?>
							</div>
				      <div class="mybooking-activity_detail-description">
								<?php echo wp_kses_post( $args->detailed_info_what_to_bring ) ?>
							</div>
				    </div>
		      <?php } ?>

		      <?php if (!empty($args->detailed_info_recommendations)) { ?>
		      	<div class="mybooking-activity_detail">
				      <div class="mybooking-activity_detail-name">
								<?php echo esc_html_x('Recomendations', 'activity_detail', 'mybooking-wp-plugin'); ?>
							</div>
				      <div class="mybooking-activity_detail-description">
								<?php echo wp_kses_post( $args->detailed_info_recommendations ) ?>
							</div>
				    </div>
		      <?php } ?>
				</div>

				<div class="mb-col-md-6 mb-col-lg-4">
					<p><?php echo esc_html( $args->short_description ) ?></p>
			    <?php mybooking_engine_get_template('mybooking-plugin-activities-activity-widget.php', array('activity_id' => $args->id)) ?>
				</div>
			</div>
		</section>
  </div>
</div>  
</div>

<?php get_footer();
