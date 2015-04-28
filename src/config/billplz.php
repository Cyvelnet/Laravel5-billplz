<?php

return [

    // obtains your api key by register account with www.billplz.com
    'api_key' => env('BILLPLZ_API_KEY','YOUR DEFAULT API_KEY!!!'),

    // default bill collection id, you may override it with facade Billplz::collection('collection_id');
    'collection_id' => env('BILLPLZ_COLLECTION_ID','YOUR DEFAULT COLLECTION ID!!!'),

    'callback_url' => env('BILLPLZ_CALLBACK_URL', 'YOUR DEFAULT CALLBACK URL!!!')


];
