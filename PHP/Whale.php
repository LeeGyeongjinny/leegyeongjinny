<?php

class Whale {

    public $name = "고래\n";
    private $age = 30;
    
    function breath() {
        echo "숨을 쉽니다.\n";
    }

    function info() {
        // echo "나이는".$this->age."\n";
        echo "나이는".$this->breath()."\n";
    }

    public static function myStatic() {
        echo "이건 스테틱 메소드.\n";
    }
}