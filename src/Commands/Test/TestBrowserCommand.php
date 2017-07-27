<?php

namespace Tarampampam\LaravelDuskTester\Commands\Test;

/**
 * Class TestBrowserCommand.
 *
 * Command for starting browser tests.
 */
class TestBrowserCommand extends AbstractTestCommand
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'test:browser';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Start browser-tests';

    /**
     * {@inheritdoc}
     */
    public function handle()
    {
        // Makes directories
        $this->createScreenshotsDirectory();
        $this->createConsoleLogsDirectory();

        // Make clean
        if ((bool) config('laravel-dusk-tester.browser.screenshots.clean_before', true)) {
            $this->clearScreenshotsDirectory();
        }
        if ((bool) config('laravel-dusk-tester.browser.console_logs.clean_before', true)) {
            $this->clearConsoleLogsDirectory();
        }

        parent::handle();
    }

    /**
     * Makes directory for screenshots storing.
     *
     * @return bool
     */
    protected function createScreenshotsDirectory(): bool
    {
        if (($path = $this->getScreenshotsDirectoryPath()) && ! is_dir($path)) {
            return $this->makeDirectoryWithGitignoreFile($path);
        }

        return true;
    }

    /**
     * Retrieve path to the directory with screenshots.
     *
     * @return string
     */
    protected function getScreenshotsDirectoryPath(): string
    {
        return config('laravel-dusk-tester.browser.screenshots.path', storage_path('screenshots'));
    }

    /**
     * Makes directory for console logs storing.
     *
     * @return bool
     */
    protected function createConsoleLogsDirectory(): bool
    {
        if (($path = $this->getConsoleLogsDirectoryPath()) && ! is_dir($path)) {
            return $this->makeDirectoryWithGitignoreFile($path);
        }

        return true;
    }

    /**
     * Retrieve path to the directory with console logs.
     *
     * @return string
     */
    protected function getConsoleLogsDirectoryPath(): string
    {
        return (string) config('laravel-dusk-tester.browser.console_logs.path', storage_path('console_logs'));
    }

    /**
     * Make directory with screenshots clean.
     *
     * @return bool
     */
    protected function clearScreenshotsDirectory(): bool
    {
        if (($path = $this->getScreenshotsDirectoryPath()) && is_dir($path)) {
            return $this->clearDirectory($path, ['png', 'gif', 'jpg', 'jpeg', 'bmp']);
        }

        return false;
    }

    /**
     * Make directory with console logs clean.
     *
     * @return bool
     */
    protected function clearConsoleLogsDirectory(): bool
    {
        if (($path = $this->getConsoleLogsDirectoryPath()) && is_dir($path)) {
            return $this->clearDirectory($path, ['log', 'dump']);
        }

        return false;
    }

    /**
     * {@inheritdoc}
     */
    protected function getTestsSuiteName(): string
    {
        return (string) config('laravel-dusk-tester.browser.test_suite.name', 'Browser');
    }
}
