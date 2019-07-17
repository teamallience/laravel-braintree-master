<?php

$pusher_key = getenv('PUSHER_APP_KEY') !== null ? getenv('PUSHER_APP_KEY') : env('PUSHER_APP_KEY');
$pusher_secret = getenv('PUSHER_APP_SECRET') !== null ? getenv('PUSHER_APP_SECRET') : env('PUSHER_APP_SECRET');
$pusher_app_id = getenv('PUSHER_APP_ID') !== null ? getenv('PUSHER_APP_ID') : env('PUSHER_APP_ID');
$pusher_app_cluster = getenv('PUSHER_APP_CLUSTER') !== null ? getenv('PUSHER_APP_CLUSTER') : env('PUSHER_APP_CLUSTER');

return [

    /*
    |--------------------------------------------------------------------------
    | Default Broadcaster
    |--------------------------------------------------------------------------
    |
    | This option controls the default broadcaster that will be used by the
    | framework when an event needs to be broadcast. You may set this to
    | any of the connections defined in the "connections" array below.
    |
    | Supported: "pusher", "redis", "log", "null"
    |
    */



    'default' => env('BROADCAST_DRIVER', 'null'),

    /*
    |--------------------------------------------------------------------------
    | Broadcast Connections
    |--------------------------------------------------------------------------
    |
    | Here you may define all of the broadcast connections that will be used
    | to broadcast events to other systems or over websockets. Samples of
    | each available type of connection are provided inside this array.
    |
    */

    'connections' => [

        'pusher' => [
            'driver' => 'pusher',
            'key' => $pusher_key,
            'secret' => $pusher_secret,
            'app_id' => $pusher_app_id ,
            'options' => [
                'cluster' => $pusher_app_cluster,
                'encrypted' => true,
            ],
        ],

        'redis' => [
            'driver' => 'redis',
            'connection' => 'default',
        ],

        'log' => [
            'driver' => 'log',
        ],

        'null' => [
            'driver' => 'null',
        ],

    ],

];
