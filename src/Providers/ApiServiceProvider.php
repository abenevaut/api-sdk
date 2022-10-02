<?php

namespace abenevaut\ApiSdk\Providers;

use abenevaut\ApiSdk\Contracts\ApiEntitiesEnum;
use abenevaut\ApiSdk\Contracts\ApiProviderNameInterface;
use abenevaut\ApiSdk\Factories\ApiDriverFactory;
use Illuminate\Foundation\Application;
use Illuminate\Support\Collection;
use Illuminate\Support\ServiceProvider;

class ApiServiceProvider extends ServiceProvider implements ApiProviderNameInterface
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Bootstrap the application events.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__.'/../../config/abenevaut.php',
        ], self::ABENEVAUT);

        Collection::macro('toApiEntity', function (ApiEntitiesEnum $driver) {
            return $this->map(function ($value) use ($driver) {
                return new ("abenevaut\\ApiSdk\\Entities\\{$driver->value}Entity")($value);
            });
        });
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        parent::register();

        $this->app->singleton(self::ABENEVAUT, function (Application $app) {
            // @codeCoverageIgnoreStart
            return new ApiDriverFactory($app);
            // @codeCoverageIgnoreEnd
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [self::ABENEVAUT];
    }
}
