<?php

namespace App\Controller;

use App\Model\AdminOrderManager;

class AdminOrderController extends AbstractController
{
    public function index(): string
    {
        $listOrder = new AdminOrderManager();
        $orders = $listOrder->selectAll();

        return $this->twig->render('Admin/listOrder.html.twig', ['orders' => $orders]);
    }
}
