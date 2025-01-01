<?php

namespace Controllers;

use Controllers\Controller;
use Models\Board;
use Models\BoardsCategory;

class BoardController extends Controller{
  private $arrBoardList = []; // 게시글 정보 리스트
  // 외부에서 이 데이터를 함부로 조작하거나 변경하는 것을 막기 위함
  // 객체지향의 캡슐화
  private $boardName = ''; // 게시판 이름
  protected $boardType = ''; // 게시판 코드

  // getter
  public function getArrBoardList(){
    return $this->arrBoardList;
  }

  public function getBoardName(){
    return $this->boardName;
  }

  // setter
  public function setArrBoardList($arrBoardList){
    $this->arrBoardList = $arrBoardList;
  }

  public function setBoardName($boardName){
    $this->boardName = $boardName;
  }

  // getter, setter 쓰는 이유 : 캡슐화
  // public, protected : 이거 두개는 캡슐화 안됨, 외부접근가능 (자식도 외부라서 상속도 안되게 해야한다 -> private사용해야함)

  public function index(){
    // 보드타입 획득
    $requestData = [
      'bc_type' => isset($_GET['bc_type']) ? $_GET['bc_type'] : '0'
    ];

    $this->boardType = $requestData['bc_type'];

    // 게시글 정보 획득
    $boardModel = new Board(); // use Models\Board; 빠뜨리는거 조심하자! -> 자동완성 하는 습관
    $this->setArrBoardList($boardModel->getArrBoardList($requestData)); // return값이 배열로 옴 -> setArrBoardList 여기서 프로퍼티로 저장

    // 보드 이름 획득
    $boardCategoryModel = new BoardsCategory();
    $resultBoardCategory = $boardCategoryModel->getBoardName($requestData);
    $this->setBoardName($resultBoardCategory['bc_name']);

    return 'board.php';
  }

  // 상세
  public function show() {
    $requestData = [
      'b_id' => $_GET['b_id']
    ];

    // 게시글 정보 조회
    $boardModel = new Board();
    $resultBoard = $boardModel->getBoardDetail($requestData);

    // JSON 변환
    $responseData = json_encode($resultBoard);

    header('Content-type: application/json');
    // 안적으면 기본적으로 html(hyper-text 타입으로 간다)
    // 이렇게 하면 php에서는 json타입으로 보냈다는 것을 명시해줌
    // 이거 안적으면 js에서 받을 때 json이라는 것을 인식 못하고 버그남
    echo $responseData;
    exit;
  }

  // 작성 페이지로 이동
  public function create() {
    $this->boardType = $_GET['bc_type'];
    return 'insert.php';
  }

  // 작성 처리
  public function store() {
    $requestData = [
      'b_title' => $_POST['b_title']
      ,'b_content' => $_POST['b_content']
      ,'b_img' => '' 
      // 빈 문자열인 이유
      // 파일에 객체가 들어가있다 -> 이름을 새로 지정해주고 파일을 실제로 저장하고 그 경로를 가져와서 db에 저장할거야
      ,'bc_type' => $_POST['bc_type']
      ,'u_id' => $_SESSION['u_id']
    ];

    $requestData['b_img'] = $this->saveImg($_FILES['file']);

    $boardModel = new Board();
    $boardModel->beginTransaction();
    $resultBoardInsert = $boardModel->insertBoard($requestData); // INSERT 결과 개수
    if($resultBoardInsert !== 1) {
      $boardModel->rollBack();
      $this->arrErrorMsg[] = '게시글 작성 실패';
      $this->boardType = $requestData['bc_type'];
      return 'insert.php';
    }

    $boardModel->commit();

    return 'Location: /boards?bc_type='.$requestData['bc_type'];
  }

  private function saveImg($file) {
    $type = explode('/', $file['type']); // ['IMAGE', '확장자'] // 이미지 파일 '/' 기준으로 배열로 나눔
    $fileName = uniqid().'.'.$type[1]; // 34lk34l5nl(랜덤 예시).확장자 // 1번방에 있는거 unique한 배열 랜덤으로 가져옴.확장자명
    $filePath = _PATH_IMG.'/'.$fileName; // /view/img/34lk34l5nl.확장자 // 파일이 저장될  경로(상대경로)
    move_uploaded_file($file['tmp_name'], _ROOT.$filePath); // 파일 복사

    return $filePath;
  }
}