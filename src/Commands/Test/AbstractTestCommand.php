<?php

namespace Tarampampam\LaravelDuskTester\Commands\Test;

use Exception;
use RuntimeException;
use Illuminate\Console\Command;
use Symfony\Component\Process\ProcessBuilder;
use Tarampampam\LaravelDuskTester\Environment;
use Symfony\Component\Console\Input\InputArgument;
use Tarampampam\LaravelDuskTester\Events\TestsFailedEvent;
use Tarampampam\LaravelDuskTester\Events\TestsSuccessEvent;
use Symfony\Component\Process\Exception\ProcessFailedException;

/**
 * Class AbstractTestCommand.
 *
 * Abstract class for package commands.
 */
abstract class AbstractTestCommand extends Command
{
    /**
     * 'Tests group name' argument key name.
     *
     * @var string
     */
    const GROUP_NAME_ARGUMENT_NAME = 'group';

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        try {
            $process = (new ProcessBuilder)
                ->setTimeout(null)
                ->setPrefix($this->getPhpunitBinary())
                ->setArguments($this->getPhpunitArguments())
                ->add('--testsuite=' . $this->getTestsSuiteName())
                ->getProcess();

            try {
                $process->setTty(true);
            } catch (RuntimeException $e) {
                $this->warn('Warning: ' . $e->getMessage());
            }

            // Run Process Asynchronously
            $process->start();

            // Read command output and write into console
            $process->wait(function ($type, $line) {
                $this->output->write($line);
            });

            if ($process->isSuccessful()) {
                event(new TestsSuccessEvent(
                    sprintf('Tests suite %s completed successful', $this->getTestsSuiteName())
                ));
            } else {
                throw new ProcessFailedException($process);
            }
        } catch (Exception $e) {
            event(new TestsFailedEvent($e->getMessage(), $e->getCode(), $e->getLine()));

            throw new Exception($e->getMessage(), $e->getCode(), $e);
        }
    }

    /**
     * Get the PHP binary to execute.
     *
     * @return string[]
     */
    protected function getPhpunitBinary(): array
    {
        return [
            PHP_BINARY,
            config('laravel-dusk-tester.phpunit.binary.path', base_path('vendor/phpunit/phpunit/phpunit')),
        ];
    }

    /**
     * Возвращает массив опций для запуска phpunit.
     *
     * @param array $options
     *
     * @return string[]
     */
    protected function getPhpunitArguments(array $options = []): array
    {
        $tests_group_name = $this->hasArgument(static::GROUP_NAME_ARGUMENT_NAME)
            ? $this->argument(static::GROUP_NAME_ARGUMENT_NAME)
            : null;

        return array_filter(array_merge([
            '-c', $this->getPhpunitConfigPath(),
            '--no-coverage',
            is_string($tests_group_name) && ! empty($tests_group_name)
                ? '--group=' . $tests_group_name
                : null,
            Environment::isDevelopment()
                ? '--verbose'
                : null,
        ], $options));
    }

    /**
     * Retrieve path to the phpunit.xml file.
     *
     * @return string
     */
    protected function getPhpunitConfigPath(): string
    {
        $path = (string) config('laravel-dusk-tester.phpunit.config.path', base_path('phpunit.xml'));

        if (file_exists($path) && is_readable($path)) {
            return $path;
        } else {
            throw new RuntimeException('phpunit config file not exists on cannot be read');
        }
    }

    /**
     * The suite name for tests running (must be declared in phpunit.xml).
     *
     * @return string
     */
    abstract protected function getTestsSuiteName(): string;

    /**
     * Make directory cleaning by passed files extensions.
     *
     * @param string $dir_path         Directory path
     * @param array  $files_extensions Files extensions
     *
     * @return bool
     */
    protected function clearDirectory(string $dir_path, array $files_extensions = []): bool
    {
        if (is_dir($dir_path) && ! empty($files_extensions)) {
            $glob_pattern = $dir_path . DIRECTORY_SEPARATOR . '*.{' . implode(',', $files_extensions) . '}';
            foreach (glob($glob_pattern, GLOB_BRACE) as $file_path) {
                try {
                    unlink($file_path);
                } catch (Exception $e) {
                    $this->error($e->getMessage());
                }
            }

            return true;
        }

        return false;
    }

    /**
     * Make directory with '.gitignore' file inside.
     *
     * @param string $path
     *
     * @return bool
     */
    protected function makeDirectoryWithGitignoreFile(string $path): bool
    {
        try {
            mkdir($path, 0755, true);
            file_put_contents($path . '/.gitignore', "*\n!.gitignore\n");

            return true;
        } catch (Exception $e) {
            $this->error($e->getMessage());
        }

        return false;
    }

    /**
     * Get the console command arguments.
     *
     * @return array[]
     */
    protected function getArguments(): array
    {
        return [
            [static::GROUP_NAME_ARGUMENT_NAME, InputArgument::OPTIONAL, 'The name of the tests group.', null],
        ];
    }
}
