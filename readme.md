# Laravel Dev Extras

[![Packagist](https://img.shields.io/packagist/v/jim-merioles/laravel-dev-extras.svg?label=Latest%20Release)](https://github.com/JimMerioles/Laravel-Dev-Extras/releases)
[![Travis branch](https://img.shields.io/travis/JimMerioles/Laravel-Dev-Extras/master.svg?label=TravisCI%20Build:%20Master)](https://travis-ci.org/JimMerioles/Laravel-Dev-Extras)
[![GitHub commits](https://img.shields.io/github/commits-since/JimMerioles/Laravel-Dev-Extras/v0.1.0.svg?)](https://github.com/JimMerioles/Laravel-Dev-Extras/commits/master)
[![Packagist](https://img.shields.io/packagist/dt/jim-merioles/laravel-dev-extras.svg?label=Total%20Downloads)](https://packagist.org/packages/jim-merioles/laravel-dev-extras/stats)
[![license](https://img.shields.io/github/license/mashape/apistatus.svg?label=Open%20Source%20License)](https://github.com/JimMerioles/Laravel-Dev-Extras/blob/master/LICENSE.txt)

Collection of Extra artisan console commands and helpers that is very useful when developing web applications using Laravel Framework.

## Installation

To get the latest version of Laravel Markdown, simply require the project using Composer:
```
$ composer require --dev jim-merioles/laravel-dev-extras
```

Once installed, you need to register the service provider. Open up `config/app.php` and add the following to the `providers` key.
```
/*
 * Package Service Providers...
 */
JimMerioles\LaravelDevExtras\LaravelDevExtrasServiceProvider::class,
```

##Features:

###Repository Make Command: 
Creates a repository class for a model.

####Scenario:
When creating repository class for a model, adhering to Repository Design Pattern.

####Usage:
```
$ php artisan make:repository FooRepository [--path=path/to/custom/repositories/directory/]
```

###Database Listener Helper:
Alias for:
```
DB::listen(function ($event) {
    dump($event->sql);
    dump($event->bindings);
    dump($event->time);
});
```

####Scenario:
When tinkering with your database and eloquent models using `$ php artisan tinker`, you might want to dump the sql statements being queried, parameter bindings being passed and time that it took for the query or even just to simply verify if your cache works when no query has been made.

####Usage:
```
Psy Shell v0.7.2 (PHP 7.0.11-1+deb.sury.org~trusty+1 — cli) by Justin Hileman
>>> db()
```

**Other useful features coming really soon..** :bowtie: **Have any suggestions? Please do contribute.** :)

## Contributing

Very open for suggestions and request. Please request an [issue](https://github.com/JimMerioles/Laravel-Dev-Extras/issues) or by [pull requests](/JimMerioles/Laravel-Dev-Extras/pull/new/master).

## Security Vulnerabilities

If you discover a security vulnerability, please send an e-mail to Jim Merioles at jimwisleymerioles@gmail.com. All security vulnerabilities will be promptly addressed.

## License

Laravel Dev Extras is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT).
