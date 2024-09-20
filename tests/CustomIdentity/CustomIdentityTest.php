<?php declare(strict_types=1);

namespace TH\VOIdentity\Tests\CustomIdentity;

use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\Assert;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Test;

class CustomIdentityTest extends TestCase
{
    #[Test]
    #[DataProvider('cases')]
    public function overridingIdentityMethod(
        int $left,
        int $right,
        bool $expectSame,
        string $expectMessage,
    ): void {
        $left = BrokenInteger::of($left);
        $right = BrokenInteger::of($right);

        Assert::assertSame($expectSame, $left === $right, $expectMessage);
    }

    public static function cases(): iterable
    {
        yield "non broken - same" => [
            "left" => 1,
            "right" => 1,
            "expectSame" => true,
            "expectMessage" => "BrokenInteger(1) is not broken so they should be the same",
        ];

        yield "non broken - different" => [
            "left" => 1,
            "right" => 2,
            "expectSame" => false,
            "expectMessage" => "BrokenInter(1) and BrokenInteger(2) are not broken so they should be different",
        ];

        yield "3 === 1" => [
            "left" => 1,
            "right" => 3,
            "expectSame" => true,
            "expectMessage" => "BrokenInteger(3) identifies as BrokenInteger(1) so they should be the same",
        ];

        yield "4 === 4" => [
            "left" => 4,
            "right" => 4,
            "expectSame" => false,
            "expectMessage" => "BrokenInteger(4) identity changes each time so they should be different",
        ];
    }
}
