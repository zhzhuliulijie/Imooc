<?php
//$path = "test";

//$info = scandir($path);
//
//foreach ($info as $val){
//    if ($val != '.' && $val != '..'){
//        $pathName = $path.DIRECTORY_SEPARATOR.$val;
//        if (is_dir($pathName)){
//            echo '目录：',$val,'<br>';
//        }else{
//            echo '文件',$val,'<br>';
//        }
//    }
//}

//glob

$info = glob("test/*");

var_dump($info);

