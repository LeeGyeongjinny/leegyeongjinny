<?php
function my_db_conn() {
    $my_host = "localhost";
    $my_port = "3306";
    $my_user = "root";
    $my_password = "php504";
    $my_db_name = "dbsample";
    $my_charset = "utf8mb4";
    $my_dsn = "mysql:host=".$my_host.";port=".$my_port.";dbname=".$my_db_name.";charset=".$my_charset;

    $my_otp = [
        PDO::ATTR_EMULATE_PREPARES          => false
        ,PDO::ATTR_ERRMODE                  => PDO::ERRMODE_EXCEPTION
        ,PDO::ATTR_DEFAULT_FETCH_MODE       => PDO::FETCH_ASSOC
    ];

    return new PDO($my_dsn, $my_user, $my_password, $my_otp);
}