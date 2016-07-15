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

return [

    /**
     * Username of the espiral user
     */
    'user' => env('ESPIRAL_USER'),

    /**
     * Password of your espiral user
     */
    'password' => env('ESPIRAL_PASSWORD'),

    /**
     * Transaction mode of the api, you can execute transactions
     * in production or test mode the variables are:
     * PRD (Production mode)
     * AUT (Authorization mode) The transaction is processed by the authorizer
     * DEC (Decline mode) The transaction is always declined
     * RND (Random mode) Simulates that the transaction is accepted or declined randomly
     */
    'mode' => env('ESPIRAL_MODE')
];