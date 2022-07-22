var THEMEIM = THEMEIM || {};

(function($) {




  // USE STRICT
  "use strict";

  THEMEIM.initialize = {

    init: function() {
      THEMEIM.initialize.general();
    },



    general: function() {

      //Product Single Details

      $('.slider-for').slick({
        slidesToShow: 1,
        slidesToScroll: 1,
        arrows: false,
        fade: true,
        asNavFor: '.slider-nav',
        swipe: false,
      });

      $('.slider-nav').slick({
        slidesToShow: 4,
        slidesToScroll: 1,
        asNavFor: '.slider-for',
        focusOnSelect: true,
        swipe: false,
        infinite: false,
        arrows: true,
      });
    }
  };

  THEMEIM.documentOnReady = {
    init: function() {
      THEMEIM.initialize.init();

    },
  };

})(jQuery);



