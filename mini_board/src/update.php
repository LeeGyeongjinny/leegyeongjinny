<?php
require_once($_SERVER["DOCUMENT_ROOT"]."/config.php");
require_once(MY_PATH_DB_LIB);
require_once(MY_PATH_COMMON_FNC);

$conn = null;

try {
    if(strtoupper($_SERVER["REQUEST_METHOD"]) === "GET") {
        // GET 처리
        
        $id = isset($_GET["id"]) ? (int)$_GET["id"] : 0;
        
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
            "id" => $id
        ];

        $result = my_board_select_id($conn, $arr_prepare);

    } else {
        // POST 처리
        
        // --------------------
        // parameter 획득
        // --------------------

        $id = isset($_POST["id"]) ? (int)$_POST["id"] : 0;
        $page = isset($_POST["page"]) ? (int)$_POST["page"] : 1;
        $title = isset($_POST["title"]) ? (string)$_POST["title"] : "";
        $content = isset($_POST["content"]) ? (string)$_POST["content"] : "";
        $country = isset($_POST["country"]) ? (string)$_POST["country"] : "";
        $city = isset($_POST["city"]) ? (string)$_POST["city"] : "";
        $departure = isset($_POST["departure"]) ? $_POST["departure"] : "";
        $arrival = isset($_POST["arrival"]) ? $_POST["arrival"] : "";
        $companion = isset($_POST["companion"]) ? (string)$_POST["companion"] : "";
        $img_1 = $_FILES["upload_file1"];
        $img_2 = $_FILES["upload_file2"];


        if($id < 1 || $title === "") {
            throw new Exception("파라미터 오류임");
        }

        // PDO Instance
        $conn = my_db_conn();

        // Transaction Start
        $conn->beginTransaction();

        $arr_prepare = [
            "id" => $id
            ,"title" => $title
            ,"content" => $content
            ,"country" => $country
            ,"city" => $city
            ,"departure" => $departure
            ,"arrival" => $arrival
            ,"companion" => $companion
        ];

        if($img_1["name"] !== "" ) {
            $arr_prepare["img_1"] = my_save_img($_FILES["upload_file1"]);
        }
        
        if($img_2["name"] !== "" ) {
            $arr_prepare["img_2"] = my_save_img($_FILES["upload_file2"]);
        }
        
        my_board_update($conn, $arr_prepare);

        // commit
        $conn->commit();
        
        header("Location: /detail.php?id=".$id."&page=".$page);
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
    <link rel="stylesheet" href="./css/common_main.css">
    <title>Travel Update</title>
</head>
<body>
    <form action="/update.php" method="post" enctype="multipart/form-data">
        <header>
            <div class="head-title">
                <a href="/main.php"><h1>Travels<span>_수정</span></h1></a>
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
                <a href="/detail.php?id=<?php echo $result["id"] ?>&page=<?php echo $page ?>">
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
        <main>
            <input type="hidden" name="id" value="<?php echo $result["id"] ?>">
            <input type="hidden" name="page" value="<?php echo $page ?>">
            <div class="main-board">
                <div class="main-title">
                    <div class="title-content">
                        <input type="text" name="title" maxlength="20" value="<?php echo $result["title"] ?>">
                    </div>
                </div>
                <div class="main-box">
                    <div class="main-board-grid">
                        <div class="main-board-left">
                            <div class="main-board-info">
                                <div class="main-board-info1">게시번호</div>
                                <div class="main-board-info2"><?php echo $result["id"] ?></div>
                            </div>
                            <div class="main-board-info">
                                <label for="country" class="main-board-info1">국가</label>
                                <input name="country" id="country" class="main-board-info2" maxlength="10" value="<?php echo $result["country"] ?>" required>
                            </div>
                            <div class="main-board-info">
                                <label for="city" class="main-board-info1">도시</label>
                                <input name="city" id="city" class="main-board-info2" maxlength="10" value="<?php echo $result["city"] ?>" required>
                            </div>
                            <div class="main-board-info">
                                <label for="departure" class="main-board-info1">출발</label>
                                <input type="date" name="departure" id="departure" max="2077-06-20" min="1995-10-21" value="<?php echo $result["departure"] ?>" class="main-board-info2">
                            </div>
                            <div class="main-board-info">
                                <label for="arrival" class="main-board-info1">도착</label>
                                <input type="date" name="arrival" id="arrival" max="2077-06-20" min="1995-10-21" value="<?php echo $result["arrival"] ?>" class="main-board-info2">
                            </div>
                            <div class="main-board-info">
                                <div class="main-board-info1">동행</div>
                                <input class="main-board-info2" name="companion" value="<?php echo $result["companion"] ?>">
                            </div>
                            <div class="main-board-info">
                                <div class="main-board-info1 created-date">작성일</div>
                                <div class="main-board-info2 created-date" name="created_at"><?php echo $result["created_at"] ?></div>
                            </div>
                        </div>
                        <div>
                            <div class="main-content-title">내용</div>
                            <div>
                                <textarea class="main-content" name="content"><?php echo $result["content"] ?></textarea>
                            </div>
                        </div>
                        <div class="main-board-right">
                            <div>
                                <div class="main-board-photo-title">사진</div>
                                <div class="main-board-photo">
                                    <img src="<?php echo $result["img_1"] ?>" alt="" class="info-image"  name="img_1">
                                    <input type="file" id="photo1" name="upload_file1">
                                </div>
                            </div>
                            <div>
                                <div class="main-board-photo-title">사진</div>
                                <div class="main-board-photo">
                                    <img src="<?php echo $result["img_2"] ?>" alt="" class="info-image"  name="img_2">
                                    <input type="file" id="photo2" name="upload_file2">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </form>
</body>
</html>