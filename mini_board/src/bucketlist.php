<?php
require_once($_SERVER["DOCUMENT_ROOT"]."/config.php");
require_once(MY_PATH_DB_LIB);

$conn = null;
$max_board_count = 0;
$max_page = 0;

try {
    $conn = my_db_conn();

    // ----------------------------------
    // MAX page 획득 처리
    // ----------------------------------
    $max_board_count = my_bucket_board_total_count($conn);
    $max_page = (int)ceil($max_board_count / MY_LIST_COUNT_BUCKET);

    // ----------------------------------
    // pagination 설정 처리
    // ----------------------------------
    $page = isset($_GET["page"]) ? (int)$_GET["page"] : 1; // 현재 페이지 획득
    $offset = ($page - 1) * MY_LIST_COUNT_BUCKET; // 오프셋 설정

    $start_page_button_number = (int)(floor((($page - 1) / MY_PAGE_BUTTON_COUNT)) * MY_PAGE_BUTTON_COUNT) + 1 ; // 화면 표시 페이지 버튼 시작값
    $end_page_button_number = $start_page_button_number + (MY_PAGE_BUTTON_COUNT - 1); // 화면 표시 페이지 버튼 마지막값

    $end_page_button_number = $end_page_button_number > $max_page ? $max_page : $end_page_button_number;
    $prev_page_button_number = $start_page_button_number - 1 < 1? 1 : $start_page_button_number - 1; // 이전 버튼
    $next_page_button_number = $start_page_button_number + 5 > $max_page? $max_page : $start_page_button_number + 5; // 다음 버튼


    $arr_prepare = [
        "list_cnt" => MY_LIST_COUNT_BUCKET
        ,"offset" => $offset
    ];

    $result = my_bucket_board_select_pagination($conn, $arr_prepare);


} catch(Throwable$th) {
    require_once(MY_PATH_ROOT."error.php");
    exit;
}



?>


<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/common.css">
    <link rel="stylesheet" href="./css/bucketlist.css">
    <title>Travel Bucket List</title>
</head>
<body>
    <header>
        <div class="head-title">
            <a href="/loginok.php"><h1>Travels<span>_버킷리스트</span></h1></a>
        </div>
        <div class="btn-header">
            <a href="/index.php">
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
                    <span>홈</span>
                </button>
            </a>
            <a href="/bucket_insert.php">
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
                    <span>+</span>
                </button>
            </a>
        </div>
    </header>
    <main>
        <div class="bucket-board">            
            <?php foreach($result as $item) { ?>
            <a href="/bucket_detail.php?bkl_id=<?php echo $item["bkl_id"] ?>" class="bucket-mini">
                <div class="main-title bucket-main-title">
                    <div><?php echo $item["title"] ?></div>
                </div>
                <div class="main-box bucket-main-content">
                    <div>
                        <span><?php echo $item["country"] ?></span>
                        <span><?php echo $item["sort"] ?></span>
                    </div>
                    <div><?php echo $item["bucket_content"] ?></div>
                </div>
            </a>
            <?php } ?>
        </div>
        <div class="main-footer">
            <?php if($page > 5) {?>
                <a href="/bucketlist.php?page=<?php echo $prev_page_button_number ?>"><button class="btn-footer"><</button></a>
            <?php }?>

            <?php for($i = $start_page_button_number; $i <= $end_page_button_number; $i++) {?>
            <a href="/bucketlist.php?page=<?php echo $i ?>"><button class="btn-footer <?php echo $page ===  $i ? "btn-selected" : "" ?>"><?php echo $i ?></button></a>
            <?php }?>
            <?php if($start_page_button_number + 5 < $max_page) {?>
                <a href="/bucketlist.php?page=<?php echo $next_page_button_number ?>"><button class="btn-footer">></button></a>
            <?php }?>
        </div>
    </main>
</body>
</html>