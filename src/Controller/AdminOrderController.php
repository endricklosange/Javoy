<?php

namespace App\Controller;

use App\Service\SendEmail;
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
        $email = new SendEmail();
        $deleteLast = substr($orderStatus['detail'], 0, -1);
        $deleteSlash = explode('/', $deleteLast);
        $details = [];

        foreach ($deleteSlash as $value) {
            $array = explode('|', $value);
            $details[] = $array;
        }
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // clean $_POST data
            $statusList = array_map('trim', $_POST);
            $orderStatus['status_id'] = $statusList['status'];
            $statusOrder->update($orderStatus);
            if ($orderStatus['status_id'] == 2) {
                $email->sendEmail('javoytest@gmail.com', $orderStatus['email'], 'Votre commande est disponible
                JAVOY Père et Fils', $orderStatus, 'orderDoneForm');
            }
            if ($orderStatus['status_id'] == 3) {
                $email->sendEmail('javoytest@gmail.com', $orderStatus['email'], 'Votre commande est annulée
                JAVOY Père et Fils', $orderStatus, 'cancelOrderForm');
            }
            header('Location: /AdminOrder/index');
        }

        if (isset($_SESSION['role'])) {
            return $this->twig->render('Admin/showOrder.html.twig', [
                'orderStatus' => $orderStatus,
                'statusLists' => $statusLists,
                'details' => $details,
            ]);
        } else {
            header('Location:/');
        }
    }
}
