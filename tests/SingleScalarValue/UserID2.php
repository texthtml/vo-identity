<?php declare(strict_types=1);

namespace TH\VOIdentity\Tests\SingleScalarValue;

use TH\VOIdentity\Identity;
use PHPUnit\Framework\TestCase;

final readonly class UserID2
{
    use Identity;

    protected function __construct(
        private int $n,
    ) {
    }
}
