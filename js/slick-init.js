(function( root, $, undefined ) {
  "use strict";

  $(function () {

    var windowWidth = $(window).width();

    if(windowWidth < 576) {
      var menuWidth = windowWidth - 50;
    } else if(windowWidth < 992) {
      var menuWidth = windowWidth/2;
    } else if(windowWidth < 1200) {
      var menuWidth = 400;
    } else {
      var menuWidth = 400;
    }

    $(document).ready(function(){

    });



    $(document).ready(function() {
      $(document).on('click', '.slider-toggle', function() {
        var postID = $(this).attr('data-postID');
        $('.slider-toggle').not(this).removeClass('current');
        $(this).addClass('current');

        $.ajax({
          type : 'post',
          dataType : 'json',
          url : seigalAjax.ajaxurl,
          data : {
            action : 'seigal_get_object_slider',
            postID : postID
          },
          beforeSend : function(e) {
            var height = $('.object-archive-slider').height();
            console.log(height);
            $('.object-archive-slider').height(height + 'px');
            $('.object-archive-slider').html('<div class="loading"><div><i class="fal fa-circle-notch fa-spin"></i></div></div>');
          },
          success : function(responce) {
            if(responce.success == true) {
              $('.object-archive-slider').height('unset').html(responce.data).promise().done(function(){
                $('.object-slides').slick({
                  arrows : true,
                  dots : false,
                  slidesToShow : 1,
                  centerMode : false,
                  infinite : false,
                  nextArrow: $('.slide-controls .slide-next'),
        					prevArrow: $('.slide-controls .slide-prev'),

        					// appendDots: $('.object-slides .slide-dots'),
                });
                $(document).on('click', '.slide-nav', function() {
                  var slideID = $(this).attr('data-slide');
                  $('.object-slides').slick('slickGoTo', slideID, false);
                  $('.slide-nav').not(this).removeClass('current');
                  $(this).addClass('current');
                });
                $('.object-slides').on('beforeChange', function(event, slick, currentSlide, nextSlide){
                  $('.slide-nav[data-slide="' + currentSlide + '"]').removeClass('current');
                  $('.slide-nav[data-slide="' + nextSlide + '"]').addClass('current');
                });
                $('html, body').animate({
                  scrollTop: $('.object-archive-slider').offset().top - 60
                }, 'slow');
              });

            }
          },

        })
      });

    });





    $(document).on('click', '.slide-toggle', function(e) {

    });

  });


} ( this, jQuery ));
