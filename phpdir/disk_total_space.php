<?php

$total = disk_total_space("D:");

$space = $total / (1024 * 1024 * 1024);

echo $space;
