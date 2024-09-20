<?php declare(strict_types=1);

namespace TH\VOIdentity\Tests\Unserializing;

use TH\VOIdentity\Identity;
use PHPUnit\Framework\TestCase;

final readonly class UserID
{
    use Identity;

    protected function __construct(
        private int $n,
    ) {
    }
}
