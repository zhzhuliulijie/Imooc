<?php
$code = imagecreatetruecolor(100, 50);

$back = imagecolorallocate($code, rand(100, 200), rand(100, 200), rand(100, 200));

imagefill($code, 0, 0, $back);

$str = '0123456789ABCDEFGHJKLMNPQRSTUVWXYZ';

$codeStr = '';

for ($i = 0; $i < 4; $i++) {
    $codeStr .= $str[rand(0,strlen($str)-1)];
}

$strColor = imagecolorallocate($code, rand(200, 255), rand(200, 255), rand(200, 255));

imagestring($code, 5, rand(10, 50), rand(10, 35), $codeStr, $strColor);

header("Content-Type: image/jpeg");

imagejpeg($code);

imagedestroy($code);


