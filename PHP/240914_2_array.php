<?php

// array 배열

$arr = [1, 3, 5, 7, 9];
echo $arr[2];
$arr[2] = 100;
var_dump($arr);
$arr[3] = "만원 갖고싶다";
var_dump($arr);

// 연관배열
$arr2 = [
    "key1" => 5000
    ,"key2" => "안녕하세요."
];
echo $arr2["key2"];

$arr["key3"] = "미어캣";
var_dump($arr2);
echo "\n----------------------\n";

// 다차원 배열
$result2 = [
    [
        "id" => 100001
        ,"name" => "홍길동" 
    ]
    ,[
        "id" => 100002
        ,"name" => "갑순이" 
    ]
    ,[
        "id" => 100003
        ,"name" => "갑돌이" 
    ]
];
echo $result2[2]["name"];
echo "\n----------------------\n";

echo count($result2);
unset($result2[2]);
var_dump($result2);
echo "\n----------------------\n";