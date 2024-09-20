<?php declare(strict_types=1);

namespace TH\VOIdentity\Tests\SingleScalarValue;

use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\Assert;
use PHPUnit\Framework\Attributes\Test;

class SingleScalarValueTest extends TestCase
{
    #[Test]
    public function VOswithTheSameValueAreTheSameObjects(): void
    {
        $left = UserID::of(1);
        $right = UserID::of(1);

        Assert::assertSame($left, $right, 'UserID with the same ID should be the same object');
    }

    #[Test]
    public function VOswithTheDifferentValuesAreDifferents(): void
    {
        $left = UserID2::of(1);
        $right = UserID2::of(2);

        Assert::assertNotSame($left, $right, 'UserID with the different IDs should be different objects');
        Assert::assertNotEquals($left, $right, 'UserID with the different IDs should not be equals');
    }
}
