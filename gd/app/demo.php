<?php

require_once './lib/Captcha.php';
$captcha = new \app\lib\Captcha(200, 50);

$captcha->string(6, 15)->show();
//$captcha->logic(15)->show();
