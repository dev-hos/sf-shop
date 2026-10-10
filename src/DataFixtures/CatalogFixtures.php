<?php

declare(strict_types=1);

namespace App\DataFixtures;

use App\Catalog\Product;
use App\Shared\Money;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

final class CatalogFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $products = [
            ['clavier-mecanique', 'Clavier mécanique', 8990, 'Switchs linéaires, rétroéclairage et châssis aluminium.'],
            ['souris-ergonomique', 'Souris ergonomique', 5490, 'Forme verticale pour soulager le poignet.'],
            ['ecran-27', 'Écran 27 pouces', 24900, 'Dalle IPS QHD, 144 Hz.'],
            ['casque-audio', 'Casque audio', 12990, 'Réduction de bruit active, 40 h d\'autonomie.'],
        ];

        foreach ($products as [$slug, $name, $cents, $description]) {
            $manager->persist(new Product($slug, $name, Money::eur($cents), $description));
        }

        $manager->flush();
    }
}
