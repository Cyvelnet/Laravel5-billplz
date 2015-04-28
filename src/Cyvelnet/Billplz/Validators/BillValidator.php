<?php namespace Cyvelnet\Billplz\Validators;

use Cyvelnet\Billplz\Contracts\BillValidator as BillValidatorContract;
use Cyvelnet\Billplz\Exceptions\IncorrectAmountValueException;
use Cyvelnet\Billplz\Exceptions\IncorrectContactNumberFormatException;
use Cyvelnet\Billplz\Exceptions\IncorrectDateFormatException;
use Cyvelnet\Billplz\Exceptions\InsufficientParametersException;
use Cyvelnet\Billplz\Exceptions\InvalidEmailException;

class BillValidator implements BillValidatorContract
{

    private $mandatoryFields = ['collection_id', 'email', 'name', 'amount', 'callback_url'];

    const MOBILE = 'mobile';
    const EMAIL = 'email';
    const AMOUNT = 'amount';
    const DUE_AT =  'due_at';

    public function validBillMobileNo($mobileNo)
    {
        $validateAgainst = $this->unpack($mobileNo, self::MOBILE);

        if ($validateAgainst AND !preg_match('/^\+[1-9]{1}[0-9]{3,14}$/', $validateAgainst)) {
            throw new IncorrectContactNumberFormatException('Contact number should match the format. +60102345678 (country_code)(numbers)');
        }

        return true;
    }

    public function validBillEmail($email)
    {
        $validateAgainst = $this->unpack($email, self::EMAIL);

        if (!filter_var($validateAgainst, FILTER_VALIDATE_EMAIL)) {
            throw new InvalidEmailException;
        }

        return true;
    }

    public function validBillAmount($amount)
    {
        $validateAgainst = $this->unpack($amount, self::AMOUNT);

        $validateAgainst = filter_var($validateAgainst, FILTER_VALIDATE_FLOAT);

        if (!$validateAgainst AND $validateAgainst < 1) {
            throw new IncorrectAmountValueException;
        }

        return true;
    }

    public function validBillDate($date)
    {
        $validateAgainst = $this->unpack($date, self::DUE_AT);

        if ((!preg_match('/^(\d{4}-\d{2}-\d{2})$/', $validateAgainst)) AND !is_null($validateAgainst)) {
            throw new IncorrectDateFormatException;
        }

        return true;
    }

    /**
     * unpack an array
     * @param $data
     * @param $key
     * @return null|string
     */
    private function unpack($data, $key)
    {
        $validateAgainst = null;
        if (is_array($data) AND isset($data[$key])) {
            $validateAgainst = $data[$key];
        } else {
            if (is_string($data)) {
                $validateAgainst = $data;
            }
        }

        return $validateAgainst;
    }

    public function validateCreate($data)
    {
        // validate mandatory
        if (count(array_intersect_key($data, array_flip($this->mandatoryFields))) !== 5) {
            throw new InsufficientParametersException('You are required to provides email, name, amount, collection_id and callback_url.');
        }

        $this->validBillEmail($data);

        $this->validBillAmount($data);

        $this->validBillDate($data);

    }

}
