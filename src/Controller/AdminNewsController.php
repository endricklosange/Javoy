<?php

namespace App\Controller;

use App\Model\NewsManager;

class AdminNewsController extends AbstractController
{
    private const NEWS_MAX_LENGHT = 80;
    private const DESCRIPTION_MAX_LENGHT = 500;
    public function add(): string
    {
        $errors = [];
        $news = [];
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $news = array_map('trim', $_POST);


            if (empty($news['name'])) {
                $errors[] = 'Le nom est obligatoire';
            }
            if (strlen($news['name']) > self::NEWS_MAX_LENGHT) {
                $errors[] = 'Le nom doit contenir moin de ' . self::NEWS_MAX_LENGHT . 'caractère';
            }
            if (empty($news['description'])) {
                $errors[] = 'La description est obligatoire';
            }
            if (strlen($news['description']) > self::DESCRIPTION_MAX_LENGHT) {
                $errors[] = 'Le nom doit contenir moin de ' . self::DESCRIPTION_MAX_LENGHT . 'caractère';
            }
            if (empty($news['image'])) {
                $errors[] = 'L\'image est obligatoire';
            }
            if (!filter_var($news['image'], FILTER_VALIDATE_URL)) {
                $errors[] = 'L\'image doit etre un url';
            }

            if (empty($errors)) {
                $newsManager = new NewsManager();
                $newsManager->insert($news);
                header('Location:/AdminNews/add');
            }
        }

        return $this->twig->render('Admin/addNews.html.twig', ['errors' => $errors, 'news' => $news,]);
    }
}
