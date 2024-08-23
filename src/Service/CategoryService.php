<?php

namespace App\Service;

use App\Model\Category;

class CategoryService
{

    public function ensureCategories()
    {
        $requiredCategories = ['Technology', 'Health', 'Travel', 'Lifestyle', 'Education'];

        foreach ($requiredCategories as $category) {
            if (!Category::categoryExists($category)) {
                Category::insertCategory($category);
            }
        }
    }
}
