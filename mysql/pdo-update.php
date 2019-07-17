<?php

$dsn = "mysql:host=localhost;dbname=imooc_test";

$pdo = new PDO($dsn, 'root', '123456');

$pdo -> exec("set names utf8");

$sql = "UPDATE users SET age=20 WHERE id = 1";

$res = $pdo -> exec($sql);

var_dump($res);
