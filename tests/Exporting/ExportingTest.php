<?php

declare(strict_types=1);

namespace TH\VOIdentity\Tests\Exporting;

use PHPUnit\Framework\Assert;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

class ExportingTest extends TestCase
{
    #[Test]
    public function cloningValueObjectIsNotFullyImplemented(): void
    {
        $left = UserID::of(1);

        $export = var_export(value: $left, return: true);

        // @mago-expect lint:no-eval
        eval("\$right = {$export};");

        // @mago-expect analysis:undefined-variable
        Assert::assertSame($left, $right, 'UserID with the same ID should be the same object');
    }
}
