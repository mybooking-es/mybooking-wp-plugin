<?php
$popup_args = array(
  'post_type' => 'popup',
  'posts_per_page'=> 1,
);
$query = new WP_Query($popup_args);
$popup_items = $query -> get_posts();

foreach($popup_items as $popup_item) :

  /**
  *		PROMO POPUP
  *  	-----------
  * 	Gets the featured image as a background, if not set nothigns happens.
  *   Supports Gutenber, and Elementor if allowed in settings.
  */
  ?>

<div class="mybooking-popup_backdrop" id="MybookingPromotionsPopup">
  <div class="mybooking-popup_box">
    <div class="mybooking-popup" tabindex="-1" role="dialog">
      <?php $featured_img_url = get_the_post_thumbnail_url( $popup_item,'full' ); ?>
      <div class="mybooking-popup_content" style="background-image: url(<?php echo esc_url( $featured_img_url ) ?>)">
        <button type="button" class="close mybooking-popup_close" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <div class="mybooking-popup_post">
          <?php echo $popup_item->post_content; ?>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- <div class="modal fade" id="promoPopup" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <//?php echo $popup_item->post_content; ?>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div> -->

<?php endforeach; ?>
