# laravel5-billplz
A Malaysia simple billing and payment solution from Billplz for laravel 5


Require this package with composer using the following command:

    composer require cyvelnet/billplz

After updating composer, add the ServiceProvider to the providers array in config/app.php

    'Cyvelnet\Billplz\BillplzServiceProvider',

You can also publish the config-file to change implementations to suits you.

   
    php artisan vendor:publish
    
