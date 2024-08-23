<?php

namespace App\Controller;

use App\Http\Request;
use App\Http\Response;
use App\Model\Category;
use App\Model\User;
use App\Service\View;
use App\Model\BlogPost;
use DateTime;

class HomeController
{
    public function __construct()
    {
        // Start the session for all requests to the controller
        session_start();
    }

    /**
     * @throws \Exception
     */
    public function index(Request $request)
    {
        $title = 'Home - My Blog';
        $blogs = BlogPost::getAll();

        foreach ($blogs as &$blog) {
            $user = User::getById($blog['user_id']);
            if ($user) {
                $blog['username'] = $user['username'];
            }

            $date = new DateTime($blog['publication_date']);

            $dateOnly = $date->format('d-m-Y');

            $blog['publication_date'] = $dateOnly;

            $category = Category::getCategoryById($blog['category_id']);

            if ($category) {
                $blog['category_name'] = $category['name'];
            }
        }

        $categories = Category::getCategories();

        $view = new View(__DIR__ . '/../../templates/pages/home.php', $title, ['blogs' => $blogs, 'categories' => $categories]);

        return new Response($view->render());
    }
}
