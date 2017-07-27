<?php

namespace Tests;

use Facebook\WebDriver\Chrome\ChromeOptions;
use Facebook\WebDriver\Remote\DesiredCapabilities;
use Facebook\WebDriver\Remote\RemoteWebDriver;
use Laravel\Dusk\Browser;
use Laravel\Dusk\TestCase as BaseTestCase;
use Tarampampam\LaravelDuskTester\Environment;

/**
 * Class AbstractDuskTestCase
 *
 * Abstract class for browser tests.
 */
abstract class AbstractDuskTestCase extends BaseTestCase
{
    use CreatesApplication;

    /**
     * @inheritdoc
     */
    public function setUp()
    {
        parent::setUp();

        Browser::$storeScreenshotsAt = config('laravel-dusk-tester.browser.screenshots.path');
        Browser::$storeConsoleLogAt  = config('laravel-dusk-tester.browser.console_logs.path');
    }

    /**
     * Prepare for Dusk test execution.
     *
     * @beforeClass
     *
     * @return void
     */
    public static function prepare()
    {
        if (Environment::isDevelopment()) {
            static::startChromeDriver();
        }
    }

    /**
     * Create the RemoteWebDriver instance.
     *
     * @return \Facebook\WebDriver\Remote\RemoteWebDriver
     */
    protected function driver()
    {
        $chromeOptions = new ChromeOptions();
        $chromeOptions->addArguments(['no-sandbox']);
        $capabilities = DesiredCapabilities::chrome();
        $capabilities->setCapability(ChromeOptions::CAPABILITY, $chromeOptions);

        return RemoteWebDriver::create(
            env('SELENIUM_SERVER_URI', 'http://localhost:9515'),
            $capabilities,
            150000,
            150000
        );
    }
}
