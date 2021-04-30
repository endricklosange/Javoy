<?php

namespace App\Controller;

use App\Model\ActualityManager;

class AdminActualityController extends AbstractController
{
    private const NEWS_MAX_LENGTH = 80;
    private const DESCRIPTION_MAX_LENGTH = 500;

    public function index(): string
    {
        $actualityManager = new ActualityManager();
        $actualities = $actualityManager->selectAll();

        return $this->twig->render('Admin/listActuality.html.twig', ['actualities' => $actualities]);
    }

    private function isEmpty($actuality): array
    {
        $errors = [];
        if (empty($actuality['name'])) {
            $errors[] = 'Le nom est obligatoire';
        }
        if (empty($actuality['description'])) {
            $errors[] = 'La description est obligatoire';
        }
        if (empty($actuality['image'])) {
            $errors[] = 'L\'image est obligatoire';
        }
        if (empty($actuality['article'])) {
            $errors[] = 'L\'article est obligatoire';
        }
        if (empty($actuality['created_at'])) {
            $errors[] = 'La date de création est obligatoire';
        }
        return $errors;
    }
    private function validate($actuality)
    {
        $errors = $this->isEmpty($actuality);

        if (strlen($actuality['name']) > self::NEWS_MAX_LENGTH) {
            $errors[] = 'Le nom doit contenir moins de ' . self::NEWS_MAX_LENGTH . 'caractères';
        }

        if (strlen($actuality['description']) > self::DESCRIPTION_MAX_LENGTH) {
            $errors[] = 'Le nom doit contenir moins de ' . self::DESCRIPTION_MAX_LENGTH . 'caractères';
        }

        if (!filter_var($actuality['image'], FILTER_VALIDATE_URL)) {
            $errors[] = 'L\'image doit etre un url';
        }
        return $errors;
    }

    public function add(): string
    {
        $errors = [];
        $actuality = [];
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $actuality = array_map('trim', $_POST);
            $errors = $this->validate($actuality);
            if (empty($errors)) {
                $actualityManager = new ActualityManager();
                $actualityManager->insert($actuality);
                header('Location:/AdminActuality/index');
            }
        }
        return $this->twig->render('Admin/addActuality.html.twig', ['errors' => $errors, 'actuality' =>  $actuality,]);
    }

    public function edit(int $id): string
    {
        $errors = [];

        $actualityManager = new ActualityManager();
        $actuality = $actualityManager->selectOneById($id);
        if ($actuality === false) {
            $errors[] = 'L\actualité séléctionné n\'existe pas';
        }
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $actuality = array_map('trim', $_POST);

            $errors = $this->validate($actuality);
            if (empty($errors)) {
                $actuality['id'] = $id;
                $actualityManager->update($actuality);
                header('Location:/AdminActuality/index');
            }
        }
        return $this->twig->render('Admin/editActuality.html.twig', ['errors' => $errors, 'actuality' =>  $actuality,]);
    }

    public function delete(int $id): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $productsManager = new ActualityManager();
            $productsManager->delete($id);
            header('location: /AdminActuality/index');
        }
    }
}