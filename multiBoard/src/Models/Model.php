<?php
namespace Models;

use Throwable;
use PDO;

class Model {
  protected $conn; // 객체 저장용
  // PDO class instance한 것 -> 외부에서 접근수정하면 안됨 -> 상송관계에서만 접근할 수 있게 protected

  // 생성자
  public function __construct() {
    try {
      $opt = [
        PDO::ATTR_EMULATE_PREPARES      => false // DB의 Prepared Statement 기능을 사용하도록 설정
        ,PDO::ATTR_ERRMODE              => PDO::ERRMODE_EXCEPTION // PDO Exception을 throw하도록 설정
        ,PDO::ATTR_DEFAULT_FETCH_MODE   => PDO::FETCH_ASSOC // 연관배열로 Fetch 설정
      ];

      $this->conn = new PDO(_MARIA_DB_DNS, _MARIA_DB_USER, _MARIA_DB_PASSWORD, $opt);
    } catch(Throwable $th) {
      echo 'Model->__construct(), '.$th->getMessage(); // Model의 __construct에서 에러났다고 확실하게 알 수있게 하기 위함
      exit;
    }
  }

  // 트랜잭션 시작
  public function beginTransaction(){
    $this->conn->beginTransaction();
  }

  // 커밋
  public function commit(){
    $this->conn->commit();
  }

  // 롤백
  public function rollBack(){
    $this->conn->rollBack();
  }
  // 커밋과 롤백의 예외처리는 자식모델쪽에서 하면 될 듯
}