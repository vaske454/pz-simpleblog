const $ = jQuery.noConflict();

'use strict';
const AddComment = {

    // Initialize
    init: function() {
        this.bindAddCommentLinkClick();
        this.bindAddCommentPopupCloseClick();
        this.bindWindowClick();
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
}

export default AddComment;
