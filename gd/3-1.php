<?php
$img = imagecreatetruecolor(800, 600);

$back = imagecolorallocate($img, rand(100, 200), rand(100, 200), rand(100, 200));

imagefill($img, 0, 0, $back);

$black = imagecolorallocate($img, 10, 10, 10);
$red = imagecolorallocate($img, 200, 0, 0);
//画点
for ($i = 0; $i < 2000; $i++) {
    imagesetpixel($img, rand(10, 790), rand(10, 590), $black);
}

//画线
for ($i = 0; $i < 20; $i++) {
    $color = imagecolorallocate($img, rand(100, 255), rand(20, 100), rand(0, 100));
    imageline($img, rand(10, 790), rand(10, 590), rand(10, 790), rand(10, 590), $color);
}

//画虚线
$style = array($red, $red, $red, $red, $red, $red, $back, $back, $back, $back, $back, $back);
//设置虚线风格
imagesetstyle($img, $style);
//画线
for ($i = 0; $i < 20; $i++) {
    imageline($img, rand(10, 790), rand(10, 590), rand(10, 790), rand(10, 590), IMG_COLOR_STYLED);
}

//画矩形
for ($i = 0; $i < 20; $i++) {
    imagerectangle($img, rand(10, 790), rand(10, 590), rand(10, 790), rand(10, 590), $red);
}

//画圆
for ($i = 0; $i < 20; $i++) {
    imageellipse($img, rand(20, 780), rand(20, 580), 40, 20, $red);
}


header("Content-Type: image/jpeg");

imagejpeg($img);
