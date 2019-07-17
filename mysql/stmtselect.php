<?php
header('content-type:text/html;charset=utf-8');

$mysqli = new mysqli('localhost', 'root', '123456', 'imooc_test');

$mysqli->query('set names utf8');

$sql = "SELECT * FROM users WHERE id>?";

$stmt = $mysqli->prepare($sql);

$id = 1;

$stmt->bind_param('i', $id);

$stmt->bind_result($id, $name, $age, $sex);

$stmt->execute();

while ($stmt->fetch()) {
    $data[] = [
        'id' => $id,
        'name' => $name,
        'age' => $age,
        'sex' => $sex
    ];
}

var_dump($data);

