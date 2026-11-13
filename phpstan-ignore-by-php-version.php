<?php declare(strict_types=1);

// DateMalformedStringException was added in PHP 8.3; PHPStan running on PHP < 8.3
// doesn't know it, so `@throws` looks non-Throwable there. Only ignore it when
// running on an older PHP version.

if (PHP_VERSION_ID >= 80300) {
    return [];
}

return [
    'parameters' => [
        'ignoreErrors' => [
            [
                'identifier' => 'throws.notThrowable',
                'path' => __DIR__ . '/examples/TsRange.php',
            ],
        ],
    ],
];
