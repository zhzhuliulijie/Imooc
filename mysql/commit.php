<?php

$mysqli = new mysqli('localhost', 'root', '123456', 'imooc_test');

$mysqli->query('set names utf8');

$mysqli->autocommit(false);

$mysqli->query("UPDATE money SET money=money+10 WHERE id = 1");
$r1 = $mysqli->affected_rows;
$mysqli->query("UPDATE money SET money=money-10 WHERE id = 2");
$r2 = $mysqli->affected_rows;

if ($r1 > 0 && $r2 > 0) {
    echo "操作成功";
    $mysqli->commit();
} else {
    echo "操作失败";
    $mysqli->rollback();
}


