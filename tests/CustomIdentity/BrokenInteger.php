<?php declare(strict_types=1);

namespace TH\VOIdentity\Tests\CustomIdentity;

use TH\VOIdentity\Identity;
use PHPUnit\Framework\TestCase;

final readonly class BrokenInteger
{
    use Identity;

    protected function __construct(
        private int $n,
    ) {
    }

    protected function identity(): int
    {
        static $four = 4;

        return match ($this->n) {
            3 => 1,
            4 => $four++,
            default => $this->n,
        };
    }
}
