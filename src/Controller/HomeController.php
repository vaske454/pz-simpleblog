<?php

namespace App\Controller;

use App\Http\Request;
use App\Http\Response;
use App\Model\BlogPost;
use App\Model\Category;
use App\Model\User;
use App\View\View;
use DateTime;

class HomeController
{
    private $categoryModel;
    private $userModel;
    private $blogPostModel;

    public function __construct()
    {
        // Start the session for all requests to the controller
        session_start();
        $this->categoryModel = new Category();
        $this->userModel = new User();
        $this->blogPostModel = new BlogPost();
    }

    /**
     * @throws \Exception
     */
    public function index(Request $request)
    {
        $title = 'Home - My Blog';
        $blogs = $this->blogPostModel->getAll();
        $currentUser = $this->userModel->getCurrentUser();

        foreach ($blogs as &$blog) {
            $user = $this->userModel->getUsernameById($blog['user_id']);
            if ($user) {
                $blog['username'] = $user['username'];
            }

            $blog['is_my_post'] = ($blog['user_id'] === $currentUser['id']);

            $date = new DateTime($blog['publication_date']);
            $dateOnly = $date->format('d-m-Y');
            $blog['publication_date'] = $dateOnly;

            $category = $this->categoryModel->getCategoryById($blog['category_id']);
            if ($category) {
                $blog['category_name'] = $category['name'];
            }

            $comments = $this->blogPostModel->getCommentsById($blog['id']);
            if (!empty($comments)) {
                $blog['comments'] = $comments;
            }
        }

        $categories = $this->categoryModel->getCategories();

        $view = new View(__DIR__ . '/../../templates/pages/home.php', $title, ['blogs' => $blogs, 'categories' => $categories]);

        return new Response($view->render());
    }

    /**
     * @throws \Exception
     */
    public function filterByCategories(Request $request)
    {
        $selectedCategory = $request->get('category');
        $currentUser = $this->userModel->getCurrentUser();

        if (!empty($selectedCategory)) {
            $blogs = $this->blogPostModel->getByCategoryId($selectedCategory);
        } else {
            $blogs = $this->blogPostModel->getAll();
        }

        ob_start();
        foreach ($blogs as &$blog) {
            $user = $this->userModel->getUsernameById($blog['user_id']);
            if ($user) {
                $blog['username'] = $user['username'];
            }

            $blog['is_my_post'] = ($blog['user_id'] === $currentUser['id']);

            $date = new DateTime($blog['publication_date']);
            $dateOnly = $date->format('d-m-Y');
            $blog['publication_date'] = $dateOnly;

            $category = $this->categoryModel->getCategoryById($blog['category_id']);
            if ($category) {
                $blog['category_name'] = $category['name'];
            }

            $comments = $this->blogPostModel->getCommentsById($blog['id']);
            if (!empty($comments)) {
                $blog['comments'] = $comments;
            }

            include __DIR__ . '/../../templates/components/parts/blog-item/blog-item.php';
        }

        $html = ob_get_clean();

        return new Response($html);
    }
}
