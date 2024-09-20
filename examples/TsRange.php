<?php declare(strict_types=1);

namespace TH\VOIdentity\Tests\Cloning;

use TH\VOIdentity\Identity;
use PHPUnit\Framework\TestCase;

/**
 * ```php
 * $start = new \DateTimeImmutable();
 * $end = $start->modify('+2 hours');
 *
 * $left = TsRange::of($start, $end);
 *
 * $end = $start->modify('+1 hour');
 * $right = TsRange::of($start, $end);
 *
 * assert($left !== $right);
 *
 * $right = $right->extendBy('+1 hour');
 * assert($left === $right);
 * ```
 */
final readonly class TsRange
{
    use Identity;

    protected function __construct(
        private \DateTimeImmutable $start,
        private \DateTimeImmutable $end,
    ) {
    }

    public function extendBy(string $relativeTime): self {
        return self::of($this->start, $this->end->modify($relativeTime));
    }
}
