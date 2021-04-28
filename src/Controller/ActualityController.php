<?php

namespace App\Controller;

use App\Model\ActualityManager;

class ActualityController extends AbstractController
{

    /**
     * Show informations for a specific item
     */
    public function index(): string
    {
        $actualityManager = new ActualityManager();
        $actuality = $actualityManager->selectAll('name');

        return $this->twig->render('Actuality/index.html.twig', ['actuality' => $actuality]);
    }
}
