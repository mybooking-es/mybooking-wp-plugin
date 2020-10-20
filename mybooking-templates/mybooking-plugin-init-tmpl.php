<?php
  /** 
   * The Template for configure mybookingEngine
   *
   */
?>
    <!-- Initialize mybookingEngine -->
    <script type="text/javascript">
      window.mybookingEngine = function(){
        var siteURL = '<?php echo esc_url( get_site_url() ) ?>';     
        var baseURL = '<?php echo esc_url( $args['mybooking_api_url_prefix'] )?>';
        var apiKey = '<?php echo esc_js( $args['mybooking_api_key'] )?>';
        // Renting
        var extrasStep = false;
        var chooseProductUrl = '<?php echo esc_url( $args['mybooking_choose_products_page'] )?>';
        var chooseExtrasUrl = '<?php echo esc_url( $args['mybooking_choose_extras_page'] )?>';
        var completeUrl = '<?php echo esc_url( $args['mybooking_checkout_page'] )?>';
        var summaryUrl = '<?php echo esc_url( $args['mybooking_summary_page'] )?>';
        var termsUrl = '<?php echo esc_url( $args['mybooking_terms_page'] )?>';
        var selectorInProcess = '<?php echo esc_url( $args['mybooking_selector_in_process'] )?>';
        // Activities
        var shoppingCartUrl = '<?php echo esc_url( $args['mybooking_activities_shopping_cart_page'] )?>';
        var orderUrl = '<?php echo esc_url( $args['mybooking_activities_summary_page'] )?>';  
        var activitiesTermsUrl = '<?php echo esc_url( $args['mybooking_activities_terms_page'] )?>'; 
        // Common
        <?php if ($args['mybooking_custom_loader'] == '1') { ?>
        var customLoader = true;
        <?php } else { ?>
        var customLoader = false;
        <?php } ?>
        // Select 2
        <?php if ($args['mybooking_js_select2'] == '1') { ?>
        var jsUseSelect2 = true;
        <?php } else { ?>
        var jsUseSelect2 = false;
        <?php } ?> 
        // Modal JS compatibility
        <?php if ($args['mybooking_js_bs_modal_no_conflict'] == '1') { ?>
        var jsBsModalNoConflict = true;
        <?php } else { ?>
        var jsBsModalNoConflict = false;
        <?php } ?>  
        <?php if ($args['mybooking_js_bs_modal_backdrop_compatibility'] == '1') { ?>
        var jsBsModalBackdropCompatibility = true;
        <?php } else { ?>
        var jsBsModalBackdropCompatibility = false;  
        <?php } ?>  
        // Google Integration
        <?php if ($args['mybooking_google_api_places']) { ?>
        var useGoogleMaps = true;
        var googleMapsSettings = {
          apiKey: '<?php echo esc_js( $args['mybooking_google_api_places_api_key'] )?>',
          settings: {
            googleMapsRestrictCountryCode: '<?php echo esc_js( $args['mybooking_google_api_places_restrict_country_code'] )?>',
            <?php if ($args['mybooking_google_api_places_restrict_bounds']) { ?>
            googlePlacesRetrictBounds: true,
            googleMapsBoundsSWLat: <?php echo ( $args['mybooking_google_api_places_bounds_sw_lat'] ? esc_js( $args['mybooking_google_api_places_bounds_sw_lat'] ) : 0 ) ?>,
            googleMapsBoundsSWLng: <?php echo ( $args['mybooking_google_api_places_bounds_sw_lng'] ? esc_js( $args['mybooking_google_api_places_bounds_sw_lng'] ) : 0 ) ?>,
            googleMapsBoundsNELat: <?php echo ( $args['mybooking_google_api_places_bounds_ne_lat'] ? esc_js( $args['mybooking_google_api_places_bounds_ne_lat'] ) : 0 ) ?>,
            googleMapsBoundsNELng: <?php echo ( $args['mybooking_google_api_places_bounds_ne_lng'] ? esc_js( $args['mybooking_google_api_places_bounds_ne_lng'] ) : 0 ) ?>            
            <?php } else { ?>
            googlePlacesRetrictBounds: false
            <?php } ?>  
          }
        };
        <?php } else { ?>
        var useGoogleMaps = false;
        <?php } ?> 
        function getSiteURL() {
          return siteURL;
        }
        function getBaseURL() {
          return baseURL;
        }
        function getApiKey() {
          return apiKey;
        }
        // -- Renting
        function getExtrasStep() {
          return extrasStep;
        }
        function getChooseProductUrl() {
          return chooseProductUrl;
        }
        function getChooseExtrasUrl() {
          return chooseExtrasUrl;
        }
        function getCompleteUrl() {
          return completeUrl;
        }
        function getSummaryUrl() {
          return summaryUrl;
        }
        function getTermsUrl() {
          return termsUrl;
        }
        function getSelectorInProcess() {
          return selectorInProcess;
        }
        // -- Activities
        function getShoppingCartUrl() {
          return shoppingCartUrl;
        }
        function getOrderUrl() {
          return orderUrl;
        }       
        function getActivitiesTermsUrl() {
          return activitiesTermsUrl;
        }        
        // -- Utilities
        function getCustomLoader() {
          return customLoader;
        }
        function getJsUseSelect2() {
          return jsUseSelect2;
        }
        function getJsBsModalNoConflict(){
          return jsBsModalNoConflict;
        }
        function getJsBsModalBackdropCompatibility(){
          return jsBsModalBackdropCompatibility;
        }
        <?php if ($args['mybooking_google_api_places']) { ?>
        function getUseGoogleMaps() {
          return useGoogleMaps;
        }
        function getGoogleMapsSettings() {
          return googleMapsSettings;
        }
        <?php } ?>
        return{
          siteURL: getSiteURL,
          baseURL: getBaseURL,
          apiKey: getApiKey,
          <?php if ($args['mybooking_google_api_places']) { ?>   
          // Google API Integration       
          useGoogleMaps: getUseGoogleMaps,
          googleMapsSettings: getGoogleMapsSettings,  
          <?php } ?>         
          // Renting   
          extrasStep: getExtrasStep,
          chooseProductUrl: getChooseProductUrl,
          chooseExtrasUrl: getChooseExtrasUrl,
          completeUrl: getCompleteUrl,
          summaryUrl: getSummaryUrl,
          termsUrl: getTermsUrl,
          selectorInProcess: getSelectorInProcess,
          // Activities
          shoppingCartUrl: getShoppingCartUrl,
          orderUrl: getOrderUrl,
          activitiesUrl: getActivitiesTermsUrl,
          // Common
          customLoader: getCustomLoader,  
          jsUseSelect2: getJsUseSelect2,
          jsBsModalNoConflict: getJsBsModalNoConflict,
          jsBsModalBackdropCompatibility: getJsBsModalBackdropCompatibility         
        }
      }();
    </script> 