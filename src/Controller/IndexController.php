<?php

namespace App\Controller;

class IndexController extends AbstractController
{
    public function home(): string
    {
        return $this->twig->render('index/home.html.twig');
    }

    public function contact(): string
    {
        return $this->twig->render('index/contact.html.twig');
    }
}