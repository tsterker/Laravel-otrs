<?php

/*
 * This file is part of the Laravel OTRS library.
 *
 * (c) Filippo Galante <filippo.galante@b-ground.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

return [
    /*
      |--------------------------------------------------------------------------
      | Default Connection Name
      |--------------------------------------------------------------------------
      |
      | Here you may specify which of the connections below you wish to use as
      | your default connection for all work. Of course, you may use many
      | connections at once using the manager class.
      |
     */
    'default' => 'main',
    /*
      |--------------------------------------------------------------------------
      | OTRS Connections
      |--------------------------------------------------------------------------
      |
      | Here are each of the connections setup for your application. Example
      | configuration has been included, but you may add as many connections as
      | you would like. At the moment only guzzlehttp driver is supported.
      |
      | Operations:
      | Follow the following guide to setup the operations in your OTRS
      | webservice control panel.
      |
     */
    'connections' => [
        'main' => [
            'driver' => 'guzzlehttp',
            'username' => 'your-username', // User or customer username
            'password' => 'your-password',
            'url' => 'http://yourdomain.com',
            'webservice' => 'webservice-name',
            'operations' => [
                'session_create' => [
                    'method' => 'POST',
                    'url' => 'your/url',
                ],
                'ticket_create' => [
                    'method' => 'POST',
                    'url' => 'your/url',
                ],
                'ticket_get' => [
                    'method' => 'GET',
                    'url' => 'your/url',
                ],
                'ticket_search' => [
                    'method' => 'GET',
                    'url' => 'your/url',
                ],
                'ticket_update' => [
                    'method' => 'PUT',
                    'url' => 'your/url',
                ]
            ],
        ],
    ],
];
