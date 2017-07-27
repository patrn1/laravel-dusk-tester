<?php

use Illuminate\Contracts\Console\Kernel;
use Illuminate\Foundation\Application;

/**
 * You can use this file as bootstrap for your tests. For this you must make a little bit changes in `phpunit.xml`:
 *
 * <?xml version="1.0" encoding="UTF-8"?>
 * <phpunit bootstrap="./tests/bootstrap.php" ...
 */
require_once __DIR__ . '/../bootstrap/autoload.php';

/** @var Application $app */
$app = require __DIR__ . '/../bootstrap/app.php';
$app->make(Kernel::class)->bootstrap();

// Use $app here as you want

return $app;
