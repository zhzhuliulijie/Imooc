<?php
$path = "test";

$handle = opendir($path);

while (($item = readdir($handle)) !== false) {
    if ($item != '.' && $item != '..'){
        if (is_dir($path . '/' . $item)) {
            echo '目录' . $item . '<br/>';
        } else {
            echo '文件' . $item . '<br/>';
        }
    }
}
rewinddir($handle);
//var_dump(readdir($handle));
closedir($handle);

