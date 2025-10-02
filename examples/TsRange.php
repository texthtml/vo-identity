<?php declare(strict_types=1);

namespace TH\VOIdentity\Tests\Cloning;

use TH\VOIdentity\Identity;

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

    /**
     * @throws \DateMalformedStringException
     */
    public function extendBy(string $relativeTime): self {
        // @phpstan-ignore argument.type,argument.type
        return self::of($this->start, $this->end->modify($relativeTime));
    }
}
