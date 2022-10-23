<?php

namespace App\Controller;

use App\Model\OrderManager;
use App\Model\StatusManager;

class AdminOrderController extends AbstractController
{
    public function index()
    {
        $status = new OrderManager();
        $orderStatus = $status->selectAllOrderStatus();
        if (isset($_SESSION['role'])) {
            return $this->twig->render('Admin/listOrder.html.twig', [
                'orderStatus' => $orderStatus,
            ]);
        } else {
            header('Location:/');
        }
    }

    public function show(int $orderStatus)
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
        if (isset($_SESSION['role'])) {
            return $this->twig->render('Admin/showOrder.html.twig', [
                'orderStatus' => $orderStatus,
                'statusLists' => $statusLists,
            ]);
        } else {
            header('Location:/');
        }
    }
}
