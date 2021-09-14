<?php
  /** 
   * The Template for showing the transfer selector widget - JS Microtemplates
   *
   * This template can be overridden by copying it to yourtheme/mybooking-templates/mybooking-plugin-transfer-selector-widget-tmpl.php
   *
   * @phpcs:disable PHPCompatibility.Miscellaneous.RemovedAlternativePHPTags.MaybeASPOpenTagFound 
   * @phpcs:disable Generic.PHP.DisallowAlternativePHPTags.MaybeASPOpenTagFound
   * @phpcs:disable Generic.PHP.DisallowAlternativePHPTags.MaybeASPShortOpenTagFound   
   */
?>
<script type="text/tmpl" id="transfer_form_selector_tmpl">

<div class="flex-form-group-wrapper">

  <!-- Origin and Return Points -->
	<div class="flex-form-group">
    <!-- Delivery place -->
    <div class="flex-form-horizontal-box">
        <label for="origin_point"><?php echo esc_html_x( 'Origin', 'transfer_form_selector', 'mybooking-wp-plugin') ?></label>
        <div class="flex-form-item">
        	<select class="form-control" id="origin_point" name="origin_point_id"></select>
      	</div>
    </div>
    <!-- Collection place -->
    <div class="flex-form-horizontal-box">
      <label for="return_place"><?php echo esc_html_x( 'Destination', 'transfer_form_selector', 'mybooking-wp-plugin' ) ?></label>
      <div class="flex-form-item">
        <select class="form-control" id="destination_point" name="destination_point_id"></select>
      </div>
    </div>
  </div>

  <!-- Date and time -->
  <div class="flex-form-group">
    <!-- Date -->
    <div class="flex-form-horizontal-box">
      <label for="date"><?php echo esc_html_x( 'Date', 'transfer_form_selector', 'mybooking-wp-plugin') ?></label>
      <div class="flex-form-horizontal-item">
        <input type="text" class="form-control" name="date" id="date" autocomplete="off" readonly="true">
      </div>
    </div>
    <!-- Time -->
    <div class="flex-form-horizontal-box">
      <label for="date"><?php echo esc_html_x( 'Time', 'transfer_form_selector', 'mybooking-wp-plugin') ?></label>
      <div class="flex-form-horizontal-item">
        <select class="form-control ml-1" name="time" id="time"></select>
      </div>
    </div>
  </div>
   
</div>

<div class="flex-form-horizontal-box">
  <input class="btn btn-success" type="submit" value="<?php echo esc_attr_x( 'Search', 'transfer_form_selector', 'mybooking-wp-plugin') ?>" />
</div>

</script>