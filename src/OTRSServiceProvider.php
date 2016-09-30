<?php

/*
 * This file is part of the Laravel OTRS library.
 *
 * (c) Filippo Galante <filippo.galante@b-ground.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace IlGala\LaravelOTRS;

use IlGala\LaravelOTRS\OTRSGenericInterface;
use IlGala\LaravelOTRS\Adapters\ConnectionFactory as AdapterFactory;
use Illuminate\Contracts\Container\Container;
use Illuminate\Foundation\Application as LaravelApplication;
use Illuminate\Support\ServiceProvider;
use Laravel\Lumen\Application as LumenApplication;

/**
 * This is the OTRS service provider class.
 *
 * @author ilgala
 */
class OTRSServiceProvider extends ServiceProvider
{

    /**
     * Boot the service provider.
     *
     * @return void
     */
    public function boot()
    {
        $this->setupConfig();
    }

    /**
     * Setup the config.
     *
     * @return void
     */
    protected function setupConfig()
    {
        $source = realpath(__DIR__ . '/../config/otrs.php');
        if ($this->app instanceof LaravelApplication && $this->app->runningInConsole()) {
            $this->publishes([$source => config_path('otrs.php')]);
        } elseif ($this->app instanceof LumenApplication) {
            $this->app->configure('otrs');
        }
        $this->mergeConfigFrom($source, 'otrs');
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->registerAdapterFactory();
        $this->registerDigitalOceanFactory();
        $this->registerManager();
        $this->registerBindings();
    }

    /**
     * Register the adapter factory class.
     *
     * @return void
     */
    protected function registerAdapterFactory()
    {
        $this->app->singleton('otrs.adapterfactory', function () {
            return new AdapterFactory();
        });
        $this->app->alias('otrs.adapterfactory', AdapterFactory::class);
    }

    /**
     * Register the OTRS factory class.
     *
     * @return void
     */
    protected function registerDigitalOceanFactory()
    {
        $this->app->singleton('otrs.factory', function (Container $app) {
            $adapter = $app['otrs.adapterfactory'];
            return new OTRSFactory($adapter);
        });
        $this->app->alias('otrs.factory', OTRSFactory::class);
    }

    /**
     * Register the manager class.
     *
     * @return void
     */
    protected function registerManager()
    {
        $this->app->singleton('otrs', function (Container $app) {
            $config = $app['config'];
            $factory = $app['otrs.factory'];
            return new OTRSManager($config, $factory);
        });
        $this->app->alias('otrs', OTRSManager::class);
    }

    /**
     * Register the bindings.
     *
     * @return void
     */
    protected function registerBindings()
    {
        $this->app->bind('otrs.connection', function (Container $app) {
            $manager = $app['otrs'];
            return $manager->connection();
        });
        $this->app->alias('otrs.otrs', OTRSGenericInterface::class);
    }

    /**
     * Get the services provided by the provider.
     *
     * @return string[]
     */
    public function provides()
    {
        return [
            'otrs.adapterfactory',
            'otrs.factory',
            'otrs',
            'otrs.connection',
        ];
    }

}
