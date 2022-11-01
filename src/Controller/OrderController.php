<?php

namespace App\Controller;

use App\Service\SendEmail;
use App\Model\OrderManager;

class OrderController extends AbstractController
{
    private const DATA_MAX_LENGTH = 255;

    public function randomString()
    {
        $caracteres = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $stringMax = strlen($caracteres);
        $randomString = '';
        for ($i = 0; $i < 10; $i++) {
            $randomString .= $caracteres[rand(0, $stringMax - 1)];
        }
        return $randomString;
    }
    public function reference()
    {

        $allRef = [];
        $randCar = $this->randomString();

        if (!in_array($randCar, $allRef)) {
            $allRef[] = $randCar;
            return $randCar;
        }
    }
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

        return $errors;
    }
    private function validate($order)
    {
        $errors = $this->isEmpty($order);

        if (strlen($order['firstname']) > self::DATA_MAX_LENGTH) {
            $errors[] = 'Le prénom doit contenir moins de ' . self::DATA_MAX_LENGTH . ' caractères';
        }
        if (strlen($order['lastname']) > self::DATA_MAX_LENGTH) {
            $errors[] = 'Le nom doit contenir moins de ' . self::DATA_MAX_LENGTH . ' caractères';
        }
        if (!filter_var($order['email'], FILTER_VALIDATE_EMAIL)) {
            $errors[] = 'L\'email est incorrect';
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
        $orderReference = $this->reference();
        $errors = [];
        $order['reference'] = $orderReference;
        $email = new SendEmail();
        $products = $_SESSION['cart'] ?? [];
        $detail = '';
        foreach ($products as $product) {
            $detail .= $product['name'] . '|';
            $detail .=  $product['quantity'] . '/';
        }
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // clean $_POST data
            $order = array_map('trim', $_POST);
            // Verification
            $errors = $this->validate($order);
            // no error, send to db
            if (empty($order['objet'])) {
                if (empty($errors)) {
                    $orderManager = new OrderManager();
                    $orderManager->insert($order, $orderReference, $detail);
                    $email->sendEmail('javoytest@gmail.com', $order['email'], 'JAVOY Père et Fils votre 
                commande est confirmée', $order, 'completeOrderForm', $orderReference);
                    header('Location:/Order/thanks');
                }
            }
        }
        if (isset($_SESSION['cart'])) {
            return $this->twig->render('Order/add.html.twig', [
                'errors' => $errors,
                'order' => $order,
                'products' => $products,

            ]);
        } else {
            header('Location:/');
        }
    }

    public function thanks(): string
    {
        return $this->twig->render('Order/thanks.html.twig');
    }
}
