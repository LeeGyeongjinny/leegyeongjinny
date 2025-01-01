<?php

// ** MariaDB 설정 **
define("MY_MARIADB_HOST", "localhost");
define("MY_MARIADB_PORT", "3306");
define("MY_MARIADB_USER", "root");
define("MY_MARIADB_PASSWORD", "php504");
define("MY_MARIADB_NAME", "travels");
define("MY_MARIADB_CHARSET", "utf8mb4");
define("MY_MARIADB_DSN", "mysql:host=".MY_MARIADB_HOST.";port=".MY_MARIADB_PORT.";dbname=".MY_MARIADB_NAME.";charset=".MY_MARIADB_CHARSET);

// ** PHP Path관련 설정 **
define("MY_PATH_ROOT", $_SERVER["DOCUMENT_ROOT"]."/"); // 웹서버 document root (지금은 C:\Apache24\htdocs)
define("MY_PATH_DB_LIB", MY_PATH_ROOT."lib/db_lib.php"); // DB 라이브러리 path
// MY_PATH_ROOT = C:\Apache24\htdocs
// MY_PATH_DB_LIB = C:\Apache24\htdocs\lib\db_lib.php 이 경로를 가짐
define("MY_PATH_ERROR", MY_PATH_ROOT."error.php"); // 에러 페이지
define("MY_PATH_COMMON_FNC", MY_PATH_ROOT."lib/common_fnc.php"); // 에러 페이지

// ** 로직 관련 설정 **
define("MY_LIST_COUNT", 5);
define("MY_LIST_COUNT_BUCKET", 6);
define("MY_PAGE_BUTTON_COUNT", 5);