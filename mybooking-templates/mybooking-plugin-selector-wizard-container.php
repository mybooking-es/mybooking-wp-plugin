      <!-- Wizard container -->  
      <div id="wizard_container" class="bg-white" 
           style="display: none; position: fixed; top: 0; left: 0; z-index: 1040; width: 100%; height: 100%; overflow: hidden;">
           <!-- Title -->
           <div id="step_title" class="text-center h5 pb-2" style="position: relative; top: 20px; border-bottom: 1px solid #eee"></div>
           <!-- Close btn -->
           <span id="close_wizard_btn" style="position: fixed; top: 20px; right: 20px; margin-right: 10px" ><i class="fa fa-times" style="font-size:1.2em; font-weight: 200"></i></span>
           <!-- Container -->
          <div id="wizard_container_step" class="p-2" 
               style="position: fixed; top: 50px; left: 0; z-index: 2000; width: 100%; height: 100%; overflow-y: auto; overflow-x: hidden">
            <div id="wizard_container_step_header"></div>
            <div id="wizard_container_step_body"></div>
          </div>
      </div>