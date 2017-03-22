<?php
/* User:lyt123; Date:2017/3/22; QQ:1067081452 */
defined('APP_PATH') || define('APP_PATH',dirname(__FILE__) . '/..');
defined('FRAMEWORK_PATH') || define('FRAMEWORK_PATH',APP_PATH . '/Library/Test');
include FRAMEWORK_PATH . '/FrontController.php';
$frontController = FrontController::getInstance();
$frontController->run();