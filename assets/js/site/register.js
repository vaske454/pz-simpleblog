const $ = jQuery.noConflict();

'use strict';
const Register = {

    // Initialize
    init: function() {
        // Check if the toggle password button exists before binding click event
        if ($('.js-toggle-password').length > 0) {
            this.bindTogglePassword();
        }

        // Check if the register form exists before binding submit event
        if ($('.js-register-form').length > 0) {
            this.bindFormSubmit();
        }
    },

    bindTogglePassword: function() {
        $('.js-toggle-password').on('click', function() {
            const passwordField = $('#password');
            const type = passwordField.attr('type') === 'password' ? 'text' : 'password';
            passwordField.attr('type', type);
            $(this).text(type === 'password' ? 'Show' : 'Hide');
        });
    },

    bindFormSubmit: function() {
        $('.js-register-form').on('submit', function(event) {
            // Clear previous errors
            $('.error-message').remove();

            // Validate fields
            let isValid = true;

            if (!Register.validateUsername()) {
                isValid = false;
            }

            if (!Register.validatePassword()) {
                isValid = false;
            }

            // Prevent form submission if validation fails
            if (!isValid) {
                event.preventDefault();
            }
        });
    },

    validateUsername: function() {
        const username = $('.js-username').val().trim();
        if (!username) {
            $('#username').after('<div class="error-message">Username is required.</div>');
            return false;
        }

        if (username.length < 3 || username.length > 30) {
            $('#username').after('<div class="error-message">Username must be 3-30 characters long.</div>');
            return false;
        }

        const usernamePattern = /^[a-zA-Z0-9._-]{3,30}$/;

        if (!usernamePattern.test(username)) {
            $('#username').after('<div class="error-message">Username must be 3-30 characters long and can only include letters, numbers, dots, underscores, and hyphens.</div>');
            return false;
        }

        return true;
    },

    validatePassword: function() {
        const password = $('.js-password').val().trim();
        if (!password) {
            $('.password-container').after('<div class="error-message">Password is required.</div>');
            return false;
        }

        if (password.length < 8 || password.length > 32) {
            $('.password-container').after('<div class="error-message">Password must be 8-32 characters long.</div>');
            return false;
        }

        const pattern = /^(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).{8,32}$/;

        if (!pattern.test(password)) {
            $('.password-container').after('<div class="error-message">Password must be 8-32 characters long, contain at least one uppercase letter, one number, and one special character.</div>');
            return false;
        }

        return true;
    },
};

export default Register;
