<?php

namespace App\Controller;

use App\Model\ListProductManager;

class AdminListProductController extends AbstractController
{
    public function index(): string
    {
        $listProducts = new ListProductManager();
        $products = $listProducts->selectAll();

        return $this->twig->render('Admin/listProduct.html.twig', ['products' => $products]);
    }
}
