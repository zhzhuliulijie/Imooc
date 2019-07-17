<?php
$car = imagecreatetruecolor(500, 300);

$back = imagecolorallocate($car, 230, 150, 130);

imagefill($car, 0, 0, $back);

$lineColor = imagecolorallocate($car, 10, 0, 0);

imageline($car, 90,150, 140, 80, $lineColor);
imageline($car, 90,150, 220, 150, $lineColor);
imageline($car, 170,80, 170, 150, $lineColor);
imageline($car, 140,80, 220, 80, $lineColor);
imageline($car, 90,150, 90, 250, $lineColor);
imageline($car, 410,250, 90, 250, $lineColor);
imageline($car, 410,250, 410, 55, $lineColor);
imageline($car, 220,55, 410, 55, $lineColor);
imageline($car, 220,55, 220, 250, $lineColor);

imageellipse($car, 155, 250, 60, 50, $lineColor);
imageellipse($car, 295, 250, 60, 50, $lineColor);
imageellipse($car, 360, 250, 60, 50, $lineColor);

header("Content-Type: image/jpeg");

imagejpeg($car);
