<?php

namespace Tarampampam\LaravelDuskTester;

use Illuminate\Support\Str;

/**
 * Class Environment
 */
class Environment
{

    /**
     * Return 'true' only if current environment is local|dev.
     *
     * @return bool
     */
    public static function isDevelopment(): bool
    {
        static $is_dev = null;

        $is_dev = $is_dev ?? in_array(Str::lower(app()->environment()), ['local', 'dev', 'development']);

        return (bool) $is_dev;
    }
}
