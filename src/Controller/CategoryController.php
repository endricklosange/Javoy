<?php

namespace App\Controller;

use App\Model\CategoryManager;

class CategoryController extends AbstractController
{
    public function index(): string
    {
        $categoryManager = new CategoryManager();
        $category = $categoryManager->selectAll();
        return $this->twig->render('Category/index.html.twig', ["categories" => $category]);
    }
}
