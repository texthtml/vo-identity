<?php declare(strict_types=1);

namespace TH\VOIdentity\Tests\Unserializing;

use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\Assert;
use PHPUnit\Framework\Attributes\Test;

class UnserializingTest extends TestCase
{
    #[Test]
    public function cloningValueObjectIsForbidden(): void
    {
        $vo = UserID::of(1);

        $string = serialize($vo);

        $this->expectExceptionObject(new \LogicException(
            'Value Object ' . UserID::class . ' using ' . \TH\VOIdentity\Identity::class . ' can\'t be unserialized',
        ));

        unserialize($string);
    }
}
