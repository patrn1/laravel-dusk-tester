<?php

namespace Tarampampam\LaravelDuskTester\Tests;

use Tarampampam\LaravelDuskTester\Environment;

/**
 * Class EnvironmentTest
 */
class EnvironmentTest extends AbstractUnitTestCase
{
    /**
     * Tested object.
     *
     * @var Environment
     */
    protected $environment_object;

    /**
     * @inheritdoc
     */
    public function setUp()
    {
        parent::setUp();

        $this->environment_object = new Environment;
    }

    /**
     * @inheritdoc
     */
    public function tearDown(): void
    {
        unset($this->environment_object);

        parent::tearDown();
    }

    /**
     * Test for method isDevelopment().
     *
     * @return void
     */
    public function testIsDevelopment()
    {
        $this->assertTrue(method_exists($this->environment_object, 'isDevelopment'));
    }
}
