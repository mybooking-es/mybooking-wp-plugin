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
        var useGoogleMaps = mybooking_init_vars.mybooking_google_api_places;
        var googleMapsSettings = {
          apiKey: mybooking_init_vars.mybooking_google_api_places_api_key,
          settings: {
            googleMapsRestrictCountryCode: mybooking_init_vars.mybooking_google_api_places_restrict_country_code,
          }
        };
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
          googleMapsSettings: getGoogleMapsSettings,  
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
        return result;
      }();