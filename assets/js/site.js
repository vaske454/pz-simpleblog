import '../css/globals.css';
import Login from './site/login';
import Register from './site/register';
import SingleBlogPopup from './site/singleBlogPopup';

// DOM ready
jQuery(function() {
    Login.init();
    Register.init();
    SingleBlogPopup.init();
});