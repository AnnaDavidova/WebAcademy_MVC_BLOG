<?php

return [
    'frameworkOptions'  => [
        'templatesPath'     => __DIR__ . '/../public/static/',
    ],
    'dbConfig'  => [
        'main'      => [
            'type'     => 'mysql',
            'host'     => 'localhost',
//            'port'     => '22',
            'name'     => 'webacademy_mvc_blog_db',
            'user'     => 'root',
            'password' => 'root',
            'charset'  => 'utf8',
        ],
        'test'      => [
            'type'     => 'mysql',
            'host'     => 'localhost',
            'name'     => 'webacademy_mvc_blog_db_test',
            'user'     => 'root',
            'password' => '',
            'charset'  => 'utf8',
        ],
    ]
];
