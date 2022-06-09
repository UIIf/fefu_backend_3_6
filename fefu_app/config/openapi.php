<?php

return [

    'collections' => [

        'default' => [

            'info' => [
                'title' => config('app.name'),
                'description' => null,
                'version' => '0.0.1',
                'contact' => [],
            ],

            'servers' => [
                [
                    'url' => 'http://localhost',
                    'description' => null,
                    'variables' => [],
                ],
            ],

            'tags' => [
                [
                    'name' => 'page',
                    'description' => 'Shows pages',
                 ],
                [
                   'name' => 'news',
                   'description' => 'Shows news',
                ],
                [
                    'name' => 'appeal',
                    'description' => 'For applications',
                 ],
                [
                    'name' => 'auth',
                    'description' => 'Auth',
                ],
                [
                    'name' => 'categories',
                    'description' => 'Categories',
                ],
                [
                    'name' => 'products',
                    'description' => 'Products',
                ],
            ],

            'security' => [
                // GoldSpecDigital\ObjectOrientedOAS\Objects\SecurityRequirement::create()->securityScheme('JWT'),
            ],

            // Route for exposing specification.
            // Leave uri null to disable.
            'route' => [
                'uri' => '/openapi',
                'middleware' => [],
            ],

            // Register custom middlewares for different objects.
            'middlewares' => [
                'paths' => [
                    //
                ],
                'components' => [
                    //
                ],
            ],

        ],

    ],

    // Directories to use for locating OpenAPI object definitions.
    'locations' => [
        'callbacks' => [
            app_path('OpenApi/Callbacks'),
        ],

        'request_bodies' => [
            app_path('OpenApi/RequestBodies'),
        ],

        'responses' => [
            app_path('OpenApi/Responses'),
        ],

        'schemas' => [
            app_path('OpenApi/Schemas'),
        ],

        'security_schemes' => [
            app_path('OpenApi/SecuritySchemes'),
        ],
    ],

];
