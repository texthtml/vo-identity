<?php declare(strict_types=1);

namespace TH\VOIdentity\Tests\NormalizedIdentity;

use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\Assert;
use PHPUnit\Framework\Attributes\Test;

class NormalizedIdentityTest extends TestCase
{
    #[Test]
    public function identityOfNormalizedValueObject(): void
    {
        $left = Integer::of(1);
        $right = Integer::of(1.5);

        Assert::assertSame(1, $left->n);
        Assert::assertSame(1, $right->n);

        Assert::assertSame($left, $right, 'ValueObject with the same values should be the same object');

        $right = Integer::of(2);

        Assert::assertSame(2, $right->n);
        Assert::assertNotSame($left, $right, 'ValueObject with different values should be different objects');
    }
}
