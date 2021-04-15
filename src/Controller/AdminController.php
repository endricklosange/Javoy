<?php

namespace App\Controller;

use App\Model\ProductsManager;

class AdminController extends AbstractController
{
    /**
     * Display home page
     *
     * @return string
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function index()
    {
        return $this->twig->render('Admin/index.html.twig');
    }

    /* Formulaire ajout de produit */

    public function add()
    {
        $errors = [];
        $categoryValue = array("Rouge", "Blanc", "Rosé", "Alcool de fruit", "Jus de fruit");

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // clean $_POST data  
            $products = array_map('trim', $_POST);
            // TODO validations (length, format...)            

            // Category verification

            if (!in_array($products['category'], $categoryValue)) {
                $errors[] = 'Veuillez renseigné une catégorie valide';
            }

            //name verification

            if (empty($products['name'])) {
                $errors[] = 'Le nom est obligatoire';
            }

            if (strlen($products['name']) > 255) {
                $errors[] = 'Le nom doit contenir moin de 255 charactère';
            }

            // price verification

            if (empty($products['price'])) {
                $errors[] = 'Le prix est obligatoire';
            }

            if ($products['price'] <= 0) {
                $errors[] = 'Le prix doit etre un nombre supérieur a 0';
            }

            // description verification

            if (empty($products['description'])) {
                $errors[] = 'La déscription est obligatoire';
            }

            // year verification

            if (empty($products['year'])) {
                $errors[] = 'L\'année est obligatoire';
            }

            if ($products['year'] <= 0) {
                $errors[] = 'L\'année doit etre un nombre supérieur a 0';
            }

            // image verification

            if (empty($products['image'])) {
                $errors[] = 'L\'image est obligatoire';
            }

            if (!filter_var($products['image'], FILTER_VALIDATE_URL)) {
                $errors[] = "Le format d'url n’est pas correct";
            }

            // created_at verification

            if (empty($products['created_at'])) {
                $errors[] = 'La date de création est obligatoire';
            }

            // if validation is ok, insert and redirection

            if (empty($errors)) {
                $productsManager = new ProductsManager();
                $productsManager->insert($products);
                header('Location:/admin/add');
            }
        }

        return $this->twig->render('Admin/add.html.twig', [
            'errors' => $errors,
        ]);
    }
}
