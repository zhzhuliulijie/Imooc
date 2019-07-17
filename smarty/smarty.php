<?php

require "libs/Smarty.class.php";

$smarty = new Smarty();

$smarty -> setTemplateDir('./views');

$smarty -> setCompileDir('./runtime/compile');

$smarty -> setPluginsDir('./plugins');

$smarty -> setCacheDir('./runtime/cache');

$smarty -> setConfigDir('./config');

$smarty -> caching = true;

$smarty -> cache_lifetime = 24 * 3600;

$smarty -> left_delimiter = '{{';

$smarty -> right_delimiter = '}}';

$smarty -> assign('name', '刘利杰');

$smarty -> assign('wife', '李庆杰');

$smarty -> display('user.html');
