<?php

return [

    'default' => 'default',

    'documentations' => [

        'default' => [

            'api' => [
                'title' => 'API REST - Plataforma de Adopción de Animales',
            ],

            'routes' => [
                /*
                 * URL donde se muestra Swagger UI
                 */
                'api' => 'api/documentation',
            ],

            /*
             * ⚠️ CONFIGURACIÓN CLAVE
             * Usamos SOLO OpenAPI en YAML
             * NO usamos anotaciones PHP
             */
            'paths' => [
                'docs_json' => 'api-docs.json',
                'docs_yaml' => 'openapi.yaml',

                // ❌ Desactivar completamente anotaciones
                'annotations' => [],
            ],

            /*
             * Forzar uso de YAML en Swagger UI
             */
            'format_to_use_for_docs' => 'yaml',
        ],
    ],

    'defaults' => [

        'routes' => [
            'docs' => 'docs',
            'oauth2_callback' => 'api/oauth2-callback',

            'middleware' => [
                'api' => [],
                'asset' => [],
                'docs' => [],
                'oauth2_callback' => [],
            ],

            'group_options' => [],
        ],

        'paths' => [
            /*
             * Carpeta donde está tu openapi.yaml
             */
            'docs' => storage_path('api-docs'),

            'views' => base_path('resources/views/vendor/l5-swagger'),

            'base' => null,

            'excludes' => [],
        ],

        /*
         * ⚠️ IMPORTANTE
         * No escanear PHP → no usar swagger-php
         */
        'scanOptions' => [
            'analyser' => null,
            'analysis' => null,
            'processors' => [],
            'pattern' => null,
            'exclude' => [],
            'open_api_spec_version' => \L5Swagger\Generator::OPEN_API_DEFAULT_SPEC_VERSION,
        ],

        /*
         * No generar automáticamente
         */
        'generate_always' => false,

        'generate_yaml_copy' => false,

        'proxy' => false,

        'additional_config_url' => null,

        'operations_sort' => null,

        'validator_url' => null,

        'ui' => [
            'display' => [
                'dark_mode' => false,
                'doc_expansion' => 'none',
                'filter' => true,
            ],

            'authorization' => [
                'persist_authorization' => false,
            ],
        ],
    ],
];
