<?php
//定义一个变量，变量中含有正则的制表符匹配符号
$pattern = '/\t/';

//定义一个变量，存放字符串内容，字符串内容中必须含有制表符空格
$subject = "asdf	sadf  jijeifa";

//使用正则函数给这两个变量相互匹配，并赋值结果给一个变量
$result = preg_match($pattern, $subject);

//判断赋值的变量，如果匹配成功就输出“匹配成功”字符串，失败则输出“匹配失败”字符串。
if($result) {
    echo '匹配成功';
}else{
    echo '匹配失败';
}
?>
