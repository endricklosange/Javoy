<?php

namespace App\Controller;

use App\Model\OrderManager;

class OrderController extends AbstractController
{
    private const DATA_MAX_LENGHT = 255;
    private const ORDER_MAX_LENGHT = 2000;
    private const ZIPCODE_MIN_INT = 0;

    private function isEmpty($orders): array
    {
        $errors = [];
        if (empty($orders['firstname'])) {
            $errors[] = 'Le prénom est obligatoire';
        }
        if (empty($orders['lastname'])) {
            $errors[] = 'La nom est obligatoire';
        }
        if (empty($orders['email'])) {
            $errors[] = 'L\'email est obligatoire';
        }
        if (empty($orders['address'])) {
            $errors[] = 'L\'adresse est obligatoire';
        }
        if (empty($orders['zipcode'])) {
            $errors[] = 'Le code postal est obligatoire';
        }
        if (empty($orders['city'])) {
            $errors[] = 'La ville est obligatoire';
        }
        if (empty($orders['detail'])) {
            $errors[] = 'Votre commande ne peut être vide';
        }
        return $errors;
    }
    
    private function validate($orders)
    {
        $titleValue = ["Mr", "Mme", "Mlle"];
        $errors = $this->isEmpty($orders);

        if (!in_array($orders['title'], $titleValue)) {
            $errors[] = 'Veuillez choisir un titre valide';
        }
        if (strlen($orders['firstname']) > self::DATA_MAX_LENGHT) {
            $errors[] = 'Le prénom doit contenir moins de ' . self::DATA_MAX_LENGHT . ' caractères';
        }
        if (strlen($orders['lastname']) > self::DATA_MAX_LENGHT) {
            $errors[] = 'Le nom doit contenir moins de ' . self::DATA_MAX_LENGHT . ' caractères';
        }
        if (!filter_var($orders['email'], FILTER_VALIDATE_EMAIL)) {
            $errors[] = 'L\'email est incorrect';
        }
        if (strlen($orders['address']) > self::DATA_MAX_LENGHT) {
            $errors[] = 'L\adresse doit faire moins de ' . self::DATA_MAX_LENGHT . ' caractères';
        }
        if (strlen($orders['zipcode'])  <= self::ZIPCODE_MIN_INT) {
            $errors[] = 'Le code postal doit être supérieur à ' . self::ZIPCODE_MIN_INT;
        }
        if (strlen($orders['detail']) > self::ORDER_MAX_LENGHT) {
            $errors[] = 'Le détail de la commande doit contenir moins de ' . self::ORDER_MAX_LENGHT . ' caractères';
        }
        return $errors;
    }

    public function add()
    {
        $errors = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // clean $_POST data
            $orders = array_map('trim', $_POST);
            // Verification
            $errors = $this->validate($orders);
            // no errors, send to db
            if (empty($errors)) {
                $orderManager = new OrderManager();
                $orderManager->insert($orders);
                header('Location:/Order/add');
            }
        }

        return $this->twig->render('Order/add.html.twig', [
            'errors' => $errors,
        ]);
    }
}
