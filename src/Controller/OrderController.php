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
        $errors = [];
        if (empty($order['firstname'])) {
            $errors[] = 'Le prénom est obligatoire';
        }
        if (empty($order['lastname'])) {
            $errors[] = 'La nom est obligatoire';
        }
        if (empty($order['email'])) {
            $errors[] = 'L\'email est obligatoire';
        }
        if (empty($order['address'])) {
            $errors[] = 'L\'adresse est obligatoire';
        }
        if (empty($order['zipcode'])) {
            $errors[] = 'Le code postal est obligatoire';
        }
        if (empty($order['city'])) {
            $errors[] = 'La ville est obligatoire';
        }
        if (empty($order['detail'])) {
            $errors[] = 'Votre commande ne peut être vide';
        }
        return $errors;
    }
    private function validate($order)
    {
        $titleValue = ["Mr", "Mme", "Mlle"];
        $errors = $this->isEmpty($order);

        if (!in_array($order['title'], $titleValue)) {
            $errors[] = 'Veuillez choisir un titre valide';
        }
        if (strlen($order['firstname']) > self::DATA_MAX_LENGTH) {
            $errors[] = 'Le prénom doit contenir moins de ' . self::DATA_MAX_LENGTH . ' caractères';
        }
        if (strlen($order['lastname']) > self::DATA_MAX_LENGTH) {
            $errors[] = 'Le nom doit contenir moins de ' . self::DATA_MAX_LENGTH . ' caractères';
        }
        if (!filter_var($order['email'], FILTER_VALIDATE_EMAIL)) {
            $errors[] = 'L\'email est incorrect';
        }
        if (strlen($order['address']) > self::DATA_MAX_LENGTH) {
            $errors[] = 'L\adresse doit faire moins de ' . self::DATA_MAX_LENGTH . ' caractères';
        }
        if (strlen($order['zipcode'])  <= self::ZIPCODE_MIN_INT) {
            $errors[] = 'Le code postal doit être supérieur à ' . self::ZIPCODE_MIN_INT;
        }
        if (strlen($order['detail']) > self::ORDER_MAX_LENGTH) {
            $errors[] = 'Le détail de la commande doit contenir moins de ' . self::ORDER_MAX_LENGTH . ' caractères';
        }
        return $errors;
    }

    public function index(): string
    {
        $orderManager = new OrderManager();
        $orders = $orderManager->selectAll('lastname');

        return $this->twig->render('Order/index.html.twig', ['orders' => $orders]);
    }

    public function show(int $id): string
    {
        $orderManager = new OrderManager();
        $order = $orderManager->selectOneById($id);

        return $this->twig->render('Order/show.html.twig', ['order' => $order]);
    }

    public function add()
    {
        $errors = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // clean $_POST data
            $order = array_map('trim', $_POST);
            // Verification
            $errors = $this->validate($order);
            // no error, send to db
            if (empty($errors)) {
                $orderManager = new OrderManager();
                $orderManager->insert($order);
                header('Location:/Order/thanks');
            }
        }

        return $this->twig->render('Order/add.html.twig', [
            'errors' => $errors,
        ]);
    }

    public function thanks(): string
    {
        return $this->twig->render('Order/thanks.html.twig');
    }
}
