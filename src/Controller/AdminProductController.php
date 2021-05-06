<?php

namespace App\Controller;

use App\Model\ProductManager;

class AdminProductController extends AbstractController
{
    private const PRODUCT_MAX_LENGHT = 80;
    private const PRODUCT_MIN_INT = 0;
    public const MAX_UPLOAD_FILESIZE = 1000000;
    public const ALLOWED_MIMES = ['image/jpeg', 'image/png'];

    // Verification champ vide
    private function isEmpty($product): array
    {
        $errors = [];
        if (empty($product['price'])) {
            $errors[] = 'Le prix est obligatoire';
        }

        if (empty($product['description'])) {
            $errors[] = 'La déscription est obligatoire';
        }

        if (empty($product['year'])) {
            $errors[] = 'L\'année est obligatoire';
        }

        if (empty($product['created_at'])) {
            $errors[] = 'La date de création est obligatoire';
        }

        if (empty($product['name'])) {
            $errors[] = 'Le nom est obligatoire';
        }

        return $errors;
    }

    // Suite des verifications
    private function validate($product)
    {

        // validations
        $errors = $this->isEmpty($product);

        //name verification
        if (strlen($product['name']) > self::PRODUCT_MAX_LENGHT) {
            $errors[] = 'Le nom doit contenir moins de ' . self::PRODUCT_MAX_LENGHT . ' charactères';
        }

        // price verification
        if ($product['price'] <= self::PRODUCT_MIN_INT) {
            $errors[] = 'Le prix doit etre un nombre supérieur à ' . self::PRODUCT_MIN_INT;
        }

        // year verification
        if ($product['year'] <= self::PRODUCT_MIN_INT) {
            $errors[] = 'L\'année doit etre un nombre supérieur à ' . self::PRODUCT_MIN_INT;
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


    /* Ajout de produit */

    public function add()
    {
        $errors = [];
        $product = array_map('trim', $_POST);

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // clean $_POST data
            $product = array_map('trim', $_POST);
            // Verification
            $dataErrors = $this->validate($product);
            $fileErrors = $this->validateFile($_FILES['image']);
            $errors = array_merge($dataErrors, $fileErrors);

            // no errors, send to db
            if (empty($errors)) {
                $fileName = uniqid() . '_' . $_FILES['image']['name'];
                $product['image'] = $fileName;
                move_uploaded_file($_FILES['image']['tmp_name'], __DIR__ . '/../../public/uploads/' .  $fileName);

                $productsManager = new ProductManager();
                $productsManager->insert($product);
                header('Location:/AdminListProduct/index');
            }
        }

        return $this->twig->render('Admin/add.html.twig', [
            'errors' => $errors,
            'product' => $product
        ]);
    }

    /* Editer un produit */

    public function edit(int $id): string
    {
        $errors = [];

        $productManager = new ProductManager();
        $product = $productManager->selectOneById($id);

        if ($product === false) {
            $errors[] = 'Le produit séléctionné n\'existe pas';
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // clean $_POST data

            $product = array_map('trim', $_POST);

            // TODO validations (length, format...)
            $dataErrors = $this->validate($product);
            $fileErrors = $this->validateFile($_FILES['image']);
            $errors = array_merge($dataErrors, $fileErrors);
            // if validation is ok, update and redirection
            if (empty($errors)) {
                $fileName = uniqid() . '_' . $_FILES['image']['name'];
                $product['image'] = $fileName;
                move_uploaded_file($_FILES['image']['tmp_name'], __DIR__ . '/../../public/uploads/' .  $fileName);

                $product['id'] = $id;
                $productManager->update($product);
                header('Location:/AdminListProduct/index');
            }
        }

        return $this->twig->render('Admin/edit.html.twig', [
            'errors' => $errors,
            'product' => $product,
        ]);
    }

    public function delete(int $id): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $productsManager = new ProductManager();
            $product = $productsManager->selectOneById($id);
            $path =  __DIR__ . '/../../public/uploads/' . $product['image'];
            if (file_exists($path)) {
                unlink($path);
            }


            $productsManager->delete($id);
            header('location: /AdminListProduct/index');
        }
    }
}
