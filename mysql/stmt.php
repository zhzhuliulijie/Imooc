<?php
header('content-type:text/html;charset=utf-8');
$mysqli = new mysqli('localhost','root','123456','imooc_test');

$mysqli -> query('set names utf8');

$sql = "DELETE FROM money WHERE id = ?";
$stmt = $mysqli -> prepare($sql);

$id = 2;
$stmt -> bind_param('i',$id);

$res = $stmt -> execute();

var_dump($res);

//$sql = "INSERT INTO money(uid,money) VALUES (?,?)";
//
//$stmt = $mysqli -> prepare($sql);
//
//$uid = 6;
//$money = 450;
//
//$stmt -> bind_param('ii',$uid, $money);
//
//$res = $stmt -> execute();

//var_dump($res);

