<?php
require_once($_SERVER["DOCUMENT_ROOT"]."/config.php");
require_once(MY_PATH_DB_LIB);

$conn = null;

try {
    $conn = my_db_conn();

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
    <link rel="stylesheet" href="./css/loginok.css">
    <title>Travel board</title>
</head>
<body>
    <div class="container">
        <h1>Travels</h1>        
        <nav role="navigation">
            <div class="menuToggle">
                <input type="checkbox" />
                <span></span>
                <span></span>
                <span></span>
                <ul class="menu">
                    <a href="/main.php"><li>기록</li></a>
                    <a href="/bucketlist.php"><li>버킷리스트</li></a>
                    <!-- <a href="/login.php"><li>로그인</li></a> -->
                </ul>
            </div>
        </nav>
    </div>
    
</body>
</html>