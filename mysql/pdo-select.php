<?php

$dsn = "mysql:host=localhost;dbname=imooc_test";

$pdo = new PDO($dsn, 'root', '123456');

$pdo -> exec("set names utf8");

$sql = "SELECT * FROM users";

$res = $pdo -> query($sql);

$data = $res -> fetchAll(PDO::FETCH_ASSOC);

var_dump($data);
