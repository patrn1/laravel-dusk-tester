<?php

namespace Tests\Browser\Pages;

use Laravel\Dusk\Browser;
use Laravel\Dusk\Page as BasePageTest;

/**
 * Class AbstractPage
 *
 * Abstract class for all browser pages.
 */
abstract class AbstractPage extends BasePageTest
{
    /**
     * Get the URL for the page.
     *
     * @return string
     */
    public function url(): string
    {
        return '';
    }

    /**
     * Assert that the browser is on the page.
     *
     * @param  Browser  $browser
     * @return void
     */
    public function assert(Browser $browser)
    {
        //
    }

    /**
     * Get the global element shortcuts for the site.
     *
     * @return string[]
     */
    public static function siteElements(): array
    {
        return [
            //'@element' => '#selector',
        ];
    }
}
