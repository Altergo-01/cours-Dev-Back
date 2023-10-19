<?php

namespace App\Controller;

use App\Service\TestSlug;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProductController extends AbstractController
{
    #[Route('/product', name: 'app_product')]
    public function listProduct(TestSlug $testSlug)
    {

        $slugResult = $testSlug->slugify("le numéro de votre produit est : ");

        return $this->render('product.html.twig',
            [
                'slug' => $slugResult,


            ]

        );

    }

    #[Route('/product/{id}', name: 'product_view')]
    public function viewProduct($id, TestSlug $testSlug)
    {
        $slugResult = $testSlug->slugify("le numéro de votre produit est : ");
        $produit = $id;

        return $this->render('product.html.twig',
            [
                'slug' => $slugResult,
                'produit' => $produit,


            ]

        );

    }



}
