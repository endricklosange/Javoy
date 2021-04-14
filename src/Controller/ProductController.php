<?php

namespace App\Controller;

use App\Model\ProductManager;

class ProductController extends AbstractController
{
    public function index(): string
    {
        $productManager = new ProductManager();
        $products = $productManager->selectAll();
        return $this->twig->render("Item/_listProducts.html.twig", ["products" => $products]);
    }
}