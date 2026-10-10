<?php

namespace App\Controller;

use App\Catalog\InMemoryCatalog;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(InMemoryCatalog $catalog): Response
    {
        return $this->render('home/index.html.twig', [
            'products' => $catalog->all(),
        ]);
    }
}
