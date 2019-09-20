	  <!-- Initialize mybookingEngine -->
	  <script type="text/javascript">
      window.mybookingEngine = function(){
        var baseURL = 'https://<?php echo $args['mybooking_account_id']?>.mybooking.es';
        var apiKey = '<?php echo $args['mybooking_api_key']?>';
        var extrasStep = false;
        var chooseProductUrl = '/<?php echo $args['mybooking_choose_products_page']?>';
        var chooseExtrasUrl = '/<?php echo $args['mybooking_choose_extras_page']?>';
        var completeUrl = '/<?php echo $args['mybooking_checkout_page']?>';
        var summaryUrl = '/<?php echo $args['mybooking_summary_page']?>';
        function getBaseURL() {
          return baseURL;
        }
        function getApiKey() {
          return apiKey;
        }
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
        return{
          baseURL: getBaseURL,
          apiKey: getApiKey,
          extrasStep: getExtrasStep,
          chooseProductUrl: getChooseProductUrl,
          chooseExtrasUrl: getChooseExtrasUrl,
          completeUrl: getCompleteUrl,
          summaryUrl: getSummaryUrl
        }
      }();
    </script> 