<?php

// $arr = [1, 2, 3, 4, 5, 6, 7, 8, 9];
// foreach($arr as $key => $val) {
//   echo "2 x ".$val." = ".(2*$val)."\n";
// }

// foreach($arr as $val){
//   foreach($arr as $item) {
//     echo $val." X "$item." = ".($val*$item)."\n";
//     }
// } // 구구단 전체 돌릴라했는데 이건 안되네

// 3의 배수
for($i = 1; $i <= 100; $i++){
  if(($i % 3) === 0) {
    echo "짝,";
  } else{
    echo $i.",";
  }
}

echo "\n";

// 별 찍기

$concat = "";
for($i = 1;$i <= 5; $i++){
  for($z = 1;$z <= $i; $z++){
    $concat .= "*";
  }
  $concat .= "\n";
}
echo $concat;

// 별 거꾸로 찍기

$concat = "";
for($i = 1; $i <= 5;$i++){
  for($z = 5;($z-$i) > 0;$z--){
    $concat .=" ";
  }
  for($k = 1;$k <= $i;$k++){
    $concat .="*";
  }
  $concat .= "\n";
}
echo $concat;


// 로또 만들기

// 내꺼 수업
$array = range(1,45);

for ($i = 1; $i <= 6; $i++){
  $ran = array_rand($array);
  echo $array[$ran]." ";

  unset($array[$ran]);
}

echo "\n";

// 선생님 수업
$arr = range(1,45); // 숫자 1 - 45 배열
$get_numbers = []; // 뽑은 숫자 저장용

$random_key = array_rand($arr,6); // 배열에서 랜덤 키 6개 획득

foreach($random_key as $val){
  $get_numbers[] = $arr[$val]; // 키를 이용해서 값 삽입
}

echo implode(" ", $get_numbers); // 공백을 구분자로 배열을 스트링으로 출력