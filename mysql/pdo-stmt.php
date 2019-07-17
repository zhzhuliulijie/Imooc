<?php

$dsn = "mysql:host=localhost;dbname=imooc_test";

$pdo = new PDO($dsn, 'root', '123456');

$pdo -> exec("set names utf8");

//$sql = "SELECT * FROM users WHERE id > ?";
$sql = "SELECT * FROM users WHERE id > :id";

$stmt = $pdo -> prepare($sql);

$id = 3;

$stmt -> bindParam(':id',$id);
//$stmt -> bindValue(1,2);

$stmt -> execute();

$data = $stmt -> fetchAll(PDO::FETCH_ASSOC);

var_dump($data);
