<?php

namespace App\Controller;

use App\Shared\Money;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(): Response
    {
        return $this->render('home/index.html.twig', [
            'products' => [
                ['name' => 'Clavier mécanique', 'price' => Money::eur(8990)],
                ['name' => 'Souris ergonomique', 'price' => Money::eur(5490)],
                ['name' => 'Écran 27 pouces', 'price' => Money::eur(24900)],
                ['name' => 'Casque audio', 'price' => Money::eur(12990)],
            ],
        ]);
    }
}
