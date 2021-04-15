<?php

namespace App\Controller;

use App\Model\ProductsManager;

class AdminProductsController extends AbstractController
{
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
        $categoryValue = array("Rouge", "Blanc", "Rosé", "Alcool de fruit", "Jus de fruit"); // category list

        // validations
        $errors = $this->isEmpty($products);

        // Category verification
        if (!in_array($products['category'], $categoryValue)) {
            $errors[] = 'Veuillez renseigné une catégorie valide';
        }

        //name verification
        if (strlen($products['name']) > 80) {
            $errors[] = 'Le nom doit contenir moin de 80 charactères';
        }

        // price verification
        if ($products['price'] <= 0) {
            $errors[] = 'Le prix doit etre un nombre supérieur a 0';
        }

        // year verification
        if ($products['year'] <= 0) {
            $errors[] = 'L\'année doit etre un nombre supérieur a 0';
        }

        // image verification
        if (!filter_var($products['image'], FILTER_VALIDATE_URL)) {
            $errors[] = "Le format d'url n’est pas correct";
        }

        // description verification
        if (strlen($products['description']) > 255) {
            $errors[] = 'Le nom doit contenir moin de 255 charactères';
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
                $productsManager = new ProductsManager();
                $productsManager->insert($products);
                header('Location:/adminProducts/add');
            }
        }

        return $this->twig->render('Admin/add.html.twig', [
            'errors' => $errors,
        ]);
    }
}
