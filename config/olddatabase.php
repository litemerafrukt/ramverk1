<?php

// mysql -hblu-ray.student.bth.se -uanng15 -p

return [
    // $dsn = "mysql:host=blu-ray.student.bth.se;dbname=anng15;",
    // $login = "anng15",
    // $password = "xrVazvnZQDNb",
    $dsn      = "mysql:host=localhost;dbname=anng15;",
    $login    = "whoever",
    $password = "whatever",
    $options = [PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'UTF8'"],
];
