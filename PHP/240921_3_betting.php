<?php

// 컴퓨터랑 가위바위보

fscanf(STDIN, "%d\n", $input);

// 집에서 한 것 - 근데 왜자꾸 유저 : 에 빈칸뜨고 멘트안떠? 학원에서는 떴는뎁

$rsp = ["rock", "scissors", "paper"];
$randomKey = array_rand($rsp);
$com = $rsp[$randomKey];

echo "user : ".$input."\n";
echo "computer : ".$com."\n";


$win = "이겼습니다";
$lose = "졌습니다.";
$draw = "비겼습니다";

if($input === "rock") {
    if($com === "rock") {
        echo $draw;
    } else if($com === "scissors") {
        echo $win;
    } else {
        echo $lose;
    }
}
if($input === "scissors") {
    if($com === "rock") {
        echo $lose;
    } else if($com === "scissors") {
        echo $draw;
    } else {
        echo $win;
    }
}
if($input === "paer") {
    if($com === "rock") {
        echo $win;
    } else if($com === "scissors") {
        echo $lose;
    } else {
        echo $draw;
    }
}

// ------------------------------------------
// 학원에서 한 것

// $rsp = ["scissor", "rock", "paper"];
// $randomKey = array_rand($rsp);
// $com = $rsp[$randomKey];

// // $input = "가위";
// echo "유저 : ".$input."\n";
// echo "컴퓨터 : ".$com."\n";

// if ($input === "scissor") {
//     if($com === "paper") {
//         echo "이겼습니다.\n";
//     } else if ($com === "rock") {
//         echo "졌습니다.\n";
//     } else {
//         echo "비겼습니다.\n";
//     }
// }

// if ($input === "rock") {
//     if($com === "scissor") {
//         echo "이겼습니다.\n";
//     } else if ($com === "paper") {
//         echo "졌습니다.\n";
//     } else {
//         echo "비겼습니다.\n";
//     }
// }

// if ($input === "paper") {
//     if($com === "rock") {
//         echo "이겼습니다.\n";
//     } else if ($com === "scissor") {
//         echo "졌습니다.\n";
//     } else {
//         echo "비겼습니다.\n";
//     }
// }
