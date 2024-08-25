const $ = jQuery.noConflict();

'use strict';
const AddComment = {

    // Initialize
    init: function() {
        // Check if elements exist before binding events
        if ($('.js-add-comment').length > 0) {
            this.bindAddCommentLinkClick();
        }

        if ($('.add-comment-close-popup').length > 0) {
            this.bindAddCommentPopupCloseClick();
        }

        if ($('.js-add-comment-popup').length > 0) {
            this.bindWindowClick();
        }

        if ($('form[id^="add-comment-form-"]').length > 0) {
            this.bindCommentFormSubmit();
        }
    },

    bindAddCommentLinkClick: function() {
        $('.js-add-comment').on('click', function(event) {
            event.preventDefault();
            // Get blog ID from data attribute
            const blogId = $(this).data('id');
            // Show the specific popup
            $(`#add-comment-popup-${blogId}`).css('display', 'flex');
        });
    },

    bindAddCommentPopupCloseClick: function() {
        $(document).on('click', '.add-comment-close-popup', function() {
            $(this).closest('.js-add-comment-popup').css('display', 'none');
        });
    },

    bindWindowClick: function() {
        $(window).on('click', function(event) {
            if ($(event.target).is('.js-add-comment-popup')) {
                $(event.target).css('display', 'none');
            }
        });
    },

    bindCommentFormSubmit: function() {
        $('form[id^="add-comment-form-"]').on('submit', function(event) {
            const blogId = $(this).find('input[name="id"]').val();
            const commentTextarea = $(`#comment-text-${blogId}`);
            const errorMessageDiv = $(`#comment-error-message-${blogId}`);
            const content = commentTextarea.val().trim();

            // Validate input length
            if (content.length < 1) {
                errorMessageDiv.text('Comment must be at least 1 character long.').show();
                event.preventDefault(); // Prevent the form from submitting
            } else if (content.length > 500) {
                errorMessageDiv.text('Comment cannot exceed 500 characters.').show();
                event.preventDefault(); // Prevent the form from submitting
            } else {
                errorMessageDiv.hide(); // Hide the error message if validation passes
            }
        });
    },
}

export default AddComment;
