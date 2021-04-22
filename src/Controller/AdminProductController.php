<?php

namespace App\Controller;

use App\Model\ProductManager;

class AdminProductController extends AbstractController
{
    private const PRODUCT_MAX_LENGHT = 80;
    private const DESCRIPTION_MAX_LENGHT = 255;
    private const PRODUCT_MIN_INT = 0;
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

        if (empty($product['image'])) {
            $errors[] = 'L\'image est obligatoire';
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
        $categoryValue = ["Rouge", "Blanc", "Rosé", "Alcool de fruit", "Jus de fruit"]; // category list

        // validations
        $errors = $this->isEmpty($product);

        // Category verification
        if (!in_array($product['category'], $categoryValue)) {
            $errors[] = 'Veuillez renseigner une catégorie valide';
        }

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

        // image verification
        if (!filter_var($product['image'], FILTER_VALIDATE_URL)) {
            $errors[] = "Le format d'url n’est pas correct";
        }

        // description verification
        if (strlen($product['description']) > self::DESCRIPTION_MAX_LENGHT) {
            $errors[] = 'Le nom doit contenir moins de ' . self::DESCRIPTION_MAX_LENGHT . ' charactères';
        }
        return $errors;
    }



    /* Ajout de produit */

    public function add()
    {
        $errors = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // clean $_POST data
            $product = array_map('trim', $_POST);
            // Verification
            $errors = $this->validate($product);
            // no errors, send to db
            if (empty($errors)) {
                $productsManager = new ProductManager();
                $productsManager->insert($product);
                header('Location:/adminProduct/add');
            }
        }

        return $this->twig->render('Admin/add.html.twig', [
            'errors' => $errors,
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
            $errors = $this->validate($product);
            // if validation is ok, update and redirection
            if (empty($errors)) {
                $product['id'] = $id;
                $productManager->update($product);
                header('Location: /AdminProduct/add/');
            }
        }

        return $this->twig->render('Admin/edit.html.twig', [
            'errors' => $errors,
            'product' => $product,
        ]);
    }
}
