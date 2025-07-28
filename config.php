<?php
// config.php

return [
    'database' => [
        'host' => '127.0.0.1', // veya 'localhost'
        'port' => 3306,
        'dbname' => 'stajyer_db',
        'user' => 'root',
        'password' => '', // XAMPP kurulumunda varsayılan şifre boştur. Farklıysa değiştir.
        'charset' => 'utf8mb4'
    ],
    // 'ldap' => [
    //     'host' => 'ldap.sirket.com', // Bu bilgiyi daha sonra dolduracağız
    //     'port' => 389,
    //     'dn' => 'ou=users,dc=sirket,dc=com' // Bu bilgiyi de sonra dolduracağız
    // ]
];