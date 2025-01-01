<?php
// require_once("./my_db.php");
// $conn = null;

// ---------------------------------------------------------------------------------------
// 사원, 연봉 테이블에 내 정보 넣기
// try {
//     $conn = my_db_conn();
//     $conn->beginTransaction();

//     // employees 내 정보 추가
//     $sql = " INSERT INTO employees( "
//     ."      name "
//     ."      ,birth "
//     ."      ,gender "
//     ."      ,hire_at "
//     ." ) "
//     ." VALUES("
//     ."      :name "
//     ."      ,:birth "
//     ."      ,:gender "
//     ."      ,DATE(NOW()) "
//     ." ) "
//     ;
//     $arr_prepare = [
//         "name"      => "이경진"
//         ,"birth"    => "1995-10-21"
//         ,"gender"   => "F"
//     ];

//     $stmt = $conn->prepare($sql); // 쿼리 준비
//     $result_flg = $stmt->execute($arr_prepare); // 쿼리 실행
//     $result_cnt = $stmt->rowCount(); // 영향받은 레코드 수 획득


//     if(!$result_flg) {
//         throw new Exception("Insert Query Error : employees");
//     }

//     if($result_cnt !== 1) {
//         throw new Exception("Insert row count Error : employees");
//     }

//     $emp_id = $conn->lastInsertId();
//     // ---------------------------------------------------------
//     // salaries 내 정보 추가

//     $sql = 
//         " INSERT INTO salaries( "
//         ."       emp_id "
//         ."      ,salary "
//         ."      ,start_at "
//         ." ) "
//         ." VALUE( "
//         ."      :emp_id "
//         ."      ,:salary "
//         ."      ,DATE(NOW()) "
//         ." ) "
//     ;
//     $arr_prepare = [
//         "emp_id"    => $emp_id
//         ,"salary"   => 50000000
//     ];

//     $stmt = $conn->prepare($sql); // 쿼리 준비
//     $result_flg = $stmt->execute($arr_prepare); // 쿼리 실행
//     $result_cnt = $stmt->rowCount(); // 영향받은 레코드 수 획득

//     if(!$result_flg) {
//         throw new Exception("Insert Query Error : employees");
//     }

//     if($result_cnt !== 1) {
//         throw new Exception("Insert row count Error : employees");
//     }

//     $conn->commit();
// } catch(Throwable $th) {
//     if(!is_null($conn)) {
//         $conn->rollBack();
//     }
//     echo $th->getMessage();
// }

// ---------------------------------------------------------------------------------------


// 소속부서 테이블 정보 넣기
// try {
//     $conn = my_db_conn();
//     $conn->beginTransaction();

//     $sql =
//         " INSERT INTO department_emps( "
//         ."      emp_id "
//         ."      ,dept_code "
//         ."      ,start_at "
//         ." ) "
//         ." VALUE( "
//         ."      :emp_id "
//         ."      ,:dept_code "
//         ."      ,DATE(NOW()) "
//         ." ) "
//     ;
//     $arr_prepare = [
//         "emp_id" => 100018
//         ,"dept_code" => "D001"
//     ];

//     $stmt = $conn->prepare($sql);
//     $result_flg = $stmt->execute($arr_prepare);
//     $result_cnt = $stmt->rowCount();

//     if(!$result_flg) {
//         throw new EXception("Insert Query Error : department_emps");
//     }

//     if($result_cnt !== 1) {
//         throw new EXception("Row Count Error : department_emps");
//     }
    
//     $conn->commit();
// } catch(Throwable $th) {
//     if(!is_null($conn)) {
//         $conn->rollBack();
//     }
//     echo $th->getMessage();
// }

// ---------------------------------------------------------------------------------------

// 방금 넣은 내 정보 연봉 1억으로 갱신하기
// try {
//     $conn = my_db_conn();
//     $conn->beginTransaction();

//     $sql =
//         " UPDATE salaries "
//         ." SET "
//         ."      updated_at  = NOW() "
//         ."      ,end_at = DATE(NOW()) "
//         ." WHERE "
//         ."      emp_id = :emp_id "
//         ."  AND end_at IS NULL "
//     ;
//     $arr_prepare = [
//         "emp_id" => 100018
//     ];

//     $stmt = $conn->prepare($sql);
//     $result_flg = $stmt->execute($arr_prepare);
//     $result_cnt = $stmt->rowCount();

//     if(!$result_flg) {
//         throw new Exception("Update Query Error : salaries ");
//     }

//     if($result_cnt > 1) {
//         throw new Exception("Row Count Query Error : salaries ");
//     }

