<?php
  /** 
   * The Template for showing the activity search component - JS Microtemplates
   *
   * This template can be overridden by copying it to yourtheme/mybooking-templates/mybooking-plugin-products-search-tmpl.php
   *
   * @phpcs:disable PHPCompatibility.Miscellaneous.RemovedAlternativePHPTags.MaybeASPOpenTagFound 
   * @phpcs:disable Generic.PHP.DisallowAlternativePHPTags.MaybeASPOpenTagFound
   * @phpcs:disable Generic.PHP.DisallowAlternativePHPTags.MaybeASPShortOpenTagFound   
   */
?>
<script type="text/tmpl" id="form_products_selector_tmpl">

	<% if (configuration.selectFamily) { %>
		<div class="form-group col-md-12">
			<select name="family_id" id="family_id" class="form-control"
				<?php if ( array_key_exists('family_id', $args) && $args['family_id'] != '') { ?>data-value="<?php echo esc_attr( $args['family_id'] )?>"<?php } ?>>
			  <option value=""><?php echo esc_html( MyBookingEngineContext::getInstance()->getFamily() ) ?></option> 
			</select>
		</div>
	<% } %>

	<% if (typeof keyCharacteristics['1'] !== 'undefined' ) { %>
		<div class="form-group col-md-12">
			<label for="key_characteristic_1"><%= keyCharacteristics['1'].name%></label>
			<select name="key_characteristic_1" id="mybooking_key_characteristic_1" class="form-control mybooking-key-characteristic"
				<?php if ( array_key_exists('key_characteristic_1', $args) && $args['key_characteristic_1'] != '') { ?>data-value="<?php echo esc_attr( $args['key_characteristic_1'] )?>"<?php } ?>>
			  <option value=""><%= keyCharacteristics['1'].name%></option> 
			  <% for (idx in keyCharacteristics['1'].values) { %>
			  	<option value="<%=keyCharacteristics['1'].values[idx].value%>"><%=keyCharacteristics['1'].values[idx].description%></option>
			  <% } %>	
			</select>
		</div>
  <% } %>		

	<% if (typeof keyCharacteristics['2'] !== 'undefined' ) { %>
		<div class="form-group col-md-12">
			<label for="key_characteristic_2"><%= keyCharacteristics['2'].name%></label>
			<select name="key_characteristic_2" id="mybooking_key_characteristic_2" class="form-control mybooking-key-characteristic"
				<?php if ( array_key_exists('key_characteristic_2', $args) && $args['key_characteristic_2'] != '') { ?>data-value="<?php echo esc_attr( $args['key_characteristic_2'] )?>"<?php } ?>>
			  <option value=""><%= keyCharacteristics['2'].name%></option> 
			  <% for (idx in keyCharacteristics['2'].values) { %>
			  	<option value="<%=keyCharacteristics['2'].values[idx].value%>"><%=keyCharacteristics['2'].values[idx].description%></option>
			  <% } %>	
			</select>
		</div>
  <% } %>		

	<% if (typeof keyCharacteristics['3'] !== 'undefined' ) { %>
		<div class="form-group col-md-12">
			<label for="key_characteristic_3"><%= keyCharacteristics['3'].name%></label>
			<select name="key_characteristic_3" id="mybooking_key_characteristic_3" class="form-control mybooking-key-characteristic"
				<?php if ( array_key_exists('key_characteristic_3', $args) && $args['key_characteristic_3'] != '') { ?>data-value="<?php echo esc_attr( $args['key_characteristic_3'] )?>"<?php } ?>>
			  <option value=""><%= keyCharacteristics['3'].name%></option> 
			  <% for (idx in keyCharacteristics['3'].values) { %>
			  	<option value="<%=keyCharacteristics['3'].values[idx].value%>"><%=keyCharacteristics['3'].values[idx].description%></option>
			  <% } %>	
			</select>
		</div>
  <% } %>		

	<% if (typeof keyCharacteristics['4'] !== 'undefined' ) { %>
		<div class="form-group col-md-12">
			<label for="key_characteristic_4"><%= keyCharacteristics['4'].name%></label>
			<select name="key_characteristic_4" id="mybooking_key_characteristic_4" class="form-control mybooking-key-characteristic"
				<?php if ( array_key_exists('key_characteristic_4', $args) && $args['key_characteristic_4'] != '') { ?>data-value="<?php echo esc_attr( $args['key_characteristic_4'] )?>"<?php } ?>>
			  <option value=""><%= keyCharacteristics['4'].name%></option> 
			  <% for (idx in keyCharacteristics['4'].values) { %>
			  	<option value="<%=keyCharacteristics['4'].values[idx].value%>"><%=keyCharacteristics['4'].values[idx].description%></option>
			  <% } %>	
			</select>
		</div>
  <% } %>		

	<% if (typeof keyCharacteristics['5'] !== 'undefined' ) { %>
		<div class="form-group col-md-12">
			<label for="key_characteristic_5"><%= keyCharacteristics['5'].name%></label>
			<select name="key_characteristic_5" id="mybooking_key_characteristic_3" class="form-control mybooking-key-characteristic"
				<?php if ( array_key_exists('key_characteristic_5', $args) && $args['key_characteristic_5'] != '') { ?>data-value="<?php echo esc_attr( $args['key_characteristic_5'] )?>"<?php } ?>>
			  <option value=""><%= keyCharacteristics['5'].name%></option> 
			  <% for (idx in keyCharacteristics['5'].values) { %>
			  	<option value="<%=keyCharacteristics['5'].values[idx].value%>"><%=keyCharacteristics['5'].values[idx].description%></option>
			  <% } %>	
			</select>
		</div>
  <% } %>		

	<% if (typeof keyCharacteristics['6'] !== 'undefined' ) { %>
		<div class="form-group col-md-12">
      <label for="key_characteristic_6"><%= keyCharacteristics['6'].name%></label>
			<select name="key_characteristic_6" id="mybooking_key_characteristic_6" class="form-control mybooking-key-characteristic"
				<?php if ( array_key_exists('key_characteristic_6', $args) && $args['key_characteristic_6'] != '') { ?>data-value="<?php echo esc_attr( $args['key_characteristic_6'] )?>"<?php } ?>>
			  <option value=""><%= keyCharacteristics['6'].name%></option> 
			  <% for (idx in keyCharacteristics['6'].values) { %>
			  	<option value="<%=keyCharacteristics['6'].values[idx].value%>"><%=keyCharacteristics['6'].values[idx].description%></option>
			  <% } %>	
			</select>
		</div>
  <% } %>		


</script>