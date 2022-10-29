<?php

namespace App\Controller;

use App\Controller\AbstractController;
use App\Service\SendEmail;

class ContactController extends AbstractController
{
    private const NAME_MAX_LENGTH = 80;
    private const MESSAGE_MAX_LENGTH = 2000;

    private function isEmpty($data)
    {
        $errors = [];
        if (empty($data['lastname'])) {
            $errors[] = 'Le nom est obligatoire';
        }
        if (empty($data['firstname'])) {
            $errors[] = 'Le prénom est obligatoire';
        }
        if (empty($data['email'])) {
            $errors[] = 'L\'email est obligatoire';
        }
        if (empty($data['message'])) {
            $errors[] = 'Un message est obligatoire';
        }
        return $errors;
    }



    public function validate($data)
    {
        $errors = $this->isEmpty($data);

        if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
            $errors[] = 'Mauvais format d\'email';
        }

        if (strlen($data['lastname']) > self::NAME_MAX_LENGTH) {
            $errors = 'Le nom doit faire moins de' . self::NAME_MAX_LENGTH . ' caractères';
        }


        if (strlen($data['firstname']) > self::NAME_MAX_LENGTH) {
            $errors = 'Le prénom doit faire moins de' . self::NAME_MAX_LENGTH . ' caractères';
        }

        if (strlen($data['message']) > self::MESSAGE_MAX_LENGTH) {
            $errors = 'Le message doit faire moins de ' . self::MESSAGE_MAX_LENGTH . ' caractères';
        }
        return $errors;
    }

    private function send()
    {
        $errors = [];
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $datas = array_map('trim', $_POST);
            $errors = $this->validate($datas);
            if (empty($datas['objet'])) {
                if (empty($errors)) {
                    $email = new SendEmail();
                    $email->sendEmail($datas['email'], 'javoytest@gmail.com', 'Formulaire de contact
                     JAVOY Père et Fils', $datas, 'contactAdminForm');
                    $email->sendEmail('javoytest@gmail.com', $datas['email'], 'Merci beaucoup de nous avoir
                     contacté JAVOY Père et Fils', $datas, 'contactVisitorForm');
                    // header('location: /Contact/thanks');
                }
            }
        }
        return $errors;
    }

    public function index()
    {
        $data = array_map('trim', $_POST);
        $errors = $this->send();
        return $this->twig->render('Contact/index.html.twig', [
            "errors" => $errors,
            "data" => $data
        ]);
    }
    public function thanks(): string
    {
        return $this->twig->render('Contact/thanks.html.twig');
    }
}
