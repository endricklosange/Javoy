<?php

namespace App\Controller;

use App\Model\ActualityManager;

class AdminActualityController extends AbstractController
{


    public function index(): string
    {
        $actualityManager = new ActualityManager();
        $actualities = $actualityManager->selectAll();

        return $this->twig->render('Admin/listActuality.html.twig', ['actualities' => $actualities]);
    }
}
