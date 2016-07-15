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

use GuzzleHttp\Exception\ClientException;
use Usckuro\Espiral\Api\Exceptions\EASaleException;
use Usckuro\Espiral\Api\Providers\Espiral\EspiralAdapter;
use GuzzleHttp\Client;

class EspiralApi extends EspiralAdapter{

    const BASE_URI = 'https://osciespiralapp.com/EspiralAPI/recursosweb/servicios/';

    protected $adapter;

    public function __construct(EspiralAdapter $adapter){
        $this->adapter = $adapter;
    }

    /**
     * @return EspiralAdapter
     */
    public function getAdapter()
    {
        return $this->adapter;
    }

    /**
     * @param EspiralAdapter $adapter
     */
    public function setAdapter(EspiralAdapter $adapter){
        $this->adapter = $adapter;
    }

    /**
     * @param $uri
     * @param $parameters
     * @param string $method
     * @return array
     */
    public function sendRequest($uri, $parameters, $method = "POST"){
        $client = new Client(['base_uri' => self::BASE_URI]);
        try {
            $response = $client->request($method, $uri, ['json' => $parameters]);
        }catch (ClientException $e){
            throw new EASaleException($e->getResponse()->getBody()->getContents());
        }

        if($response->getStatusCode() <> 200){
            throw new EASaleException($response->getResponse());
        }

        return $response->getBody();
    }

}