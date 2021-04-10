<?php

namespace Distortion\LaravelInvite;

use Illuminate\Support\ServiceProvider;

class LaravelInviteServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        $this->registerPublishableAssets();

        // Package items
        $this->registerMigrations();
    }

    /**
     * Register the application services.
     */
    public function register()
    {
        // Automatically apply the package configuration
        $this->mergeConfigFrom(__DIR__ . '/../config/config.php', 'laravelinvite');

        // Register the main class to use with the facade
        $this->app->singleton('invite', function () {
            return new LaravelInvite(new LaravelInviteManager());
        });
    }

    /**
     * Register application migrations.
     *
     * @return void
     */
    private function registerMigrations()
    {
        $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');
    }

    /**
     * Register publishable assets.
     *
     * @return void
     */
    private function registerPublishableAssets()
    {
        if ($this->app->runningInConsole()) {
            // Config
            $this->publishes([
                __DIR__ . '/../config/config.php' => config_path('laravelinvite.php'),
            ], 'config');

            // Migrations
            if (! class_exists('CreateInvitesTable')) {
                $this->publishes([
                    __DIR__ . '/../database/migrations/create_invites_table.php.stub' => database_path('migrations/' . date('Y_m_d_His', time()) . '_create_invites_table.php'),
                ], 'migrations');
            }
        }
    }
}
