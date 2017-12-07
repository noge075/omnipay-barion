<?php
/**
 * Created by PhpStorm.
 * User: Noge
 * Date: 2017.11.30.
 * Time: 15:07
 */

namespace Omnipay\Barion\Message;


abstract class AbstractRequest extends \Omnipay\Common\Message\AbstractRequest
{
    protected $apiVersion = "2";

    public function __construct(ClientInterface $httpClient, HttpRequest $httpRequest)
    {
        require_once '../library/BarionClient.php';

        parent::__construct($httpClient, $httpRequest);
    }

    public function getBarionClient()
    {
        return $this->getBarionClient($this->getPosKey(), $this->apiVersion, $this->getBarionEnvironment());
    }

    public function getBarionEnvironment(){
        if($this->getTestMode()){
            return \BarionEnvironment::Test;
        }else{
            return \BarionEnvironment::Prod;
        }
    }

    public function getRedirectUrl(){
        if($this->getBarionEnvironment() == \BarionEnvironment::Test){
            return BARION_WEB_URL_TEST;
        }else {
            return BARION_WEB_URL_PROD;
        }
    }

}