<?php

namespace App\Controller;

use App\Model\ProductManager;

class ProductController extends AbstractController
{
    public function index(): string
    {
        $allProducts = new ProductManager();
        $products = $allProducts->selectAll();

        return $this->twig->render('Product/index.html.twig', ['products' => $products]);
    }
}
