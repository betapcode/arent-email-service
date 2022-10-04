<?php

namespace Arent\SendMail;

use Illuminate\Support\ServiceProvider;

class SendMailServiceProvider extends ServiceProvider
{
    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot(): void
    {
        // $this->loadTranslationsFrom(__DIR__.'/../resources/lang', 'arent');
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'arent_send_email');
        $this->loadMigrationsFrom(__DIR__.'/../database/migrations');

        $this->mapWebRoutes();
        $this->mapApiRoutes();

        // Publishing is only necessary when using the CLI.
        if ($this->app->runningInConsole()) {
            $this->bootForConsole();
        }
    }

    protected function mapWebRoutes(): void
    {
        $this->app['router']
            ->middleware(['web'])
            ->group(function () {
                $this->loadRoutesFrom(__DIR__ . '/../routes/web.php');
            });
    }

    protected function mapApiRoutes(): void
    {
        $this->app['router']->group([
            'prefix' => 'api',
            'middleware' => ['api'],
        ], function () {
            $this->loadRoutesFrom(__DIR__ . '/../routes/api.php');
        });
    }

    /**
     * Register any package services.
     *
     * @return void
     */
    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__.'/../config/sendmail.php', 'sendmail');

        // Register the service the package provides.
        $this->app->singleton('sendmail', function ($app) {
            return new SendMail;
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['sendmail'];
    }

    /**
     * Console-specific booting.
     *
     * @return void
     */
    protected function bootForConsole(): void
    {
        // Publishing the configuration file.
        $this->publishes([
            __DIR__.'/../config/sendmail.php' => config_path('sendmail.php'),
        ], 'sendmail.config');

        // Publishing the views.
        /*$this->publishes([
            __DIR__.'/../resources/views' => base_path('resources/views/vendor/arent'),
        ], 'sendmail.views');*/

        // Publishing assets.
        /*$this->publishes([
            __DIR__.'/../resources/assets' => public_path('vendor/arent'),
        ], 'sendmail.views');*/

        // Publishing the translation files.
        /*$this->publishes([
            __DIR__.'/../resources/lang' => resource_path('lang/vendor/arent'),
        ], 'sendmail.views');*/

        // Registering package commands.
        // $this->commands([]);
    }
}
