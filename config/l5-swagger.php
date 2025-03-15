<?php
return [
    'default' => 'default',
    'documentations' => [
        'default' => [
            'api' => [
                'title' => 'News Aggregator API', //Custom API Title
                'description' => 'API documentation for the News Aggregator Laravel project.',
                'version' => '1.0.0',
            ],

            'routes' => [
                'api' => 'api/documentation', //Swagger UI URL
            ],

            'paths' => [
                'use_absolute_path' => env('L5_SWAGGER_USE_ABSOLUTE_PATH', true),
                'annotations' => [
                    base_path('app'),
                ],
            ],
        ],
    ],
];
