<?php

declare(strict_types=1);

namespace App\Controller;

use App\Catalog\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class ProductController extends AbstractController
{
    #[Route('/produits/{slug}', name: 'app_product_show')]
    public function show(string $slug, ProductRepository $products): Response
    {
        $product = $products->findOneBySlug($slug) ?? throw $this->createNotFoundException();

        return $this->render('product/show.html.twig', ['product' => $product]);
    }
}
