<?php declare(strict_types=1);

namespace TH\VOIdentity\Tests\Exporting;

use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\Assert;
use PHPUnit\Framework\Attributes\Test;

class ExportingTest extends TestCase
{
    #[Test]
    public function cloningValueObjectIsNotFullyImplemented(): void
    {
        $left = UserID::of(1);

        $export = var_export($left, true);

        eval("\$right = $export;");

        Assert::assertSame($left, $right, 'UserID with the same ID should be the same object');
    }
}
