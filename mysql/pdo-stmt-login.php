<?php

$dsn = "mysql:host=localhost;dbname=imooc_test";

$pdo = new PDO($dsn, 'root', '123456');

$pdo->exec("set names utf8");

$sql = "SELECT * FROM users WHERE id = :id";

$stmt = $pdo->prepare($sql);

$id = isset($_GET['id']) ? $_GET['id'] : '';

$stmt->bindParam(':id', $id);

$stmt->execute();

$data = $stmt->fetchAll(PDO::FETCH_ASSOC);

if (!empty($data)) {
    echo "登录成功";
} else {
    echo "登录失败";
}
