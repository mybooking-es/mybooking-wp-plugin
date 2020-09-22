<?php
/**
*   Renting Selector Form Template
*   ------------------------------
*
*   @version 0.0.1
*   @package WordPress
*   @subpackage Mybooking WordPress Plugin
*   @since Mybooking WordPress Plugin 0.5.12
*/
?>
<!-- =========================================== -->
<!--			 Renting Form selector template 			 -->
<!-- =========================================== -->
<script type="text/tmpl" id="widget_form_selector_tmpl">

	<% if (!configuration.pickupReturnPlace && !configuration.timeToFrom) { %>

	<div class="flex-form-group-wrapper inline-form">

	    <div class="flex-form-group">
	      <label for="date_from"><?php echo _x( 'Pick-up date', 'renting_form_selector', 'mybooking-wp-plugin' ) ?></label>
	      <div class="flex-form-horizontal-item">
		      <input type="text" class="form-control" name="date_from" id="widget_date_from" autocomplete="off">
		      <input type="hidden" name="time_from" value="<%=configuration.defaultTimeStart%>"/>
			  </div>
	    </div>
	    <div class="flex-form-group">
	      <label for="date_from"><?php echo _x( 'Return date', 'renting_form_selector', 'mybooking-wp-plugin' ) ?></label>
	      <div class="flex-form-horizontal-item">
		      <input type="text" class="form-control" name="date_to" id="widget_date_to" autocomplete="off">
		      <input type="hidden" name="time_to" value="<%=configuration.defaultTimeEnd%>"/>
 		    </div>
	    </div>

		<% if (configuration.promotionCode) { %>
			<div class="flex-form-group">
		      <label for="promotion_code"><?php echo _x( 'Promotion code', 'renting_form_selector', 'mybooking-wp-plugin' ) ?></label>
		      <div class="flex-form-horizontal-item">
			      <input type="text" class="form-control" name="promotion_code" id="widget_promotion_code" autocomplete="off">
			    </div>
			</div>
		<% } %>

	    <div class="flex-form-group flex-form-group-no-label">
	      <div class="flex-form-horizontal-item">
   		    <input class="btn btn-primary" type="submit" value="<?php echo _x( 'Search', 'renting_form_selector', 'mybooking-wp-plugin') ?>" />
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
			        <label for="pickup_place"><?php echo _x( 'Pick-up place', 'renting_form_selector', 'mybooking-wp-plugin') ?></label>
			        <select class="form-control" name="pickup_place" id="widget_pickup_place"></select>
			    </div>
			    <!-- Collection place -->
			    <div class="flex-form-horizontal-box">
			      <label for="return_place"><?php echo _x( 'Return place', 'renting_form_selector', 'mybooking-wp-plugin' ) ?></label>
			      <select class="form-control" name="return_place" id="widget_return_place"></select>
			    </div>
			  </div>
		  <% } %>

		  <!-- Delivery / Collection dates and times -->

		  <div class="flex-form-group">
		    <!-- Delivery date -->
		    <div class="flex-form-horizontal-box">
		      <label for="date_from"><?php echo _x( 'Pick-up date', 'renting_form_selector', 'mybooking-wp-plugin' ) ?></label>
		      <div class="flex-form-horizontal-item">
			      <input type="text" class="form-control" name="date_from" id="widget_date_from" autocomplete="off">
			    	<% if (configuration.timeToFrom) { %>
				      <select class="form-control ml-1" name="time_from" id="widget_time_from"></select>
				    <% } else { %>
				     	<input type="hidden" name="time_from" value="<%=configuration.defaultTimeStart%>"/>
				    <% } %>
				  </div>
		    </div>
		    <!-- Delivery time -->
		    <div class="flex-form-horizontal-box">
		      <label for="date_from"><?php echo _x( 'Return date', 'renting_form_selector', 'mybooking-wp-plugin' ) ?></label>
		      <div class="flex-form-horizontal-item">
			      <input type="text" class="form-control" name="date_to" id="widget_date_to" autocomplete="off">
				    <% if (configuration.timeToFrom) { %>
			          <select class="form-control ml-1" name="time_to" id="widget_time_to"></select>
			      <% } else { %>
			      	  <input type="hidden" name="time_to" value="<%=configuration.defaultTimeEnd%>"/>
			      <% } %>
			    </div>
		    </div>
		  </div>

		</div>

		<% if (configuration.promotionCode) { %>
			<div class="flex-form-horizontal-box">
		      <label for="date_from"><?php echo _x( 'Promotion code', 'renting_form_selector', 'mybooking-wp-plugin' ) ?></label>
		      <div class="flex-form-horizontal-item">
			      <input type="text" class="form-control" name="promotion_code" id="widget_promotion_code" autocomplete="off">
			    </div>
			</div>
		<% } %>

		<div class="flex-form-horizontal-box">
		  <input class="btn btn-primary" type="submit" value="<?php echo _x( 'Search', 'renting_form_selector', 'mybooking-wp-plugin') ?>" />
		</div>

	<% } %>

</script>