//     $sql = 
//         " INSERT INTO salaries ("
//         ."      emp_id "
//         ."      ,salary "
//         ."      ,start_at "
//         ." ) "
//         ." VALUE( "
//         ."      :emp_id "
//         ."      ,:salary "
//         ."      ,DATE(NOW()) "
//         ." ) "
//     ;
//     $arr_prepare = [
//         "emp_id" => 100018
//         ,"salary" => 100_000_000
//     ];

//     $stmt = $conn->prepare($sql);
//     $result_flg = $stmt->execute($arr_prepare);
//     $result_cnt = $stmt->rowCount();

//     if(!$result_flg) {
//         throw new Exception("Insert Query Error : salaries ");
//     }

//     if($result_cnt !== 1) {
//         throw new Exception("Row Count Query Error : salaries ");
//     }

//     $conn->commit();
// } catch(Throwable $th) {
//     if(!is_null($conn)) {
//         $conn->rollBack();
//     }
//     echo $th->getMessage();
// }

// ---------------------------------------------------------------------------------------

// 방금 넣은 내 정보 연봉 1억 중복된거 삭제하기

// try {
//     $conn = my_db_conn();
//     $conn -> beginTransaction();

//     $sql =
//         " DELETE FROM salaries "
//         ." WHERE "
//         ."      emp_id = :emp_id "
//         ."  AND salary = :salary "
//         ."  AND end_at IS NOT NULL "
//     ;
//     $arr_prepare = [
//         "emp_id" => 100018
//         ,"salary" => 100_000_000
//     ];

//     $stmt = $conn->prepare($sql);
//     $result_flg = $stmt->execute($arr_prepare);
//     $result_cnt = $stmt->rowCount();

//     if(!$result_flg) {
//         throw new Exception("Delete Query Error : salaries");
//     }

//     if($result_cnt !== 1) {
//         throw new Exception("Delete Row Count Query Error : salaries");
//     }

//     $conn -> commit();
// } catch(Throwable $th) {
//     if(!is_null($conn)) {
//         $conn -> rollBack();
//     }

//     echo $th->getMessage();
// }

// ---------------------------------------------------------------------------------------
// 여러사람 정보 한번에 insert into employees

// $data = [
//     ["name" => "갤럭시", "birth" => "2001-01-01", "gender" => "M"]
//     ,["name" => "아이폰", "birth" => "2002-01-01", "gender" => "F"]
//     ,["name" => "우주인", "birth" => "2003-01-01", "gender" => "M"]
// ];

// try {
//     $conn = my_db_conn();
//     $conn->beginTransaction(); // 여기넣으면 하나라도 실패시 전부다 롤백

//     foreach($data as $item) {
//         $sql = 
//             " INSERT INTO employees( "
//             ."      name "
//             ."      ,birth "
//             ."      ,gender "
//             ."      ,hire_at "
//             ." ) "
//             ." VALUE( "
//             ."      :name "
//             ."      ,:birth "
//             ."      ,:gender "
//             ."      ,DATE(NOW()) "
//             ." ) "
//         ;
//         $arr_prepare = [
//             "name" => $item["name"]
//             ,"birth" => $item["birth"]
//             ,"gender" => $item["gender"]
//         ];

//         $stmt = $conn->prepare($sql);
//         $result_flg = $stmt->execute($arr_prepare);

//         if(!$result_flg) {
//             throw new Exception("Foreach Insert Error : employees");
//         }

//         if($stmt->rowCount() !== 1) {
//             throw new Exception("Foreach Insert Row Count Error : employees");
//         }
//     }


//     $conn->commit();
// } catch(Throwable $th) {
//     if(!is_null($conn)) {
//         $conn->rollBack();
//     }

//     echo $th->getMessage();
// }

// ---------------------------------------------------------------------------------------

// 동적 쿼리 dynamic query

$data = [
    "name" => "갤럭시"
    ,"gender" => "2001-01-01"
];

$sql =
    " SELECT * "
    ." FROM employees "
;

$where = "";
$arr_prepare = [];

foreach($data as $key => $val) {
    // where절 작성
    if(empty($where)) {
        $where .= " WHERE ";
    } else {
        $where .= " AND ";
    }
    $where .= " ".$key." = : ".$key;

    //prepared statement 작성
    $arr_prepare[$key] = $val;
}
$sql .= $where;
// echo $sql;

require_once("./my_db.php");
$conn = my_db_conn();

$stmt = $conn->prepare($sql);
$stmt->execute($arr_prepare);

print_r($stmt->fetchAll());


// -----------------------------------------
// $data = [
//     "name" => "둘리"
//     ,"gender" => "M"
// ];

// $sql =
//     " SELECT * "
//     ." FROM employees "
// ;

// $where = "";

// foreach($data as $key => $val) {
//     if(empty($where)) {
//         $where .= " WHERE ";
//     } else {
//         $where .= " AND ";
//     }
//     $where .= " ".$key." = :".$key;
// }
// $sql .= $where;
// echo $sql;