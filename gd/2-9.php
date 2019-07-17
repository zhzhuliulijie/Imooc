<?php

$srcIm = imagecreatefromjpeg('./images/ChMkJ1v9A1mIN_iKABERj1MSlcQAAtatAEvvFEAERGn385.jpg');

$srcW = imagesx($srcIm);
$srcH = imagesy($srcIm);

$percent = 0.1;

$desW = $srcW*$percent;
$desH = $srcH*$percent;

$desIm = imagecreatetruecolor($desW, $desH);

imagecopyresampled($desIm, $srcIm, 0, 0, 0, 0, $desW, $desH, $srcW, $srcH);

header("Content-Type: image/jpeg");

imagejpeg($desIm, 'images/2-9.jpg', 75);

