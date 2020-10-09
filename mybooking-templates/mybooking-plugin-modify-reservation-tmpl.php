<?php
/**
*   Renting Modify Reservation Form Template
*   -----------------------------------------
*
*   Versión: 0.0.1
*   @package WordPress
*   @subpackage Mybooking WordPress Plugin
*   @since Mybooking WordPress Plugin 0.5.12
*/
?>
<script type="text/tmpl" id="form_selector_tmpl">

<div class="flex-form-group-wrapper">

  <!-- Delivery / Collection place -->
  <% if (configuration.pickupReturnPlace) { %>    
		<div class="flex-form-group">
	    <!-- Delivery place -->
	    <div class="flex-form-horizontal-box">
	        <label for="pickup_place"><?php echo _x( 'Pick-up place', 'renting_form_selector', 'mybooking-wp-plugin') ?></label>
	        <select class="form-control" name="pickup_place" id="pickup_place"></select>
	    </div>
	    <!-- Collection place -->
	    <div class="flex-form-horizontal-box">
	      <label for="return_place"><?php echo _x( 'Return place', 'renting_form_selector', 'mybooking-wp-plugin' ) ?></label>
	      <select class="form-control" name="return_place" id="return_place"></select>
	    </div>
	  </div>
  <% } %>

  <!-- Delivery / Collection dates and times -->
  <div class="flex-form-group">
    <!-- Delivery date -->
    <div class="flex-form-horizontal-box">
      <label for="date_from"><?php echo _x( 'Pick-up date', 'renting_form_selector', 'mybooking-wp-plugin' ) ?></label>
      <div class="flex-form-horizontal-item">
	      <input type="text" class="form-control" name="date_from" id="date_from" autocomplete="off" readonly="true">
	    	<% if (configuration.timeToFrom) { %>
		      <select class="form-control ml-1" name="time_from" id="time_from"></select>
		    <% } else { %>
		     	<input type="hidden" name="time_from" value="<%=configuration.defaultTimeStart%>"/>
		    <% } %>
		  </div>
    </div>
    <!-- Delivery time -->
    <div class="flex-form-horizontal-box">
      <label for="date_to"><?php echo _x( 'Return date', 'renting_form_selector', 'mybooking-wp-plugin' ) ?></label>
      <div class="flex-form-horizontal-item">
	      <input type="text" class="form-control" name="date_to" id="date_to" autocomplete="off" readonly="true">
		    <% if (configuration.timeToFrom) { %>
	          <select class="form-control ml-1" name="time_to" id="time_to"></select>
	      <% } else { %>
	      	  <input type="hidden" name="time_to" value="<%=configuration.defaultTimeEnd%>"/>
	      <% } %>    
	    </div>
    </div>
  </div>
   
</div>

<% if (not_hidden_family_id && configuration.selectFamily) { %>
    <div class="flex-form-horizontal-box family" style="display: none">
      <label for="family_id"><?php echo _x( 'Family', 'renting_form_selector', 'mybooking-wp-plugin' ) ?></label>
      <div class="flex-form-horizontal-item">
      	<select name="family_id" id="family_id" class="form-control"></select>
	    </div>
    </div>
<% } %>

<div class="flex-form-horizontal-box">
  <input class="btn btn-success" type="submit" value="<?php echo _x( 'Search', 'renting_form_selector', 'mybooking-wp-plugin') ?>" />
</div>

</script>