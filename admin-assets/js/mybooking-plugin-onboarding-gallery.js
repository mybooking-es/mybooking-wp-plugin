(function($) {
  $(document).ready(function() {

    // Wp i18n integration
    const { __, _x, _n, sprintf } = wp.i18n;

    // TODO Data
    var galleryURLS = {
      'home-test': [
        'home-test.png',
      ],
      'choose-products': [
        'choose-products.png',
      ],
      'checkout': [
        'checkout.png',
      ],
      'shopping-cart': [
        'checkout.png',
      ],
      'summary': [
        'summary.png'
      ],
      'my-reservation': [
        'my-reservation.png'
      ],
      'selector': [
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

      // Remove pre and post substrings getting folder name
      if ( type.endsWith("_page") ) {
        var regExp = /mybooking_plugin_settings_(.*?)_page/;
        if ( type.includes('_activities_') ) {
          regExp = /mybooking_plugin_settings_activities_(.*?)_page/;
        } else if ( type.includes('_transfer_') ) {
          regExp = /mybooking_plugin_settings_transfer_(.*?)_page/;
        }

        var matches = type.match( regExp );
        if ( matches && matches.length > 1 ) {
          type = matches[1];
          type = type.replace(/_/g, '-');
        }
      }

      var URLS = galleryURLS[type];

      var HTML = '';
      if (URLS && URLS.length > 0) {
        URLS.forEach(url => {
          HTML +=  '<input type="radio" name="selector" id="' + url + '" />';
        });
        URLS.forEach(url => {
          HTML += '<label for="' + url + '">';
          HTML += '<img src="' + folder + '/' + type + '/' + url + '" alt="image" />';
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