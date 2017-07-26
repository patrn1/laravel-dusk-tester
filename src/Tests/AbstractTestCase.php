<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

/**
 * Class AbstractTestCase
 *
 * Абстрактный класс для всех unit-тестов.
 */
abstract class AbstractTestCase extends BaseTestCase
{
    use CreatesApplication;
}
