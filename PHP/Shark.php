<?php

class Shark {
    
    public $name;

    function introduce(){
        echo "나는 상어.\n";
    }

    public function __construct($name) {
        $this->name = $name;
        $this->info();
    }
    
    private function info() {
        return "안녕";
    }
}