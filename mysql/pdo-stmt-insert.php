<?php

$dsn = "mysql:host=localhost;dbname=imooc_test";

$pdo = new PDO($dsn, 'root', '123456');

$pdo->exec("set names utf8");

$sql = "INSERT INTO users(`name`,`age`,`sex`) VALUES (:name, :age, :sex)";

$stmt = $pdo->prepare($sql);

$name = '小布丁';
$age = 9;
$sex = '女';

$stmt->bindParam(':name', $name);
$stmt->bindParam(':age', $age);
$stmt->bindParam(':sex', $sex);

$res = $stmt->execute();

if ($res) {
    echo "添加成功";
} else {
    echo "添加失败";
}
