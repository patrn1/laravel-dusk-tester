<?php

namespace Tarampampam\LaravelDuskTester;

use App\Console\Commands\Make\Test\MakeBrowserPageCommand;
use App\Console\Commands\Make\Test\MakeBrowserTestCommand;
use App\Console\Commands\Make\Test\MakeUnitTestCommand;
use Illuminate\Support\ServiceProvider;
use Tarampampam\LaravelDuskTester\Commands\Test\TestBrowserCommand;
use Tarampampam\LaravelDuskTester\Commands\Test\TestUnitCommand;

/**
 * Class LaravelDuskTesterServiceProvider
 */
class LaravelDuskTesterServiceProvider extends ServiceProvider
{
    /**
     * Path to the package config.
     */
    const CONFIG_PATH = __DIR__ . '/../config/laravel-dusk-tester.php';

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
            static::CONFIG_PATH => config_path('laravel-dusk-tester.php'),
        ], 'config');

        $app_tests_directory     = base_path('tests');
        $package_tests_directory = __DIR__ . '/Tests';

        $this->publishes([
            $package_tests_directory . '/bootstrap.php'                  => $app_tests_directory,
            $package_tests_directory . '/AbstractDuskTestCase.php'       => $app_tests_directory,
            $package_tests_directory . '/AbstractTestCase.php'           => $app_tests_directory,
            $package_tests_directory . '/Browser/Pages/AbstractPage.php' => $app_tests_directory . '/Browser/Pages',
            $package_tests_directory . '/Unit/AbstractUnitTestCase.php'  => $app_tests_directory . '/Unit',
        ], 'tests');
    }
}
