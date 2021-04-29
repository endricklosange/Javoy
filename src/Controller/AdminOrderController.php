<?php

namespace App\Controller;

use App\Model\AdminOrderManager;
use App\Model\StatusManager;

class AdminOrderController extends AbstractController
{
    public function index(): string
    {
        $statusManager = new StatusManager();
        $statusLists = $statusManager->selectAll();

        $status = new AdminOrderManager();
        $orderStatus = $status->selectAllstatus();

        return $this->twig->render('Admin/listOrder.html.twig', [
            'statusLists' => $statusLists,
            'orderStatus' => $orderStatus,
        ]);
    }
}
