<?php
  /** 
   * The Template for showing the renting selector widget - JS Microtemplates
   *
   * This template can be overridden by copying it to yourtheme/mybooking-templates/mybooking-plugin-selector-widget-tmpl.php
   *
   * @phpcs:disable PHPCompatibility.Miscellaneous.RemovedAlternativePHPTags.MaybeASPOpenTagFound 
   * @phpcs:disable Generic.PHP.DisallowAlternativePHPTags.MaybeASPOpenTagFound
   * @phpcs:disable Generic.PHP.DisallowAlternativePHPTags.MaybeASPShortOpenTagFound   
   */
?>
<!-- =========================================== -->
<!--			 Renting Form selector template 			 -->
<!-- =========================================== -->
<script type="text/tmpl" id="widget_form_selector_tmpl">

	<% if (!configuration.pickupReturnPlace && !configuration.timeToFrom) { %>

	<div class="flex-form-group-wrapper inline-form">

  	    <% if (not_hidden_family_id && configuration.selectFamily) { %>
		    <div class="flex-form-group widget_family" style="display: none">
		      <label for="family_id"><?php echo esc_html( MyBookingEngineContext::getInstance()->getFamily() ) ?></label>
		      <div class="flex-form-horizontal-item">
		      	<select name="family_id" id="widget_family_id" class="form-control"></select>
	  	    </div>
		    </div>
	    <% } %>
	    
	    <div class="flex-form-group">
	      <label for="date_from"><?php echo esc_html( MyBookingEngineContext::getInstance()->getDeliveryDate() ) ?></label>
	      <div class="flex-form-horizontal-item">
		      <input type="text" class="form-control" name="date_from" id="widget_date_from" autocomplete="off" readonly="true">
		      <input type="hidden" name="time_from" value="<%=configuration.defaultTimeStart%>"/>
			  </div>
	    </div>
	    <div class="flex-form-group">
	      <label for="date_to"><?php echo esc_html( MyBookingEngineContext::getInstance()->getCollectionDate() ) ?></label>
	      <div class="flex-form-horizontal-item">
		      <input type="text" class="form-control" name="date_to" id="widget_date_to" autocomplete="off" readonly="true">
		      <input type="hidden" name="time_to" value="<%=configuration.defaultTimeEnd%>"/>
 		    </div>
	    </div>

		<% if (configuration.promotionCode) { %>
			<div class="flex-form-group">
		      <label for="promotion_code"><?php echo esc_html_x( 'Promotion code', 'renting_form_selector', 'mybooking-wp-plugin' ) ?></label>
		      <div class="flex-form-horizontal-item">
			      <input type="text" class="form-control" name="promotion_code" id="widget_promotion_code" autocomplete="off">
			    </div>
			</div>
		<% } %>

	    <div class="flex-form-group flex-form-group-no-label">
	      <div class="flex-form-horizontal-item">
   		    <input class="btn btn-primary" type="submit" value="<?php echo esc_html_x( 'Search', 'renting_form_selector', 'mybooking-wp-plugin') ?>" />
			  </div>
	    </div>
  	</div>

  <% } else { %>

		<div class="flex-form-group-wrapper">

		  <!-- Delivery / Collection place -->

		  <% if (configuration.pickupReturnPlace) { %>
				<div class="flex-form-group">
			    <!-- Delivery place -->
			    <div class="flex-form-horizontal-box">
			        <label for="pickup_place"><?php echo esc_html_x( 'Pick-up place', 'renting_form_selector', 'mybooking-wp-plugin') ?></label>
			        <!-- List pickup place -->
							<div class="flex-form-item widget_pickup_place_group">
			        	<select class="form-control" name="pickup_place" id="widget_pickup_place"></select>
          		</div>
		          <!-- Custom delivery place -->
		          <div id="widget_another_pickup_place_group" style="display: none;">
		            <div class="flex-form-item justify-content-between position-relative">
		              <input type="text" class="form-control" id="widget_pickup_place_other" name="pickup_place_other" />
		              <input type="hidden" name="custom_pickup_place" value="false" />
		              <button type="button" class="widget_another_pickup_place_group_close">
		                <i class="fa fa-times flex-icon-absolute"></i>&nbsp;
		              </button>
		            </div>
		          </div>
			    </div>
			    <!-- Collection place -->
			    <div class="flex-form-horizontal-box">
			      <label for="return_place"><?php echo esc_html_x( 'Return place', 'renting_form_selector', 'mybooking-wp-plugin' ) ?></label>
			      <div class="flex-form-item widget_return_place_group">
			      	<select class="form-control" name="return_place" id="widget_return_place"></select>
			      </div>
	          <!-- Custom delivery place -->
	          <div id="widget_another_return_place_group" style="display: none;">
	            <div class="flex-form-item justify-content-between position-relative">
	              <input type="text" class="form-control" id="widget_return_place_other" name="return_place_other" />
	              <input type="hidden" name="custom_return_place" value="false" />
	              <button type="button" class="widget_another_return_place_group_close">
	                <i class="fa fa-times flex-icon-absolute"></i>&nbsp;
	              </button>
	            </div>
	          </div>			      
			    </div>
			  </div>
		  <% } %>

		  <!-- Delivery / Collection dates and times -->

		  <div class="flex-form-group">
		    <!-- Delivery date -->
		    <div class="flex-form-horizontal-box">
		      <label for="date_from"><?php echo esc_html( MyBookingEngineContext::getInstance()->getDeliveryDate() ) ?></label>
		      <div class="flex-form-horizontal-item">
			      <input type="text" class="form-control" name="date_from" id="widget_date_from" autocomplete="off" readonly="true">
			    	<% if (configuration.timeToFrom) { %>
				      <select class="form-control ml-1" name="time_from" id="widget_time_from"></select>
				    <% } else { %>
				     	<input type="hidden" name="time_from" value="<%=configuration.defaultTimeStart%>"/>
				    <% } %>
				  </div>
		    </div>
		    <!-- Delivery time -->
		    <div class="flex-form-horizontal-box">
		      <label for="date_to"><?php echo esc_html( MyBookingEngineContext::getInstance()->getCollectionDate() ) ?></label>
		      <div class="flex-form-horizontal-item">
			      <input type="text" class="form-control" name="date_to" id="widget_date_to" autocomplete="off" readonly="true">
				    <% if (configuration.timeToFrom) { %>
			          <select class="form-control ml-1" name="time_to" id="widget_time_to"></select>
			      <% } else { %>
			      	  <input type="hidden" name="time_to" value="<%=configuration.defaultTimeEnd%>"/>
			      <% } %>
			    </div>
		    </div>
		  </div>

		</div>

	  <% if (not_hidden_family_id && configuration.selectFamily) { %>
	    <div class="flex-form-horizontal-box widget_family" style="display: none">
	      <label for="family_id"><?php echo esc_html( MyBookingEngineContext::getInstance()->getFamily() ) ?></label>
	      <div class="flex-form-horizontal-item">
	      	<select name="family_id" id="widget_family_id" class="form-control"></select>
  	    </div>
	    </div>
    <% } %>

		<% if (configuration.promotionCode) { %>
			<div class="flex-form-horizontal-box">
		      <label for="promotion_code"><?php echo esc_html_x( 'Promotion code', 'renting_form_selector', 'mybooking-wp-plugin' ) ?></label>
		      <div class="flex-form-horizontal-item">
			      <input type="text" class="form-control" name="promotion_code" id="widget_promotion_code" autocomplete="off">
			    </div>
			</div>
		<% } %>

		<div class="flex-form-horizontal-box">
		  <input class="btn btn-primary" type="submit" value="<?php echo esc_html_x( 'Search', 'renting_form_selector', 'mybooking-wp-plugin') ?>" />
		</div>

	<% } %>

</script>
