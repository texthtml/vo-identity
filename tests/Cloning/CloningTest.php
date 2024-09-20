<?php declare(strict_types=1);

namespace TH\VOIdentity\Tests\Cloning;

use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\Assert;
use PHPUnit\Framework\Attributes\Test;

class CloningTest extends TestCase
{
    #[Test]
    public function cloningValueObjectIsForbidden(): void
    {
        $vo = UserID::of(1);

        $this->expectExceptionObject(new \LogicException(
            'Value Object ' . UserID::class . ' using ' . \TH\VOIdentity\Identity::class . ' can\'t be cloned',
        ));

        clone $vo;
    }
}
