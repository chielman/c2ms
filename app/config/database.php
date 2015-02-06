<?php

use \PDO;

return [
    'dsn' => 'mysql:host=localhost;dbname=c2ms',
    'username' => 'root',
    'password' => '',
    'params' => [PDO::ATTR_PERSISTENT => true]
];