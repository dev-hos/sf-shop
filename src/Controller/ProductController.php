<?php

declare(strict_types=1);

namespace App\Controller;

use App\Catalog\InMemoryCatalog;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class ProductController extends AbstractController
{
    #[Route('/produits/{slug}', name: 'app_product_show')]
    public function show(string $slug, InMemoryCatalog $catalog): Response
    {
        $product = $catalog->find($slug) ?? throw $this->createNotFoundException();

        return $this->render('product/show.html.twig', ['product' => $product]);
    }
}
