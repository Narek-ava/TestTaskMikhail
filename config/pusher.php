<?php

return [
        'id' => env('PUSHER_APP_ID'),
        'name' => env('APP_NAME'),
        'key' => env('PUSHER_APP_KEY'),
        'secret' => env('PUSHER_APP_SECRET'),
        'path' => env('PUSHER_APP_PATH'),
        'cluster' => ['cluster' => env('PUSHER_APP_CLUSTER')],
        'capacity' => null,
        'enable_client_messages' => false,
        'enable_statistics' => true,
];
