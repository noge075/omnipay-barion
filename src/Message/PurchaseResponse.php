<?php
namespace Omnipay\Barion\Message;

use Omnipay\Common\Message\RedirectResponseInterface;
use Omnipay\Common\Message\RequestInterface;

class PurchaseResponse extends AbstractRequest implements RedirectResponseInterface
{
    protected $redirectUrl;

    public function isSuccessful()
    {
        return false;
    }

    public function isRedirect()
    {
        return true;
    }

    public function getRedirectUrl()
    {

        return $this->getRedirectUrl();
    }

    public function getRedirectMethod()
    {
        return 'GET';
    }

    public function getRedirectData()
    {
        return null;
    }

    public function getMessage()
    {
        if (!empty($this->data['message'])) {
            return $this->data['message'];
        }
    }
}