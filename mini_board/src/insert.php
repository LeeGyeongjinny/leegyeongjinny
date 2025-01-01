<?php
require_once($_SERVER["DOCUMENT_ROOT"]."/config.php");
require_once(MY_PATH_DB_LIB);
require_once(MY_PATH_COMMON_FNC);

$conn = null;

// post 처리
if(strtoupper($_SERVER["REQUEST_METHOD"]) === "POST") {
    try{
        // PDO Instance
        $conn = my_db_conn();

        // $file = $_FILES["upload_file1"];
        // $file2 = $_FILES["upload_file2"];
        
        // $file_type = $file["type"];
        // $file_type_arr = explode("/", $file_type);
        // $extension = $file_type_arr[1];
        // $file_name = uniqid().".".$extension;
        // $file_path = "img/".$file_name;
        
        // move_uploaded_file($_FILES["tmp_name"], MY_PATH_ROOT.$file_path);

        
        $file_path_1 = my_save_img($_FILES["upload_file1"]);
        $file_path_2 = my_save_img($_FILES["upload_file2"]);


        // insert 처리
        $arr_prepare = [
            "country" => $_POST["country"]
            ,"city" => $_POST["city"]
            ,"departure" => $_POST["departure"]
            ,"arrival" => $_POST["arrival"]
            ,"companion" => $_POST["companion"]
            ,"title" => $_POST["title"]
            ,"content" => $_POST["content"]
            ,"img_1" => $file_path_1
            ,"img_2" => $file_path_2
        ];

        if($_POST["companion"] === "") {
            $arr_prepare["companion"] = null;
        }

        // begin transaction
        $conn->beginTransaction();
        my_board_insert($conn, $arr_prepare);
        
        $conn->commit();      

        header("Location: /main.php");
        exit;

    }catch(Throwable $th) {
        if(!is_null($conn)) {
            $conn->rollBack();
        }
        require_once(MY_PATH_ERROR);
        exit;
    }
}


?>




<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/common.css">
    <link rel="stylesheet" href="./css/common_main.css">
    <link rel="stylesheet" href="./css/insert.css">
    <title>Travel Insert</title>
</head>
<body>
    <form action="/insert.php" method="post" enctype="multipart/form-data" name="fileUpload">
        <header>
            <div class="head-title">
                <a href="/main.php"><h1>Travels<span>_작성</span></h1></a>
            </div>
            <!-- <button type="submit" class="btn-top" value="upload" name="upload">작성</button> -->
            <!-- <div class="btn-header">
                <button type="submit" class="btn-top">작성</button>
                <a href="/main.php"><button type="button" class="btn-top">취소</button></a>
            </div> -->
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
                    <span>작성</span>
                </button>
                    <!-- <button type="button" class="btn-top">작성</button> -->
                    <!-- <button type="submit" class="btn-top" value="upload" name="upload">작성</button> -->
                <a href="/main.php">
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
            <div class="main-board">
                <div class="main-title">
                    <div class="title-content">
                        <input type="text" placeholder="제목" name="title" maxlength="20" required>
                    </div>
                </div>
                <div class="main-box">
                    <div class="main-board-grid">
                        <div class="main-board-left">
                            <div class="main-board-info">
                                <label for="country" class="main-board-info1">국가</label>
                                <input type="text" name="country" id="country" maxlength="10" class="main-board-info2" required>
                            </div>
                            <div class="main-board-info">
                                <label for="city" class="main-board-info1">도시</label>
                                <input type="text" name="city" id="city" maxlength="10" class="main-board-info2" required>
                            </div>
                            <div class="main-board-info">
                                <label for="departure" class="main-board-info1">출발</label>
                                <input  type="date" id="departure" max="2077-06-20" min="1995-10-21" class="main-board-info2" name="departure" >
                            </div>
                            <div class="main-board-info">
                                <label for="arrival" class="main-board-info1">도착</label>
                                <input  type="date" id="arrival" max="2077-06-20" min="1995-10-21" class="main-board-info2" name="arrival">
                            </div>
                            <div class="main-board-info">
                                <label for="companion" class="main-board-info1">동행</label>
                                <input name="companion" id="companion" maxlength="10" class="main-board-info2" name="companion">
                            </div>
                            <div class="main-board-info">
                                <label for="photo1" class="main-board-info1">사진</label>
                                <input type="file" id="photo1" name="upload_file1" class="main-board-info2">
                            </div>
                            <div  class="main-board-info">
                                <label for="photo2" class="main-board-info1">사진</label>
                                <input type="file" id="photo2" name="upload_file2" class="main-board-info2">
                            </div>
                        </div>
                        <div class="insert-content-box">
                            <div class="insert-content-title">내용</div>
                            <div>
                                <textarea  class="insert-content" placeholder="내용" name="content" required></textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </form>
</body>
</html>