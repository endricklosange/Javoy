<?php

/**
 * Created by PhpStorm.
 * User: aurelwcs
 * Date: 08/04/19
 * Time: 18:40
 */

namespace App\Controller;

use App\Model\UserManager;

class LoginController extends AbstractController
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
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $data = array_map('trim', $_POST);
            $email = $data['email'];
            $password = $data['password'];
            $userManager = new UserManager();
            $users = $userManager->selectUserEmail($email);
            foreach ($users as $user) {
                if (password_verify($password, $user['password'])) {
                    $_SESSION['role'] = "admin" ;
                    header('Location:/AdminActuality/index');
                }
            }
        }
        return $this->twig->render('Login/index.html.twig');
    }
}
