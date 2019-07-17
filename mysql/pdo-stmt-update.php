<?php

$dsn = "mysql:host=localhost;dbname=imooc_test";

$pdo = new PDO($dsn, 'root', '123456');

$pdo -> exec("set names utf8");

$sql = "UPDATE users SET age=20 WHERE id=:id";

$stmt = $pdo -> prepare($sql);

$id = 1;

$stmt -> bindParam(':id',$id);

$res = $stmt -> execute();

var_dump($res);
