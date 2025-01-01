<?php
require_once($_SERVER["DOCUMENT_ROOT"]."/config.php");
require_once(MY_PATH_DB_LIB);
require_once(MY_PATH_COMMON_FNC);

$conn = null;

try {
    if(strtoupper($_SERVER["REQUEST_METHOD"]) === "GET") {

        $id = isset($_GET["bkl_id"]) ? (int)$_GET["bkl_id"] : 0;

        $page = isset($_GET["page"]) ? (int)$_GET["page"] : 1;

        
        if($id < 1) {
            throw new Exception("파라미터 오류");
        }

        // PDO Instance
        $conn = my_db_conn();

        $arr_prepare = [
            "bkl_id" => $id
        ];

        $result = my_bucket_board_select_id($conn, $arr_prepare);

    } else {
        // POST 처리

        $id = isset($_POST["bkl_id"]) ? (int)$_POST["bkl_id"] : 0;

        if($id < 1) {
            throw new Exception("파라미터 오류");
        }

        // PDO Instance
        $conn = my_db_conn();

        // Transaction Start
        $conn->beginTransaction();
        
        $arr_prepare = [
            "bkl_id" => $id
        ];

        // 삭제 처리
        my_bucket_board_delete_id($conn, $arr_prepare);
        // $result = my_board_delete_id($conn, $arr_prepare);

        $conn->commit();
        

        // 리스트 페이지로 이동
        header("Location: /bucketlist.php");
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
    <title>Bucket List Delete</title>
</head>
<body>
    <header>
        <div class="head-title">
            <a href="/bucketlist.php"><h1>Travels<span>_버킷리스트 삭제</span></h1></a>
        </div>
        <div class="btn-header">
            <form action="/bucket_delete.php" method="post">
                <input type="hidden" name="bkl_id" value="<?php echo $result["bkl_id"]?>">
                <div class="head-flex">
                    <div class="btn-flex">
                        <button type="submit" class="btn-header-css btn-del-chk">
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
                        <p>진짜 삭제?</p>
                    </div>
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
            </form>
        </div>
    </header>
    <main>
        <div class="bucket-board-grid">
            <div class="main-board">
                <div class="main-title bucket-title-content">
                    <p><?php echo $result["title"] ?></p>
                </div>
                <div>
                    <textarea readonly name="bucketlist" id="bucketlist"  class="delete-content"><?php echo $result["bucket_content"] ?></textarea>
                </div>
            </div>
            <div class="bucket-right">
                <div class="bucket-right-top">
                    <div class="bucket-right-align">
                        <label for="country" class="top-left">국가</label>
                        <div name="country" id="country" class="top-right"><?php echo $result["country"] ?></div>
                    </div>
                    <div class="bucket-right-align">
                        <div class="top-left">분류</div>
                        <div class="top-right">
                            <div name="sort" id="sort" class="top-right">
                                <?php echo $result["sort"] ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="bucket-right-bottom">
                    <div class="main-title bottom-info">
                        <div>정보</div>
                    </div>
                    <div class="right-bottom-info">
                        <div>
                            <?php if(!is_null($result["info_img"])){ ?>
                                <img src="<?php echo $result["info_img"] ?>" alt="" class="bottom-info-image">
                            <?php } else { ?>
                            <img src="/img/no_image_available.png" alt="" class="bottom-info-image">
                            <?php } ?>
                        </div>
                        <textarea readonly name="botton-content-info" id="botton-content-info" class="bottom-content"><?php echo $result["info_content"] ?></textarea>
                    </div>
                </div>
            </div>
        </div>
    </main>
</body>
</html>