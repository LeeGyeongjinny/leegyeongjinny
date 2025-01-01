<?php

namespace PHP\oop;

require_once('./Pet.php');
require_once('./Swim.php');

use PHP\oop\Pet;
use PHP\oop\Swim;

class GoldFish implements Pet, Swim{
  private $name = '금붕어';

  public function swimming(){
    return '수영합니다.';
  }

  public function printPet(){
    return '애완동물';
  }
}