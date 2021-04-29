<?php

namespace App\Controller;

use App\Model\AdminOrderManager;
use App\Model\StatusManager;

class AdminOrderController extends AbstractController
{
    public function index(): string
    {
        $listOrder = new AdminOrderManager();
        $orders = $listOrder->selectAll();
        $statusManager = new StatusManager();
        $statusLists = $statusManager->selectAll();

        return $this->twig->render('Admin/listOrder.html.twig', [
            'orders' => $orders,
            'statusLists' => $statusLists,
        ]);
    }
}
