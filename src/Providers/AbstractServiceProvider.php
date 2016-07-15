<?php

/**
 * This file is part of espiralapi
 *
 * Date: 7/14/16
 *
 * (c) Uscanga Luis <luis_josue_uscanga@hotmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Usckuro\Espiral\Api\Providers;

use Illuminate\Support\ServiceProvider;
use Usckuro\Espiral\Api\EspiralApi;
use Usckuro\Espiral\Api\Providers\Espiral\EspiralAdapter;
use Usckuro\Espiral\Api\EACard;
use Usckuro\Espiral\Api\EASale;

abstract class AbstractServiceProvider extends ServiceProvider{

    /**
     * The application instance.
     *
     * @var \Illuminate\Contracts\Foundation\Application
     */
    protected $app;

    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = true;

    /**
     * Boot service provider
     *
     * @return mixed
     */
    abstract public function boot();

    public function register(){
        $this->app->singleton(EASale::class, function ($app) {
            return new EASale(new EspiralAdapter($this->config('user'), $this->config('password'), $this->config('mode')));
        });

    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [EASale::class];
    }


    /**
     * Merge the given configuration with the existing configuration.
     *
     * @param  string  $path
     * @param  string  $key
     * @return void
     */
    protected function mergeConfigFrom($path, $key)
    {
        $config = $this->app['config']->get($key, []);

        $this->app['config']->set($key, array_merge(require $path, $config));
    }

    /**
     * Helper to get the config values.
     *
     * @param  string  $key
     * @param  string  $default
     *
     * @return mixed
     */
    protected function config($key, $default = null)
    {
        return config("espiral.$key", $default);
    }


    /**
     * Get an instantiable configuration instance.
     *
     * @param  string  $key
     *
     * @return mixed
     */
    protected function getConfigInstance($key)
    {
        $instance = $this->config($key);
        if (is_string($instance)) {
            return $this->app->make($instance);
        }
        return $instance;
    }
}