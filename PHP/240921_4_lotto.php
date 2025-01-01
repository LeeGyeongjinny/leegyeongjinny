<?php

// $num = range(1, 45);
// for($i = 1; $i <= 6; $i++) {
//     $randomKey = array_rand($num);
//     echo $num[$randomKey]." ";

//     unset($random);
// }

// 수업 - 내장함수 최대한 안 쓰고

$arr = []; // 1 - 45수를 가지는 배열
$get_numbers = []; // 뽑은 숫자 저장용 배열

// 1 -45의 값을 가지는 배열 생성
for($i = 1; $i < 45; $i++) {
    $arr[$i - 1] = $i;
}

// 숫자 6개 뽑는 처리
for($i = 0; $i < 6; $i++) {
    $random_num = random_int(0,44);
}