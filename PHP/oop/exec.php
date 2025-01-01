<?php
require_once('./Whale.php');
require_once('./Dog.php');
require_once('./GoldFish.php');

use PHP\oop\Whale;
use PHP\oop\Dog;
use PHP\oop\GoldFish;

$whale = new Whale('고래', '바다', '파랑색');
echo $whale->printInfo();
echo $whale->swimming();

$dog = new Dog('개', '마당', '갈색');
echo $dog->printInfo();
echo $dog->running();

$goldfish = new GoldFish();
echo $goldfish->printPet();
echo $goldfish->swimming();