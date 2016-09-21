# laravel5-billplz
A Malaysia simple billing and payment solution from Billplz for laravel 5

## [2016/09/21] Please consider this repo as deprecated, in favors of https://github.com/Cyvelnet/laravel-billplz (support v3 api & sandbox), visit https://github.com/Cyvelnet/laravel-billplz/wiki/Laravel5-billplz-compatibility for potential change to adapts to v3 api


Require this package with composer using the following command:

    composer require cyvelnet/billplz

After updating composer, add the ServiceProvider to the providers array in config/app.php

    'Cyvelnet\Billplz\BillplzServiceProvider',

You can also publish the config file to change implementations to suits your configuration.
   
    php artisan vendor:publish
    

To create a new bill

    Billplz::issue(function ($bill) {
            $bill->amount(1)
                 ->to('customer name', 'customer@customer.com', 'customer mobile number');
            });
                
                

To delete an existing bill

    Billplz::delete($billId);
    

To retrieve an existing bill info.

    Billplz::get($billId);

To ensure an request is success without error, you verify with

    $response = Billplz::get($billId);
    if($response->isSuccess())
    {
        $apiResponse = $response->getResponse();
    }else
    {
        $errorResponse = $response->getFailedReason();
    }
    



