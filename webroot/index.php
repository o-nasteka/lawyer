<?php
error_reporting(-1);
define('DS', DIRECTORY_SEPARATOR);
define('ROOT', dirname(dirname(__FILE__)));
define('VIEWS_PATH', ROOT.DS.'views');

require_once(ROOT.DS.'lib'.DS.'init.php');

session_start();
// var_dump($_SERVER['REQUEST_URI']);
// echo phpversion();
App::run($_SERVER['REQUEST_URI']);

