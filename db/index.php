<?php

$app->register(new Silex\Provider\DoctrineServiceProvider(), array(
    'dbs.options' => array (
        'localhost' => array(
            'driver'    => 'pdo_mysql',
            'host'      => 'localhost',
            'dbname'    => 'kineo',
            'user'      => 'root',
            'password'  => 'root',
            'charset'   => 'utf8',
        )
    ),
));
