<?php

namespace App\Controller;

use App\Model\OrderManager;
use App\Model\StatusManager;

class AdminOrderController extends AbstractController
{

    public function index(): string
    {
        $status = new OrderManager();
        $orderStatus = $status->selectAllOrderStatus();

        return $this->twig->render('Admin/listOrder.html.twig', [
            'orderStatus' => $orderStatus,
        ]);
    }

    public function show(int $orderStatus): string
    {
        $statusManager = new StatusManager();
        $statusLists = $statusManager->selectAll();
        $statusOrder = new OrderManager();
        $orderStatus = $statusOrder->selectByIdOrder($orderStatus);

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // clean $_POST data
            $statusList = array_map('trim', $_POST);
            $orderStatus['status_id'] = $statusList['status'];
            $statusOrder->update($orderStatus);
            header('Location: /AdminOrder/index');
        }

        return $this->twig->render('Admin/showOrder.html.twig', [
            'orderStatus' => $orderStatus,
            'statusLists' => $statusLists,
        ]);
    }
}
