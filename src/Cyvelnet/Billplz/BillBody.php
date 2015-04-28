<?php

namespace Cyvelnet\Billplz;


/**
 * Class Bill
 * @package Cyvelnet\Billplz
 */
class BillBody
{

    /**
     * billplz take 1 cent as an unit
     * which mean RM 1 = 100
     */
    const BILLPLZ_CONVERSATION_RATIO = 100;
    /**
     * @var
     */
    private $collectionId;

    /**
     * @var
     */
    private $billId;

    /**
     * @var
     */
    private $amount;

    private $name;

    private $email;

    /**
     * @var
     */
    private $callbackUrl;
    /**
     * format YYYY-MM-DD
     * @var
     */
    private $dueAt;
    /**
     * format +(country code) mobile no
     * +600101234567
     * @var
     */
    private $mobile;
    /**
     * @var
     */
    private $metaData;
    /**
     * @var bool
     */
    private $deliver = true;
    /**
     * @var
     */
    private $redirect_url;

    /**
     * set collection
     * @param $collectionId
     * @return $this
     */
    public function collection($collectionId)
    {
        $this->collectionId = $collectionId;

        return $this;
    }

    /**
     * set bill amount
     * @param $amount
     * @return $this
     */
    public function amount($amount)
    {
        $this->amount = ($amount * self::BILLPLZ_CONVERSATION_RATIO);

        return $this;
    }

    /**
     * set callback url
     * @param $callbackUrl
     * @return mixed
     */
    public function callback($callbackUrl)
    {
        $this->callbackUrl = $callbackUrl;

        return $this;
    }

    /**
     * set bill due date
     * @param $date
     * @return mixed
     */
    public function dueAt($date)
    {
        $this->dueAt = $date;

        return $this;
    }

    /**
     * set recipient mobile no
     * @param $mobileNo
     * @return mixed
     */
    public function mobile($mobileNo)
    {
        $this->mobile = $mobileNo;

        return $this;
    }

    /**
     * set bill meta
     * @param array $meta
     * @return array
     */
    public function meta(array $meta = array())
    {
        $this->metaData = $meta;

        return $this;
    }

    /**
     * set delivery
     * @param $boolean
     * @return mixed
     */
    public function deliver($boolean)
    {
        $this->deliver = $boolean;

        return $this;
    }

    /** set redirect url on success
     * @param $redirectUrl
     * @return mixed
     */
    public function redirect($redirectUrl)
    {
        $this->redirect_url = $redirectUrl;

        return $this;
    }

    /**
     * set bill id
     * @param $bill
     * @return string
     */
    public function bill($bill)
    {
        $this->billId = $bill;

        return $this;
    }

    public function to($recipientName, $recipientEmail, $recipientMobile = null)
    {
        $this->name = $recipientName;
        $this->email = $recipientEmail;
        $this->mobile = $recipientMobile;

        return $this;
    }

    /**
     * get collection id
     * @return string
     */
    public function getCollection()
    {
        return $this->collectionId;
    }

    /**
     * get bill amount
     * @return float
     */
    public function getAmount()
    {
        return $this->amount;
    }

    /**
     * get callback
     * @return string
     */
    public function getCallback()
    {
        return $this->callbackUrl;
    }

    /**
     * get bill due date
     * @return string
     */
    public function getDueAt()
    {
        return $this->dueAt;
    }

    /**
     * get recipient mobile
     * @return string
     */
    public function getMobile()
    {
        return $this->mobile;
    }

    /**
     * get bill meta
     * @return array
     */
    public function getMeta()
    {
        return $this->metaData;
    }

    /**
     * get delivery
     * @return bool
     */
    public function getDeliver()
    {
        return $this->deliver;
    }

    /**
     * get redirect url
     * @return string
     */
    public function getRedirect()
    {
        return $this->redirect_url;
    }

    /**
     * get bill id
     * @return string
     */
    public function getBill()
    {
        return $this->billId;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getEmail()
    {
        return $this->email;
    }
}
