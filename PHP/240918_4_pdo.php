<?php

// $my_host = "localhost";
// $my_user = "root";
// $my_password = "php504";
// $my_db_name = "dbsample";
// $my_charset = "utf8mb4";
// $my_dsn = "mysql:host=".$my_host.";dbname=".$my_db_name.";charset=".$my_charset;

// $my_otp = [
//     PDO::ATTR_EMULATE_PREPARES          => false
//     ,PDO::ATTR_ERRMODE                  => PDO::ERRMODE_EXCEPTION
//     ,PDO::ATTR_DEFAULT_FETCH_MODE       => PDO::FETCH_ASSOC
// ];

require_once("./my_pdo_class.php");
$conn = my_db_conn();

$sql = "SELECT
            *
        FROM
            employees
        ORDER BY emp_id ASC
        LIMIT 5";
$stmt = $conn->query($sql);
$result = $stmt->fetchAll();
print_r($result);

foreach($result as $item) {
    echo $item["emp_id"]." ".$item["name"]."\n";
}