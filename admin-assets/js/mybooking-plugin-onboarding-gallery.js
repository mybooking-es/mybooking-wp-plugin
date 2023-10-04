(function($) {
  $(document).ready(function() {

    // Wp i18n integration
    const { __, _x, _n, sprintf } = wp.i18n;

    // Data TODO
    var galleryURLS = {
      'mybooking_plugin_settings_home_test_page': [
        'vertical-selector.png',
      ],
      'mybooking_plugin_settings_choose_products_page': [
        'search-result.png',
      ],
      'mybooking_plugin_settings_checkout_page': [
        'checkout.png',
      ],
      'mybooking_plugin_settings_summary_page': [
        'summary.png'
      ],
      'rmybooking_plugin_settings_my_reservation_page': [
        'my-reservation.png'
      ],
      'mybooking_plugin_settings_activities_shopping_cart_page': [
        'checkout.png',
      ],
      'mybooking_plugin_settings_activities_summary_page': [
        'summary.png'
      ],
      'mybooking_plugin_settings_my_reservation_page': [
        'my-reservation.png'
      ],
      'mybooking_plugin_settings_home_test_page': [
        'vertical-selector.png',
      ],
      'mybooking_plugin_settings_transfer_choose_vehicle_page': [
        'choose-vehicle.png',
      ],
      'mybooking_plugin_settings_transfer_checkout_page': [
        'checkout.png',
      ],
      'mybooking_plugin_settings_transfer_summary_page': [
        'summary.png'
      ],
      'mybooking_plugin_settings_my_reservation_page': [
        'my-reservation.png'
      ],
      'selector': [
        'vertical-selector.png',
        'horizontal-selector.png'
      ],
      'catalog': [
        'catalog.png'
      ],
      'calendar': [
        'calendar.png',
      ],
      'planning-diary': [
        'planning-diary.png'
      ],
      'planning-calendar': [
        'planning-calendar.png'
      ],
      'planning-weekly': [
        'planning-weekly.png'
      ],
      'shift-picker': [
        'shift-picker.png'
      ],
    };

    /**
     * Gallery
     */
    // Get gallery data
    var folder = $('#mb-onboarding-gallery-container').attr('data-root-folder');

    // Append loading
    var form = $('#mb-onboarding-gallery-form');
    form.html('<div class="mb-onboarding-loading">' + _x('Loading ...', 'onboarding_context_js', 'mybooking-wp-plugin') + '</div>');

    /**
     * Buttons events
     */
    var container = $('#mb-onboarding-gallery-container');
    $('body').on('click', '.mb-onboarding-gallery-btn', function() {
      var element = $(this);
      var type = element.attr('data-type');
      var module = element.attr('data-module');
      var URLS = galleryURLS[type];

      var HTML = '';
      if (URLS && URLS.length > 0) {
        URLS.forEach(url => {
          HTML +=  '<input type="radio" name="selector" id="' + url + '" />';
        });
        URLS.forEach(url => {
          HTML += '<label for="' + url + '">';
          if (module) {
            HTML += '<img src="' + folder   + '/' + module + '/' + type + '/' + url + '" alt="image" />';
          } else {
            HTML += '<img src="' + folder + '/' + type + '/' + url + '" alt="image" />';
          }
          
          HTML +=   '</label>';
        });
      }

      // Append video
      form.html(HTML);

      container.show();
    });
    $('#mb-onboarding-close-btn').on('click', function() {
      container.hide();
      // Append loading
      form.html('<div class="mb-onboarding-loading">'+_x('Loading ...', 'onboarding_context_js', 'mybooking-wp-plugin')+'</div>');
    });
  });
})(jQuery);