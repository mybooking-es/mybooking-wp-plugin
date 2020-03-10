<?php
/**
*   PLUGIN RENTING MODULE CHOOSE PRODUCT PAGE
*   -----------------------------------------
*
*   Versión: 0.5.5
*   @package WordPress
*   @subpackage Mybooking WordPress Plugin
*   @since Mybooking WordPress Theme 0.0.1
*
*   Description:
*   ------------
*
*   This template renders the complete step page. It manages the following:
*
*      - Select the coverage 
*      - Select the extras
*      - Fill in the reservation from
*      - Request reservation or pay
*
*   Elements & Scripts:
*   -------------------
*
*   Container                        Script
*   ----------------------------     ---------------------------------
*   id=reservation_detail        ->  script_reservation_summary
*   id=product_listing           ->  script_detailed_product
*
*   Notes:
*   ------
*
*   The scripts are defined in mybooking-plugin-choose-product-tmpl.php
*/
?>
<section class="section">
  
  <!-- Modify reservation wizard : take into account the theme due to HTML elements -->
  <?php mybooking_engine_get_template('mybooking-plugin-selector-wizard-container.php') ?>
  
  <!-- Modify reservation form -->
  <?php mybooking_engine_get_template('mybooking-plugin-modify-reservation.php') ?>

  <div class="row">
    <div class="col-lg-4">
      <div id="reservation_detail"></div>
    </div>
    <div class="col-lg-8">
      <div id="product_listing"></div>
    </div>
  </div>

  <div class="modal" tabindex="-1" role="dialog" id="modalProductDetail">
    <div class="modal-dialog" role="document">
  	  <div class="modal-content">
  			<div class="modal-header">
  	      <h5 class="modal-title modal-product-detail-title"></h5>
  	      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
  	        <span aria-hidden="true">&times;</span>
  	      </button>
  	    </div>
        <div class="modal-body modal-product-detail-content">
        </div>
    	</div>
    </div>
  </div>
</section>