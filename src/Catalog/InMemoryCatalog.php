<?php

declare(strict_types=1);

namespace App\Catalog;

use App\Shared\Money;

final class InMemoryCatalog
{
    /** @return list<Product> */
    public function all(): array
    {
        return [
            new Product('clavier-mecanique', 'Clavier mécanique', Money::eur(8990), 'Switchs linéaires, rétroéclairage et châssis aluminium.'),
            new Product('souris-ergonomique', 'Souris ergonomique', Money::eur(5490), 'Forme verticale pour soulager le poignet.'),
            new Product('ecran-27', 'Écran 27 pouces', Money::eur(24900), 'Dalle IPS QHD, 144 Hz.'),
            new Product('casque-audio', 'Casque audio', Money::eur(12990), 'Réduction de bruit active, 40 h d\'autonomie.'),
        ];
    }

    public function find(string $slug): ?Product
    {
        return array_find($this->all(), static fn (Product $p): bool => $p->slug === $slug);
    }
}
