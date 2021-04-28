<?php

namespace App\Controller;

use App\Model\CategoryManager;

class CartController extends AbstractController
{
    public function sessionStart()
    {
        session_start();
    }

    public function addToCart()
    {
        if (isset($_GET['add_to_cart'])) {
            if (isset($_SESSION[CategoryManager::TABLE][$_GET['add_to_cart']])) {
                $_SESSION[CategoryManager::TABLE][$_GET['add_to_cart']]++;
            } else {
                $_SESSION[CategoryManager::TABLE][$_GET['add_to_cart']] = 1;
            }
        }
    }

    public function removeToCart()
    {
        if (isset($_GET['remove_cart'])) {
            if (isset($_SESSION[CategoryManager::TABLE][$_GET['remove_cart']]) > 0) {
                $_SESSION[CategoryManager::TABLE][$_GET['remove_cart']]--;
            } elseif ($_SESSION[CategoryManager::TABLE][$_GET['remove_cart']] > 0) {
                $_SESSION[CategoryManager::TABLE][$_GET['remove_cart']]--;
            }
        }

        // if (empty($_SESSION[CategoryManager::TABLE])) {
        //     $product = "cart";
        // } else {
        //     $product = array_sum($_SESSION[CategoryManager::TABLE]);
        // }
    }
}
