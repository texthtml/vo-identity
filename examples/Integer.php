<?php declare(strict_types=1);

namespace TH\VOIdentity\Tests\Cloning;

use TH\VOIdentity\Identity;
use PHPUnit\Framework\TestCase;

/**
 * ```php
 * $left = Integer::of(1);
 * $right = Integer::of(1.2);
 *
 * assert($left === $right);
 *
 * $right = Integer::of(2);
 *
 * assert($left !== $right);
 * ```
 */
final readonly class Integer
{
    use Identity;

    private int $n;

    protected function __construct(
        int|float $n,
    ) {
        $this->n = (int) $n;
    }
}
