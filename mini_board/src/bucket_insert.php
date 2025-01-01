<?php
require_once($_SERVER["DOCUMENT_ROOT"]."/config.php");
require_once(MY_PATH_DB_LIB);
require_once(MY_PATH_COMMON_FNC);

$conn = null;

// function my_save_img($file) {
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



if(strtoupper($_SERVER["REQUEST_METHOD"]) === "POST") {
    
    try {
        $conn = my_db_conn();
        
        // my_save_img($conn, $file);

        $file_path = my_save_img($_FILES["info_img"]);

        $arr_prepare = [
            "title" => $_POST["title"]
            ,"bucket_content" => $_POST["bucket_content"]
            ,"country" => $_POST["country"]
            ,"sort" => $_POST["sort"]
            ,"info_content" => $_POST["info_content"]
            ,"info_img" => $file_path
        ];

        // if($_FILES["info_content"] === "") {
        //     $arr_prepare["info_content"] = null;
        // }

        // if($_FILES["info_img"] === "") {
        //     $arr_prepare["info_img"] = null;
        // }

        $conn->beginTransaction();
        my_bucket_board_insert($conn, $arr_prepare);
        
        $conn->commit();

        header("Location: /bucketlist.php");
        exit;

    } catch(Throwable$th) {
        if(!is_null($conn)) {
            $conn->rollBack();
        }
        require_once(MY_PATH_ROOT."error.php");
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
    <link rel="stylesheet" href="./css/common_bucket.css">
    <title>Bucket List Insert</title>
</head>
<body>
    <form action="/bucket_insert.php"  method="post" enctype="multipart/form-data" name="fileUpload">
        <header>
            <div class="head-title">
                <a href="/bucketlist.php"><h1>Travels<span>_버킷리스트 작성</span></h1></a>
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
                    <span>작성</span>
                </button>
                <a href="/bucketlist.php">
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
            <div class="bucket-board-grid">
                <div class="main-board">
                    <div class="main-title bucket-title-content">
                        <input type="text" placeholder="제목" maxlength="20" name="title" required>
                    </div>
                    <div>
                        <textarea id="bucket_content" placeholder="내용" class="insert-content" placeholder="내용"  name="bucket_content" required></textarea>
                    </div>
                </div>
                <div class="bucket-right">
                    <div class="bucket-right-top">
                        <div class="bucket-right-align">
                            <label for="country" class="top-left">국가</label>
                            <input  name="country" id="country" class="top-right" required>
                        </div>
                        <div class="bucket-right-align">
                            <label for="sort" class="top-left">분류</label>
                            <select name="sort" id="sort" class="top-right">
                                <option value="관광">관광</option>
                                <option value="먹방">먹방</option>
                                <option value="쇼핑">쇼핑</option>
                                <option value="체험">체험</option>
                                <option value="기타">기타</option>
                            </select>
                        </div>
                    </div>
                    <!-- <div class="right-bottom"> -->
                    <div class="bucket-right-bottom">
                        <div class="main-title bottom-info">
                            <p>정보</p>
                        </div>
                        <div class="right-bottom-info">
                            <input type="file" id="info_img" name="info_img" class="bottom-info-image">
                            <div>
                                <textarea name="info_content" id="info_content" class="bottom-content"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </form>
</body>
</html>