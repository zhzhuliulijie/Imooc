<?php

//$img = imagecreatefromjpeg('./images/ChMkJ1v88BaIQSHMAAZFEV54ltgAAtalgMSYoUABkUp411.jpg');
//
//$water = imagecreatefromjpeg('./images/2-9.jpg');
//
////imagecopy($img, $water, 0, 0, 0, 0, imagesx($water), imagesy($water));
//imagecopymerge($img, $water, 0, 0, 0, 0, imagesx($water), imagesy($water), 10);
//
//header("Content-Type: image/jpeg");
//
//imagejpeg($img);

$img = imagecreatetruecolor(400,200);

$back = imagecolorallocate($img, 60, 20, 10);

imagefill($img, 0, 0, $back);

$stringColor = imagecolorallocate($img, rand(100, 200), rand(100, 200), rand(100, 200));

$string = rand(111111, 999999);

imagestring($img, rand(3, 5), rand(20, 300), rand(20, 150), $string, $stringColor);
imagestringup($img, rand(3, 5), rand(20, 300), rand(20, 150), $string, $stringColor);

header("Content-Type: image/jpeg");

imagejpeg($img);

imagedestroy($img);
