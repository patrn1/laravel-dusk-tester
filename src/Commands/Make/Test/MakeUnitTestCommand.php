<?php

namespace Tarampampam\LaravelDuskTester\Commands\Make\Test;

/**
 * Class MakeUnitTestCommand.
 *
 * Создает unit-тест.
 */
class MakeUnitTestCommand extends AbstractMakeTestCommand
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'make:unit';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new unit-test class';

    /**
     * Get the stub file for the generator.
     *
     * @return string
     */
    protected function getStub()
    {
        $config = config('laravel-dusk-tester.unit.stub.test.path');

        return ! empty($config) ? $config : __DIR__ . '/stubs/unit-test.stub';
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
        return $rootNamespace . '\Unit';
    }
}
