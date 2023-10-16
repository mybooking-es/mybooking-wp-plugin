<?php
/**
 *   MYBOOKING ENGINE - WIZARD CONTAINER
 *   ---------------------------------------------------------------------------
 *   The Template for showing the renting select product step - JS Microtemplates
 *   This template can be overridden by copying it to your
 *   theme /mybooking-templates/mybooking-plugin-wizard-container.php
 */
?>

<!-- WIZARD CONTAINER --------------------------------------------------------->

<div id="wizard_container" class="selector_wizard_container mybooking-wizard_container" style="display: none">

  <?php if ( function_exists('mybooking_site_logo') ) : ?>
    <br/><br/>
    <div class="text-center">
        <?php mybooking_site_logo(); ?>
    </div>
  <?php endif; ?>

  <!-- Title -->
  <div id="step_title" class="selector_wizard_step_title mybooking-wizard_step-title">
    <div><?php $bloginfo = get_bloginfo(); echo $bloginfo ?></div>
  </div>

  <!-- Close btn -->
  <span id="close_wizard_btn" class="selector_wizard_close_btn mybooking-wizard_close">
    <span class="dashicons dashicons-dismiss"></span>
  </span>

  <!-- Container -->
  <div id="wizard_container_step" class="selector_wizard_step_container mybooking-wizard_step-container">
    <div id="wizard_container_step_header" class="mybooking-wizard_step-header"></div>
    <div id="wizard_container_step_body" class="mybooking-wizard_step-body"></div>
  </div>
</div>
