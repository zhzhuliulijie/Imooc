<?php
date_default_timezone_set('PRC');
require_once './lib/dir.func.php';
require_once './lib/file.func.php';
define('WEBROOT', 'D:\\wamp\\www\\Classimooc');
$path = isset($_GET['path']) ? $_GET['path'] : WEBROOT;
$act = isset($_GET['act']) ? $_GET['act'] : '';
$dirName = isset($_GET['dirName']) ? $_GET['dirName'] : '';
$fileName = isset($_GET['fileName']) ? $_GET['fileName'] : '';
$newfileName = isset($_GET['newfileName']) ? $_GET['newfileName'] : '';
$showName = isset($_GET['showName']) ? $_GET['showName'] : '';
$file = isset($_GET['file']) ? $_GET['file'] : '';
$fileContent = isset($_POST['fileContent']) ? $_POST['fileContent'] : '';
$info = read_directory($path);
if (!is_array($info)) {
    exit('读取失败');
}

switch ($act) {
    case 'createDir':
        $result = create_dir($path . DIRECTORY_SEPARATOR . $dirName);
        if ($result === true) {
            $res['msg'] = '目录创建成功！';
            $res['icon'] = 1;
        } else {
            $res['msg'] = $result;
            $res['icon'] = 2;
        }
        exit(json_encode($res));
        break;
    case 'renameDir':
        $oldName = $fileName;
        $newName = $path . DIRECTORY_SEPARATOR . $showName;
//        echo $oldName . '-----------' . $newName;
        $result = rename_dir($oldName, $newName);
        if ($result === true) {
            $res['msg'] = '目录重命名成功！';
            $res['icon'] = 1;
        } else {
            $res['msg'] = $result;
            $res['icon'] = 2;
        }
        exit(json_encode($res));
        break;
    case 'cutDir':
        $result = cut_dir($fileName, $newfileName);
        if ($result === true) {
            $res['msg'] = '目录移动成功！';
            $res['icon'] = 1;
        } else {
            $res['msg'] = $result;
            $res['icon'] = 2;
        }
        exit(json_encode($res));
        break;
    case 'copyDir':
        $result = copy_dir($fileName, $newfileName);
        if ($result === true) {
            $res['msg'] = '目录复制成功！';
            $res['icon'] = 1;
        } else {
            $res['msg'] = $result;
            $res['icon'] = 2;
        }
        exit(json_encode($res));
        break;
    case 'delDir':
        $result = del_dir($fileName);
        if ($result === true) {
            $res['msg'] = '目录删除成功！';
            $res['icon'] = 1;
        } else {
            $res['msg'] = $result;
            $res['icon'] = 2;
        }
        exit(json_encode($res));
        break;
    case 'createFile':
        $cfileName = $path . DIRECTORY_SEPARATOR . $file;
        $result = create_file($cfileName);
        if ($result === true) {
            $res['msg'] = '文件创建成功！';
            $res['icon'] = 1;
        } else {
            $res['msg'] = $result;
            $res['icon'] = 2;
        }
        exit(json_encode($res));
        break;
    case 'checkFile':
        $result = check_file($fileName);
        exit($result);
        break;
    case 'editFile':
        $result = edit_file($fileName);
        exit($result);
        break;
    case 'saveFile':
        $result = save_file($fileName, $fileContent);
        if ($result === true) {
            $res['msg'] = '修改成功！';
            $res['icon'] = 1;
        } else {
            $res['msg'] = $result;
            $res['icon'] = 2;
        }
        exit(json_encode($res));
        break;
    case 'downFile':
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
        break;
    case 'renameFile':
        $oldName = $fileName;
        $newName = $path . DIRECTORY_SEPARATOR . $showName;
//        echo $oldName . '-----------' . $newName;
        $result = rename_file($oldName, $newName);
        if ($result === true) {
            $res['msg'] = '文件重命名成功！';
            $res['icon'] = 1;
        } else {
            $res['msg'] = $result;
            $res['icon'] = 2;
        }
        exit(json_encode($res));
        break;
    case 'cutFile':
        $result = cut_file($fileName, $newfileName);
        if ($result === true) {
            $res['msg'] = '文件移动成功！';
            $res['icon'] = 1;
        } else {
            $res['msg'] = $result;
            $res['icon'] = 2;
        }
        exit(json_encode($res));
        break;
    case 'copyFile':
        $result = copy_file($fileName, $newfileName);
        if ($result === true) {
            $res['msg'] = '文件复制成功！';
            $res['icon'] = 1;
        } else {
            $res['msg'] = $result;
            $res['icon'] = 2;
        }
        exit(json_encode($res));
        break;
    case 'delFile':
        $result = del_file($fileName);
        if ($result === true) {
            $res['msg'] = '文件删除成功！';
            $res['icon'] = 1;
        } else {
            $res['msg'] = $result;
            $res['icon'] = 2;
        }
        exit(json_encode($res));
        break;
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Web在线文件管理器</title>
    <link rel="stylesheet" href="./css/bootstrap.min.css">
    <link rel="stylesheet" href="./layui/layer/theme/default/layer.css">
</head>
<body>

<div class="container">
    <div class="row clearfix">
        <div class="col-md-12 column">
            <nav class="navbar navbar-default" role="navigation">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse"
                            data-target="#bs-example-navbar-collapse-1"><span class="sr-only">切换导航</span><span
                                class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span>
                    </button>
                    <a rel="nofollow" class="navbar-brand" href="javascript:window.history.back(-1)"><i
                                class="glyphicon glyphicon-backward"></i> 返回上级目录</a>
                    <a rel="nofollow" class="navbar-brand" href="/web-file-manage"><i
                                class="glyphicon glyphicon-home"></i> 首页</a>
                </div>

                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav">
                        <li>
                            <a rel="nofollow" href="javascript:void(0)" id="createDir"
                               data-url="index.php?act=createDir&path=<?= $path; ?>"><i
                                        class="glyphicon glyphicon-folder-close"></i> 新建目录</a>
                        </li>
                        <li>
                            <a rel="nofollow" href="javascript:void(0)"
                               data-url="index.php?act=createFile&path=<?= $path; ?>" class="createFile"><i
                                        class="glyphicon glyphicon-file"></i> 新建文件</a>
                        </li>
                        <li>
                            <a rel="nofollow" href="#"><i class="glyphicon glyphicon-upload"></i> 上传文件</a>
                        </li>
                        <li>
                            <a rel="nofollow" href="#"><i class="glyphicon glyphicon-cog"></i> 系统信息</a>
                        </li>
                    </ul>
                    <form class="navbar-form navbar-left" role="search">
                        <div class="form-group">
                            <input type="text" class="form-control"/>
                        </div>
                        <button type="submit" class="btn btn-default">搜索</button>
                    </form>
                </div>
            </nav>
            <div class="jumbotron">
                <h1>Web在线文件管理器</h1>
                <p>Web在线文件管理器，实现文件和目录的在线创建、修改和删除</p>
            </div>
            <table class="table table-hover">
                <thead>
                <tr>
                    <th>类型</th>
                    <th>名称</th>
                    <th>读-写-执行</th>
                    <th>访问时间</th>
                    <th>操作</th>
                </tr>
                </thead>
                <tbody>
                <?php
                //目录
                if (isset($info['dir']) && is_array($info['dir'])) {
                    foreach ($info['dir'] as $key => $value) {
                        ?>
                        <tr class="success">
                            <td><i class="glyphicon glyphicon-folder-close"></i></td>
                            <td><?= $value['showName']; ?></td>
                            <td>
                                <i class="glyphicon <?= $value['readable'] ? 'glyphicon-ok text-success' : 'glyphicon-remove text-danger'; ?>"></i>-
                                <i class="glyphicon <?= $value['writable'] ? 'glyphicon-ok text-success' : 'glyphicon-remove text-danger'; ?>"></i>-
                                <i class="glyphicon <?= $value['executable'] ? 'glyphicon-ok text-success' : 'glyphicon-remove text-danger'; ?>"></i>
                            </td>
                            <td><?= $value['atime']; ?></td>
                            <td>
                                <a href="index.php?path=<?= $value['fileName']; ?>" class="btn btn-info btn-xs">打开</a>
                                <a href="javascript:void(0)"
                                   data-url="index.php?act=renameDir&fileName=<?= $value['fileName']; ?>&path=<?= $path; ?>"
                                   data-showname="<?= $value['showName']; ?>"
                                   class="renameDir btn btn-info btn-xs">重命名</a>
                                <a href="javascript:void(0)"
                                   data-url="index.php?act=cutDir&fileName=<?= $value['fileName']; ?>"
                                   data-filedir="<?= dirname($value['fileName']); ?>"
                                   data-filename="<?= $value['fileName']; ?>" class="cutDir btn btn-info btn-xs">剪切</a>
                                <a href="javascript:void(0)"
                                   data-url="index.php?act=copyDir&fileName=<?= $value['fileName']; ?>"
                                   data-filedir="<?= dirname($value['fileName']); ?>"
                                   data-filename="<?= $value['fileName']; ?>" class="copyDir btn btn-info btn-xs">复制</a>
                                <a href="javascript:void(0)"
                                   data-url="index.php?act=delDir&fileName=<?= $value['fileName']; ?>"
                                   data-filename="<?= basename($value['fileName']); ?>"
                                   class="delDir btn btn-danger btn-xs">删除</a>
                            </td>
                        </tr>
                        <?php
                    }
                }

                //文件
                if (isset($info['file']) && is_array($info['file'])) {
                    foreach ($info['file'] as $key => $value) {
                        ?>
                        <tr class="warning">
                            <td><i class="glyphicon glyphicon-file"></i></td>
                            <td><?= $value['showName']; ?></td>
                            <td>
                                <i class="glyphicon <?= $value['readable'] ? 'glyphicon-ok text-success' : 'glyphicon-remove text-danger'; ?>"></i>-
                                <i class="glyphicon <?= $value['writable'] ? 'glyphicon-ok text-success' : 'glyphicon-remove text-danger'; ?>"></i>-
                                <i class="glyphicon <?= $value['executable'] ? 'glyphicon-ok text-success' : 'glyphicon-remove text-danger'; ?>"></i>
                            </td>
                            <td><?= $value['atime']; ?></td>
                            <td>
                                <a href="javascript:void(0)"
                                   data-url="index.php?act=checkFile&fileName=<?= $value['fileName']; ?>"
                                   class="checkFile btn btn-info btn-xs">查看</a>
                                <a href="javascript:void(0)"
                                   data-url="index.php?act=editFile&fileName=<?= $value['fileName']; ?>"
                                   data-save="index.php?act=saveFile&fileName=<?= $value['fileName']; ?>"
                                   class="editFile btn btn-info btn-xs">编辑</a>
                                <a href="javascript:void(0)"
                                   data-url="index.php?act=downFile&fileName=<?= $value['fileName']; ?>"
                                   class="downFile btn btn-info btn-xs">下载</a>
                                <a href="javascript:void(0)"
                                   data-url="index.php?act=renameFile&fileName=<?= $value['fileName']; ?>&path=<?= $path; ?>"
                                   data-showname="<?= $value['showName']; ?>"
                                   class="renameFile btn btn-info btn-xs">重命名</a>
                                <a href="javascript:void(0)"
                                   data-url="index.php?act=cutFile&fileName=<?= $value['fileName']; ?>"
                                   data-filedir="<?= dirname($value['fileName']); ?>"
                                   class="cutFile btn btn-info btn-xs">剪切</a>
                                <a href="javascript:void(0)"
                                   data-url="index.php?act=copyFile&fileName=<?= $value['fileName']; ?>"
                                   data-filedir="<?= dirname($value['fileName']); ?>"
                                   class="copyFile btn btn-info btn-xs">复制</a>
                                <a href="javascript:void(0)"
                                   data-url="index.php?act=delFile&fileName=<?= $value['fileName']; ?>"
                                   data-filename="<?= basename($value['fileName']); ?>"
                                   class="delFile btn btn-danger btn-xs">删除</a>
                            </td>
                        </tr>
                        <?php
                    }
                }
                ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<script src="./js/jquery-3.3.1.min.js"></script>
<script src="./js/bootstrap.min.js"></script>
<script src="./layui/layer/layer.js"></script>
<script src="./js/dir.js"></script>
<script src="./js/file.js"></script>
</body>
</html>
