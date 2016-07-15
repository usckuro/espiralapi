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
     * Boot service provider
     *
     * @return mixed
     */
    abstract public function boot();

    public function register(){
        $this->registerAliases();
        $this->registerEspiralProvider();
        $this->registerEspiralApi();
        $this->registerEACard();
        $this->registerEASale();
    }

    /**
     * Bind some aliases.
     *
     * @return void
     */
    protected function registerAliases()
    {
        $this->app->alias('usckuro.espiral.api.provider.espiral', EspiralAdapter::class);
        $this->app->alias('usckuro.espiral.api.espiralapi', EspiralApi::class);
        $this->app->alias('usckuro.espiral.api.card', EACard::class);
        $this->app->alias('usckuro.espiral.api.sale', EASale::class);
    }

    /**
     * Register the bindings for the Espiral provider.
     *
     * @return void
     */
    protected function registerEspiralProvider()
    {
        $this->app->singleton('usckuro.espiral.api.provider.espiral', function ($app) {

            $provider = 'Usckuro\Espiral\Api\Providers\Espiral\EspiralAdapter';

            return $app->make(
                $provider,
                [$this->config('user'), $this->config('password'), $this->config('mode')]
            );
        });
    }

    protected function registerEspiralApi(){
        $this->app->singleton('usckuro.espiral.api.espiralapi', function($app){
            return new EspiralApi($app['usckuro.espiral.api.provider.espiral']);
        });
    }

    public function registerEACard(){
        $this->app->singleton('usckuro.espiral.api.card');
    }

    public function registerEASale(){
        $this->app->singleton('usckuro.espiral.api.sale');
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