<?php


function my_save_img($file) {
    if($file["name"] === "") {
        $result_path = null;
    } else {
        $file_type = $file["type"];
        // type "image/webp" 가져옴
        $file_type_arr = explode("/", $file_type);
        // type을 explode써서 배열로 가져옴 (/기준으로 방 나뉨)
        $extension = $file_type_arr[1];
        // 배열중에 1번방 -> 확장자명
        $file_name = uniqid().".".$extension;
        // unique한 배열 랜덤으로 가져옴.확장자명
        $file_path = "img/".$file_name;
        
        move_uploaded_file($file["tmp_name"], MY_PATH_ROOT.$file_path);

        $result_path = "/".$file_path;
    }

    return $result_path;
}