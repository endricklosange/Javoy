<?php

namespace App\Controller;

use App\Model\AdminOrderManager;
use App\Model\StatusManager;

class AdminOrderController extends AbstractController
{

    public function index(): string
    {
        $status = new AdminOrderManager();
        $orderStatus = $status->selectAllOrderStatus();

        return $this->twig->render('Admin/listOrder.html.twig', [
            'orderStatus' => $orderStatus,
        ]);
    }

    public function show(int $orderStatus): string
    {
        $statusManager = new StatusManager();
        $statusLists = $statusManager->selectAll();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // clean $_POST data
            $statusList = array_map('trim', $_POST);
        }

        return $this->twig->render('Admin/showOrder.html.twig', [
            'statusLists' => $statusLists,
        ]);
    }
}
