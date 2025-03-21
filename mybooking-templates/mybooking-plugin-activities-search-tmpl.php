<?php
  /**
   * The Template for showing the activity search component - JS Microtemplates
   *
   * This template can be overridden by copying it to yourtheme/mybooking-templates/mybooking-plugin-activities-search-tmpl.php
   *
   * @phpcs:disable PHPCompatibility.Miscellaneous.RemovedAlternativePHPTags.MaybeASPOpenTagFound
   * @phpcs:disable Generic.PHP.DisallowAlternativePHPTags.MaybeASPOpenTagFound
   * @phpcs:disable Generic.PHP.DisallowAlternativePHPTags.MaybeASPShortOpenTagFound
   */
?>
<script type="text/tmpl" id="form_activities_selector_tmpl">

	<% if (configuration.selectActivityDestination) { %>
		<select name="destination_id" id="activity_selector_destination_id" class="mb-form-control form-control"
			<?php if ( array_key_exists('destination_id', $args) && $args['destination_id'] != '') { ?>data-value="<?php echo esc_attr( $args['destination_id'] )?>"<?php } ?>>
			<option value=""><?php echo esc_html_x( 'Destination', 'activities_search', 'mybooking-reservation-engine' ) ?></option>
		</select>
	<% } %>

	<% if (configuration.selectActivityCategory) { %>
		<select name="family_id" id="family_id" class="mb-form-control form-control"
			<?php if ( array_key_exists('family_id', $args) && $args['family_id'] != '') { ?>data-value="<?php echo esc_attr( $args['family_id'] )?>"<?php } ?>>
			<option value=""><?php echo esc_html_x( 'Category', 'activities_search', 'mybooking-reservation-engine' ) ?></option>
		</select>
	<% } %>

</script>
