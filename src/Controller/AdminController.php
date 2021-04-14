<?php

namespace App\Controller;

class AdminController extends AbstractController
{
    public function index()
    {
        return $this->twig->render('Admin/index.html.twig');
    }    
    
    public function add()
    {
        return $this->twig->render('Admin/add-products.html.twig');
    }
}
