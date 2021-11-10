<?php
  /**
   * The Template for showing the renting selector wizard container
   *
   * This template can be overridden by copying it to yourtheme/mybooking-templates/mybooking-plugin-wizard-container.php
   *
   */
?>

<!-- Wizard container -->
<div id="wizard_container" class="mb-section selector_wizard_container mybooking-wizard-container" style="display: none">

  <!-- Title -->
  <div id="step_title" class="selector_wizard_step_title mybooking-wizard-step_title"></div>

  <!-- Close btn -->
  <span id="close_wizard_btn" class="selector_wizard_close_btn mybooking-wizard-close"><span class="dashicons dashicons-dismiss"></span></span>

  <!-- Container -->
  <div id="wizard_container_step" class="selector_wizard_step_container mybooking-wizard-step_container">
    <div id="wizard_container_step_header" class="mybooking-wizard-step_header"></div>
    <div id="wizard_container_step_body"></div>
  </div>
</div>
