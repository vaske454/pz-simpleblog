const $ = jQuery.noConflict();

'use strict';

const SingleBlogPopup = {

    popupBlogTitle: $('#popup-blog-title'),
    popupBlogContent: $('#popup-blog-content'),
    popupBlogCategory: $('#popup-blog-category'),

    // Initialize
    init: function () {
        this.bindEvents();
    },

    // Bind Events
    bindEvents: function () {
        $('.blog-item-link').on('click', this.handleBlogClick);
        $('.blog-popup-close').on('click', this.closeBlogPopup);
        $('#update-blog-form').on('submit', this.validateForm);
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
        SingleBlogPopup.popupBlogTitle.val(blog.title);
        $('#popup-blog-author').text(blog.username || 'Unknown Author');
        $('#popup-blog-date').text(blog.publication_date);
        SingleBlogPopup.popupBlogContent.text(blog.content);
        $('#popup-blog-id').val(blog.id);
        $('#delete-blog-id').val(blog.id);

        // Set selected category
        if (blog.category_id) {
            SingleBlogPopup.popupBlogCategory.val(blog.category_id);
        }

        if (blog.is_my_post) {
            $('#save-blog-button').show();
            $('#delete-blog-form').show();

            SingleBlogPopup.popupBlogTitle.prop('disabled', false);
            SingleBlogPopup.popupBlogContent.prop('disabled', false);
            SingleBlogPopup.popupBlogCategory.prop('disabled', false);
        } else {
            $('#save-blog-button').hide();
            $('#delete-blog-form').hide();

            SingleBlogPopup.popupBlogTitle.prop('disabled', true);
            SingleBlogPopup.popupBlogContent.prop('disabled', true);
            SingleBlogPopup.popupBlogCategory.prop('disabled', true);
        }


        $('#blog-popup').show();
    },

    // Close Blog Popup
    closeBlogPopup: function () {
        $('#blog-popup').hide();
    },

    // Validate Form
    validateForm: function (event) {
        // Clear previous error messages
        $('.error-message').remove();

        let isValid = true;

        // Validate title
        const title = SingleBlogPopup.popupBlogTitle.val().trim();
        if (title === '') {
            isValid = false;
            $('#popup-blog-title').after('<span class="error-message" style="color: red;">Title is required.</span>');
        }

        // Validate content
        const content = SingleBlogPopup.popupBlogContent.val().trim();
        if (content === '') {
            isValid = false;
            $('#popup-blog-content').after('<span class="error-message" style="color: red;">Content is required.</span>');
        }

        // Validate category
        const category = SingleBlogPopup.popupBlogCategory.val();
        if (!category) {
            isValid = false;
            $('#popup-blog-category').after('<span class="error-message" style="color: red;">Category is required.</span>');
        }

        // If the form is not valid, prevent form submission
        if (!isValid) {
            event.preventDefault();
        }
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