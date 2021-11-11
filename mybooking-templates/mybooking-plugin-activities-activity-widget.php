<?php
/**
 *   MYBOOKING ENGINE - ACTIVITY CALENDAR
 *   ---------------------------------------------------------------------------
 *   The Template for showing the renting complete step - JS microtemplates
 *   This template can be overridden by copying it to your
 *   theme /mybooking-templates/mybooking-plugin-activities-activity-widget.php
 *
 *   @phpcs:disable PHPCompatibility.Miscellaneous.RemovedAlternativePHPTags.MaybeASPOpenTagFound
 *   @phpcs:disable Generic.PHP.DisallowAlternativePHPTags.MaybeASPOpenTagFound
 *   @phpcs:disable Generic.PHP.DisallowAlternativePHPTags.MaybeASPShortOpenTagFound
 */
?>


<div class="mybooking-product_detail-datepicker">
  <div id="buy_selector" class="full-size-datepicker-container" data-id="<?php echo esc_attr( $args['activity_id'] )?>"></div>
  <?php mybooking_engine_get_template('mybooking-plugin-activities-activity-widget-tmpl.php') ?>
</div>
