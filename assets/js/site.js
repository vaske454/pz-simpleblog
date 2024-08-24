import '../css/globals.css';
import Login from './site/login';
import Register from './site/register';
import SingleBlogPopup from './site/singleBlogPopup';
import AddComment from './site/addComment';
import ViewComments from './site/viewComments';
import CreateBlog from './site/createBlog';

// DOM ready
jQuery(function() {
    Login.init();
    Register.init();
    SingleBlogPopup.init();
    AddComment.init();
    ViewComments.init();
    CreateBlog.init();
});