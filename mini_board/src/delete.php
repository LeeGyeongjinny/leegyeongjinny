<?php
require_once($_SERVER["DOCUMENT_ROOT"]."/config.php");
require_once(MY_PATH_DB_LIB);

$conn = null;

try {
    if(strtoupper($_SERVER["REQUEST_METHOD"]) === "GET") {
        // GET 처리

        // --------------------
        // parameter 획득
        // --------------------

        // id 획득
        $id = isset($_GET["id"]) ? (int)$_GET["id"] : 0;
        // page 획득
        $page = isset($_GET["page"]) ? (int)$_GET["page"] : 1;

        if($id < 1) {
            throw new Exception("파라미터 오류");
        }

        // PDO Instance
        $conn = my_db_conn();

        // 단순 조회만 해서 변화 없음 -> transaction 안해도됨
        // ------------------------
        // 데이터 조회
        // ------------------------
        $arr_prepare = [
            "id" => $id
        ];

        // 데이터 조회
        $result = my_board_select_id($conn, $arr_prepare);

    } else {
        // POST 처리
        
        // --------------------
        // parameter 획득
        // --------------------
        // id 획득
        $id = isset($_POST["id"]) ? (int)$_POST["id"] : 0;

        if($id < 1) {
            throw new Exception("파라미터 오류");
        }

        // PDO Instance
        $conn = my_db_conn();

        // Transaction Start
        $conn->beginTransaction();
        
        $arr_prepare = [
            "id" => $id
        ];

        // 삭제 처리
        my_board_delete_id($conn, $arr_prepare);
        // $result = my_board_delete_id($conn, $arr_prepare);

        $conn->commit();
        

        // 리스트 페이지로 이동
        header("Location: /main.php");
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
    <title>Travel Delete</title>
</head>
<body>
    <header>
        <div class="head-title">
            <a href="/main.php"><h1>Travels<span>_삭제</span></h1></a>
        </div>
        <div class="btn-header">
            <form action="/delete.php" method="post">
                <input type="hidden" name="id" value="<?php echo $result["id"]?>">
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
                
            </form>
        </div>
    </header>
    <main>
        <div class="main-board">
            <div class="main-title">
                <div class="title-content">
                    <p><?php echo $result["title"] ?></p>
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
                            <div class="main-board-info1">국가</div>
                            <div class="main-board-info2"><?php echo $result["country"] ?></div>
                        </div>
                        <div class="main-board-info">
                            <div class="main-board-info1">도시</div>
                            <div class="main-board-info2"><?php echo $result["city"] ?></div>
                        </div>
                        <div class="main-board-info">
                            <div class="main-board-info1">출발</div>
                            <div class="main-board-info2"><?php echo $result["departure"] ?></div>
                        </div>
                        <div class="main-board-info">
                            <div class="main-board-info1">도착</div>
                            <div class="main-board-info2"><?php echo $result["arrival"] ?></div>
                        </div>
                        <div class="main-board-info">
                            <div class="main-board-info1">동행</div>
                            <div class="main-board-info2"><?php echo $result["companion"] ?></div>
                        </div>
                        <div class="main-board-info">
                            <div class="main-board-info1 created-date">작성일</div>
                            <div class="main-board-info2 created-date"><?php echo $result["created_at"] ?></div>
                        </div>
                    </div>

                    <div>
                        <div class="main-content-title">내용</div>
                        <div>
                            <textarea readonly class="main-content"><?php echo $result["content"] ?></textarea>
                        </div>
                    </div>
                    <div class="main-board-right">
                        <div>
                            <div class="main-board-photo-title">사진</div>
                            <div class="main-board-photo">
                                <?php if(!is_null($result["img_1"])){ ?>
                                    <img src="<?php echo $result["img_1"] ?>" alt="" class="info-image">
                                <?php } else { ?>
                                <img src="/img/no_image_available.png" alt="" class="info-image">
                                <?php } ?>
                            </div>
                        </div>
                        <div>
                            <div class="main-board-photo-title">사진</div>
                            <div class="main-board-photo">
                                <?php if(!is_null($result["img_2"])){ ?>
                                    <img src="<?php echo $result["img_2"] ?>" alt="" class="info-image">
                                <?php } else { ?>
                                <img src="/img/no_image_available.png" alt="" class="info-image">
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</body>