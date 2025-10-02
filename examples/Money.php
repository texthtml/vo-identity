<?php declare(strict_types=1);

namespace TH\VOIdentity\Tests\Cloning;

use TH\VOIdentity\Identity;

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
        // @phpstan-ignore argument.type,argument.type
        return self::ofMinor((int) ($value * 100), $currency);
    }

    /**
     * @param int<1,max> $n
     */
    public function dividedBy(int $n): self
    {
        // @phpstan-ignore argument.type,argument.type
        return self::ofMinor($this->cents / $n, $this->currency);
    }
}
