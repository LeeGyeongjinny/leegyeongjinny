<?php
require_once($_SERVER["DOCUMENT_ROOT"]."/config.php");
require_once(MY_PATH_DB_LIB);
require_once(MY_PATH_COMMON_FNC);

$conn = null;

try {
    if(strtoupper($_SERVER["REQUEST_METHOD"]) === "GET") {
        // GET 처리
        
        $id = isset($_GET["bkl_id"]) ? (int)$_GET["bkl_id"] : 0;
        
        $page = isset($_GET["page"]) ? (int)$_GET["page"] : 1;


        if($id < 1) {
            throw new Exception("파라미터 오류인가");
        }
        
        
        // PDO Instance
        $conn = my_db_conn();
        
         // ------------------------
        // 데이터 조회
        // ------------------------
        $arr_prepare = [
            "bkl_id" => $id
        ];

        $result = my_bucket_board_select_id($conn, $arr_prepare);

    } else {
        // POST 처리
        
        // --------------------
        // parameter 획득
        // --------------------

        $id = isset($_POST["bkl_id"]) ? (int)$_POST["bkl_id"] : 0;
        $page = isset($_POST["page"]) ? (int)$_POST["page"] : 1;
        $title = isset($_POST["title"]) ? (string)$_POST["title"] : "";
        $bucket_content = isset($_POST["bucket_content"]) ? (string)$_POST["bucket_content"] : "";
        
        $country = isset($_POST["country"]) ? (string)$_POST["country"] : "";
        $sort = isset($_POST["sort"]) ? (string)$_POST["sort"] : "";
        $info_content = isset($_POST["info_content"]) ? (string)$_POST["info_content"] : "";
        $info_img = $_FILES["info_img_upload"];

        // var_dump($id);
        // var_dump($title);
        // var_dump($info_img);
        // exit;

        if($id < 1 || $title === "") {
            throw new Exception("파라미터 오류임");
        }

        // PDO Instance
        $conn = my_db_conn();

        // Transaction Start
        $conn->beginTransaction();

        $arr_prepare = [
            "bkl_id" => $id
            ,"title" => $title
            ,"bucket_content" => $bucket_content
            ,"country" => $country
            ,"sort" => $sort
            ,"info_content" => $info_content
        ];


        if($info_img["name"] !== "") {
            $arr_prepare["info_img"] =  my_save_img($_FILES["info_img_upload"]);
        }
        
        my_bucket_board_update($conn, $arr_prepare);


        // commit
        $conn->commit();
        
        header("Location: /bucket_detail.php?bkl_id=".$id."&page=".$page);
        exit; 
    }
    

} catch(Throwable $th) {
    if(!is_null($conn) && $conn->inTransaction()) {
        $conn->rollBack();
    }

    require_once(MY_PATH_ERROR);
    exit;
}





?>

<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/common.css">
    <link rel="stylesheet" href="./css/common_bucket.css">
    <title>Bucket List Update</title>
</head>
<body>
    <form action="/bucket_update.php" method="post" enctype="multipart/form-data">
        <header>
            <div class="head-title">
                <a href="/bucketlist.php"><h1>Travels<span>_버킷리스트 수정</span></h1></a>
            </div>
            <div class="btn-header">
                <button type="submit" class="btn-header-css">
                    <div class="svg-wrapper-1">
                        <div class="svg-wrapper">
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 24 24"
                            width="30"
                            height="30"
                            class="icon"
                        >
                            <path
                            d="M22,15.04C22,17.23 20.24,19 18.07,19H5.93C3.76,19 2,17.23 2,15.04C2,13.07 3.43,11.44 5.31,11.14C5.28,11 5.27,10.86 5.27,10.71C5.27,9.33 6.38,8.2 7.76,8.2C8.37,8.2 8.94,8.43 9.37,8.8C10.14,7.05 11.13,5.44 13.91,5.44C17.28,5.44 18.87,8.06 18.87,10.83C18.87,10.94 18.87,11.06 18.86,11.17C20.65,11.54 22,13.13 22,15.04Z"
                            ></path>
                        </svg>
                        </div>
                    </div>
                    <span>확인</span>
                </button>
                <a href="/bucket_detail.php?bkl_id=<?php echo $result["bkl_id"] ?>&page=<?php echo $page ?>">
                    <button type="button" class="btn-header-css">
                        <div class="svg-wrapper-1">
                            <div class="svg-wrapper">
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 24 24"
                                width="30"
                                height="30"
                                class="icon"
                            >
                                <path
                                d="M22,15.04C22,17.23 20.24,19 18.07,19H5.93C3.76,19 2,17.23 2,15.04C2,13.07 3.43,11.44 5.31,11.14C5.28,11 5.27,10.86 5.27,10.71C5.27,9.33 6.38,8.2 7.76,8.2C8.37,8.2 8.94,8.43 9.37,8.8C10.14,7.05 11.13,5.44 13.91,5.44C17.28,5.44 18.87,8.06 18.87,10.83C18.87,10.94 18.87,11.06 18.86,11.17C20.65,11.54 22,13.13 22,15.04Z"
                                ></path>
                            </svg>
                            </div>
                        </div>
                        <span>취소</span>
                    </button>
                </a>
            
            </div>
        </header>
        <input type="hidden" name="bkl_id" value="<?php echo $result["bkl_id"] ?>">
        <input type="hidden" name="page" value="<?php echo $page ?>">
        <main>
            <div class="bucket-board-grid">
                <div class="main-board">
                    <div class="main-title bucket-title-content">
                        <input type="text" name="title" required class="update-title" value="<?php echo $result["title"] ?>">
                        <div>
                            <textarea name="bucket_content" id="bucketlist" class="update-content"><?php echo $result["bucket_content"] ?></textarea>
                        </div>
                    </div>
                </div>
                <div class="bucket-right">
                    <div class="bucket-right-top">
                        <div class="bucket-right-align">
                            <label for="country" class="top-left">국가</label>
                            <input  name="country" id="country" class="top-right" value="<?php echo $result["country"] ?>" required>
                        </div>
                        <div class="bucket-right-align">
                            <div class="top-left">분류</div>
                            <div class="top-right">
                                <select name="sort" id="sort" class="top-right">
                                    <option value="관광" <?php echo $result["sort"] === "관광" ? "selected" : ""; ?>>관광</option>
                                    <option value="먹방" <?php echo $result["sort"] === "먹방" ? "selected" : ""; ?>>먹방</option>
                                    <option value="쇼핑" <?php echo $result["sort"] === "쇼핑" ? "selected" : ""; ?>>쇼핑</option>
                                    <option value="체험" <?php echo $result["sort"] === "체험" ? "selected" : ""; ?>>체험</option>
                                    <option value="기타" <?php echo $result["sort"] === "기타" ? "selected" : ""; ?>>기타</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="bucket-right-bottom">
                        <div class="main-title bottom-info">
                            <div>정보</div>
                        </div>
                        <div class="right-bottom-info">
                            <img src="<?php echo $result["info_img"] ?>" alt="" class="bottom-info-image" name="info_img">
                            <input type="file" id="photo" name="info_img_upload">
                            <textarea name="info_content" id="info_content" class="bottom-content" ><?php echo $result["info_content"] ?></textarea>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </form>
</body>
</html>