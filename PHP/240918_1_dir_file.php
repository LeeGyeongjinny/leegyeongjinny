<?php
// mkdir("./my_dir");
// $mkdir_result = mkdir("./my_dir");
// if($mkdir_result) {
//     // 성공
// } else {
//     // 실패
// }

// $chk_result = is_dir("./my_dir");
// if($chk_result) {
//     echo "있다";
// } else {
//     echo "없다";
// }

$open_result = opendir("./my_dir");
while($file = readdir($open_result)) {
    echo $file."\n";
}

closedir($open_result);

// closedir($mkdir_result);
// rmdir("./my_dir");