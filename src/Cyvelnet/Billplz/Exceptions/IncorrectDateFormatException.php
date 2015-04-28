<?php namespace Cyvelnet\Billplz\Exceptions;

use Exception;

class IncorrectDateFormatException extends Exception
{


    function __construct()
    {
        parent::__construct('Date format should match YYYY-MM-DD');
    }
}
