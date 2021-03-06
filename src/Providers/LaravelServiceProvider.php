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


class LaravelServiceProvider extends AbstractServiceProvider{

    public function boot(){
        $path = realpath(__DIR__.'/../../config/config.php');
        $this->publishes([$path => config_path('espiral.php')], 'config');
        $this->mergeConfigFrom($path, 'espiral');
    }
}