const $ = jQuery.noConflict();

'use strict';
const PageNotFound = {

    // Initialize
    init: function() {
        if ($('.js-not-found-container').length > 0) {
            this.addOverflowHidden();
        }
    },

    addOverflowHidden: function() {
        $('body').addClass('no-scroll');
    }
};

export default PageNotFound;