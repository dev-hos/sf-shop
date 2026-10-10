<?php

declare(strict_types=1);

namespace App\Catalog;

use App\Shared\Money;

final readonly class Product
{
    public function __construct(
        public string $slug,
        public string $name,
        public Money $price,
        public string $description,
    ) {
    }
}
