<?php
namespace Omnipay\Barion\Http;

use Psr\Http\Message\RequestInterface;

class GuzzleClient extends \Http\Client\HttpClient
{
    /**
     * @inheritdoc
     */
    public function sendRequest(RequestInterface $request)
    {
        return $this->guzzle->send($request, [
            'verify' => __DIR__ . '/../certs/cacert.pem'
        ]);
    }
}