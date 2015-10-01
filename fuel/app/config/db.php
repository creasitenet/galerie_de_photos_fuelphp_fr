<?php
/**
 * Use this file to override global defaults.
 *
 * See the individual environment DB configs for specific config information.
 */

return array(
    'default' => array(
            'connection'  => array(
                //'hostname'   => '127.0.0.1',
                //'database'   => 'fuel',
                'dsn'        => 'mysql:host=127.0.0.1;dbname=galerie_fuelphp',
                'username'   => 'root',
                'password'   => '',
            ),
        ),
);
