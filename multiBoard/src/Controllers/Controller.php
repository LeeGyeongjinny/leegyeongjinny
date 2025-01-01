<?php

namespace Controllers;

use Lib\Auth;
use Models\BoardsCategory;

class Controller{
  protected $arrErrorMsg = []; // 화면에 표시할 에러 메시지 리스트
  // private $arrBoardNameInfo = []; // 헤더 게시판 드롭다운 리스트
  // getter, setter 만들기 귀찮아서 protected로 바꾼다
  protected $arrBoardNameInfo = []; // 헤더 게시판 드롭다운 리스트

  // 생성자
  public function __construct(string $action) {
    // 세션 시작
    if(session_status() === PHP_SESSION_NONE) {
      session_start();
    }

    // 유저 로그인 및 권한 체크
    Auth::chkAuthorization();

    // 헤더 드롭다운 리스트 획득
    $boardsCategoryModel = new BoardsCategory();
    $this->arrBoardNameInfo = $boardsCategoryModel->getBoardsNameList();

    // 해당 Action 호출
    $resultAction = $this->$action();

    // view 호출
    $this->callView($resultAction);

    exit; // php 처리 종료
  }


  /**
   * 뷰 OR 로케이션 처리용 메소드
   */
  private function callView($path) {
    if(strpos($path, 'Location:') === 0) {
      header($path); // $path로 보내줌
    } else {
      require_once(_PATH_VIEW.'/'.$path); // view파일 호출하고 exit으로 처리 종료
    }
  }
}