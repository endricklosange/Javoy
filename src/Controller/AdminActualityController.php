<?php

namespace App\Controller;

use App\Model\ActualityManager;

class AdminActualityController extends AbstractController
{
    private const NEWS_MAX_LENGHT = 80;
    private const DESCRIPTION_MAX_LENGHT = 500;

    public function add(): string
    {
        $errors = [];
        $actuality = [];
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $actuality = array_map('trim', $_POST);


            if (empty($actuality['name'])) {
                $errors[] = 'Le nom est obligatoire';
            }
            if (strlen($actuality['name']) > self::NEWS_MAX_LENGHT) {
                $errors[] = 'Le nom doit contenir moin de ' . self::NEWS_MAX_LENGHT . 'caractère';
            }
            if (empty($actuality['description'])) {
                $errors[] = 'La description est obligatoire';
            }
            if (strlen($actuality['description']) > self::DESCRIPTION_MAX_LENGHT) {
                $errors[] = 'Le nom doit contenir moin de ' . self::DESCRIPTION_MAX_LENGHT . 'caractère';
            }
            if (empty($actuality['image'])) {
                $errors[] = 'L\'image est obligatoire';
            }
            if (!filter_var($actuality['image'], FILTER_VALIDATE_URL)) {
                $errors[] = 'L\'image doit etre un url';
            }

            if (empty($errors)) {
                $actualityManager = new ActualityManager();
                $actualityManager->insert($actuality);
                header('Location:/AdminActuality/index');
            }
        }
        return $this->twig->render('Admin/addActuality.html.twig', ['errors' => $errors, 'actuality' =>  $actuality,]);
    }
}
