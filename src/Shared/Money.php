<?php

declare(strict_types=1);

namespace App\Shared;

final readonly class Money
{
    public function __construct(public int $amount, public string $currency)
    {
        if ($amount < 0) {
            throw new \InvalidArgumentException(sprintf('Amount cannot be negative, got %d.', $amount));
        }
    }

    public static function eur(int $amount): self
    {
        return new self($amount, 'EUR');
    }

    private function assertSameCurrency(self $other): void
    {
        if ($this->currency !== $other->currency) {
            throw new \InvalidArgumentException(sprintf('Currency mismatch: %s and %s.', $this->currency, $other->currency));
        }
    }

    #[\NoDiscard('add() returns a new Money, it does not modify the original.')]
    public function add(self $other): self
    {
        $this->assertSameCurrency($other);

        return new self($this->amount + $other->amount, $this->currency);
    }

    #[\NoDiscard('subtract() returns a new Money, it does not modify the original.')]
    public function subtract(self $other): self
    {
        $this->assertSameCurrency($other);

        return new self($this->amount - $other->amount, $this->currency);
    }

    #[\NoDiscard('multiply() returns a new Money, it does not modify the original.')]
    public function multiply(int $factor): self
    {
        if ($factor < 0) {
            throw new \InvalidArgumentException('It Cannot Multiply By A Negative Factor');
        }

        return new self($this->amount * $factor, $this->currency);
    }

    public function equals(self $other): bool
    {
        return $this->amount === $other->amount
            && $this->currency === $other->currency;
    }

    public function format(): string
    {
        return number_format($this->amount / 100, 2, ',', ' ').' '.$this->currency;
    }
}
