<?php

namespace App\Controller;

use App\Model\ProductManager;

class PanierController extends AbstractController
{

    public function add(int $id)
    {
        $productManager = new ProductManager();
        $product = $productManager->selectOneById($id);
        if ($product) {
            $_SESSION['panier'][$id] = $product;
        }
        header('Location: /Panier/index');
    }
    public function index()
    {
        $products = $_SESSION['panier'] ?? [];
        return $this->twig->render('Panier/index.html.twig',['products' => $products]);
    }
}
