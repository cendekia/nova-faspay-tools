<?php

return [
    'merchant' => env('FASPAY_MERCHANT'),
    'recurring' => [
        'merchant_id' => env('FASPAY_RECURRING_MERCHANT_ID'),
        'merchant_name' => env('FASPAY_RECURRING_MERCHANT_NAME'),
        'client_id' => env('FASPAY_RECURRING_CLIENT_ID'),
        'password' => env('FASPAY_RECURRING_PASSWORD'),
        'url_check' => env('FASPAY_RECURRING_CHECK_URL'),
        'url_update' => env('FASPAY_RECURRING_MEMBER_DATA_URL'),
    ],
    'debit' =>  [
        //
    ],
    'notification_class' => [
        'stop_recurring' => env('FASPAY_STOP_RECURRING_NOTIF_CLASS'),
    ],
    'notification_channel' => [
        'slack' => env('SLACK_OPERATION_CHANNEL'),
    ],
];
