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

namespace Usckuro\Espiral\Api\Providers\Espiral;


class EspiralAdapter extends Provider{
    public function __construct($user, $password, $mode){
        parent::__construct($user, $password, $mode);
    }
}