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

namespace Usckuro\Espiral\Api\Validators;


use Usckuro\Espiral\Api\Exceptions\EASaleException;

class SaleValidator extends Validator{
    public function check($value, $field = null){
        $this->validateAmount($value);
    }

    public function validateAmount($value){
        if(!is_numeric($value)){
            throw new EASaleException('Card number is not numeric');
        }

        return true;
    }
}