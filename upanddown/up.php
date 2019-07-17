<?php
$file = $_FILES;

if ($file['headimg']['error'] === 0){
    $extName = pathinfo($file['headimg']['name'], PATHINFO_EXTENSION);
    $path = './uploads/liulijie.jpg';  //上传保存同名文件，服务器会覆盖保存
    $res = move_uploaded_file($file['headimg']['tmp_name'], $path);
    if ($res){
        echo "上传成功";
    }
}

var_dump($extName);

