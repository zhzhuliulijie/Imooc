<?php

/*
 *
 * CREATE TABLE `imooc_test`. (
 *  `id` INT NOT NULL AUTO_INCREMENT ,
 *  `name` VARCHAR(32) NOT NULL ,
 *  `money` INT NOT NULL DEFAULT '0' ,
 *  `edit` ENUM('1','2','3','4') NOT NULL ,
 *  `date` TIMESTAMP NOT NULL ,
 *  `udate` TEXT NOT NULL ,
 *  PRIMARY KEY (`id`)
 * ) ENGINE = InnoDB;
 * */

$mysqli = new mysqli('localhost','root','123456','imooc_test');

$mysqli -> query('set names utf8');
//添加数据
//$res = $mysqli -> query("INSERT INTO users(`name`,`age`,`sex`) VALUES ('小六',12,'男')");
//$res = $mysqli -> query("INSERT INTO money(`uid`,`money`) VALUES (3,280)");
//修改数据
//$res = $mysqli -> query("UPDATE users SET `sex`='女' WHERE `name`='程菲'");
//删除数据
//$res = $mysqli -> query("DELETE FROM users WHERE `id`=4");
//查询数据
//$result = $mysqli ->query("SELECT * FROM users");
//$res = $result -> fetch_all(MYSQLI_ASSOC);
//关闭数据库
$mysqli -> close();
//var_dump($res);


