# Laravel 5 dusk tester

[![GitHub license](https://styleci.io/repos/98423395/shield)](https://styleci.io/repos/98423395) [![Build Status](https://scrutinizer-ci.com/g/tarampampam/laravel-dusk-tester/badges/build.png?b=master)](https://scrutinizer-ci.com/g/tarampampam/laravel-dusk-tester/build-status/master)  [![Code Coverage](https://scrutinizer-ci.com/g/tarampampam/laravel-dusk-tester/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/tarampampam/laravel-dusk-tester/?branch=master) [![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/tarampampam/laravel-dusk-tester/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/tarampampam/laravel-dusk-tester/?branch=master)  [![GitHub issues](https://img.shields.io/github/issues/tarampampam/laravel-dusk-tester.svg?style=flat-square)](https://github.com/tarampampam/laravel-dusk-tester/issues) [![GitHub license](https://img.shields.io/badge/license-MIT-blue.svg?style=flat-square)](https://raw.githubusercontent.com/tarampampam/laravel-dusk-tester/master/LICENSE) 

More useful creating and starting tests, including browser tests *(based on official [`laravel/dusk` package][laravel_dusk_package])*.

### Install

Require this package with composer using the following command:

```bash
$ composer require tarampampam/laravel-dusk-tester
```

After updating composer, add the service provider to the `providers` array in `config/app.php`:

```php
'providers' => [
    // ...
    Tarampampam\LaravelDuskTester\LaravelDuskTesterServiceProvider::class,
]
```

And publish config & basic tests classes:

```php
$ ./artisan vendor:publish --provider="Tarampampam\LaravelDuskTester\LaravelDuskTesterServiceProvider"
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

Command `./artisan test:unit` will start `unit` tests with `phpunit`. You can pass _second_ argument - name of tests group *(for this feature your tests must be "marked" with phpdoc comment `@group %group_name%`)*. More information about this you can [find here][group_phpdoc].

#### Starting browser tests

Command `./artisan test:browser` will start `browser` *(with `chromium` browser driver by default)* tests also using `phpunit`. And also can pass _second_ argument - name of tests group.

#### Create new unit test

For creating new `unit` test you can use command `./artisan make:unit YourNewTestNameHere` - it will be creates new test file located, by default, in directory `./tests/Unit` with name `YourNewTestNameHereTest.php`. Postfix `Test` always appends automatically.

Also you can specify additional path, for example: `./artisan make:unit Foo/BarTests/MyTest`. As you probably guessed - new test will creates in the directory `./tests/Unit/Foo/BarTests` with name `MyTest.php`.

#### Create new browser test

With command `./artisan make:browser SomeBrowserTest` you can create new `browser` test, for more information about this you can read here: [Laravel dusk tests][laravel_dusk_docs].

Browsers tests located in directory `./tests/Browser`.

As with `make:unit` command you can specify additional path.

#### Create new page for browser test

Command `./artisan make:page SomeBrowserTest` will creates for you `page` class, for using with `browser` tests. You can find more information about this here: [Laravel dusk pages][laravel_dusk_docs_pages].

Pages for browser tests located in directory `./tests/Browser/Pages`.

As with `make:unit` command you can specify additional path.

### License

Laravel 5 dusk tester is open-sourced software licensed under the [MIT license](./LICENSE).

[laravel_dusk_package]: https://github.com/laravel/dusk
[laravel_dusk_docs]: https://laravel.com/docs/5.4/dusk
[laravel_dusk_docs_pages]: https://laravel.com/docs/5.4/dusk#pages
[group_phpdoc]: https://phpunit.de/manual/current/en/appendixes.annotations.html#appendixes.annotations.group
