<?php
require_once($_SERVER["DOCUMENT_ROOT"]."/config.php");

function my_db_conn() {
    $option = [
        PDO::ATTR_EMULATE_PREPARES       => false
        ,PDO::ATTR_ERRMODE               => PDO::ERRMODE_EXCEPTION
        ,PDO::ATTR_DEFAULT_FETCH_MODE    => PDO::FETCH_ASSOC
    ];

    return new PDO(MY_MARIADB_DSN, MY_MARIADB_USER, MY_MARIADB_PASSWORD, $option);
}

/**
 * 로그인
 */


function my_board_select_id_pw(PDO $conn, array $arr_param) {
    // SQL
    $sql =
        " SELECT "
        ."    * "
        ." FROM "
        ."      tb_user "
        ." WHERE "
        ."      deleted_at IS NULL "
        ."   AND userid = :userid "
        ."   AND userpw = :userpw "
    ;



    $stmt = $conn->prepare($sql);
    $result_flg = $stmt->execute($arr_param);

    if(!$result_flg) {
    throw new Exception("쿼리 실행 실패");
    }


    return $stmt->fetchAll();
}


/**
 * main board --------------------------------------------------------
 */


/**
*   board select 페이지네이션
*/
function my_board_select_pagination(PDO $conn, array $arr_param) {
    // SQL
    $sql =
        " SELECT "
        ."    * "
        ." FROM "
        ."      travel_boards "
        ." WHERE "
        ."      deleted_at IS NULL "    
        ." ORDER BY "
        ."      created_at DESC "
        ."      ,id DESC "
        ." LIMIT :list_cnt OFFSET :offset "
    ;



    $stmt = $conn->prepare($sql);
    $result_flg = $stmt->execute($arr_param);

    if(!$result_flg) {
    throw new Exception("쿼리 실행 실패");
    }


    return $stmt->fetchAll();
}

/**
 * board 테이블 유효 게시글 총 수 획득
 */

function my_board_total_count(PDO $conn) {
    $sql = 
        " SELECT "
        ."      COUNT(*) cnt "
        ." FROM "
        ."      travel_boards "
        ." WHERE "
        ."      deleted_at IS NULL "
    ;

    $stmt = $conn->query($sql);
    $result = $stmt->fetch();
    return $result["cnt"];
}

/**
 * board 테이블 insert 처리
 */
function my_board_insert(PDO $conn, array $arr_param) {
    $sql =
        " INSERT INTO travel_boards ( "
        ."      country "
        ."      ,city "
        ."      ,departure "
        ."      ,arrival "
        ."      ,companion "
        ."      ,title "
        ."      ,content "
        ."      ,img_1 "
        ."      ,img_2 "
        ." ) "
        ." VALUES( "
        ."      :country "
        ."      ,:city "
        ."      ,:departure "
        ."      ,:arrival "
        ."      ,:companion "
        ."      ,:title "
        ."      ,:content"
        ."      ,:img_1 "
        ."      ,:img_2 "
        ." ) "
    ;

    $stmt = $conn->prepare($sql);
    $result_flg = $stmt->execute($arr_param);

    if(!$result_flg) {
        throw new Exception("쿼리 실행 실패");
    }

    $result_cnt = $stmt->rowCount();

    if($result_cnt !== 1) {
        throw new Exception("Inset Count 이상");
    }

    return true;
}


/**
 * id로 게시글 조회
 */
function my_board_select_id(PDO $conn, array $arr_param){
    $sql = 
        " SELECT "
        ."      * "
        ." FROM "
        ."      travel_boards "
        ." WHERE "
        ."      id = :id "
    ;

    $stmt = $conn->prepare($sql);
    $result_flg = $stmt->execute($arr_param);

    if(!$result_flg) {
        throw new Exception("쿼리 실행 실패");
    }

    return $stmt->fetch();
}



/**
 * board 테이블 update
 */
function my_board_update(PDO $conn, array $arr_param){
    $set = 
        " SET "
        ."      title = :title "
        ."      ,updated_at = NOW() "
        ."      ,content = :content "
        ."      ,country = :country "
        ."      ,city = :city "
        ."      ,departure = :departure "
        ."      ,arrival = :arrival "
        ."      ,companion = :companion "
    ;
    if(isset($arr_param["img_1"])) {
        $set .= "      ,img_1 = :img_1 ";
    }
    if(isset($arr_param["img_2"])) {
        $set .= "      ,img_2 = :img_2 ";
    }

    $where =
        " WHERE "
        ."      id = :id "
    ;

    $sql = 
        " UPDATE "
        ."      travel_boards "
        .$set
        .$where
    ;

    $stmt = $conn->prepare($sql);
    $result_flg = $stmt->execute($arr_param);

    if(!$result_flg) {
        throw new Exception("쿼리 실행 실패");
    }
    
    $result_cnt = $stmt->rowCount();

    if($result_cnt !== 1) {
        throw new Exception("Update Count 이상");
    }

    return $stmt->fetch();
}


/**
 * board 테이블 레코드 삭제
 */
function my_board_delete_id(PDO $conn, array $arr_param){
    $sql = 
        " UPDATE travel_boards "
        ." SET "
        ."      updated_at = NOW() "
        ."      ,deleted_at = NOW() "
        ." WHERE "
        ."      id = :id "
    ;
    
    $stmt = $conn->prepare($sql);
    $result_flg = $stmt->execute($arr_param);

    if(!$result_flg) {
        throw new Exception("쿼리 실행 실패");
    }
    
    $result_cnt = $stmt->rowCount();

    if($result_cnt !== 1) {
        throw new Exception("Delete Count 이상");
    }

    return true;
}



