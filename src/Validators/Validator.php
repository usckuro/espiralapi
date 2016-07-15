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

use Usckuro\Espiral\Api\Exceptions\EspiralApiException;

abstract class Validator {

    /**
     * Return a boolean
     *
     * @param $value
     *
     * @return bool
     */
    public function isValid($value, $field = null){
        try{
            $this->check($value, $field);
        }catch (EspiralApiException $e){
            return false;
        }

        return true;
    }

    /**
     * Return validation
     *
     * @param $value
     *
     * @return mixed
     */
    abstract public function check($value, $field);
}