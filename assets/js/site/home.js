const $ = jQuery.noConflict();

'use strict';
const Home = {

    // Initialize
    init: function() {
        this.bindLoginLinkClick();
        this.bindPopupCloseClick();
        this.bindWindowClick();
        this.bindFormSubmit('.js-login-form');
        this.bindFormSubmit('.js-login-popup');
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
    },

    bindFormSubmit: function(selector) {
        $(selector).on('submit', function(event) {
            // Clear previous errors
            $('.error-message').remove();

            // Validate fields
            let isValid = true;
            if (!Home.validateUsername()) {
                isValid = false;
            }
            if (!Home.validatePassword()) {
                isValid = false;
            }

            if (!isValid) {
                event.preventDefault(); // Prevent form submission if validation fails
            }
        });
    },

    validateUsername: function() {
        const username = $('#username').val().trim();
        if (!username) {
            $('#username').after('<div class="error-message">Username is required.</div>');
            return false;
        }
        return true;
    },

    validatePassword: function() {
        const password = $('#password').val().trim();
        if (!password) {
            $('#password').after('<div class="error-message">Password is required.</div>');
            return false;
        }
        return true;
    }
};

export default Home;
