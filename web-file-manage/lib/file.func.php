<?php
/*
 * 新建文件
 * @mehtod create_file()
 * @param string        $fileName 创建文件的目录
 * @param array         $allowExt 允许创建的文件类型
 * @return mixed        true | string
 * */
function create_file(string $fileName, array $allowExt = array('php', 'txt', 'html'))
{
    if (is_file($fileName)) {
        return '目录中存在同名文件';
    }
    $ext = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
    if (!in_array($ext, $allowExt)) {
        return '非法文件类型';
    }
    if (!touch($fileName)) {
        return '文件创建失败';
    }
    return true;
}

/*
 * 查看文件
 * @mehtod check_file()
 * @param string        $fileName 查看文件的名称
 * @param array         $allowExt 允许查看的文件类型
 * @return string       文件内容
 * */
function check_file(string $fileName, array $allowExt = array('php', 'txt', 'html', 'jpg', 'png', 'gif', 'json', 'htm', 'md', 'js'))
{
    if (!is_file($fileName)) {
        return '要查看的文件不存在';
    }
    $ext = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
    if (!in_array($ext, $allowExt)) {
        return '不能被查看的文件类型';
    }
    if (@getimagesize($fileName)) {
        $fileName = str_replace('\\', '/', $fileName);
        $fileName = preg_replace('/D:\\/wamp\\/www\\/Classimooc/', '', $fileName);
        $res = "<img src='{$fileName}' class='img-responsive' style='max-width: 100%; max-height: 100%;' />";
    } else {
        $str = file_get_contents($fileName);
        if (strlen($str) > 0) {
            $res = highlight_string($str, true);
        } else {
            $res = '空文件，没有内容';
        }
    }
    return $res;
}

/*
 * 编辑文件
 * @mehtod edit_file()
 * @param string        $fileName 编辑文件的名称
 * @param array         $allowExt 允许编辑的文件类型
 * @return string       文件内容
 * */
function edit_file(string $fileName, array $allowExt = array('php', 'html', 'htm', 'txt', 'js', 'json', 'ini'))
{
    if (!is_file($fileName)) {
        return '要编辑的文件不存在';
    }
    $ext = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
    if (!in_array($ext, $allowExt)) {
        return '不能被编辑的文件类型';
    }
    $str = file_get_contents($fileName);
    if (strlen($str)) {
        $res = $str;
    } else {
        $res = '文件内容为空';
    }
    return $res;
}

/*
 * 保存文件
 * @mehtod save_file()
 * @param string        $fileName 编辑文件的名称
 * @param string         $fileContent 编辑后的文件内容
 * @return mixed        boolean | string
 * */
function save_file(string $fileName, string $fileContent)
{
    if (!is_file($fileName)) {
        return '文件不存在';
    }
    if (strlen($fileContent) <= 0) {
        return '内容不能为空';
    }
    if (!file_put_contents($fileName, $fileContent)) {
        return '保存失败';
    }
    return true;
}

/*
 * 下载文件
 * @mehtod down_file()
 * @param string        $fileName 文件的名称
 * @return mixed        boolean | string
 * */
function down_file(string $fileName)
{
    if (!is_file($fileName) || !file_exists($fileName)) {
        return '文件不存在';
    }
    if (!is_readable($fileName)) {
        return '文件不可读';
    }

//清空缓冲区
    ob_clean();

//以 rb 模式打开文件
    $fileHandle = fopen($fileName, 'rb');

    if (!$fileHandle) {
        return '文件打开失败';
    }

//通知浏览器
    header('Content-type: application/octet-stream; charset=utf-8');
    header('Content-Transfer-Encoding: binary');
    header('Content-Length: ' . filesize($fileName));
    header('Content-Disposition: attachment; filename="' . urlencode(basename($fileName)) . '"');

//读取并传输文件
    while (!feof($fileHandle)) {
        echo fread($fileHandle, 102400);
    }

//关闭文档流
    fclose($fileHandle);
}


/*
 * 重命名文件
 * @method rename_file
 * @param string    $oldName 原文件名称
 * @param string    $newName 新文件名称
 * @return mixed    true | string
 * */
function rename_file(string $oldName, string $newName)
{
    if (!is_file($oldName)) {
        return '原文件不存在';
    }
    if (is_file($newName)) {
        return '当前目录下已经存在该文件';
    }
    if (!rename($oldName, $newName)) {
        return '文件重命名失败';
    }
    return true;
}

/*
 * 剪切（移动）文件
 * @method cut_file
 * @param string    $src 要剪切的文件名称
 * @param string    $dest 剪切目标新文件名称
 * @return mixed    true | string
 * */
function cut_file(string $src, string $dst)
{
    if (!is_file($src)) {
        return '要剪切的文件不存在';
    }
    if (!is_dir($dst)) {
        mkdir($dst, 755, true);
    }
    $dest = $dst . DIRECTORY_SEPARATOR . basename($src);
    if (is_file($dest)) {
        return '剪切目标文件夹下已经存在该文件';
    }
    if (!rename($src, $dest)) {
        return '文件剪切失败';
    }
    return true;
}

/*
 * 复制文件
 * @method copy_file
 * @param string    $src 要复制的文件名称
 * @param string    $dest 复制目标文件名称
 * @return mixed    true | string
 * */
function copy_file(string $src, string $dst)
{
    if (!is_file($src)) {
        return '要复制的文件不存在';
    }
    if (!is_dir($dst)) {
        mkdir($dst, 755, true);
    }
    $dest = $dst . DIRECTORY_SEPARATOR . basename($src);
    if (is_file($dest)){
        return '复制目标文件夹下已经存在该文件';
    }
    if (!copy($src, $dest)){
        return '复制文件失败';
    }
    return true;
}

/*
 * 删除文件
 * @method del_file
 * @param string    $fileName 要删除的文件名称
 * @return mixed    true | string
 * */
function del_file(string $fileName)
{
    if (!is_file($fileName)) {
        return '要删除的文件不存在';
    }
    if (!unlink($fileName)){
        return '删除失败';
    }
    return true;
}





