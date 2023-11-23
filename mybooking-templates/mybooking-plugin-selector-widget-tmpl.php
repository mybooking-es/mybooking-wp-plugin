<?php
/**
 *   MYBOOKING ENGINE - SELECTOR TEMPLATES
 *   ---------------------------------------------------------------------------
 *   The Template for showing the renting complete step
 *   This template can be overridden by copying it to your
 *   theme /mybooking-templates/mybooking-plugin-selector.php
 *
 * @phpcs:disable PHPCompatibility.Miscellaneous.RemovedAlternativePHPTags.MaybeASPOpenTagFound
 * @phpcs:disable Generic.PHP.DisallowAlternativePHPTags.MaybeASPOpenTagFound
 * @phpcs:disable Generic.PHP.DisallowAlternativePHPTags.MaybeASPShortOpenTagFound
 */
?>

<script type="text/tmpl" id="widget_form_selector_tmpl">

	<% if (configuration.pickupReturnPlace || configuration.timeToFrom || configuration.useDriverAgeRules) { %>

		<?php mybooking_engine_get_template('mybooking-plugin-selector-widget-block-tmpl.php'); ?>

	<% } else { %>
		
		<?php mybooking_engine_get_template('mybooking-plugin-selector-widget-inline-tmpl.php'); ?>
				
  <% } %>

</script>
