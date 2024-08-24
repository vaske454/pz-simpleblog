const $ = jQuery.noConflict();

'use strict';
const CreateBlog = {

    // Initialize
    init: function () {
        this.bindFormValidation();
    },

    // Function to bind form validation
    bindFormValidation: function () {
        const form = $('#create-blog-form');
        const titleInput = $('#blog-title');
        const contentTextarea = $('#blog-content');
        const titleError = $('#title-error');
        const contentError = $('#content-error');

        form.on('submit', function (event) {
            let isValid = true;

            // Reset error messages
            titleError.text('');
            contentError.text('');
            titleError.hide();
            contentError.hide();

            // Validate Title
            if (titleInput.val().trim().length < 1) {
                titleError.text('Title must be at least 1 character long.');
                titleError.show();
                isValid = false;
            }

            // Validate Content
            if (contentTextarea.val().trim().length < 1) {
                contentError.text('Content must be at least 1 character long.');
                contentError.show();
                isValid = false;
            }

            // Prevent form submission if there are errors
            if (!isValid) {
                event.preventDefault();
            }
        });
    }
};

export default CreateBlog;