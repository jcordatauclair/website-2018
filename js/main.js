$(function() {

  $('.probootstrap-main .card-columns .card a').click(function(e) {
    e.preventDefault();
    $('.lightbox').fadeIn(300);
    var srcImg = $('img', this).attr('src');
    $('.middle').css('background-image', 'url("' + srcImg + '")');

    // Mobile
    if ($(window).width() < 768) {
      $('.middle').css('margin-left', 'auto');
      $('.middle').css('margin-right', 'auto');
      $('.middle').css('margin-top', '20px');
      $('.close').css('visibility', 'hidden');
    }

    $('html').css('overflow-y', 'scroll');
    $('html').css('overflow-x', 'auto');
  });

  // Mobile
  if ($(window).width() < 768) {
    $('.lightbox').click(function() {
      $('.lightbox').fadeOut(300);
      setTimeout(function() {
        $('html').css('overflow-y', 'scroll');
        $('html').css('overflow-x', 'auto');
        $('html').css('position', 'absolute');
      }, 300);
    });
  }

  $('.close').click(function() {
    $('.lightbox').fadeOut(300);
    setTimeout(function() {
      $('html').css('overflow-y', 'scroll');
      $('html').css('overflow-x', 'auto');
      $('html').css('position', 'absolute');
    }, 300);
  });

  $(document).keyup(function(e) {
    if (e.keyCode == 27) {
      $('.lightbox').fadeOut(300);
      setTimeout(function() {
        $('html').css('overflow-y', 'scroll');
        $('html').css('overflow-x', 'auto');
      }, 300);
    }
  });

  'use strict';

  var carousel = function() {
    $('.owl-carousel').owlCarousel({
      loop: true,
      margin: 10,
      nav: true,
      stagePadding: 5,
      navText: ['<span class="icon-chevron-left">', '<span class="icon-chevron-right">'],
      responsive: {
        0: {
          items: 1
        },
        600: {
          items: 2
        },
        1000: {
          items: 3
        }
      }
    });
  }
  carousel();

  var toggleMenu = function() {
    var aside = $('.js-probootstrap-aside'),
      main = $('.js-probootstrap-main');
    $('.js-probootstrap-toggle').on('click', function(e) {
      aside.addClass('active');
      main.addClass('mobile-open');
      e.preventDefault();
    });
    $('.js-probootstrap-close-menu').on('click', function(e) {
      aside.removeClass('active');
      main.removeClass('mobile-open');
      e.preventDefault();
    });

    $(document).mouseup(function(e) {
      var container = $(".probootstrap-aside");
      if (!container.is(e.target) && container.has(e.target).length === 0) {
        aside.removeClass('active');
        main.removeClass('mobile-open');
      }
    });

  };
  toggleMenu();

  var contentWayPoint = function() {
    var i = 0;
    jQuery('.probootstrap-animate').waypoint(function(direction) {

      if (direction === 'down' && !jQuery(this.element).hasClass('probootstrap-animated')) {

        i++;

        jQuery(this.element).addClass('item-animate');
        setTimeout(function() {

          jQuery('body .probootstrap-animate.item-animate').each(function(k) {
            var el = jQuery(this);
            setTimeout(function() {
              var effect = el.data('animate-effect');
              if (effect === 'fadeIn') {
                el.addClass('fadeIn probootstrap-animated');
              } else if (effect === 'fadeInLeft') {
                el.addClass('fadeInLeft probootstrap-animated');
              } else if (effect === 'fadeInRight') {
                el.addClass('fadeInRight probootstrap-animated');
              } else {
                el.addClass('fadeInUp probootstrap-animated');
              }
              el.removeClass('item-animate');
            }, k * 50, 'easeInOutExpo');
          });

        }, 100);

      }

    }, {
      offset: '95%'
    });
  };
  contentWayPoint();

  if ($('.probootstrap-main').length > 0) {
    $('.probootstrap-main').imagesLoaded({

      },
      function() {
        if ($('.card').length > 0) {
          $('.card').addClass('img-loaded');
        }
      }
    );
  }
});
