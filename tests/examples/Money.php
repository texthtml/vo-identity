<?php declare(strict_types=1);

namespace TH\VOIdentity\Tests\Cloning;

use TH\VOIdentity\Identity;
use PHPUnit\Framework\TestCase;

/**
 * ```php
 * $left = Money::ofMinor(1550, 'EUR');
 *
 * $right = Money::of(15.50, 'EUR');
 * assert($left === $right);
 *
 * $right = Money::of(15.50, 'GBP');
 * assert($left !== $right);
 *
 * $right = Money::ofMinor(1550, 'EUR');
 * assert($left === $right);
 *
 * $right = Money::of(31, 'EUR')->dividedBy(2);
 * assert($left === $right);
 * ```
 */
final readonly class Money
{
    use Identity { Identity::of as ofMinor; }

    protected function __construct(
        private int $cents,
        private string $currency,
    ) {
    }

    public static function of(int|float $value, string $currency): self {
        return self::ofMinor((int) ($value * 100), $currency);
    }

    public function dividedBy(int $n): self
    {
        return self::ofMinor($this->cents / $n, $this->currency);
    }
}
