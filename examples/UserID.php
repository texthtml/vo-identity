<?php declare(strict_types=1);

namespace TH\VOIdentity\Tests\Cloning;

use TH\VOIdentity\Identity;
use PHPUnit\Framework\TestCase;

/**
 * ```php
 * $left = UserID::of(1);
 * $right = UserID::of(1);
 *
 * assert($left === $right);
 *
 * $right = UserID::of(2);
 *
 * assert($left !== $right);
 * ```
 */
final readonly class UserID
{
    use Identity;

    protected function __construct(
        private int $n,
    ) {
    }
}
