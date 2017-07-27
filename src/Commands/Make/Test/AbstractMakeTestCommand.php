<?php

namespace Tarampampam\LaravelDuskTester\Commands\Make\Test;

use Illuminate\Console\GeneratorCommand;
use Illuminate\Support\Str;
use Symfony\Component\Console\Input\InputArgument;

/**
 * Class AbstractMakeTestCommand
 *
 * Abstract command class for making tests templates from stubs.
 */
abstract class AbstractMakeTestCommand extends GeneratorCommand
{
    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected $type = 'Test';

    /**
     * Execute the console command.
     *
     * @return bool|null
     */
    public function fire()
    {
        if (parent::fire() !== false) {
            $this->info('Located here: ' . $this->getPath($this->qualifyClass($this->getNameInput())));
        }
    }

    /**
     * Get the destination class path.
     *
     * @param string $name
     *
     * @return string
     */
    protected function getPath($name)
    {
        $name = str_replace_first($this->rootNamespace(), '', $name);

        return $this->laravel->basePath() . '/tests' . str_replace('\\', '/', $name) . '.php';
    }

    /**
     * Get the root namespace for the class.
     *
     * @return string
     */
    protected function rootNamespace()
    {
        return 'Tests';
    }

    /**
     * Get the desired class name from the input.
     *
     * @return string
     */
    protected function getNameInput()
    {
        $name = $this->argument('name');

        // Try to convert class name to CamelCase
        if (($parts = preg_split('~(\\\\|\/)~', $name)) && is_array($parts) && !empty($parts)) {
            $last = (string) end($parts);
            $name = Str::replaceLast($last, Str::ucfirst(Str::camel($last)), $name);
        }

        $type = Str::lower(trim($this->type));

        if ($type === 'test') {
            // If test name does not ends with 'test'
            if (!Str::endsWith(Str::lower($name), 'test')) {
                $name .= 'Test';
            } else {
                $name = preg_replace('~test$~i', 'Test', $name);
            }
        } elseif ($type === 'page') {
            // And also for 'page'
            if (!Str::endsWith(Str::lower($name), 'page')) {
                $name .= 'Page';
            } else {
                $name = preg_replace('~page$~i', 'Page', $name);
            }
        }

        return trim($name);
    }

    /**
     * Get the console command arguments.
     *
     * @return array[]
     */
    protected function getArguments(): array
    {
        return [
            ['name', InputArgument::REQUIRED, 'The name of the class.', null],
        ];
    }
}
