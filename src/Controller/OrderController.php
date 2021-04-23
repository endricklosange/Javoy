<?php

namespace App\Controller;

use App\Model\OrderManager;

class OrderController extends AbstractController
{
    private const DATA_MAX_LENGTH = 255;
    private const ORDER_MAX_LENGTH = 2000;
    private const ZIPCODE_MIN_INT = 0;

    private function isEmpty($order): array
    {
        $error = [];
        if (empty($order['firstname'])) {
            $error[] = 'Le prénom est obligatoire';
        }
        if (empty($order['lastname'])) {
            $error[] = 'La nom est obligatoire';
        }
        if (empty($order['email'])) {
            $error[] = 'L\'email est obligatoire';
        }
        if (empty($order['address'])) {
            $error[] = 'L\'adresse est obligatoire';
        }
        if (empty($order['zipcode'])) {
            $error[] = 'Le code postal est obligatoire';
        }
        if (empty($order['city'])) {
            $error[] = 'La ville est obligatoire';
        }
        if (empty($order['detail'])) {
            $error[] = 'Votre commande ne peut être vide';
        }
        return $error;
    }
    private function validate($order)
    {
        $titleValue = ["Mr", "Mme", "Mlle"];
        $error = $this->isEmpty($order);

        if (!in_array($order['title'], $titleValue)) {
            $error[] = 'Veuillez choisir un titre valide';
        }
        if (strlen($order['firstname']) > self::DATA_MAX_LENGTH) {
            $error[] = 'Le prénom doit contenir moins de ' . self::DATA_MAX_LENGTH . ' caractères';
        }
        if (strlen($order['lastname']) > self::DATA_MAX_LENGTH) {
            $error[] = 'Le nom doit contenir moins de ' . self::DATA_MAX_LENGTH . ' caractères';
        }
        if (!filter_var($order['email'], FILTER_VALIDATE_EMAIL)) {
            $error[] = 'L\'email est incorrect';
        }
        if (strlen($order['address']) > self::DATA_MAX_LENGTH) {
            $error[] = 'L\adresse doit faire moins de ' . self::DATA_MAX_LENGTH . ' caractères';
        }
        if (strlen($order['zipcode'])  <= self::ZIPCODE_MIN_INT) {
            $error[] = 'Le code postal doit être supérieur à ' . self::ZIPCODE_MIN_INT;
        }
        if (strlen($order['detail']) > self::ORDER_MAX_LENGTH) {
            $error[] = 'Le détail de la commande doit contenir moins de ' . self::ORDER_MAX_LENGTH . ' caractères';
        }
        return $error;
    }

    public function add()
    {
        $error = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // clean $_POST data
            $order = array_map('trim', $_POST);
            // Verification
            $error = $this->validate($order);
            // no error, send to db
            if (empty($error)) {
                $orderManager = new OrderManager();
                $orderManager->insert($order);
                header('Location:/Order/add');
            }
        }

        return $this->twig->render('Order/add.html.twig', [
            'error' => $error,
        ]);
    }
}
