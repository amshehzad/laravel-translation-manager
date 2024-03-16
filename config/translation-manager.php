<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Routes group config
    |--------------------------------------------------------------------------
    |
    | The default group settings for the elFinder routes.
    |
    */
    'route' => [
        'prefix' => 'translations',
        /*'middleware' => 'auth',*/
    ],

    /*
     * Enable deletion of translations
     *
     * @type boolean
     */
    'delete_enabled' => true,

    /*
     * Exclude specific groups from Laravel Translation Manager.
     * This is useful if, for example, you want to avoid editing the official Laravel language files.
     *
     * @type array
     *
     *    array(
     *        'pagination',
     *        'reminders',
     *        'validation',
     *    )
     */
    'exclude_groups' => [],

    /*
     * Exclude specific languages from Laravel Translation Manager.
     *
     * @type array
     *
     *    array(
     *        'fr',
     *        'de',
     *    )
     */
    'exclude_langs' => [],

    /*
     * Export translations with keys output alphabetically.
     */
    'sort_keys' => false,

    'trans_functions' => [
        'trans',
        'trans_choice',
        'Lang::get',
        'Lang::choice',
        'Lang::trans',
        'Lang::transChoice',
        '@lang',
        '@choice',
        '__',
        '$trans.get',
    ],

    'models' => [
//        \App\Models\Post::class,
//        \App\Models\Category::class,
    ],

    'model-field-source' => 'translatable',

    /*
     * Database connection name to allow for different db connection for the translations table.
     */
    'db_connection' => env('TRANSLATION_MANAGER_DB_CONNECTION', null),

    /*
     * Enable pagination of translations
     *
     * @type boolean
     */
    'pagination_enabled' => true,

    /*
     * Define number of translations per page
     *
     * @type integer
     */
    'per_page' => 50,

    /* ------------------------------------------------------------------------------------------------
     | Set Views options
     | ------------------------------------------------------------------------------------------------
     | Here you can set The "extends" blade of index.blade.php
    */
    'layout' => 'translation-manager::layout',

    /*
     * Choose which template to use [bootstrap4, bootstrap5, tailwind3 ]
     */
    'template' => 'tailwind3',

    /*
     * Extra options during the exportations
     */
    'export-options' => [
        'use-old-format' => false,
        'has-sub-folders' => true,
    ],
];
