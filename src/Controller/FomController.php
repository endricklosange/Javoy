<?php

namespace App\Controller;

class FormController extends AbstractController
{
    private const NAME_MAX_LENGHT = 80;
    private const MESSAGE_MAX_LENGHT = 2000;

    public function conditionForm()
    {
        $errors = [];
        $data = array_map('trim', $_POST);

        if (empty($data['lastname'])) {
            $errors[] = 'Le nom est obligatoire';
        } elseif ($data['lastname'] > self::NAME_MAX_LENGHT) {
            $errors = 'Le nom doit faire moins de' . self::NAME_MAX_LENGHT . ' caractères';
        }

        if (empty($data['firstname'])) {
            $errors[] = 'Le prénom est obligatoire';
        } elseif ($data['firstname'] > self::NAME_MAX_LENGHT) {
            $errors = 'Le prénom doit faire moins de' . self::NAME_MAX_LENGHT . ' caractères';
        }

        if (empty($data['email'])) {
            $errors[] = 'L\'email est obligatoire';
        }

        if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
            $errors[] = 'Mauvais format d\'email';
        }

        if (empty($data['message'])) {
            $errors[] = 'Un message est obligatoire';
        } elseif ($data['message'] > self::MESSAGE_MAX_LENGHT) {
            $errors = 'Le message doit faire moin de ' . self::MESSAGE_MAX_LENGHT . ' caractères';
        }
    }
    public function securisationForm()
    {
        $errors = [];
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $errors = $this->conditionForm();

            if (empty($errors)) {
                header('location: index.html.twig');
            }
            var_dump($errors);
        }
        return $this->twig->render("includes/_formContact.html.twig", ['errors' => $errors]);
    }
}
