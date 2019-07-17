<?php
/*
 * 0 - 无错误
 * 1 - 文件大小超出了php.ini中的upload_max_filesize的大小
 * 2 - 超出表单中MAX_FILE_SIZE的大小
 * 3 - 部分文件被上传
 * 4 - 没有文件被上传
 * 6 - 临时目录不存在
 * 7 - 磁盘写入失败
 * 8 - 文件上传被php扩展阻止
 * */
//图片提交表当名
$key = 'headimg';
//判断是否有文件上传
if (!isset($_FILES[$key])){
    return false;
}

//接受$_FILES数组
$name = $_FILES[$key]['name']; //源文件名称
$type = $_FILES[$key]['type']; //MIME 类型
$tmp_name = $_FILES[$key]['tmp_name']; //临时文件名
$error = $_FILES[$key]['error']; //错误代码
$size = $_FILES[$key]['size']; //文件大小  字节

$mimeList = ['image/jpg', 'image/jpeg', 'image/png', 'image/gif'];
$extList = ['jpeg', 'jpg', 'png', 'gif'];
$maxSize = 1024000;

//处理错误
if ($error > UPLOAD_ERR_OK) {
    switch ($error) {
        //0 - 无错误
        //1 - 文件大小超出了php.ini中的upload_max_filesize的大小
        case UPLOAD_ERR_INI_SIZE:
            exit('文件大小超出了php.ini中的upload_max_filesize的大小');
        //2 - 超出表单中MAX_FILE_SIZE的大小
        case UPLOAD_ERR_FORM_SIZE:
            exit('超出表单中MAX_FILE_SIZE的大小');
        //3 - 部分文件被上传
        case UPLOAD_ERR_PARTIAL:
            exit('部分文件被上传');
        //4 - 没有文件被上传
        case UPLOAD_ERR_NO_FILE:
            exit('没有文件被上传');
        //6 - 临时目录不存在
        case UPLOAD_ERR_NO_TMP_DIR:
            exit('临时目录不存在');
        //7 - 磁盘写入失败
        case UPLOAD_ERR_CANT_WRITE:
            exit('磁盘写入失败');
        //8 - 文件上传被php扩展阻止
        case UPLOAD_ERR_EXTENSION:
            exit('文件上传被php扩展阻止');
        default:
            exit('未知错误');
    }
}

//限制文件的MIME
if (!in_array($type, $mimeList)) {
    exit('当前上传的文件类型' . $type . '不被允许');
}

//限制文件的扩展名
$ext = pathinfo($name, PATHINFO_EXTENSION);
if (!in_array($ext, $extList)){
    exit('当前上传的文件扩展名' . $ext . '不被允许');
}

//限制文件的大小
if ($size > $maxSize){
    exit('当前上传的文件大小超出限定大小' . $maxSize);
}

//生成新的随机文件名称
$newFileName = uniqid() . '.' . $ext;

//文件上传的目录
$path = './uploads/' . date('Ymd');
if (!is_dir($path)){
    mkdir($path, 0777, true);
}

//移动临时文件到指定目录当中并重新命名
$newfile = $path . '/' .$newFileName;
if (is_uploaded_file($tmp_name) && move_uploaded_file($tmp_name, $newfile)){
    exit('恭喜，文件上传成功！');
}else{
    exit('抱歉，文件上传失败！');
}

