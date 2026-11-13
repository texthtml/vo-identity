<?php

declare(strict_types=1);

namespace TH\VOIdentity\Tests\StaleEntry;

use PHPUnit\Framework\Assert;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use ReflectionClass;
use TH\ObjectReaper\Reaper;
use TH\VOIdentity\Tests\CrossClassIdentity\First;

class StaleEntryTest extends TestCase
{
    #[Test]
    public function staleCacheEntryIsRebuiltInsteadOfReturningNull(): void
    {
        $left = First::of(1);

        // Simulate a GC race: detach the reaper watching the cached instance,
        // then destroy it. The cache keeps a dangling WeakReference — the state
        // that occurs if the object is collected before Reaper's callback unsets
        // the entry. resolve() must rebuild a fresh instance instead of
        // returning null from a method declared to return self.
        $this->detachReaper($left);
        unset($left);
        gc_collect_cycles();

        $right = First::of(1);

        Assert::assertNotNull($right, 'a stale cache entry must not leak a null instance');
        Assert::assertInstanceOf(First::class, $right);
    }

    private function detachReaper(object $subject): void
    {
        $map = (new ReflectionClass(Reaper::class))->getStaticPropertyValue('dd');

        foreach ($map[$subject] ?? [] as $reaper) {
            $reaper->forget();
        }
    }
}
