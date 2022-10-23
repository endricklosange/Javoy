<?php

namespace App\Controller;

use App\Model\ActualityManager;
use PHPMD\Utility\Strings;

class AdminActualityController extends AbstractController
{
    private const NEWS_MAX_LENGTH = 80;
    public const MAX_UPLOAD_FILESIZE = 1000000;
    public const ALLOWED_MIMES = ['image/jpeg', 'image/png'];

    private function isEmpty($actuality): array
    {
        $errors = [];
        if (empty($actuality['name'])) {
            $errors[] = 'Le nom est obligatoire';
        }
        if (empty($actuality['description'])) {
            $errors[] = 'La description est obligatoire';
        }

        return $errors;
    }
    private function validate($actuality)
    {
        $errors = $this->isEmpty($actuality);

        if (strlen($actuality['name']) > self::NEWS_MAX_LENGTH) {
            $errors[] = 'Le nom doit contenir moins de ' . self::NEWS_MAX_LENGTH . 'caractères';
        }
        return $errors;
    }

    private function validateFile(array $file): array
    {
        $errors = [];

        if ($file['error'] != 0) {
            $errors[] = 'Problème lors de l\'upload';
        } else {
            if ($file['size'] > self::MAX_UPLOAD_FILESIZE) {
                $errors[] = 'Le fichier doit faire moins de ' . self::MAX_UPLOAD_FILESIZE / 1000000 . 'Mo';
            }

            if (!in_array(mime_content_type($file['tmp_name']), self::ALLOWED_MIMES)) {
                $errors[] = 'Le fichier doit être de type ' . implode(', ', self::ALLOWED_MIMES);
            }
        }

        return $errors;
    }

    public function index()
    {
        $actualityManager = new ActualityManager();
        $actualities = $actualityManager->selectAll();
        if (isset($_SESSION['role'])) {
            return $this->twig->render('Admin/listActuality.html.twig', ['actualities' => $actualities]);
        } else {
            header('Location:/');
        }
    }
    public function add()
    {
        $errors = [];
        $actuality = [];

        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $actuality = array_map('trim', $_POST);

            $dataErrors = $this->validate($actuality);
            $fileErrors = $this->validateFile($_FILES['image']);
            $errors = array_merge($dataErrors, $fileErrors);
            if (empty($errors)) {
                $actualityManager = new ActualityManager();

                $fileName = uniqid() . '_' . $_FILES['image']['name'];
                $actuality['image'] = $fileName;
                move_uploaded_file($_FILES['image']['tmp_name'], __DIR__ . '/../../public/uploads/' .  $fileName);

                $actualityManager->insert($actuality);
                header('Location:/AdminActuality/index');
            }
        }
        if (isset($_SESSION['role'])) {
            return $this->twig->render('Admin/addActuality.html.twig', ['errors' => $errors, 'actuality' =>  $actuality,]);
        } else {
            header('Location:/');
        }
    }

    public function edit(int $id)
    {
        $errors = [];

        $actualityManager = new ActualityManager();
        $actuality = $actualityManager->selectOneById($id);
        if ($actuality === false) {
            $errors[] = 'L\actualité séléctionné n\'existe pas';
        }
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $actuality = array_map('trim', $_POST);
            $dataErrors = $this->validate($actuality);
            $fileErrors = $this->validateFile($_FILES['image']);
            $errors = array_merge($dataErrors, $fileErrors);

            if (empty($errors)) {
                $fileName = uniqid() . '_' . $_FILES['image']['name'];
                $actuality['image'] = $fileName;
                move_uploaded_file($_FILES['image']['tmp_name'], __DIR__ . '/../../public/uploads/' .  $fileName);

                $actuality['id'] = $id;
                $actualityManager->update($actuality);
                header('Location:/AdminActuality/index');
            }
        }
        if (isset($_SESSION['role'])) {
            return $this->twig->render('Admin/editActuality.html.twig', ['errors' => $errors, 'actuality' =>  $actuality,]);
        } else {
            header('Location:/');
        }
    }

    public function delete(int $id): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $productsManager = new ActualityManager();
            $actuality = $productsManager->selectOneById($id);
            $path =  __DIR__ . '/../../public/uploads/' . $actuality['image'];
            if (file_exists($path)) {
                unlink($path);
            }
            $productsManager->delete($id);
            header('location: /AdminActuality/index');
        }
    }
}
