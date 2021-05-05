<?php

namespace App\Controller;

class ContactController extends AbstractController
{

    private const NAME_MAX_LENGTH = 80;
    private const MESSAGE_MAX_LENGTH = 2000;

    public function validate()
    {
        $errors = [];
        $data = [];

        if (empty($data['lastname'])) {
            $errors[] = 'Le nom est obligatoire';
        } elseif ($data['lastname'] > self::NAME_MAX_LENGTH) {
            $errors[] = 'Le nom doit faire moins de' . self::NAME_MAX_LENGTH . ' caractères';
        }

        if (empty($data['firstname'])) {
            $errors[] = 'Le prénom est obligatoire';
        } elseif ($data['firstname'] > self::NAME_MAX_LENGTH) {
            $errors[] = 'Le prénom doit faire moins de' . self::NAME_MAX_LENGTH . ' caractères';
        }

        if (empty($data['email'])) {
            $errors[] = 'L\'email est obligatoire';
        } elseif (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
            $errors[] = 'Mauvais format d\'email';
        }

        if (empty($data['message'])) {
            $errors[] = 'Un message est obligatoire';
        } elseif ($data['message'] > self::MESSAGE_MAX_LENGTH) {
            $errors[] = 'Le message doit faire moins de ' . self::MESSAGE_MAX_LENGTH . ' caractères';
        }
        var_dump($data);
        return $errors;
    }

    private function send()
    {
        $errors = [];
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $errors = $this->validate();

            if (empty($errors)) {
                //send in mail
                header('location: /Contact/index');
            }
        }
        return $errors;
    }

    public function index()
    {
        $errors = $this->send();
        var_dump($errors);
        return $this->twig->render('Contact/index.html.twig', [
            "errors" => $errors
        ]);
    }
}
