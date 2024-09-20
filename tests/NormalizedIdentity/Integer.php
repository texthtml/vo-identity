<?php declare(strict_types=1);

namespace TH\VOIdentity\Tests\NormalizedIdentity;

use TH\VOIdentity\Identity;
use PHPUnit\Framework\TestCase;

final readonly class Integer
{
    use Identity;

    public int $n;

    protected function __construct(
        int|float $n,
    ) {
        $this->n = (int) $n;
    }
}
