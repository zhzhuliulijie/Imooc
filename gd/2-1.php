<?php

$image = 'images/ChMkJ1v9A1mIN_iKABERj1MSlcQAAtatAEvvFEAERGn385.jpg';

$info = getimagesize($image);

//var_dump($info);

//$string = file_get_contents($image);
//
//$info = getimagesizefromstring($string);
//
//var_dump($info);

//$imageTyep = image_type_to_extension($info[2], true);
//
//var_dump($imageTyep);

$mime = image_type_to_mime_type($info[2]);

var_dump($mime);
