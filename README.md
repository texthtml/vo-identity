# VO Identity

Make comparing Value Objects for equality easier & safer.

# Installation

```bash
composer req texthtml/vo-identity
```

# Usage

```php
final readonly class UserID
{
    use TH\VOIdentity\Identity;

    private function __construct(private int $i) {}
}

$ua = UserID::of(42);
$ub = UserID::of(42);
$uc = UserID::of(24);

assert($ua === $ub); // $ua & $ub reference the same object so they can be compared with `===`
assert($ua !== $uc);
```

# How does it work?

The `Identity` trait implements a named constructor `::of()` that takes the same arguments as the Value Object
constructor. And return the same instance of the Value Object when an identical Value Object than a previous one would
have been created.

To identify identical Value Object, `$vo->identity()` is called and should return a valid array key. A weak reference to
the object will be kept in a cache using that key. The next time an object would be created, if a reference with that
ley exists it will be returned. The default implementation of `$vo->identity()` is using `serialize($vo)` to generate
the the ID. This is valid but can generate large string and be time consuming for large objects. For better performance,
it is recommended to override it with a specialized implementation. e.g.:

```php
final readonly class UserID
{
    use TH\VOIdentity\Identity;

    private function __construct(private int $id) {}

    protected function identity(): int
    {
        return $this->id;
    }
}
```

You can also opt-in to implemented `inputIdentity()` to compute the key from the constructor arguments, and thus avoid having to construct the Value Object if not needed. e.g.:

```php
final readonly class UserID
{
    use TH\VOIdentity\Identity;

    private function __construct(private int $id) {}

    protected function inputIdentity(int $id): int
    {
        return $id;
    }
}
```

## Garbage collection

By keeping only a weak reference to the first created instance, this let PHP able to garbage collect the Value Objects
when they are not referenced anywhere else and avoid memory leaks.


# Requirements

To work properly a few rules must be respected:

* The object must be immutable and final
* The constructor should be pure (calling it with the same argument should always produce the same result)

# Notes

## Cloning

It's not allowed to clone a Value Object using `Identity`. Doing so would defeat the purpose by creating a new instance
of a Value Object having the same inner value.

## Unserializing

PHP `__unserialize()` can't be implemented in a way that an already existing instance of an object is returned instead
of a new instance. Because of that it's not allowed to `unserialize()` a previously `serialize()`'d Value Objects. Of
course, serializing and unserializing them with other tools is possible (e.g. with the Symfony Serializer, or as a
custom Doctrine type.

## Exporting

It is possible to serialize a Value Object with `var_export()` and `eval()` the corresponding export to get a PHP
instance. If the object properties doesn't match the constructor `__set_state()` will need to be overriden.
