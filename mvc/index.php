<?php

//users.php?m=user&a=action

require_once 'vendor/autoload.php';

$module = $_GET['m'] ?? 'index';
$action = $_GET['a'] ?? 'index';

$action = strtolower($action);

$module = 'app\\Controllers\\' . ucfirst(strtolower($module)) . 'Controller';

$controller = new $module;

$controller -> $action();

