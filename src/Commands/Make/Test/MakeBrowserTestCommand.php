<?php

namespace App\Console\Commands\Make\Test;

/**
 * Class MakeBrowserTestCommand
 *
 * Создает browser-тест.
 */
class MakeBrowserTestCommand extends AbstractMakeTestCommand
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'make:browser';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new browser-test class';

    /**
     * Get the stub file for the generator.
     *
     * @return string
     */
    protected function getStub()
    {
        $config = config('laravel-dusk-tester.browser.stub.test.path');

        return !empty($config) ? $config : __DIR__ . '/stubs/browser-test.stub';
    }

    /**
     * Get the default namespace for the class.
     *
     * @param  string $rootNamespace
     *
     * @return string
     */
    protected function getDefaultNamespace($rootNamespace)
    {
        return $rootNamespace . '\Browser';
    }
}
