<?php

namespace Tarampampam\LaravelDuskTester;

use Illuminate\Support\Str;
use RecursiveIteratorIterator;
use RecursiveDirectoryIterator;
use Illuminate\Support\ServiceProvider;
use Tarampampam\LaravelDuskTester\Commands\Test\TestUnitCommand;
use Tarampampam\LaravelDuskTester\Commands\Test\TestBrowserCommand;
use Tarampampam\LaravelDuskTester\Commands\Make\Test\MakeUnitTestCommand;
use Tarampampam\LaravelDuskTester\Commands\Make\Test\MakeBrowserPageCommand;
use Tarampampam\LaravelDuskTester\Commands\Make\Test\MakeBrowserTestCommand;

/**
 * Class LaravelDuskTesterServiceProvider.
 */
class LaravelDuskTesterServiceProvider extends ServiceProvider
{
    /**
     * Path to the package config.
     */
    const CONFIG_PATH = __DIR__ . '/../config/laravel-dusk-tester.php';

    /**
     * Path to the basic tests classes.
     */
    const BASIC_TESTS_PATH = __DIR__ . '/../publishes/tests';

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(): void
    {
        //
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register(): void
    {
        $this->commands([
            TestUnitCommand::class,
            TestBrowserCommand::class,

            MakeUnitTestCommand::class,
            MakeBrowserTestCommand::class,
            MakeBrowserPageCommand::class,
        ]);

        $this->mergeConfigFrom(
            static::CONFIG_PATH, 'laravel-dusk-tester'
        );

        $this->publishes([
            realpath(static::CONFIG_PATH) => config_path('laravel-dusk-tester.php'),
        ], 'config');
        $this->publishes($this->getTestsFilesPublishes(), 'tests');
    }

    /**
     * Get tests (any in static::BASIC_TESTS_PATH directory) files for publishes.
     *
     * @return string[]|array
     */
    protected function getTestsFilesPublishes(): array
    {
        static $result = [];

        if (empty($result)) {
            $basic_tests_path    = realpath(static::BASIC_TESTS_PATH);
            $iterator            = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($basic_tests_path));
            $app_tests_directory = base_path('tests');

            foreach ($iterator as $file) {
                /** @var \SplFileInfo $file */
                if ($file->isFile() && ($path = $file->getRealPath())) {
                    $result[$path] = Str::replaceFirst($basic_tests_path, $app_tests_directory, $path);
                }
                $files[] = $file->getPathname();
            }
        }

        return $result;
    }
}
