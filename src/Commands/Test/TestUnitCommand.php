<?php

namespace Tarampampam\LaravelDuskTester\Commands\Test;

/**
 * Class TestUnitCommand
 *
 * Command for starting unit tests.
 */
class TestUnitCommand extends AbstractTestCommand
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'test:unit';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Start unit-tests';

    /**
     * @inheritdoc
     */
    protected function getTestsSuiteName(): string
    {
        return (string) config('laravel-dusk-tester.unit.test_suite.name', 'Unit');
    }
}
