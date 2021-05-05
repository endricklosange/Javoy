<?php

namespace App\Controller;

use App\Model\ProductManager;
use App\Model\CategoryManager;

class ProductController extends AbstractController
{

    // Display list of products

    public function index()
    {
        $productManager = new ProductManager();
        $categoryProducts = $productManager->selectAllWithCategory();
        $categories = [];
        foreach ($categoryProducts as $categoryProduct) {
            $category = $categoryProduct['category_name'];
            $categories[$category][] = $categoryProduct;
        }

        return $this->twig->render('Product/index.html.twig', [
            'categories' => $categories,
        ]);
    }

    public function show(int $id)
    {
        $productManager = new ProductManager();
        $products =  $productManager->selectByIdCategory($id);

        return $this->twig->render('Product/show.html.twig', ['products' => $products]);
    }
}
