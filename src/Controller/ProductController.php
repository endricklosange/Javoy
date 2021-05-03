<?php

namespace App\Controller;

use App\Model\ProductManager;

class ProductController extends AbstractController
{
    public function index(): string
    {
        $AllProducts = new ProductManager();
        $products = $AllProducts->selectAll();

        return $this->twig->render('Product/index.html.twig', ['products' => $products]);
    }
}