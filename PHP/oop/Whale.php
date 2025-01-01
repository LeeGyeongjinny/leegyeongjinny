<?php

// class 상속, 추상화

namespace PHP\oop;

require_once('./Mammal.php');
require_once('./Swim.php');

use PHP\oop\Mammal;
use PHP\oop\Swim;

class Whale extends Mammal implements Swim {
  // private $name;
  // private $residence;
  // private $color;

  // public function __construct($name,$residence,$color){
  //   $this->name = $name;
  //   $this->residence = $residence;
  //   $this->color = $color;
  // }

  // public function printInfo(){
  //   return $this->color." ".$this->name."가 ".$this->residence."에 삽니다.";
  // }

  public function printInfo(){
  return "고래가 고래고래";
  }

  public function swimming(){
    return "헤엄칩니다.";
  }
}