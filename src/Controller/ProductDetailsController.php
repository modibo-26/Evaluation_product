<?php

namespace App\Controller;

use App\Entity\Product;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProductDetailsController extends AbstractController
{
    /**
     * @Route("/product/details", name="app_product_details")
     */
    public function index(): Response
    {
        return $this->render('product_details/index.html.twig', [
            'controller_name' => 'ProductDetailsController',
        ]);
    }
    /**
     * @Route("/product/details/{id}", name="app_product_details_")
     */
    public function details(Product $product): Response
    {
        return $this->render('product_details/index.html.twig', [
            'product' => $product
        ]);
    }
}
