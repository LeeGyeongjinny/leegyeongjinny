<?php

namespace Models;

use Models\Model;
use Throwable;

class User extends Model {
  public function getUserInfo($paramArr){
    try {
      $sql = 
        ' SELECT * '
        .' FROM users '
        .' WHERE u_email = :u_email '
      ;

      $stmt = $this->conn->prepare($sql); // conn -> 부모모델에 있는 conn
      $stmt->execute($paramArr);
      return $stmt->fetch();
    } catch(Throwable $th) {
      echo 'User->getUserInfo(), '.$th->getMessage();
      exit;
    }
  }

  public function registUserInfo($paramArr) {
    try {
      $sql = 
        ' INSERT INTO users( '
        .'    u_email '
        .'    ,u_password '
        .'    ,u_name '
        .' ) '
        .' VALUES ( '
        .'    :u_email '
        .'    ,:u_password '
        .'    ,:u_name '
        .' ) '
      ;

      $stmt = $this->conn->prepare($sql); // conn -> 부모모델에 있는 conn
      $stmt->execute($paramArr);
      return $stmt->rowCount(); // 영향받은 행의 개수
    } catch (Throwable $th) {
      echo 'User->registUserInfo, '.$th->getMessage();
      exit;
    } 
  }
}