const $ = jQuery.noConflict();

'use strict';

const SingleBlogPopup = {

    // Initialize
    init: function () {
        this.bindEvents();
    },

    // Bind Events
    bindEvents: function () {
        $('.blog-item-link').on('click', this.handleBlogClick);
        $('.blog-popup-close').on('click', this.closeBlogPopup);
        this.bindWindowClick();
    },

    // Handle Blog Click
    handleBlogClick: function (event) {
        event.preventDefault();

        const blogData = $(event.currentTarget).data('blog');
        SingleBlogPopup.openBlogPopup(blogData);
    },

    // Open Blog Popup
    openBlogPopup: function (blog) {
        console.log(blog);
        $('#popup-blog-title').val(blog.title);
        $('#popup-blog-author').text(blog.username || 'Unknown Author');
        $('#popup-blog-date').text(blog.publication_date);
        $('#popup-blog-content').text(blog.content);
        $('#popup-blog-id').val(blog.id);
        $('#delete-blog-id').val(blog.id);

        // Set selected category
        if (blog.category_id) {
            $('#popup-blog-category').val(blog.category_id);
        }
        // $('#popup-blog-category').val(blog.category_name || 'N/A');

        $('#blog-popup').show();
    },

    // Close Blog Popup
    closeBlogPopup: function () {
        $('#blog-popup').hide();
    },

    bindWindowClick: function() {
        $(window).on('click', function(event) {
            if ($(event.target).is('#blog-popup')) {
                $('#blog-popup').hide();
            }
        });
    },
};

export default SingleBlogPopup;