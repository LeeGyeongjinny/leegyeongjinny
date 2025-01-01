<?php

namespace Models;

use Throwable;
use Models\Model;

class BoardsCategory extends Model {
  public function getBoardName($paramArr){
    try{
      $sql = 
        ' SELECT '
        .'    bc_name '
        .' FROM '
        .'    boards_category '
        .' WHERE '
        .'    bc_type = :bc_type '
      ;

      $stmt = $this->conn->prepare($sql);
      $stmt->execute($paramArr);
      return $stmt->fetch(); // 데이터 레코드 하나만 가져올거라서 fetch
    } catch (Throwable $th){
      echo 'BoardCategory->getBoardName(), '.$th->getMessage();
      exit;
    }
  }

  public function getBoardsNameList(){
    try {
      $sql = 
        ' SELECT '
        .'    bc_name '
        .'    ,bc_type '
        .' FROM '
        .'    boards_category '
        .' ORDER BY '
        .'    bc_type ASC '
      ;

      $stmt = $this->conn->query($sql);
      return $stmt->fetchAll();
    } catch(Throwable $th) {
      echo 'BoardsCategory->getBoardNameList(), '.$th->getMessage();
    }
  }
}