jQuery(document).ready(function () {
  
  // Promotion Popup
  if (jQuery('.mybooking-popup_close.close').length > 0) {
	  jQuery('.mybooking-popup_close.close').bind('click', function() {
	  	document.getElementById( "MybookingPromotionsPopup" ).style.visibility="hidden"
	  });
  }

  // Testimonials
  if (jQuery(".-carrusel-testimonials").length > 0) {
	  jQuery(".-carrusel-testimonials").slick({
	    slidesToShow: 1,
	    slidesToScroll: 1,
	    autoplay: true,
	    autoplaySpeed: 4000,
	    arrows: false,
	  });
  }

  // Cookies  
  if (jQuery("#cookie-notice").length > 0) {
  	if (jQuery("#cookie-notice_button").length > 0) {
  		jQuery("#cookie-notice_button").bind('click', function() {
		  document.cookie="mb_cookieaccepted=1; expires=Thu, 18 Dec 2030 12:00:00 UTC; path=/";
		  document.getElementById( "cookie-notice" ).style.visibility="hidden";
  		});
  	}
	document.cookie.indexOf( "mb_cookieaccepted" ) < 0 && ( document.getElementById( "cookie-notice" ).style.visibility="visible" );
  }

});
