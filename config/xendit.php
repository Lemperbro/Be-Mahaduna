<?php

return [
    'apiKey' => 'Basic ' . base64_encode(env('XENDIT_API_KEY') . ':'),
    'x-callback-token' => env('XENDIT_CALLBACK_TOKEN'),
    'apiUrl' => [
        'invoice' => env('XENDIT_INVOICE_URL')
    ]
];