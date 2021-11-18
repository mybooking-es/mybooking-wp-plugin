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
		<div class="mb-form-group">
			<select name="family_id" id="family_id" class="mb-form-control"
				<?php if ( array_key_exists('family_id', $args) && $args['family_id'] != '') { ?>data-value="<?php echo esc_attr( $args['family_id'] )?>"<?php } ?>>
			  <option value=""><?php echo esc_html( MyBookingEngineContext::getInstance()->getFamily() ) ?></option>
			</select>
		</div>
	<% } %>

	<% if (typeof keyCharacteristics['price_ranges'] !== 'undefined' &&
	       Object.keys(keyCharacteristics['price_ranges']).length > 0 ) { %>
		<div class="mb-form-group">
      <label for="price_range"><?php echo esc_attr_x( 'Daily price', 'renting_product_search', 'mybooking-wp-plugin' )?></label>
			<select name="price_range" id="mybooking_price_range" class="mb-form-control mybooking-price-range" <?php if ( array_key_exists('price_range', $args) && $args['price_range'] != '') { ?>data-value="<?php echo esc_attr( $args['price_range'] )?>"<?php } ?>>
			  <option value=""><?php echo esc_attr_x( 'Daily price', 'renting_product_search', 'mybooking-wp-plugin' )?></option>
			  <% for (idx in keyCharacteristics['price_ranges']) { %>
			  	<option value="<%=idx%>"><%=keyCharacteristics['price_ranges'][idx]%></option>
			  <% } %>
			</select>
		</div>
  <% } %>

	<% if (typeof keyCharacteristics['key_characteristics']['1'] !== 'undefined' &&
	       Object.keys(keyCharacteristics['key_characteristics']['1']['values']).length > 0 ) { %>
		<div class="mb-form-group">
			<label for="key_characteristic_1"><%= keyCharacteristics['key_characteristics']['1'].name%></label>
			<select name="key_characteristic_1" id="mybooking_key_characteristic_1" class="mb-form-control mybooking-key-characteristic"
				<?php if ( array_key_exists('key_characteristic_1', $args) && $args['key_characteristic_1'] != '') { ?>data-value="<?php echo esc_attr( $args['key_characteristic_1'] )?>"<?php } ?>>
			  <option value=""><%= keyCharacteristics['key_characteristics']['1'].name%></option>
			  <% for (idx in keyCharacteristics['key_characteristics']['1'].values) { %>
			  	<option value="<%=keyCharacteristics['key_characteristics']['1'].values[idx].value%>"><%=keyCharacteristics['key_characteristics']['1'].values[idx].description%></option>
			  <% } %>
			</select>
		</div>
  <% } %>

	<% if (typeof keyCharacteristics['key_characteristics']['2'] !== 'undefined' &&
	       Object.keys(keyCharacteristics['key_characteristics']['2']['values']).length > 0 ) { %>
		<div class="mb-form-group">
			<label for="key_characteristic_2"><%= keyCharacteristics['key_characteristics']['2'].name%></label>
			<select name="key_characteristic_2" id="mybooking_key_characteristic_2" class="mb-form-control mybooking-key-characteristic"
				<?php if ( array_key_exists('key_characteristic_2', $args) && $args['key_characteristic_2'] != '') { ?>data-value="<?php echo esc_attr( $args['key_characteristic_2'] )?>"<?php } ?>>
			  <option value=""><%= keyCharacteristics['key_characteristics']['2'].name%></option>
			  <% for (idx in keyCharacteristics['key_characteristics']['2'].values) { %>
			  	<option value="<%=keyCharacteristics['key_characteristics']['2'].values[idx].value%>"><%=keyCharacteristics['key_characteristics']['2'].values[idx].description%></option>
			  <% } %>
			</select>
		</div>
  <% } %>

	<% if (typeof keyCharacteristics['key_characteristics']['3'] !== 'undefined' &&
	       Object.keys(keyCharacteristics['key_characteristics']['3']['values']).length > 0 ) { %>
		<div class="mb-form-group">
			<label for="key_characteristic_3"><%= keyCharacteristics['key_characteristics']['3'].name%></label>
			<select name="key_characteristic_3" id="mybooking_key_characteristic_3" class="mb-form-control mybooking-key-characteristic"
				<?php if ( array_key_exists('key_characteristic_3', $args) && $args['key_characteristic_3'] != '') { ?>data-value="<?php echo esc_attr( $args['key_characteristic_3'] )?>"<?php } ?>>
			  <option value=""><%= keyCharacteristics['key_characteristics']['3'].name%></option>
			  <% for (idx in keyCharacteristics['key_characteristics']['3'].values) { %>
			  	<option value="<%=keyCharacteristics['key_characteristics']['3'].values[idx].value%>"><%=keyCharacteristics['key_characteristics']['3'].values[idx].description%></option>
			  <% } %>
			</select>
		</div>
  <% } %>

	<% if (typeof keyCharacteristics['key_characteristics']['4'] !== 'undefined' &&
	       Object.keys(keyCharacteristics['key_characteristics']['4']['values']).length > 0 ) { %>
		<div class="mb-form-group">
			<label for="key_characteristic_4"><%= keyCharacteristics['key_characteristics']['4'].name%></label>
			<select name="key_characteristic_4" id="mybooking_key_characteristic_4" class="mb-form-control mybooking-key-characteristic"
				<?php if ( array_key_exists('key_characteristic_4', $args) && $args['key_characteristic_4'] != '') { ?>data-value="<?php echo esc_attr( $args['key_characteristic_4'] )?>"<?php } ?>>
			  <option value=""><%= keyCharacteristics['key_characteristics']['4'].name%></option>
			  <% for (idx in keyCharacteristics['key_characteristics']['4'].values) { %>
			  	<option value="<%=keyCharacteristics['key_characteristics']['4'].values[idx].value%>"><%=keyCharacteristics['key_characteristics']['4'].values[idx].description%></option>
			  <% } %>
			</select>
		</div>
  <% } %>

	<% if (typeof keyCharacteristics['key_characteristics']['5'] !== 'undefined' &&
	       Object.keys(keyCharacteristics['key_characteristics']['5']['values']).length > 0 ) { %>
		<div class="mb-form-group">
			<label for="key_characteristic_5"><%= keyCharacteristics['key_characteristics']['5'].name%></label>
			<select name="key_characteristic_5" id="mybooking_key_characteristic_3" class="mb-form-control mybooking-key-characteristic"
				<?php if ( array_key_exists('key_characteristic_5', $args) && $args['key_characteristic_5'] != '') { ?>data-value="<?php echo esc_attr( $args['key_characteristic_5'] )?>"<?php } ?>>
			  <option value=""><%= keyCharacteristics['key_characteristics']['5'].name%></option>
			  <% for (idx in keyCharacteristics['key_characteristics']['5'].values) { %>
			  	<option value="<%=keyCharacteristics['key_characteristics']['5'].values[idx].value%>"><%=keyCharacteristics['key_characteristics']['5'].values[idx].description%></option>
			  <% } %>
			</select>
		</div>
  <% } %>

	<% if (typeof keyCharacteristics['key_characteristics']['6'] !== 'undefined' &&
	       Object.keys(keyCharacteristics['key_characteristics']['6']['values']).length > 0 ) { %>
		<div class="mb-form-group">
      <label for="key_characteristic_6"><%= keyCharacteristics['key_characteristics']['6'].name%></label>
			<select name="key_characteristic_6" id="mybooking_key_characteristic_6" class="mb-form-control mybooking-key-characteristic"
				<?php if ( array_key_exists('key_characteristic_6', $args) && $args['key_characteristic_6'] != '') { ?>data-value="<?php echo esc_attr( $args['key_characteristic_6'] )?>"<?php } ?>>
			  <option value=""><%= keyCharacteristics['key_characteristics']['6'].name%></option>
			  <% for (idx in keyCharacteristics['key_characteristics']['6'].values) { %>
			  	<option value="<%=keyCharacteristics['key_characteristics']['6'].values[idx].value%>"><%=keyCharacteristics['key_characteristics']['6'].values[idx].description%></option>
			  <% } %>
			</select>
		</div>
  <% } %>


</script>
