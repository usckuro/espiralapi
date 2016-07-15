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

namespace Usckuro\Espiral\Api;

use Usckuro\Espiral\Api\Validators\CardValidator;

class EACard {
    public $card_number;
    public $expires;
    public $cvv;

    function __construct($card_number, $expires, $cvv)
    {
        $this->card_number = (new CardValidator())->check($card_number, 'card');
        $this->expires = (new CardValidator())->check($expires, 'exp');
        $this->cvv = (new CardValidator())->check($cvv, 'cvv');
    }

    /**
     * @return mixed
     */
    public function getCardNumber()
    {
        return $this->card_number;
    }

    /**
     * @return mixed
     */
    public function getExpires()
    {
        return $this->expires;
    }

    /**
     * @return mixed
     */
    public function getCvv()
    {
        return $this->cvv;
    }
}