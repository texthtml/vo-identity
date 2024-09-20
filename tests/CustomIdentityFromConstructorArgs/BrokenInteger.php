<?php declare(strict_types=1);

namespace TH\VOIdentity\Tests\CustomIdentityFromConstructorArgs;

use TH\VOIdentity\Identity;
use PHPUnit\Framework\TestCase;

final readonly class BrokenInteger
{
    use Identity;

    protected function __construct(
        private int $n,
        callable $ping,
    ) {
        $ping();
    }
    protected static function inputIdentity(int $n): int
    {
        static $four = 4;

        return match ($n) {
            3 => 1,
            4 => $four++,
            default => $n,
        };
    }
}
