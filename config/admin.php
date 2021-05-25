<?php

return [
    /*
     * Admin Panel Name
     *
     * This value is the name of your application. This value is used when the
     * framework needs to display the name of the application within the UI
     * or in other locations. Of course, you're free to change the value.
     */
    'name' => 'Laravel Admin',

    /*
     * Admin Path
     * This is the URI path where Admin Panel will be accessible from.
     * Feel free to change this path to anything you like.
     */
    'path' => '/admin',

    /*
     * Admin Domain
     *
     * You can use domain where Admin Panel wil be accessible from.
     */
    'domain' => null,


    /*
     * Admin Routes
     */
    'routes' => [
        /*
         * Custom routes file
         */
        'file' => base_path('routes/admin.php'),

        /*
         * Admin Route Namespace
         *
         * You can use own controllers to extends admin panel.
         * This namespace using for Admin Routes [routes].
         */
        'namespace' => '',

        /*
         * Admin Route Middleware
         */
        'middleware' => 'admin',
    ],

    /*
     * Admin Breadcrumbs
     */
    'breadcrumbs' => [

        /*
         * Admin Parent Item Configuration
         */
        'parent' => [

            /*
             * Parent Route Name
             */
            'name' => 'admin.dashboard',

            /*
             * Parent Title
             */
            'title' => 'Home',
        ],
    ],

    /*
     * Admin Panel Navigation Items
     */
    'navigation' => [
        [
            'name' => 'Users',
            'link' => 'admin.users.index',
            'icon' => 'fa-users',
        ],
        [
            'name' => 'Translations',
            'link' => 'admin.translations.index',
            'icon' => 'fa-language',
        ],
    ],
];