<?php

if (!isset($_GET['file'])){
    exit('需要传递文件名称');
}

if (empty($_GET['file'])){
    exit('请传递文件名称');
}

//获取远程文件地址
$path = './uploads/' . $_GET['file'];

if (!is_file($path) || !file_exists($path)){
    exit('文件不存在');
}

if (!is_readable($path)){
    exit('文件不可读');
}

//清空缓冲区
ob_clean();

//以 rb 模式打开文件
$fileHandle = fopen($path, rb);

if (!$fileHandle){
    exit('文件打开失败');
}

//通知浏览器
header('Content-type: application/octet-stream; charset=utf-8');
header('Content-Transfer-Encoding: binary');
header('Content-Length: ' . filesize($path));
header('Content-Disposition: attachment; filename="' . urlencode(basename($path)) . '"');

//读取并传输文件
while (!feof($fileHandle)){
    echo fread($fileHandle, 102400);
}

//关闭文档流
fclose($fileHandle);
