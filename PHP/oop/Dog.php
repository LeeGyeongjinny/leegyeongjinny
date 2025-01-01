<?php
namespace PHP\oop;

require_once('./Mammal.php');
require_once('./Pet.php');

use PHP\oop\Mammal;
use PHP\oop\PET;

class Dog extends Mammal implements Pet {
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
    return '개가 개개개개';
  }

  public function running(){
    return '뛰어갑니다.';
  }

  public function printPet(){
    return '애완동물';
  }
}