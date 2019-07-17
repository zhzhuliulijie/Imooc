<?php

//$img = imagecreatetruecolor(200,200);
//
//$back = imagecolorallocate($img, 210,150,130);
//
//imagefill($img, 0, 0, $back);
//
//header('Content-Type:image/png');
//
//imagepng($img, './images/2-5.png');
//
//imagedestroy($img);

$img = imagecreatefromjpeg("./images/ChMkJ1v9A1mIN_iKABERj1MSlcQAAtatAEvvFEAERGn385.jpg");

$back = imagecolorallocate($img, 230,150,130);

$newimg = imagerotate($img, 45, $back);

header("Content-Type: image/jpeg");

imagejpeg($newimg);

