/*
* EduBlink - Education & Online Course Theme
* Version: 1.0
*/

(function($) {
    'use strict';

    // Preloader
    $(window).on('load', function() {
        $('#preloader').fadeOut(1000);
    });

    // Sticky Header
    $(window).on('scroll', function() {
        if ($(window).scrollTop() > 100) {
            $('.header-mainmenu').addClass('sticky');
        } else {
            $('.header-mainmenu').removeClass('sticky');
        }
    });

    // Mobile Menu
    $('.hamberger-button').on('click', function() {
        $('.mobile-menu-wrapper').addClass('show');
        $('body').addClass('menu-open');
    });

    $('.close-menu').on('click', function() {
        $('.mobile-menu-wrapper').removeClass('show');
        $('body').removeClass('menu-open');
    });

    // Dropdown Menu
    $('.has-droupdown > a').on('click', function(e) {
        e.preventDefault();
        $(this).siblings('.submenu').slideToggle();
        $(this).parent().toggleClass('active');
    });

    // Search Popup
    $('.search-btn').on('click', function() {
        $('.search-popup').addClass('show');
    });

    $('.close-search-popup').on('click', function() {
        $('.search-popup').removeClass('show');
    });

    // Back to Top
    $(window).on('scroll', function() {
        if ($(this).scrollTop() > 300) {
            $('.back-to-top').addClass('show');
        } else {
            $('.back-to-top').removeClass('show');
        }
    });

    $('.back-to-top').on('click', function() {
        $('html, body').animate({
            scrollTop: 0
        }, 800);
        return false;
    });

    // Course Slider
    if ($('.course-slider').length) {
        $('.course-slider').slick({
            dots: true,
            infinite: true,
            speed: 500,
            slidesToShow: 3,
            slidesToScroll: 1,
            autoplay: true,
            autoplaySpeed: 3000,
            arrows: false,
            responsive: [
                {
                    breakpoint: 992,
                    settings: {
                        slidesToShow: 2
                    }
                },
                {
                    breakpoint: 768,
                    settings: {
                        slidesToShow: 1
                    }
                }
            ]
        });
    }

    // Testimonial Slider
    if ($('.testimonial-slider').length) {
        $('.testimonial-slider').slick({
            dots: true,
            infinite: true,
            speed: 500,
            slidesToShow: 2,
            slidesToScroll: 1,
            autoplay: true,
            autoplaySpeed: 3000,
            arrows: false,
            responsive: [
                {
                    breakpoint: 768,
                    settings: {
                        slidesToShow: 1
                    }
                }
            ]
        });
    }

    // Counter Up
    if ($('.counter').length) {
        $('.counter').counterUp({
            delay: 10,
            time: 1000
        });
    }

    // Wow Animation
    if ($('.wow').length) {
        new WOW().init();
    }

})(jQuery); 