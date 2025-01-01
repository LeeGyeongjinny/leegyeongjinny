<?php
require_once($_SERVER["DOCUMENT_ROOT"]."/config.php");
require_once(MY_PATH_DB_LIB);

?>

<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/common.css">
    <title>에러 페이지</title>
</head>
<body>
    <header>
        <div class="head-title">
            <a href="/"><h1>Travels<span>_에러</span></h1></a>
        </div>
        <div class="btn-header">
            <a href="/"><button class="btn-top">홈</button></a>
        </div>
    </header>
    <main>
        <p>에러가 발생했습니다.</p>
        <p>메인 페이지로 되돌아가서 다시 실행해주세요.</p>
        <p><?php echo $th->getMessage() ?></p>
        <a href="/"><button type="button" class="btn-error">메인 페이지로</button></a>
    </main>
</body>
</html>