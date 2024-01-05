<?php

return [
    'currencies' => [
        'types' => [
            'crypto' => 'Crypto',
            'fiat' => 'Fiat',
        ]
    ],

    'order' => [
        'status' => [
            'open',
            'closed'
        ]
    ],

    'transaction' => [
        'types' => [
            'buy',
            'sell',
            'deposit',
            'withdraw',
            'refund',
        ],
        'statuses' => [
            'fail',
            'cancel',
            'wait',
            'paid',
            'success',
        ],
    ],
];
