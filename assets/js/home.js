import '../css/home.css';
const $ = jQuery.noConflict();

'use strict';
const Home = {

    // Initialize
    init: function() {
        this.bindLoginLinkClick();
        this.bindPopupCloseClick();
        this.bindWindowClick();
    },

    bindLoginLinkClick: function() {
        $('#login-link').on('click', function(event) {
            event.preventDefault();
            $('#login-popup').css('display', 'flex');
        });
    },

    bindPopupCloseClick: function() {
        $('#popup-close').on('click', function() {
            $('#login-popup').css('display', 'none');
        });
    },

    bindWindowClick: function() {
        $(window).on('click', function(event) {
            if ($(event.target).is('#login-popup')) {
                $('#login-popup').css('display', 'none');
            }
        });
    }
};

// DOM ready
$(document).ready(function() {
    Home.init();
});
