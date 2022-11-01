<?php

namespace App\Controller;

use App\Model\ProductManager;
use App\Model\CategoryManager;

class CategoryController extends AbstractController
{
    public function index(): string
    {
        $categoryManager = new CategoryManager();
        $category = $categoryManager->selectAll();
        return $this->twig->render('Category/index.html.twig', ["categories" => $category]);
    }
    public function show(int $id)
    {
        $productManager = new ProductManager();
        $products =  $productManager->selectByIdCategory($id);

        return $this->twig->render('Category/show.html.twig', ['products' => $products]);
    }
}
