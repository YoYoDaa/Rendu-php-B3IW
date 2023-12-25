<?php

namespace App\Controller;

use App\Entity\Product;
use App\Repository\ProductRepository;
use Doctrine\ORM\EntityManager;

class ProductController extends AbstractController
{
    public function new(EntityManager $em): string
    {
        $product = new Product();
        $product
            ->setName(name: "sIgTKZNDZrr")
            ->setPrice(76.24);

        $em->persist(entity: $product);
        $em->flush();

        return $this->twig->render("products/new.html.twig", [
            'product' => $product
        ]);
    }

    public function list(ProductRepository $productRepository): string
    {
        return $this->twig->render('products/list.html.twig', [
            'products' => $productRepository->findAll()
        ]);
    }
}