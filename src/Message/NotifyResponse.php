<?php
/**
 * Created by PhpStorm.
 * User: Noge
 * Date: 2017.11.30.
 * Time: 14:53
 */

namespace Omnipay\Barion\Message;

use Omnipay\Barion\PaymentStatus;
use Omnipay\Common\Message\AbstractResponse;
use Omnipay\Common\Message\NotificationInterface;

class NotifyResponse extends AbstractResponse implements NotificationInterface
{

    public function isSuccessful()
    {
        if($this->getRequestSuccessful() && $this->getTransactionStatus() == PaymentStatus::Succeeded){
            return true;
        }else{
            return false;
        }
    }

    public function getTransactionId()
    {
        return $this->data->PaymentId;
    }

    public function getTransactionStatus()
    {
        return $this->data->Status;
    }

    public function getRequestSuccessful(){
        return $this->data->RequestSuccessful;
    }

    public function getData(){
        return $this->data;
    }

}