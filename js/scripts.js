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










				$(window).scroll(function() {
	        if ($(document).scrollTop() > 10) {
	          $('header.header').addClass('scrolled');
	        }
	        else {
	          $('header.header').removeClass('scrolled');
	        }
		    });

				$(document).on('click', '#mobileMenuToggle', function(e) {


					if($('#mobileMenu').hasClass('show')) {
						$('#mobileMenu').removeClass('show').css('height', '0px');
					} else {
						$('#mobileMenu').addClass('show').css('height', '100vh');
					}
					$(this).toggleClass('active');

				});


				$(document).on('click', '#mobileMenu li.menu-item-has-children a', function(e) {
					if($(this).parent().hasClass('menu-item-has-children')) {
						e.preventDefault();
					}
					$(this).parent().toggleClass('expanded');
				})


        jQuery('body').addClass('fade-in');


    });


} ( this, jQuery ));
