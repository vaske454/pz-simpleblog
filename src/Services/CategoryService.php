<?php

namespace App\Services;

use App\Model\Category;

class CategoryService
{
    private $categoryModel;

    public function __construct()
    {
        $this->categoryModel = new Category();
    }

    public function ensureCategories()
    {
        $requiredCategories = ['Technology', 'Health', 'Travel', 'Lifestyle', 'Education'];

        foreach ($requiredCategories as $category) {
            if (!$this->categoryModel->categoryExists($category)) {
                $this->categoryModel->insertCategory($category);
            }
        }
    }
}
