<?php

declare(strict_types=1);

namespace TH\VOIdentity\Tests\Unserializing;

use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

class UnserializingTest extends TestCase
{
    #[Test]
    public function cloningValueObjectIsForbidden(): void
    {
        $vo = UserID::of(1);

        $string = serialize($vo);

        $this->expectExceptionObject(
            new \LogicException(
                'Value Object '
                . UserID::class
                . ' using '
                . \TH\VOIdentity\Identity::class
                . ' can\'t be unserialized',
            ),
        );

        unserialize($string);
    }
}
