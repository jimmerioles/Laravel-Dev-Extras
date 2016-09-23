<?php
/**
 * This file is part of Laravel Dev Extras.
 *
 * (c) Jim Wisley Merioles <jimwisleymerioles@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace JimMerioles\LaravelDevExtras;

use Illuminate\Support\ServiceProvider;

/**
 * Class LaravelDevExtrasServiceProvider
 *
 * @since Class available since Release 0.1.0
 */
class LaravelDevExtrasServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = true;

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('command.repository.make', function ($app) {
            return new RepositoryMakeCommand(new RepositoryMaker($app['files']));
        });

        $this->commands('command.repository.make');
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['command.repository.make'];
    }
}
