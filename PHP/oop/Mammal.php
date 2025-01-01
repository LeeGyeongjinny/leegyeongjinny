<?php

namespace PHP\oop;

abstract class Mammal {
  private $name;
  private $residence;
  private $color;

  public function __construct($name,$residence,$color){
    $this->name = $name;
    $this->residence = $residence;
    $this->color = $color;
  }

  // public function printInfo(){
  //   return $this->color." ".$this->name."가 ".$this->residence."에 삽니다.";
  // }

  abstract public function printInfo();
  // 이건 반드시 하위 클래스에서 오버라이딩 필요
}