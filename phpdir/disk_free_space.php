<?php

$free = disk_free_space("D:");

$free = $free / pow(1024,3);

echo $free;
