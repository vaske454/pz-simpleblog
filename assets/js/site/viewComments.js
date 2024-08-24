const $ = jQuery.noConflict();

'use strict';
const ViewComments = {

    // Initialize
    init: function() {
        this.bindViewCommentsLinkClick();
        this.bindViewCommentsPopupCloseClick();
        this.bindWindowClick();
    },

    bindViewCommentsLinkClick: function() {
        $('.js-view-comments').on('click', function(event) {
            event.preventDefault();
            // Get blog ID from data attribute
            const blogId = $(this).data('id');
            console.log(blogId);

            // Show the specific popup
            $(`#view-comments-popup-${blogId}`).css('display', 'flex');
        });
    },

    bindViewCommentsPopupCloseClick: function() {
        $(document).on('click', '.js-view-comments-close-popup', function() {
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