<?php
// $path에 Route\Route의 경로가 온다
spl_autoload_register(function($path){
  // \를 /로 바꿔줘야한다
  require_once(str_replace('\\', '/', $path).'.php');
});

// index에서 new해서 인스턴스화 할 때 실행되자마자 autoload 자동으로 먼저 실행되고 인스턴스화됨
// \역슬러시는 escape문자?라서 하나만 적으면 에러나서 두개적어야함