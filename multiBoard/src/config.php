<?php

// 경로
define('_ROOT', $_SERVER['DOCUMENT_ROOT']);
define('_PATH_VIEW', _ROOT.'/View');
define('_PATH_IMG', '/View/img');

// MariaDB
define('_MARIA_DB_HOST', 'localhost');
define('_MARIA_DB_PORT', '3306');
define('_MARIA_DB_USER', 'root');
define('_MARIA_DB_PASSWORD', 'php504');
define('_MARIA_DB_NAME', 'mini_multi_board');
define('_MARIA_DB_CHARSET', 'utf8mb4');
define('_MARIA_DB_DNS',
  'mysql:host='._MARIA_DB_HOST
  .';port='._MARIA_DB_PORT
  .';dbname='._MARIA_DB_NAME
  .';charset='._MARIA_DB_CHARSET
);