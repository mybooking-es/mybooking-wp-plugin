      window.mybookingEngine = function(){
        var siteURL = mybooking_init_vars.mybooking_site_url;     
        var baseURL = mybooking_init_vars.mybooking_api_url_prefix;
        var apiKey = mybooking_init_vars.mybooking_api_key;
        // Renting
        var extrasStep = false;
        var chooseProductUrl = mybooking_init_vars.mybooking_choose_products_page;
        var chooseExtrasUrl = mybooking_init_vars.mybooking_choose_extras_page;
        var completeUrl = mybooking_init_vars.mybooking_checkout_page;
        var summaryUrl = mybooking_init_vars.mybooking_summary_page;
        var termsUrl = mybooking_init_vars.mybooking_terms_page;
        var selectorInProcess = mybooking_init_vars.mybooking_selector_in_process;
        // Activities
        var shoppingCartUrl = mybooking_init_vars.mybooking_activities_shopping_cart_page;
        var orderUrl = mybooking_init_vars.mybooking_activities_summary_page;  
        var activitiesTermsUrl = mybooking_init_vars.mybooking_activities_terms_page; 
        // Common
        var customLoader = mybooking_init_vars.mybooking_custom_loader;
        // Select 2
        var jsUseSelect2 = mybooking_init_vars.mybooking_js_select2;
        // Modal JS compatibility
        var jsBsModalNoConflict = mybooking_init_vars.mybooking_js_bs_modal_no_conflict;
        var jsBsModalBackdropCompatibility = mybooking_init_vars.mybooking_js_bs_modal_backdrop_compatibility;
        // Google Integration
        if (mybooking_init_vars.mybooking_google_api_places == 'true') {
          var useGoogleMaps = true;
          var googleMapsSettings = {
            apiKey: mybooking_init_vars.mybooking_google_api_places_api_key,
            settings: {
              googleMapsRestrictCountryCode: mybooking_init_vars.mybooking_google_api_places_restrict_country_code
            }
          };
          if (mybooking_init_vars.mybooking_google_api_places_restrict_bounds == 'true') {
            googleMapsSettings.settings.googlePlacesRetrictBounds = true;       
            googleMapsSettings.settings.googleMapsBoundsSWLat = (parseFloat(mybooking_init_vars.mybooking_google_api_places_bounds_sw_lat) || 0);
            googleMapsSettings.settings.googleMapsBoundsSWLng = (parseFloat(mybooking_init_vars.mybooking_google_api_places_bounds_sw_lng) || 0);
            googleMapsSettings.settings.googleMapsBoundsNELat = (parseFloat(mybooking_init_vars.mybooking_google_api_places_bounds_ne_lat) || 0);
            googleMapsSettings.settings.googleMapsBoundsNELng = (parseFloat(mybooking_init_vars.mybooking_google_api_places_bounds_ne_lng) || 0);
          }
          else {
            googleMapsSettings.settings.googlePlacesRetrictBounds = false;  
          }
        }
        else {
          var useGoogleMaps = false;
        }
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
        function getUseGoogleMaps() {
          return useGoogleMaps;
        }
        function getGoogleMapsSettings() {
          return googleMapsSettings;
        }

        var result = {
          siteURL: getSiteURL,
          baseURL: getBaseURL,
          apiKey: getApiKey,
          // Google API Integration       
          useGoogleMaps: getUseGoogleMaps,
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

        if (mybooking_init_vars.mybooking_google_api_places) {
          result.googleMapsSettings = getGoogleMapsSettings;  
        }

        return result;
      }();