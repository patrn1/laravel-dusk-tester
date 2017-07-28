<?php

namespace Tarampampam\LaravelDuskTester\Tests;

use PHPUnit_Framework_TestCase;

/**
 * Class AbstractUnitTestCase.
 */
abstract class AbstractUnitTestCase extends PHPUnit_Framework_TestCase
{
    use CreatesApplicationTrait;
}
