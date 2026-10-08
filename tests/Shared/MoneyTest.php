<?php

declare(strict_types=1);

namespace App\Tests\Shared;

use App\Shared\Money;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

final class MoneyTest extends TestCase
{
    #[Test]
    public function itAddsTwoAmounts(): void
    {
        $sum = Money::eur(1000)->add(Money::eur(599));
        self::assertSame(1599, $sum->amount);
    }

    #[Test]
    public function itCannotAddDifferentCurrencies(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        (void) Money::eur(1000)->add(new Money(500, 'USD'));
    }

    #[Test]
    public function itRejectsANegativeAmount(): void
    {
        $this->expectException(\InvalidArgumentException::class);

        Money::eur(-1);
    }

    #[Test]
    public function itSubtractAnAmount(): void
    {
        self::assertSame(400, Money::eur(1000)->subtract(Money::eur(600))->amount);
    }

    #[Test]
    public function itCannotGoBelowZero(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        (void) Money::eur(100)->subtract(Money::eur(200));
    }

    #[Test]
    public function itCannotSubtractDifferentCurrencies(): void
    {
        $this->expectException(\InvalidArgumentException::class);

        (void) Money::eur(1000)->subtract(new Money(500, 'USD'));
    }

    #[Test]
    public function itIsImmutable(): void
    {
        $money = Money::eur(1000);
        (void) $money->add(Money::eur(500));

        self::assertSame(1000, $money->amount);
    }

    #[Test]
    public function itCannotBeModified(): void
    {
        $money = Money::eur(1000);
        $this->expectException(\Error::class);
        // @phpstan-ignore assign.propertyProtectedSet
        $money->amount = 2000;
    }

    #[Test]
    public function itMultipliesAnAmount(): void
    {
        self::assertSame(3000, Money::eur(1000)->multiply(3)->amount);
    }

    #[Test]
    public function itCannotMultiplyByANegativeFactor(): void
    {
        $this->expectException(\InvalidArgumentException::class);

        (void) Money::eur(1000)->multiply(-2);
    }

    #[Test]
    public function itIsEqualToAnotherMoneyWithSameAmountAndCurrency(): void
    {
        self::assertTrue(Money::eur(1000)->equals(Money::eur(1000)));
    }

    #[Test]
    public function itIsNotEqualWhenAmountOrCurrencyDiffers(): void
    {
        self::assertFalse(Money::eur(1000)->equals(Money::eur(999)));
        self::assertFalse(Money::eur(1000)->equals(new Money(1000, 'USD')));
    }

    #[Test]
    public function itFormatsAnAmount(): void
    {
        self::assertSame('15,99 EUR', Money::eur(1599)->format());
    }
}
