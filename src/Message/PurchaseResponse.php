<?php
namespace Omnipay\Barion\Message;


use Omnipay\Common\Message\AbstractResponse;
use Omnipay\Common\Message\RedirectResponseInterface;
use Omnipay\Common\Message\RequestInterface;

class PurchaseResponse extends AbstractResponse implements RedirectResponseInterface
{
    protected $redirectUrl;


    public function isSuccessful()
    {
        return empty($this->data['error']);
    }

    public function isRedirect()
    {
        if (!isset($this->data['error']) || !$this->data['error']) {
            return true;
        }
    }

    public function getRedirectUrl()
    {
        if ($this->isRedirect()) {
            return $this->data['GatewayUrl'];
        }
    }

    public function getRedirectMethod()
    {
        return 'GET';
    }

    public function getRedirectData()
    {
    }

    public function getMessage()
    {
        if (!empty($this->data['message'])) {
            return $this->data['message'];
        }
    }
}