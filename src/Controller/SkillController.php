<?php

namespace App\Controller;

class SkillController extends AbstractController
{

    public function index()
    {
        return $this->twig->render('Skill/index.html.twig');
    }
}
