# Laravel Dev Extras

[![Packagist](https://img.shields.io/packagist/v/jim-merioles/laravel-dev-extras.svg?label=Latest%20Release)](https://github.com/JimMerioles/Laravel-Dev-Extras/releases)
[![Travis branch](https://img.shields.io/travis/JimMerioles/Laravel-Dev-Extras/master.svg?label=TravisCI%20Build:%20Master)](https://travis-ci.org/JimMerioles/Laravel-Dev-Extras)
[![GitHub commits](https://img.shields.io/github/commits-since/JimMerioles/Laravel-Dev-Extras/v0.1.0.svg?label=Commits%20Since%20v0.1.0)](https://github.com/JimMerioles/Laravel-Dev-Extras/commits/master)
[![Packagist](https://img.shields.io/packagist/dt/jim-merioles/laravel-dev-extras.svg?label=Total%20Downloads)](https://packagist.org/packages/jim-merioles/laravel-dev-extras/stats)
[![license](https://img.shields.io/github/license/mashape/apistatus.svg?label=Open%20Source%20License)](https://github.com/JimMerioles/Laravel-Dev-Extras/blob/master/LICENSE.txt)

This Laravel package provide artisan developers with useful developement commands and helpers that are not included in Laravel by default.

## Installation

To get the latest version of Laravel Dev Extras, simply require the project using Composer:
```
$ composer require --dev jim-merioles/laravel-dev-extras
```

Once installed, you need to register the service provider. Open up `config/app.php` and add the following to the `providers` key:
```
/*
 * Package Service Providers...
 */
JimMerioles\LaravelDevExtras\LaravelDevExtrasServiceProvider::class,
```

## Features:

### Repository Make Command: 
Generates a repository class for a model.

#### Scenario:
Most of the time our code screams for a better architecture, and often we want our models to adhere to Repository Design Pattern for some reasons; for better integration with caching and other stuffs.

#### Usage:
```
$ php artisan make:repository FooRepository
```
###### Creates:
```
<?php

namespace App\Repositories;

class FooRepository
{
    /**
     * Create a new repository instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }
}
```

##### Model Option
Automatic model scaffold within the repository class.
```
$ php artisan make:repository FooRepository --model=Foo
```
###### Creates:
```
<?php

namespace App\Repositories;

use Foo;

class FooRepository
{
    /**
     * Foo model instance.
     *
     * @var Foo
     */
    protected $foo;

    /**
     * Create a new repository instance.
     *
     * @param Foo $foo
     */
    public function __construct(Foo $foo)
    {
        $this->foo = $foo;

        //
    }
}
```

### Database Listener Helper:
Alias for:
```
DB::listen(function ($event) {
    dump($event->sql);
    dump($event->bindings);
    dump($event->time);
});
```

#### Scenario:
Most of the time when tinkering with your database and eloquent models using `$ php artisan tinker`, you might want to listen for and dump sql queries, bindings and execution time to inspect or even just to verify if your cache works when no query has been made.

#### Usage:
```
Psy Shell v0.7.2 (PHP 7.0.11-1+deb.sury.org~trusty+1 — cli) by Justin Hileman
>>> db() // dumps queries, bindings, and execution time
```

## Contributing

Very open for suggestions and request. Please request an [issue](https://github.com/JimMerioles/Laravel-Dev-Extras/issues) or by [pull requests](/JimMerioles/Laravel-Dev-Extras/pull/new/master).

## Security Vulnerabilities

If you discover a security vulnerability, please send an e-mail to Jim Merioles at jimwisleymerioles@gmail.com. All security vulnerabilities will be promptly addressed.

## License

Laravel Dev Extras is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT).
