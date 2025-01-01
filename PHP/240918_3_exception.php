<?php
try {
    echo "try문 시작\n";
    5/0;
    echo "try문 끝\n";
} catch(Throwable $th) {
    echo "catch 예외발생\n";
} finally {
    echo "어렵고만\n";
}
