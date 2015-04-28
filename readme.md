# laravel5-billplz
A Malaysia simple billing and payment solution from Billplz for laravel 5


Require this package with composer using the following command:

    composer require cyvelnet/billplz

After updating composer, add the ServiceProvider to the providers array in config/app.php

    'Cyvelnet\Billplz\BillplzServiceProvider',

You can also publish the config-file to change implementations to suits you.
   
    php artisan vendor:publish
    

To create a new bill

    `Billplz::issue(function (BillBody $bill) {
            $bill->amount(1)
                 ->to('customer name', 'customer@customer.com', 'customer mobile number');
                });`
                
                


To delete an existing bill
    `Billplz::delete($billId);`
    



To retrieve an existing bill info.
    `Billplz::get($billId);`
