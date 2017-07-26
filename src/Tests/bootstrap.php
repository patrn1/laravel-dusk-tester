<?php

use Illuminate\Contracts\Console\Kernel;
use Illuminate\Foundation\Application;

require_once __DIR__ . '/../bootstrap/autoload.php';

/** @var Application $app */
$app = require __DIR__ . '/../bootstrap/app.php';
$app->make(Kernel::class)->bootstrap();

return $app;
