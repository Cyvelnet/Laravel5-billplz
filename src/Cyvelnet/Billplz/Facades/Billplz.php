<?php namespace Cyvelnet\Billplz\Facades;

use Illuminate\Support\Facades\Facade;


class Billplz extends Facade
{

    protected static function getFacadeAccessor()
    {
        return 'billplz';
    }
}
