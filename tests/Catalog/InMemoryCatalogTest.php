<?php

declare(strict_types=1);

namespace App\Tests\Catalog;

use App\Catalog\InMemoryCatalog;
use App\Catalog\Product;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

final class InMemoryCatalogTest extends TestCase
{
    #[Test]
    public function itFindsAProductBySlug(): void
    {
        $catalog = new InMemoryCatalog();

        $product = $catalog->find('clavier-mecanique');

        self::assertInstanceOf(Product::class, $product);
        self::assertSame('Clavier mécanique', $product->name);
    }

    #[Test]
    public function itReturnsNullForAnUnknownSlug(): void
    {
        $catalog = new InMemoryCatalog();
        $product = $catalog->find('inconnu');

        self::assertNull($product);
    }

    #[Test]
    public function itHasUniqueSlugs(): void
    {
        $slugs = array_map(
            static fn (Product $product): string => $product->slug,
            (new InMemoryCatalog())->all(),
        );

        self::assertSame($slugs, array_values(array_unique($slugs)));
    }
}
