<?php namespace Cyvelnet\Billplz\Contracts;

interface BillValidator
{
    public function validBillMobileNo($mobileNo);

    public function validBillEmail($email);

    public function validBillAmount($amount);

    public function validBillDate($date);
}
