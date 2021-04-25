<?php

/**
 * Created by PhpStorm.
 * User: aurelwcs
 * Date: 08/04/19
 * Time: 18:40
 */

namespace App\Controller;

use App\Model\ActualityManager;

class HomeController extends AbstractController
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
        return $this->twig->render('Home/index.html.twig');
    }


    /**
     * Show informations for a specific item
     */
    public function actuality(): string
    {
        $actualityManager = new ActualityManager();
        $actuality = $actualityManager->selectAll('name');

        return $this->twig->render('Home/actuality.html.twig', ['actuality' => $actuality]);
    }

}
