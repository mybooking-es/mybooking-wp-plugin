<?php
  /** 
   * The Template for showing the renting modify reservation form - JS Microtemplates
   *
   * This template can be overridden by copying it to yourtheme/mybooking-templates/mybooking-plugin-modify-reservation-tmpl.php
   *
   * @phpcs:disable PHPCompatibility.Miscellaneous.RemovedAlternativePHPTags.MaybeASPOpenTagFound 
   * @phpcs:disable Generic.PHP.DisallowAlternativePHPTags.MaybeASPOpenTagFound
   * @phpcs:disable Generic.PHP.DisallowAlternativePHPTags.MaybeASPShortOpenTagFound   
   */
?>
<script type="text/tmpl" id="form_selector_tmpl">

<div class="flex-form-group-wrapper">

  <!-- Delivery / Collection place -->
  <% if (configuration.pickupReturnPlace) { %>    
		<div class="flex-form-group">
	    <!-- Delivery place -->
	    <div class="flex-form-horizontal-box">
	        <label for="pickup_place"><?php echo esc_html_x( 'Pick-up place', 'renting_form_selector', 'mybooking-wp-plugin') ?></label>
	        <div class="flex-form-item pickup_place_group">
	        	<select class="form-control" name="pickup_place" id="pickup_place"></select>
	      	</div>
          <!-- Custom delivery place -->
          <div id="another_pickup_place_group" style="display: none;">
            <div class="flex-form-item justify-content-between position-relative">
              <input class="form-control" type="text" id="pickup_place_other" name="pickup_place_other" />
              <input type="hidden" name="custom_pickup_place" value="false" />
              <button type="button" class="another_pickup_place_group_close">
                <i class="fa fa-times flex-icon-absolute"></i>
              </button>
            </div>
          </div>
	    </div>
	    <!-- Collection place -->
	    <div class="flex-form-horizontal-box">
	      <label for="return_place"><?php echo esc_html_x( 'Return place', 'renting_form_selector', 'mybooking-wp-plugin' ) ?></label>
	      <div class="flex-form-item return_place_group">
	      	<select class="form-control" name="return_place" id="return_place"></select>
	      </div>
        <!-- Custom delivery place -->
        <div id="another_return_place_group" style="display: none;">
          <div class="flex-form-item justify-content-between position-relative">
            <input class="form-control" type="text" id="return_place_other" name="return_place_other" />
            <input type="hidden" name="custom_return_place" value="false" />
            <button type="button" class="another_return_place_group_close">
              <i class="fa fa-times flex-icon-absolute"></i>
            </button>
          </div>
        </div>	      
	    </div>
	  </div>
  <% } else { %>
      <% if (configuration.selectRentalLocation) { %>
        <% if (not_hidden_rental_location_code) { %>
          <div class="flex-form-group rental_location" style="display: none">
            <div class="flex-form-horizontal-box">
              <label for="rental_location_code"><?php echo esc_html( MyBookingEngineContext::getInstance()->getRentalLocation() ) ?></label>
              <div class="flex-form-horizontal-item">
                <select name="rental_location_code" id="rental_location_code" class="form-control"></select>
              </div>
            </div>
          </div>
        <% } else { %>
          <% if (rental_location_code && rental_location_code != '') { %>
            <input type="hidden" name="rental_location_code" value="<%=rental_location_code%>"/>
            <input type="hidden" name="engine_fixed_rental_location" value="true"/>
          <% } %>               
        <% } %>  
      <% } %>
  <% } %>

  <!-- Delivery / Collection dates and times -->
  <div class="flex-form-group">
    <!-- Delivery date -->
    <div class="flex-form-horizontal-box">
      <label for="date_from"><?php echo esc_html( MyBookingEngineContext::getInstance()->getDeliveryDate() ) ?></label>
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
      <label for="date_to"><?php echo esc_html( MyBookingEngineContext::getInstance()->getCollectionDate() ) ?></label>
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

<% if (configuration.selectFamily) { %>
    <% if (not_hidden_family_id) { %>
      <div class="flex-form-horizontal-box family" style="display: none">
        <label for="family_id"><?php echo esc_html( MyBookingEngineContext::getInstance()->getFamily() ) ?></label>
        <div class="flex-form-horizontal-item">
        	<select name="family_id" id="family_id" class="form-control"></select>
  	    </div>
      </div>
    <% } else { %>
        <% if (family_id && family_id != '') { %>
          <input type="hidden" name="family_id" value="<%=family_id%>"/>
          <input type="hidden" name="engine_fixed_family" value="true"/>
        <% } %>  
    <% } %>
<% } else if (!not_hidden_family_id) { %>
    <% if (family_id && family_id != '') { %>
      <input type="hidden" name="family_id" value="<%=family_id%>"/>
      <input type="hidden" name="engine_fixed_family" value="true"/>
    <% } %>         
<% } %>

<div class="flex-form-horizontal-box">
  <input class="btn btn-success" type="submit" value="<?php echo esc_attr_x( 'Search', 'renting_form_selector', 'mybooking-wp-plugin') ?>" />
</div>

</script>