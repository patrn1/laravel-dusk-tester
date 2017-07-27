<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Laravel dusk tester settings.
    |--------------------------------------------------------------------------
    |
    */

    // Browser tests
    'browser' => [

        'test_suite' => [
            // Name of the suite for browser tests (must be presented in 'phpunit.xml')
            'name' => 'Browser',
        ],

        'screenshots' => [
            // Path to the directory for storing screenshots
            'path' => env('BROWSER_TESTS_SCREENSHOTS_PATH', storage_path('screenshots')),
            // Make directory clean before
            'clean_before' => true,
        ],

        'console_logs' => [
            // Path to the directory for storing browser console logs
            'path' => env('BROWSER_TESTS_CONSOLE_LOGS_PATH', storage_path('console_logs')),
            // Make directory clean before
            'clean_before' => true,
        ],

        // Stub file template (used for making tests 'stubs')
        'stub' => [
            'test' => [
                // Path must be absolute (override default stub file)
                'path' => null,
            ],

            'page' => [
                // Path must be absolute (override default stub file)
                'path' => null,
            ],
        ],

    ],

    // Unit tests
    'unit' => [

        'test_suite' => [
            // Name of the suite for unit tests (must be presented in 'phpunit.xml')
            'name' => 'Unit',
        ],

        // Stub file template (used for making tests 'stubs')
        'stub' => [
            'test' => [
                // Path must be absolute (override default stub file)
                'path' => null,
            ],
        ],

    ],

    // Phpunit
    'phpunit' => [

        'binary' => [
            // Path to the phpunit binary
            'path' => base_path('vendor/phpunit/phpunit/phpunit'),
        ],

        'config' => [
            // Path to the main 'phpunit.xml' config file
            'path' => base_path('phpunit.xml'),
        ],

    ],

];
