<?php
/**
 * Created by PhpStorm.
 * User: Noge
 * Date: 2017.11.30.
 * Time: 14:55
 */

namespace Omnipay\Barion\Message;

use Guzzle\Http\ClientInterface;
use Omnipay\Barion\Message\AbstractRequest;
use Symfony\Component\HttpFoundation\Request;

class NotifyRequest extends AbstractRequest
{
    protected $data;

    public function __construct(ClientInterface $httpClient, Request $httpRequest)
    {

        parent::__construct($httpClient, $httpRequest);

        $barionClient = $this->getBarionClient();
        $this->data = $barionClient->GetPaymentState($this->httpRequest->get("paymentId"));
    }

    public function getData()
    {
        return $this->data;
    }

    public function sendData($data){
        return $this->response = new NotifyResponse($this, $data);
    }

    public function getContent(){
        return $this->httpRequest->request->all();
    }
}