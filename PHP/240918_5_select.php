<?php

require_once("./my_pdo_class.php");

try {
    $conn = my_db_conn();

    // $id = 1;
    // $name = "원성현";
    $sql = " SELECT "
            ."     * "
            ." FROM employees "
            ." WHERE "
            // ."     emp_id = :emp_id"
            ."     name = :name "
    ;
    $arr_prepare = [
        // "emp_id" => $id
        "name" => "원성현"
    ];

    $stmt = $conn->prepare($sql);
    $stmt->execute($arr_prepare);
    $result = $stmt->fetchAll();
} catch (Throwable $th) {
    echo $th->getMessage();
}



print_r($result);