<?php

namespace App\Controller;

use App\Entity\User;
use App\Session\SessionManager;

class LoginController extends AbstractController
{
    public function login(): string
    {
        return $this->twig->render('login/login.html.twig');
    }

    public function authenticate(SessionManager $sessionManager, User $id): string
    {
        //Récupération des donnée par la methode POST (non fonctionnel a partir de là ...)

        $email = $_POST['email'];
        $password = $_POST['password'];

        // Récupère l'utilisateur depuis la base de données
        $user = $id->findByUsername($email);

        if ($user && password_verify($password, $user->getPassword())) {
            // Authentification réussie
            $sessionManager->start();
            $sessionManager->set('id', $user->getId());

            return $this->twig->render('login/confirmlogin.html.twig');
        } else {
            // Authentification échouée
            return $this->twig->render('login/login.html.twig', ['error' => 'Identifiants invalides']);
        }
    }

    //déconnection du user
    public function logout(SessionManager $sessionManager): void
    {
        $sessionManager->destroy();
        $this->redirect('/login/login');
    }
}
