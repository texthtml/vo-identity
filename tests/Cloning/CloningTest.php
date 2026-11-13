<?php

declare(strict_types=1);

namespace TH\VOIdentity\Tests\Cloning;

use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

class CloningTest extends TestCase
{
    #[Test]
    public function cloningValueObjectIsForbidden(): void
    {
        $vo = UserID::of(1);

        $this->expectExceptionObject(
            new \LogicException(
                'Value Object ' . UserID::class . ' using ' . \TH\VOIdentity\Identity::class . ' can\'t be cloned',
            ),
        );

        clone $vo;
    }
}
