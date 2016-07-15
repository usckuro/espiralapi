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

namespace Usckuro\Espiral\Api\Facades;


use Illuminate\Support\Facades\Facade;

class EASale extends Facade{
    protected static function getFacadeAccessor(){ return \Usckuro\Espiral\Api\EASale::class; }
}