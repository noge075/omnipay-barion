<?php

namespace Omnipay\Barion\Message;

use Guzzle\Http\Exception\ClientErrorResponseException;
use Omnipay\Barion\Item;
use Omnipay\Barion\ItemBag;
use Omnipay\Barion\ItemModel;
use Omnipay\Barion\PaymentTransactionModel;
use Omnipay\Barion\PreparePaymentRequestModel;

/**
 * Barion Purchase Request
 */
class PurchaseRequest extends AbstractRequest
{
    protected $data;

    public function getData()
    {
        $ppr = new PreparePaymentRequestModel();

        if ($this->getGuestCheckOut() !== NULL) {
            $ppr->GuestCheckOut = $this->getGuestCheckOut();
        }

        $ppr->PaymentType = $this->getPaymentType();
        $ppr->RedirectUrl = $this->getRedirectUrl();


        /*if ($this->getRedirectUrl() !== NULL) {
            $ppr->RedirectUrl = $this->getUserRedirectUrl();
        }*/

        if ($this->getCurrency() !== NULL) {
            $ppr->Currency = $this->getCurrency();
        }

        if ($this->getReservationPeriod() !== NULL) {
            $ppr->ReservationPeriod = $this->getReservationPeriod();
        }

        if ($this->getPaymentWindow() !== NULL) {
            $ppr->PaymentWindow = $this->getPaymentWindow();
        }

        if ($this->getInitiateRecurrence() !== NULL) {
            $ppr->InitiateRecurrence = $this->getInitiateRecurrence();
        }

        if ($this->getRecurrenceId() !== NULL) {
            $ppr->RecurrenceId = $this->getRecurrenceId();
        }

        if ($this->getFundingSources() !== NULL) {
            $ppr->FundingSources = $this->getFundingSources();
        }

        if ($this->getPaymentRequestId() !== NULL) {
            $ppr->PaymentRequestId= $this->getPaymentRequestId();
        }

        if ($this->getPayerHint() !== NULL) {
            $ppr->PayerHint = $this->getPayerHint();
        }

        if ($this->getCallbackUrl() !== NULL) {
            $ppr->CallbackUrl = $this->getCallbackUrl();
        }

        if ($this->getTransactions() !== NULL) {
            $ppr->Transactions = $this->getTransactions();
        }

        if ($this->getOrderNumber() !== NULL) {
            $ppr->OrderNumber = $this->getOrderNumber();
        }

        if ($this->getShippingAddress() !== NULL) {
            $ppr->ShippingAddress = $this->getShippingAddress();
        }

        if ($this->getLocale() !== NULL) {
            $ppr->Locale = $this->getLocale();
        }

        $trans = new PaymentTransactionModel();
        $trans->POSTransactionId = ($this->getPaymentRequestId() !== NULL ? $this->getPaymentRequestId() . '-01' : '');
        $trans->Payee = $this->getPayee();
        $trans->Total = $this->getAmount();

        $items = $this->getItems();

        if ($items) {
            foreach ($items as $item) {

                $transItem = new ItemModel();
                $transItem->Name = $item->getName() ?: '';
                $transItem->Description = $item->getDescription() ?: '-';
                $transItem->Quantity = $item->getQuantity();
                $transItem->Unit = $item->getUnitName();
                $transItem->UnitPrice = $item->getPrice();
                $transItem->ItemTotal = $item->getPrice() * $item->getQuantity();
                $transItem->SKU = $item->getSKU();

                $trans->AddItem($transItem);
            }
        }

        $ppr->AddTransaction($trans);

        if($this->getDump()){
            print_r($ppr);
        }
	dd($ppr);
        return $this->getBarionClient()->PreparePayment($ppr);
    }

    /**
     * return the response of the API call
     * @param array $data
     * @return PurchaseResponse
     */
    public function sendData($parameters)
	{
		return $this->response = new PurchaseResponse($this, $parameters);
	}

    /**
     * Return amount
     * @return mixed
     */
    public function getAmount()
    {
        return $this->getParameter('amount');
    }

    /**
     * Set the items in this order
     *
     * @param ItemBag|array $items An array of items in this order
     *
     * @return AbstractRequest
     */
    public function setItems($items)
    {
        if ($items && !$items instanceof ItemBag) {
            $items = new ItemBag($items);
        }

        return $this->setParameter('items', $items);
    }


    /**
     * @param $value
     */
    public function setDump($value)
    {
        $this->setParameter('dump', $value);
    }

    public function getUserRedirectUrl(){
        $this->getParameter('userRedirectUrl');
    }
	
    public function setUserRedirectUrl($value){
        $this->setParameter('userRedirectUrl', $value);
    }

    /**
     * @return mixed
     */
    public function getDump()
    {
        return $this->getParameter('dump');
    }

