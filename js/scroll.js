// Project : Fatdonald's
// File: scroll.js
// Authors: Jeffrey

jQuery(document).ready(function ($) {
    // scroll Up
    $(window).scroll(function () {
        if ($(this).scrollTop() > 600) {
            $('.scrollup').fadeIn('slow');
        } else {
            $('.scrollup').fadeOut('slow');
        }
    });
    
    $('.scrollup').click(function () {
        $("html, body").animate({scrollTop: 0}, 1000);
        return false;
    });
});