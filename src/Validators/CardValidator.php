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

use Usckuro\Espiral\Api\Exceptions\EACardException;

class CardValidator extends Validator{

    public function check($value, $field){
        switch($field){
            case 'card':
                $this->validateCardNumber($value);
                break;
            case 'exp':
                $this->validateExpirationDate($value);
                break;
            case 'cvv':
                $this->validateCvv($value);
                break;
        }
    }

    public function validateCardNumber($card){
        if(!is_numeric($card)){
            throw new EACardException('Card number is not numeric');
        }

        if(strlen($card) <> 16){
            throw new EACardException('Invalid card number');
        }

        return true;
    }

    public function validateExpirationDate($date){
        if(!preg_match("/^(0[1-9]|1[0-2])/(0[1-9]|[1-2][0-9]|3[0-1])$/", $date)){
            throw new EACardException('Invalid Expiration Date');
        }
        return true;
    }

    public function validateCvv($cvv){
        if(!is_numeric($cvv)){
            throw new EACardException('Invalid CVV');
        }

        if(strlen($cvv) != 3 && strlen($cvv) != 4){
            throw new EACardException('Invalid CVV length');
        }

        return true;
    }
}