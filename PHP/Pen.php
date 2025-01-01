<?php

class Pen {
    public $color;
    public $bold;
    public $price;

    // public function write($contents) {
    //     echo $contents."를 쓰다.\n";
    // }

    // public function draw($contents) {
    //     echo $contents."그리다.\n";
    // }

    public function __construct($color, $bold, $price) {
        echo "펜의 정보.\n";
        echo "색깔은 ".$color."\n";
        echo "굵기는 ".$bold."\n";
        echo "가격은 ".$price."\n";
    }
}