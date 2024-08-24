import SingleBlogPopup from './singleBlogPopup';
import ViewComments from "./viewComments";
import AddComment from "./addComment";

const $ = jQuery.noConflict();

'use strict';
const FilterByCategory = {
    init: function() {
        this.filterByCategory();
    },

    filterByCategory: function() {
        $('#blog-select-options').on('change', function() {
            const selectedCategory = $(this).val();

            $.ajax({
                url: '/filter-by-category',
                type: 'GET',
                data: { category: selectedCategory },
                success: function(data) {
                    $('.blog-items-container').html(data);
                    SingleBlogPopup.init();
                    ViewComments.init();
                    AddComment.init();
                },
                error: function(xhr, status, error) {
                    console.error('AJAX greška:', status, error);
                }
            });
        });
    }
};

export default FilterByCategory;
