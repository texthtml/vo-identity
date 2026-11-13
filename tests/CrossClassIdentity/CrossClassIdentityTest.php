<?php

declare(strict_types=1);

namespace TH\VOIdentity\Tests\CrossClassIdentity;

use PHPUnit\Framework\Assert;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

class CrossClassIdentityTest extends TestCase
{
    #[Test]
    public function identityCacheIsScopedPerClass(): void
    {
        $first = First::of(1);
        $second = Second::of(1);

        // Both classes deliberately use the same identity key (`1`): the cache
        // is a function-static in the trait, so it must be scoped per class and
        // a key used by one class must never resolve to another class' instance.
        Assert::assertNotSame($first, $second, 'Identity keys must not be shared across Value Object classes');
        Assert::assertInstanceOf(First::class, $first);
        Assert::assertInstanceOf(Second::class, $second);
    }

    #[Test]
    public function identityCacheStillWorksPerClass(): void
    {
        $left = First::of(1);
        $right = First::of(1);

        Assert::assertSame($left, $right, 'The per-class identity cache must still deduplicate within a class');
    }
}
