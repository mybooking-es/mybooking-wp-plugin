<?php
/**
*   Renting Selector Form
*   ---------------------
*
*   @version 0.0.1
*   @package WordPress
*   @subpackage Mybooking WordPress Plugin
*   @since Mybooking WordPress Plugin 0.0.1
*/
?>
<section class="widget widget_mybooking_renting_engine_selector reservation-step has-background-grey-lighter">
  <form
    name="widget_search_form"
    method="get"
    enctype="application/x-www-form-urlencoded"
    class="flex-form-horizontal">

    <?php if ( array_key_exists('sales_channel_code', $args) && $args['sales_channel_code'] != '' ) : ?>
    <input type="hidden" name="sales_channel_code" value="<?php echo $args['sales_channel_code']?>"/>
    <?php endif; ?>

    <?php if ( array_key_exists('family_id', $args) && $args['family_id'] != '' ) : ?>
    <input type="hidden" name="family_id" value="<?php echo $args['family_id']?>"/>
    <?php endif; ?>

  </form>
</section>
