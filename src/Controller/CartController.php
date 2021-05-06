<?php

namespace App\Controller;

use App\Model\ProductManager;

class CartController extends AbstractController
{
    public function index()
    {
        $products = $_SESSION['cart'] ?? [];
        return $this->twig->render('Cart/index.html.twig', ['products' => $products]);
    }
    public function add(int $id)
    {
        $this->increment($id);
    }
    public function empty()
    {
        unset($_SESSION['cart']);
        header("Location: /Cart/index");
    }
    public function substract(int $id)
    {
        $this->increment($id, -1);
    }
    public function increment(int $id, int $increment = 1)
    {
        $productManager = new ProductManager();
        $product = $productManager->selectOneById($id);
        if ($product) {
            $product['quantity'] = ($_SESSION['cart'][$id]['quantity'] ?? 0) + $increment;
            $_SESSION['cart'][$id] = $product;
            if ($_SESSION['cart'][$id]['quantity'] <= 0) {
                unset($_SESSION['cart'][$id]);
            }
        }
        header('Location: /Cart/index');
    }
    public function delete($id)
    {
        unset($_SESSION['cart'][$id]);
        header("Location: /Cart/index");
    }
}
