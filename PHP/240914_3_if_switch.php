<?php

$num = 5;
if($num ===10) {
    echo "10이당\n";
} else if($num === 7){
    echo "7이당\n";
} else {
    echo "10도 7도 아니당\n";
}

$rank = 7;
if($rank === 1) {
    echo "1등\n";
} else if($rank === 2) {
    echo "1등\n";
} else if($rank === 3) {
    echo "3등\n";
} else if($rank === 4 || $rank === 5) {
    echo "특별상\n";
} else {
    echo "순위 외\n";
}

$answer1 = 2;
$answer2 = 2;
if($answer1 === 2 && $answer2 === 5) {
    echo "100점\n";
} else if($answer1 === 2 || $answer2 === 5) {
    echo "50점\n";
} else {
    echo "0점\n";
}

$score = 55;
$grade = "";
if($score === 100) {
    $grade = "A+";
} else if($score >= 90) {
    $grade = "A";
} else if($score >= 80) {
    $grade = "B";
} else if($score >= 70) {
    $grade = "C";
} else if($score >= 60) {
    $grade = "D";
} else{
    $grade = "F";
}
echo "당신의 점수는 ".$score."점 입니다. <".$grade.">\n";

// switch

$sports = "발야구";
switch($sports) {
    case "축구":
        echo "축구공";
        break;
    case "야구":
    case "발야구":
        echo "야구공";
        break;
    case "배구":
    case "피구":
        echo "배구공";
        break;
    case "농구":
        echo "농구공";
        break;
    default:
        echo "스포츠";
        break;
}
echo "\n----------------------------\n";

$win = "3등";
switch($win) {
    case "1등":
        $prize= "금상";
        break;
    case "2등":
        $prize= "은상";
        break;
    case "3등":
        $prize= "동상";
        break;
    case "4등":
        $prize= "장려상";
        break;
    default:
        $prize= "노력상";
        break;
}
echo "당신은 ".$prize."입니다.";
echo "\n----------------------------\n";

