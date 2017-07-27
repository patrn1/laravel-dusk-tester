<?php

namespace Tarampampam\LaravelDuskTester\Commands\Make\Test;

/**
 * Class MakeBrowserPageCommand.
 *
 * Создает page для browser тестов.
 */
class MakeBrowserPageCommand extends AbstractMakeTestCommand
{
    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected $type = 'Page';

    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'make:page';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new page-class for browser tests';

    /**
     * Get the stub file for the generator.
     *
     * @return string
     */
    protected function getStub()
    {
        $config = config('laravel-dusk-tester.browser.stub.page.path');

        return ! empty($config) ? $config : __DIR__ . '/stubs/browser-page.stub';
    }

    /**
     * Get the default namespace for the class.
     *
     * @param string $rootNamespace
     *
     * @return string
     */
    protected function getDefaultNamespace($rootNamespace)
    {
        return $rootNamespace . '\Browser\Pages';
    }
}
