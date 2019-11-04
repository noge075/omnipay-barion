<?php
/**
 * Created by PhpStorm.
 * User: Noge
 * Date: 2017.11.30.
 * Time: 15:07
 */

namespace Omnipay\Barion\Message;


use Omnipay\Common\Http\ClientInterface;
use Omnipay\Barion\BarionClient;
use Omnipay\Barion\BarionEnvironment;
use Symfony\Component\HttpFoundation\Request;

abstract class AbstractRequest extends \Omnipay\Common\Message\AbstractRequest
{
    protected $apiVersion = "2";

    public function __construct(ClientInterface $httpClient, Request $httpRequest)
    {

        require_once __DIR__.'/../library/helpers/loader.php';

        parent::__construct($httpClient, $httpRequest);
    }

    public function getBarionClient()
    {
        return new BarionClient($this->getParameter("posKey"), $this->apiVersion, $this->getBarionEnvironment());
    }

    public function getBarionEnvironment(){
        if($this->getTestMode()){
            return BarionEnvironment::Test;
        }else{
            return BarionEnvironment::Prod;
        }
    }
    /*public function getRedirectUrl(){
        if($this->getBarionEnvironment() == BarionEnvironment::Test){
            return BARION_WEB_URL_TEST;
        }else {
            return BARION_WEB_URL_PROD;
        }
    }*/

}
