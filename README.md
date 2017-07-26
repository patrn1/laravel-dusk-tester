# Laravel 5 dusk tester

[![GitHub issues](https://img.shields.io/github/issues/tarampampam/laravel-dusk-tester.svg)](https://github.com/tarampampam/laravel-dusk-tester/issues) [![GitHub license](https://img.shields.io/badge/license-MIT-blue.svg)](https://raw.githubusercontent.com/tarampampam/laravel-dusk-tester/master/LICENSE)

More useful creating and starting tests, including browser tests *(based on official [`laravel/dusk` package][laravel_dusk])*.

### Install

Require this package with composer using the following command:

```bash
composer require tarampampam/laravel-dusk-tester
```

After updating composer, add the service provider to the `providers` array in `config/app.php`:

```php
Tarampampam\LaravelDuskTester\LaravelDuskTesterServiceProvider::class,
```

And publish config with basic tests classes:

```php
./artisan vendor:publish --provider="Tarampampam\LaravelDuskTester\LaravelDuskTesterServiceProvider"
```

> This command will create config file `./config/laravel-dusk-tester.php` with default settings and abstract test classes, required for `make:*` commands.

After that, you must add (modify) next lines in your `phpunit.xml` *(by default it located in root directory of your application)*:

```xml
<?xml version="1.0" encoding="UTF-8"?>
<phpunit>
    <testsuites>
        <testsuite name="Browser">
            <directory suffix="Test.php">./tests/Browser</directory>
        </testsuite>
    </testsuites>
</phpunit>
```

After that you will able to use next **artisan** commands:

 * `./artisan test:unit` - [Start unit-tests](#starting-unit-tests)
 * `./artisan test:browser` - [Start browser-tests](#starting-browser-tests)
 * `./artisan make:unit` - [Create new unit-test](#create-new-unit-test)
 * `./artisan make:browser` - [Create new browser-test](#create-new-browser-test)
 * `./artisan make:page` - [Create new page for browser-test](#create-new-page-for-browser-test)

#### Starting unit tests

Command `./artisan test:unit` will start `unit` test with `phpunit`. You can pass _second_ argument - name of tests group *(for this feature your tests must be "marked" with phpdoc comment `@group %group_name%`)*. More information about this you can [find here][group_phpdoc].

#### Starting browser tests

Command `./artisan test:browser` will start `browser` *(with `chromium` browser driver by default)* test also using `phpunit`. And also can pass _second_ argument - name of tests group.

#### Create new unit test

For creating new `unit` test you can use command `./artisan make:unit YourNewTestNameHere` - it will be creates new test file located, by default, in directory `./tests/Unit` with name `YourNewTestNameHereTest.php`. Postfix `Test` always appends automatically.

Also you can specify additional path, for example: `./artisan make:unit Foo/BarTests/MyTest`. As you probably guessed - new test will creates in the directory `./tests/Unit/Foo/BarTests` with name `MyTest.php`.

#### Create new browser test



#### Create new page for browser test


### License

Laravel 5 dusk tester is open-sourced software licensed under the [MIT license](./LICENSE).

[laravel_dusk]: https://github.com/laravel/dusk
[group_phpdoc]: https://phpunit.de/manual/current/en/appendixes.annotations.html#appendixes.annotations.group
