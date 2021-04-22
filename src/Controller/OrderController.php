<?php

namespace App\Controller;

use App\Model\OrderManager;

class OrderController extends AbstractController
{
    // Display order
    public function index()
    {
        return $this->twig->render('Order/index.html.twig');
    }
}
