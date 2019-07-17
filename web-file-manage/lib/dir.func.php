<?php
/*
 * 读取目录
 * @method read_directory
 * @param string        $path 文件目录
 * @return mixed        false | array
 * */
function read_directory(string $path)
{
    if (!is_dir($path)) {
        return false;
    }
    $info = [];
    $result = [];
    //打开目录
    $handel = opendir($path);
    //读取
    while (($item = @readdir($handel)) !== false) {
        if ($item != '.' && $item != '..') {
            $pathName = $path . DIRECTORY_SEPARATOR . $item;
            $info['fileName'] = $pathName;
            $info['showName'] = $item;
            $info['readable'] = is_readable($pathName) ? true : false;
            $info['writable'] = is_writable($pathName) ? true : false;
            $info['executable'] = is_executable($pathName) ? true : false;
            $info['atime'] = date('Y-m-d H:i:s', fileatime($pathName));
            if (is_file($pathName)) {
                $result['file'][] = $info;
            }
            if (is_dir($pathName)) {
                $result['dir'][] = $info;
            }
        }
    }
    closedir($handel);
    return $result;
}

/*
 * 创建目录
 * @method create_dir
 * @param string    $path 目录名称
 * @return mixed    true | string
 * */
function create_dir(string $path)
{
    if (is_dir($path)) {
        return '当前目录已存在';
    }
    if (!mkdir($path, 7555, true)) {
        return '目录创建失败';
    }
    return true;
}

/*
 * 重命名目录
 * @method rename_dir
 * @param string    $oldName 原目录名称
 * @param string    $newName 新目录名称
 * @return mixed    true | string
 * */
function rename_dir(string $oldName, string $newName)
{
    if (!is_dir($oldName)) {
        return '原目录不存在';
    }
    if (is_dir($newName)) {
        return '当前目录下已经存在该目录名称';
    }
    if (!rename($oldName, $newName)) {
        return '目录重命名失败';
    }
    return true;
}

/*
 * 剪切（移动）目录
 * @method cut_dir
 * @param string    $src 要剪切的目录名称
 * @param string    $dest 剪切目标新目录名称
 * @return mixed    true | string
 * */
function cut_dir(string $src, string $dst)
{
    if (!is_dir($src)) {
        return '要剪切的目录不存在';
    }
    if (!is_dir($dst)) {
        mkdir($dst, 755, true);
    }
    $dest = $dst . DIRECTORY_SEPARATOR . basename($src);
    if (is_dir($dest)) {
        return '剪切目标文件夹下已经存在该目录';
    }
    if (!rename($src, $dest)) {
        return '目录剪切失败';
    }
    return true;
}

/*
 * 复制目录
 * @method copy_dir
 * @param string    $src 要复制的目录名称
 * @param string    $dest 复制目标目录名称
 * @return mixed    true | string
 * */
function copy_dir(string $src, string $dst)
{
    if (!is_dir($src)) {
        return '要复制的目录不存在';
    }
    $dest = $dst . DIRECTORY_SEPARATOR . basename($src);
    if (!is_dir($dest)) {
        mkdir($dest, 755, true);
    }
    //打开$src, 逐一拷贝文件
    $handle = opendir($src);
    //读取并拷贝
    while (($item = @readdir($handle)) !== false) {
        if ($item != '.' && $item != '..'){
            $srcName = $src .DIRECTORY_SEPARATOR . $item;
            if (is_file($srcName)){
                copy($srcName, $dest . DIRECTORY_SEPARATOR . $item);
            }
            if (is_dir($srcName)){
                $func = __FUNCTION__;
                $func($srcName, $dest . DIRECTORY_SEPARATOR . $item);
            }
        }
    }
    closedir($handle);
    return true;
}

/*
 * 删除目录
 * @method del_dir
 * @param string    $path 要删除的目录名称
 * @return mixed    true | string
 * */
function del_dir(string $path)
{
    if (!is_dir($path)) {
        return '要删除的目录不存在';
    }
    //如果文件不为空，则需删除内部文件
    //打开目录
    $handle = opendir($path);
    while (($item = @readdir($handle)) !== false) {
        if ($item != '.' && $item != '..') {
            $pathName = $path . DIRECTORY_SEPARATOR . $item;
            if (is_file($pathName)) {
                @unlink($pathName);
            } else {
                $func = __FUNCTION__;
                $func($pathName);
            }
        }
    }
    closedir($handle);
    if (!rmdir($path)) {
        return '目录删除失败';
    }
    return true;
}








