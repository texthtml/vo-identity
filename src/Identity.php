<?php declare(strict_types=1);

namespace TH\VOIdentity;

use TH\ObjectReaper\Reaper;

/** @readonly */
trait Identity
{
    /** @pure */
    private function __construct() {}

    /**
     * @param array<mixed> $args
     */
    final public static function of(mixed ...$args): self {
        $constructor = static fn () => new self(...$args);

        return self::resolve($constructor, self::inputIdentity(...$args));
    }

    /**
     * @param self|callable():self $ref
     * @param array-key|null $key
     */
    final protected static function resolve(callable $ref, int|string|null $key): self {
        if ($key === null) {
            $ref = $ref();
            $key = $ref->identity();
        }

        /** @var array<\WeakReference<self>> $mem */
        static $mem = [];

        if (\array_key_exists($key, $mem)) {
            return $mem[$key]->get();
        }

        if (!$ref instanceof self) {
            $ref = $ref();
        }

        Reaper::watch($ref, static function () use ($key, &$mem): void {
            unset($mem[$key]);
        });

        $mem[$key] ??= \WeakReference::create($ref);

        return $ref;
    }

    /**
     * @return array-key
     */
    protected function identity(): int|string
    {
        return \serialize($this);
    }

    /**
     * @return array-key|null
     */
    protected static function inputIdentity(mixed ...$args): int|string|null {
        return null;
    }

    final public function __clone(): never
    {
        throw new \LogicException('Value Object ' . static::class . ' using ' . Identity::class . ' can\'t be cloned');
    }

    /**
     * @param array<mixed> $data
     */
    final public function __unserialize(array $data): never
    {
        throw new \LogicException(
            'Value Object ' . static::class . ' using ' . Identity::class . ' can\'t be unserialized',
        );
    }

    /**
     * Default implementation of __set_state()
     *
     * A correct implementation need to finish by calling self::of() or self::resolve*() and returning its result.
     *
     * @param array<string,mixed> $data
     */
    public static function __set_state(array $data): self
    {
        return self::of(...$data);
    }
}
