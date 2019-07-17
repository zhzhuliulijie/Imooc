<?php

$dsn = "mysql:host=localhost;dbname=imooc_test";

$pdo = new PDO($dsn, 'root', '123456');

$pdo -> exec("set names utf8");

$sql = "DELETE FROM users WHERE id = 7";

$res = $pdo -> exec($sql);

var_dump($res);
