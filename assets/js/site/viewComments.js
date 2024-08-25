const $ = jQuery.noConflict();

'use strict';
const ViewComments = {

    // Initialize
    init: function() {
        if ($('.js-view-comments').length > 0) {
            this.bindViewCommentsLinkClick();
        }
        if ($('.js-view-comments-close-popup').length > 0) {
            this.bindViewCommentsPopupCloseClick();
        }
        this.bindWindowClick();
    },

    bindViewCommentsLinkClick: function() {
        $('.js-view-comments').on('click', function(event) {
            event.preventDefault();
            // Get blog ID from data attribute
            const blogId = $(this).data('id');

            // Show the specific popup
            $(`#view-comments-popup-${blogId}`).css('display', 'flex');
        });
    },

    bindViewCommentsPopupCloseClick: function() {
        $('.js-view-comments-close-popup').on('click', function() {
            $(this).closest('.js-view-comments-popup').css('display', 'none');
        });
    },

    bindWindowClick: function() {
        $(window).on('click', function(event) {
            if ($(event.target).is('.js-view-comments-popup')) {
                $(event.target).css('display', 'none');
            }
        });
    }
}

export default ViewComments;