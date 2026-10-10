<?php

declare(strict_types=1);

namespace App\Catalog;

use App\Shared\Money;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProductRepository::class)]
#[ORM\Table(name: 'product')]
class Product
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    public private(set) ?int $id = null;

    public function __construct(
        #[ORM\Column(length: 120, unique: true)]
        public private(set) string $slug,
        #[ORM\Column(length: 255)]
        public private(set) string $name,
        #[ORM\Embedded(class: Money::class, columnPrefix: 'price_')]
        public private(set) Money $price,
        #[ORM\Column(type: 'text')]
        public private(set) string $description,
    ) {
    }
}
