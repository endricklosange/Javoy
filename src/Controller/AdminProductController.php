<?php

namespace App\Controller;

use App\Model\ProductManager;

class AdminProductController extends AbstractController
{
    private const PRODUCT_MAX_LENGHT = 80;
    private const DESCRIPTION_MAX_LENGHT = 255;
    private const PRODUCT_MIN_INT = 0;
    // Verification champ vide
    private function isEmpty($products): array
    {
        $errors = [];
        if (empty($products['price'])) {
            $errors[] = 'Le prix est obligatoire';
        }

        if (empty($products['description'])) {
            $errors[] = 'La déscription est obligatoire';
        }

        if (empty($products['year'])) {
            $errors[] = 'L\'année est obligatoire';
        }

        if (empty($products['image'])) {
            $errors[] = 'L\'image est obligatoire';
        }

        if (empty($products['created_at'])) {
            $errors[] = 'La date de création est obligatoire';
        }

        if (empty($products['name'])) {
            $errors[] = 'Le nom est obligatoire';
        }

        return $errors;
    }

    // Suite des verifications
    private function validate($products)
    {
        $categoryValue = ["Rouge", "Blanc", "Rosé", "Alcool de fruit", "Jus de fruit"]; // category list

        // validations
        $errors = $this->isEmpty($products);

        // Category verification
        if (!in_array($products['category'], $categoryValue)) {
            $errors[] = 'Veuillez renseigner une catégorie valide';
        }

        //name verification
        if (strlen($products['name']) > self::PRODUCT_MAX_LENGHT) {
            $errors[] = 'Le nom doit contenir moins de ' . self::PRODUCT_MAX_LENGHT . ' charactères';
        }

        // price verification
        if ($products['price'] <= self::PRODUCT_MIN_INT) {
            $errors[] = 'Le prix doit etre un nombre supérieur à ' . self::PRODUCT_MIN_INT;
        }

        // year verification
        if ($products['year'] <= self::PRODUCT_MIN_INT) {
            $errors[] = 'L\'année doit etre un nombre supérieur à ' . self::PRODUCT_MIN_INT;
        }

        // image verification
        if (!filter_var($products['image'], FILTER_VALIDATE_URL)) {
            $errors[] = "Le format d'url n’est pas correct";
        }

        // description verification
        if (strlen($products['description']) > self::DESCRIPTION_MAX_LENGHT) {
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
            $products = array_map('trim', $_POST);
            // Verification
            $errors = $this->validate($products);
            // no errors, send to db
            if (empty($errors)) {
                $productsManager = new ProductManager();
                $productsManager->insert($products);
                header('Location:/adminProduct/add');
            }
        }

        return $this->twig->render('Admin/add.html.twig', [
            'errors' => $errors,
        ]);
    }
}
