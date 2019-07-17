<?php

/*
 * 检测目录是否为空
 * @method  check_empty_dir
 * @param   string                  $path 目录名
 * @return  boolean                 falise | true
 * */
function check_empty_dir(string $path)
{
    //判断是否为目录
    if (!is_dir($path)) {
        return false;
    }
    //打开目录
    $handle = opendir($path);
    //读取
    while (($item = @readdir($handle)) !== false) {
        if ($item != '.' && $item != '..') {
            return false;
        }
    }
    return true;
    //关闭
    closedir($handle);
}


/*
 * 读取目录内容
 * @method  read_directory_no_back
 * @param   string                          $path  目录名
 * @return  void                            直接输出目录聂荣
 * */

function read_directory_no_back(string $path)
{
    if (!is_dir($path)) {
        return false;
    }
    //打开目录
    $handle = opendir($path);
    //读取
    while (($item = @readdir($handle)) !== false) {
        if ($item != '.' && $item != '..') {
            $pathfile = $path . DIRECTORY_SEPARATOR . $item;
            if (is_dir($path)) {
                echo '目录：', $item, '<br />';
                $func = __FUNCTION__;
                $func($pathfile);
            } else {
                echo '文件：', $item, '<br />';
            }
        }
    }

    closedir($handle);
}

/*
 * 遍历目录内容并返回数组
 * @method  read_directory_back_arr
 * @param   string                                $path 目录名
 * @return  array                                 $array 数组
 * */

function read_directory_back_arr(string $path)
{
    if (!is_dir($path)) {
        return false;
    }
    //打开路径
    $handle = opendir($path);
    //读取
    while (($item = @readdir($handle)) !== false) {
        if ($item != '.' && $item != '..') {
            $pathfile = $path . DIRECTORY_SEPARATOR . $item;
            if (is_dir($pathfile)) {
                $arr['path'][] = $pathfile;
                $func = __FUNCTION__;
                $func($pathfile);
            } else {
                $arr['file'][] = $pathfile;
            }
        }
    }
    closedir($handle);
    var_dump($arr);
}

/*
 * 遍历目录获取所有文件
 * @method  get_all_file
 * @param   string                                $path 目录名
 * @return  array                                 $array 数组
 * */

function get_all_file(string $path)
{
    if (!is_dir($path)) {
        return false;
    }
    if ($handle = opendir($path)) {
        $arr = [];
        $func = __FUNCTION__;
        //读取
        while (($item = readdir($handle)) !== false) {
            if ($item != '.' && $item != '..') {
                $pathName = $path . DIRECTORY_SEPARATOR . $item;
                is_dir($pathName) ? $arr[$pathName] = $func($pathName) : $arr[] = $pathName;
            }
        }
        return $arr;
    } else {
        return false;
    }
}

/*
 * 获取目录大小
 * @method  get_all_file
 * @param   string                                $path 目录名
 * @return  array                                 $array 数组
 * */

function get_dir_size(string $path)
{
    if (!is_dir($path)) {
        return false;
    }
    //定义静态变量存放文件大小的和
    static $sum = 0;
    //打开目录
    $handle = opendir($path);
    //读取
    while (($item = @readdir($handle)) !== false) {
        if ($item != '.' && $item != '..') {
            $pathName = $path . DIRECTORY_SEPARATOR . $item;
            if (is_file($pathName)) {
                $sum += filesize($pathName);
            } else {
                $func = __FUNCTION__;
                $func($pathName);
            }
        }
    }
    closedir($handle);
    return $sum;
}

/*
 * 重命名文件夹
 * @method  rename_dir
 * @param   string          $olddir 原目录名
 * @param   string          $newdir 新目录名
 * @return  boolean         false | true
 * */

function rename_dir(string $olddir, string $newdir)
{
    //当前目录下时候有$newdir
    $dest = dirname($olddir) . DIRECTORY_SEPARATOR . $newdir;
    if (!is_dir($olddir) && file_exists($dest)) {
        return false;
    }
    if (rename($olddir, $dest)) {
        return true;
    }
    return false;
}

/*
 * 剪切文件夹
 * @method  cut_dir
 * @param   string          $src 需要剪切的目录
 * @param   string          $dst 剪切目标目录
 * @return  boolean         false | true
 * */

function cut_dir(string $src, string $dst)
{
    if (!is_dir($src)) {
        return false;
    }
    if (!is_dir($dst)) {
        mkdir($dst, 755, true);
    }
    $dest = $dst . DIRECTORY_SEPARATOR . basename($src);
    if (is_dir($dest)) {
        return false;
    }
    if (rename($src, $dest)) {
        return true;
    }
    return false;
}

/*
 * 拷贝文件夹
 * @method  copy_dir
 * @param   string          $src 需要拷贝的目录
 * @param   string          $dst 拷贝目标目录
 * @return  boolean         false | true
 * */

function copy_dir(string $src, string $dst)
{
    if (!is_dir($src)) {
        return false;
    }
    $dest = $dst . DIRECTORY_SEPARATOR . basename($src);
    if (!is_dir($dest)) {
        mkdir($dest, 755, true);
    }
    //打开被拷贝目录
    $handle = opendir($src);
    //读取并拷贝
    while (($item = @readdir($handle)) !== false) {
        if ($item != '.' && $item != '..') {
            $srcName = $src . DIRECTORY_SEPARATOR . $item;
            if (is_file($srcName)) {
                copy($srcName, $dest . DIRECTORY_SEPARATOR . $item);
            }
            if (is_dir($srcName)) {
                $func = __FUNCTION__;
                $func($srcName, $dest . DIRECTORY_SEPARATOR . $item);
            }
        }
    }
    closedir($handle);
    return true;
}

/*
 * 删除文件夹
 * @method  del_dir
 * @param   string          $path 需要删除的目录
 * @return  boolean         false | true
 * */

function del_dir(string $path)
{
    if (!is_dir($path)) {
        return false;
    }
    //打开目录
    $handle = opendir($path);
    //读取并删除文件
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
    if (rmdir($path)) {
        return true;
    } else {
        return false;
    }

}