/**
 * bucketlist board --------------------------------------------------------
 */

/**
 * bucketlist board 테이블 유효 게시글 총 수 획득
 */

function my_bucket_board_total_count(PDO $conn) {
    $sql = 
        " SELECT "
        ."      COUNT(*) cnt "
        ." FROM "
        ."      bucket_lists "
        ." WHERE "
        ."      deleted_at IS NULL "
    ;

    $stmt = $conn->query($sql);
    $result = $stmt->fetch();
    return $result["cnt"];
}

/**
*   bucketlist board select 페이지네이션
*/
function my_bucket_board_select_pagination(PDO $conn, array $arr_param) {
    // SQL
    $sql =
        " SELECT "
        ."    * "
        ." FROM "
        ."      bucket_lists "
        ." WHERE "
        ."      deleted_at IS NULL "    
        ." ORDER BY "
        ."      created_at DESC " 
        ."      ,bkl_id DESC "
        ." LIMIT :list_cnt OFFSET :offset "
    ;



    $stmt = $conn->prepare($sql);
    $result_flg = $stmt->execute($arr_param);

    if(!$result_flg) {
    throw new Exception("쿼리 실행 실패");
    }


    return $stmt->fetchAll();
}

/**
 *  bucket_board 테이블 insert 처리
 */
function my_bucket_board_insert(PDO $conn, array $arr_param) {
    $sql =
        " INSERT INTO bucket_lists ( "
        ."      title "
        ."      ,bucket_content "
        ."      ,country "
        ."      ,sort "
        ."      ,info_content "
        ."      ,info_img "
        ." ) "
        ." VALUES( "
        ."      :title "
        ."      ,:bucket_content "
        ."      ,:country "
        ."      ,:sort "
        ."      ,:info_content "
        ."      ,:info_img "
        ." ) "
    ;

    $stmt = $conn->prepare($sql);
    $result_flg = $stmt->execute($arr_param);

    if(!$result_flg) {
        throw new Exception("쿼리 실행 실패");
    }

    $result_cnt = $stmt->rowCount();

    if($result_cnt !== 1) {
        throw new Exception("Inset Count 이상");
    }

    return true;
}



/**
 *  bucket_id로 게시글 조회
 */
function my_bucket_board_select_id(PDO $conn, array $arr_param){
    $sql = 
        " SELECT "
        ."      * "
        ." FROM "
        ."      bucket_lists "
        ." WHERE "
        ."      bkl_id = :bkl_id "
    ;

    $stmt = $conn->prepare($sql);
    $result_flg = $stmt->execute($arr_param);

    if(!$result_flg) {
        throw new Exception("쿼리 실행 실패");
    }

    return $stmt->fetch();
}




/**
 *  bucket_board 테이블 update
 */
function my_bucket_board_update(PDO $conn, array $arr_param){
    $set = 
        " SET "
        ."      title = :title "
        ."      ,updated_at = NOW() "
        ."      ,bucket_content = :bucket_content "
        ."      ,country = :country "
        ."      ,sort = :sort "
        ."      ,info_content = :info_content "
    ;

    if(isset($arr_param["info_img"])) {
        $set .= "      ,info_img = :info_img ";
    }

    $where =
        " WHERE "
        ."     bkl_id = :bkl_id "
    ;

    $sql = 
        " UPDATE "
        ."      bucket_lists "
        .$set
        .$where
    ;

    // $sql = 
    //     " UPDATE "
    //     ." SET "
    //     ."      title = :title "
    //     ."      ,bucket_content = :bucket_content "
    //     ."      ,country = :country "
    //     ."      ,sort = :sort "
    //     ."      ,info_content = :info_content "
    //     ."      ,info_img = :info_img "
    //     ."      ,updated_at = NOW() "
    //     ." WHERE "
    //     ."      bkl_id = :bkl_id "
    // ; 이거 한번에 쓰기

    $stmt = $conn->prepare($sql);
    $result_flg = $stmt->execute($arr_param);

    if(!$result_flg) {
        throw new Exception("쿼리 실행 실패");
    }
    
    $result_cnt = $stmt->rowCount();

    if($result_cnt !== 1) {
        throw new Exception("Update Count 이상");
    }

    return $stmt->fetch();
}



/**
 *  bucket_board 테이블 레코드 삭제
 */
function my_bucket_board_delete_id(PDO $conn, array $arr_param){
    $sql = 
        " UPDATE bucket_lists "
        ." SET "
        ."      updated_at = NOW() "
        ."      ,deleted_at = NOW() "
        ." WHERE "
        ."      bkl_id = :bkl_id "
    ;
    
    $stmt = $conn->prepare($sql);
    $result_flg = $stmt->execute($arr_param);

    if(!$result_flg) {
        throw new Exception("쿼리 실행 실패");
    }
    
    $result_cnt = $stmt->rowCount();

    if($result_cnt !== 1) {
        throw new Exception("Delete Count 이상");
    }

    return true;
}



/**
 *  image function
 */


// function my_save_img(PDO $conn, $file) {
//     if($file["name"] === "") {
//         $result_path = null;
//     } else {
//         $file_type = $file["type"];
//         $file_type_arr = explode("/", $file_type);
//         $extension = $file_type_arr[1];
//         $file_name = uniqid().".".$extension;
//         $file_path = "img/".$file_name;
        
//         move_uploaded_file($file["tmp_name"], MY_PATH_ROOT.$file_path);

//         $result_path = "/".$file_path;
//     }

//     return $result_path;
// }