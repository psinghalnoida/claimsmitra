<?php

declare(strict_types=1);

$_SERVER['CI_ENV'] = getenv('CI_ENV') ?: 'production';

if (php_sapi_name() === 'cli-server') {
    $path = parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH) ?: '/';
    $file = realpath(__DIR__ . '/../..' . $path);

    if ($path !== '/' && $file !== false && is_file($file) && str_starts_with($file, realpath(__DIR__ . '/../..'))) {
        return false;
    }
}

require __DIR__ . '/../../index.php';
