<?php

namespace App\Controller;

class AdminDrinkController extends AbstractController
{
    public function addProduct()
    {
        return $this->twig->render('Admin/add-products.html.twig');
    }
}