    /**
     * @param $value
     */
    public function setPayee($value)
    {
        $this->setParameter('payee', $value);
    }

    /**
     * @return mixed
     */
    public function getPayee()
    {
        return $this->getParameter('payee');
    }


    /**
     * @param $value
     */
    public function setPosKey($value)
    {
        $this->setParameter('posKey', $value);
    }


    /**
     * @param $value
     */
    public function setShopName($value)
    {
        $this->setParameter('shopName', $value);
    }

    /**
     * @return mixed
     */
    public function getShopName()
    {
        return $this->getParameter('shopName');
    }

    /**
     * @param $value
     */
    public function setPaymentType($value)
    {
        $this->setParameter('paymentType', $value);
    }

    /**
     * @return mixed
     */
    public function getPaymentType()
    {
        return $this->getParameter('paymentType');
    }

    /**
     * @param $value
     */
    public function setReservationPeriod($value)
    {
        $this->setParameter('reservationPeriod', $value);
    }

    /**
     * @return mixed
     */
    public function getReservationPeriod()
    {
        return $this->getParameter('reservationPeriod');
    }

    /**
     * @param $value
     */
    public function setPaymentWindow($value)
    {
        $this->setParameter('paymentWindow', $value);
    }

    /**
     * @return mixed
     */
    public function getPaymentWindow()
    {
        return $this->getParameter('paymentWindow');
    }

    /**
     * @param $value
     */
    public function setGuestCheckOut($value)
    {
        $this->setParameter('guestCheckOut', $value);
    }

    /**
     * @return mixed
     */
    public function getGuestCheckOut()
    {
        return $this->getParameter('guestCheckOut');
    }

    /**
     * @param $value
     */
    public function setInitiateRecurrence($value)
    {
        $this->setParameter('initiateRecurrence', $value);
    }

    /**
     * @return mixed
     */
    public function getInitiateRecurrence()
    {
        return $this->getParameter('initiateRecurrence');
    }

    /**
     * @param $value
     */
    public function setRecurrenceId($value)
    {
        $this->setParameter('recurrenceId', $value);
    }

    /**
     * @return mixed
     */
    public function getRecurrenceId()
    {
        return $this->getParameter('recurrenceId');
    }

    /**
     * @param $value
     */
    public function setFundingSources($value)
    {
        $this->setParameter('fundingSources', $value);
    }

    /**
     * @return mixed
     */
    public function getFundingSources()
    {
        return $this->getParameter('fundingSources');
    }

    /**
     * @param $value
     */
    public function setPaymentRequestId($value)
    {
        $this->setParameter('paymentRequestId', $value);
    }

    /**
     * @return mixed
     */
    public function getPaymentRequestId()
    {
        return $this->getParameter('paymentRequestId');
    }

    /**
     * @param $value
     */
    public function setPayerHint($value)
    {
        $this->setParameter('payerHint', $value);
    }

    /**
     * @return mixed
     */
    public function getPayerHint()
    {
        return $this->getParameter('payerHint');
    }

    /**
     * @param $value
     */
    public function setRedirectUrl($value)
    {
        $this->setParameter('redirectUrl', $value);
    }
	
    public function getRedirectUrl()
    {
        $this->getParameter('redirectUrl');
    }

    /**
     * @param $value
     */
    public function setCallbackUrl($value)
    {
        $this->setParameter('callbackUrl', $value);
    }

    /**
     * @return mixed
     */
    public function getCallbackUrl()
    {
        return $this->getParameter('callbackUrl');
    }

    /**
     * @param $value
     */
    public function setTransactions($value)
    {
        $this->setParameter('transactions', $value);
    }

    /**
     * @return mixed
     */
    public function getTransactions()
    {
        return $this->getParameter('transactions');
    }

    /**
     * @param $value
     */
    public function setOrderNumber($value)
    {
        $this->setParameter('orderNumber', $value);
    }

    /**
     * @return mixed
     */
    public function getOrderNumber()
    {
        return $this->getParameter('orderNumber');
    }

    /**
     * @param $value
     */
    public function setShippingAddress($value)
    {
        $this->setParameter('shippingAddress', $value);
    }

    /**
     * @return mixed
     */
    public function getShippingAddress()
    {
        return $this->getParameter('shippingAddress');
    }

    /**
     * @param $value
     */
    public function setLocale($value)
    {
        $this->setParameter('locale', $value);
    }

    /**
     * @return mixed
     */
    public function getLocale()
    {
        return $this->getParameter('locale');
    }

    /**
     * @param $negativeAmountAllowed
     */
    public function setNegativeAmountAllowed($negativeAmountAllowed)
    {
        $this->negativeAmountAllowed = $negativeAmountAllowed;
    }
}
