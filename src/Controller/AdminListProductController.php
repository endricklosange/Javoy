<?php

namespace App\Controller;

use App\Model\ListProductManager;

class AdminListProductController extends AbstractController
{
    public function index()
    {
        $listProducts = new ListProductManager();
        $products = $listProducts->selectAll();

        if (isset($_SESSION['role'])) {
            return $this->twig->render('Admin/listProduct.html.twig', ['products' => $products]);
        } else {
            header('Location:/');
        }
    }
}
