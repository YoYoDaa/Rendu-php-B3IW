<?php

namespace App\Controller;

use App\Entity\Newsletter;
use Doctrine\ORM\EntityManager;

class NewsletterController extends AbstractController
{
    public function subscribe(): string
    {
        return $this->twig->render('newsletter/subscribe.html.twig');
    }

    public function register(EntityManager $em): void
    {
        if (!isset($_POST['email'])) {
            $this->redirect('/newsletter/subscribe');
        }

        $email = $_POST['email'];

        if (filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
            $this->redirect('/newsletter/subscribe');
        }

        $newsletterEmail = new Newsletter();
        $newsletterEmail->setEmail($email);

        $em->persist($newsletterEmail);
        $em->flush();

        $this->redirect('/newsletter/confirm');
    }

    public function confirm(): string
    {
        return $this->twig->render('newsletter/confirm.html.twig');
    }
}
