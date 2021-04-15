<?php

namespace App\Controller;

class AdminDrinkController extends AbstractController
{
    public function add_product()
    {
        return $this->twig->render('Admin/add-products.html.twig');
    }
}
