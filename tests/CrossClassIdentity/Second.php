<?php

declare(strict_types=1);

namespace TH\VOIdentity\Tests\CrossClassIdentity;

use TH\VOIdentity\Identity;

final readonly class Second
{
    use Identity;

    protected function __construct(
        private int $n,
    ) {}

    protected function identity(): int
    {
        return $this->n;
    }
}
