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
namespace Usckuro\Espiral\Api\Exceptions;

use Exception;

class EspiralApiException extends Exception{
    /**
     * @param  string  $message
     * @param  int  $code
     * @param  \Exception|null  $previous
     *
     * @return void
     */
    public function __construct($message = 'An error occurred', $code = 0, Exception $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}