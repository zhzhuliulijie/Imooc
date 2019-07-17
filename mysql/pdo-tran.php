<?php

$dsn = "mysql:host=localhost;dbname=imooc_test";

$pdo = new PDO($dsn, 'root', '123456');

$pdo -> exec("set names utf8");

$pdo -> beginTransaction();  //开启事务

$sql1 = "UPDATE users SET age=age-1 WHERE id = 3";
$sql2 = "UPDATE users SET age=age+1 WHERE id = 4";

$res1 = $pdo -> exec($sql1);
$res2 = $pdo -> exec($sql2);

if ($res1>0 && $res2>0){
    echo "操作成功";
    $pdo -> commit();
}else{
    echo "操作失败";
    $pdo -> rollBack();
}

$pdo -> setAttribute(PDO::ATTR_AUTOCOMMIT, 1);
