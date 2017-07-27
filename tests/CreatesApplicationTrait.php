<?php

namespace Tarampampam\LaravelDuskTester\Tests;

use Illuminate\Contracts\Console\Kernel;

/**
 * Trait CreatesApplicationTrait
 */
trait CreatesApplicationTrait
{
    /**
     * Creates the application.
     *
     * @return \Illuminate\Foundation\Application
     */
    public function createApplication()
    {
        $app = require __DIR__ . '/../bootstrap/app.php';

        $app->make(Kernel::class)->bootstrap();

        return $app;
    }
}
