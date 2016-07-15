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

use Usckuro\Espiral\Api\Exceptions\EASaleException;
use Usckuro\Espiral\Api\Validators\SaleValidator;

class EASale extends EspiralApi {

    const URI_SALE = 'sale';
    const URI_REFUND = 'refund';
    const URI_PARTIAL_REFUND = 'partialRefund';
    const URI_VERIFY = 'verify';

    public $amount;
    public $control_number;
    public $reference;

    function __construct($amount, $control_number, $reference)
    {
        $this->amount =  (new SaleValidator())->check($amount);
        $this->control_number = $control_number;
    }

    /**
     * @return mixed
     */
    public function getAmount()
    {
        return $this->amount;
    }

    /**
     * @return mixed
     */
    public function getControlNumber()
    {
        return $this->control_number;
    }

    /**
     * @return mixed
     */
    public function getReference()
    {
        return $this->reference;
    }

    /**
     * @param EACard $card
     * @return array
     * @throws EASaleException
     */
    public function makeSale(EACard $card){
        $params = [
            'merchant' => [
                'sName' => parent::getAdapter()->getUser(),
                'sPassword' => parent::getAdapter()->getPassword()
            ],
            'card' => $card->getCardNumber(),
            'expires' => $card->getExpires(),
            'cvv' => $card->getCvv(),
            'mode' => parent::getAdapter()->getMode(),
            'sControlNumber' => $this->getControlNumber(),
            'amount' => $this->getAmount()
        ];

        $response = parent::sendRequest(self::URI_SALE, $params);

        return $response;
    }

    /**
     * @return array
     * @throws EASaleException
     */
    public function refundSale(){
        $params = [
            'merchant' => [
                'sName' => parent::getAdapter()->getUser(),
                'sPassword' => parent::getAdapter()->getPassword()
            ],
            'mode' => parent::getAdapter()->getMode(),
            'sControlNumber' => $this->getControlNumber(),
            'reference' => $this->getReference()
        ];

        $response = parent::sendRequest(self::URI_REFUND, $params);

        return $response;
    }

    /**
     * @return array
     * @throws EASaleException
     */
    public function partialRefundSale(){
        $params = [
            'merchant' => [
                'sName' => parent::getAdapter()->getUser(),
                'sPassword' => parent::getAdapter()->getPassword()
            ],
            'mode' => parent::getAdapter()->getMode(),
            'sControlNumber' => $this->getControlNumber(),
            'reference' => $this->getReference(),
            'amount' => $this->getAmount()
        ];

        $response = parent::sendRequest(self::URI_PARTIAL_REFUND, $params);

        return $response;
    }

    /**
     * This method makes a call to verify a transaction. The response
     * of this resource is totally different of the other because the
     * important information is inside the message field an example
     * of what is inside this field:
     *
     * CAN|345607184518|1234165002302390|1.00|C|A|00|030727|20151124 09:38:39.659|20151124
     * 09:38:39.688|20151124 09:38:39.718|20151124 09:38:39.718
     *
     * In other it refers:
     * - Original Type of transaction
     * - Reference
     * - Card Number
     * - Amount
     * - Paywork Code
     * - Authorizer Result
     * - Authorization Code
     * - Date and Time Transaction
     * - Date and Time Transaction in Prosa
     * - Date and Time Transaction exit from Prosa
     * - Date and Time Transaction exit
     *
     * @return array
     * @throws EASaleException
     */
    public function verifySale(){
        $params = [
            'merchant' => [
                'sName' => parent::getAdapter()->getUser(),
                'sPassword' => parent::getAdapter()->getPassword()
            ],
            'sControlNumber' => $this->getControlNumber(),
            'reference' => $this->getReference()
        ];

        $response = parent::sendRequest(self::URI_VERIFY, $params);

        return $response;
    }
}