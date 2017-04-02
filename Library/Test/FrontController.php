<?php
/* User:lyt123; Date:2017/3/22; QQ:1067081452 */
defined('APP_PATH') || exit('未定义APP_PATH');
defined('FRAMEWORK_PATH') || define('FRAMEWORK_PATH', APP_PATH . '/Library/Test');
defined('MODULES_PATH') || define('MODULES_PATH', APP_PATH . '/UserApps/Modules');
defined('CONFIGS_PATH') || define('CONFIGS_PATH', APP_PATH . '/UserApps/Configs');
include FRAMEWORK_PATH . '/function.php';

class FrontController extends base
{
    private static $_instance = null;

    private function __construct()
    {
        C(Config::factory(Config::PHP)); //写入配置信息
        session_start();
        date_default_timezone_set(C('timeZone'));
        if (true === C('debug')) {
            echo 'debug mode:';
            ini_set('display_errors', 'On');
            error_reporting(C('errorReporting'));
        } else {
            error_reporting(0);
            ini_set('display_errors', 'Off');
        }
    }

    private function __clone()
    {
    }

    public static function getInstance()
    {
        if (!(self::$_instance instanceof self)) {
            self::$_instance = new FrontController();
        }
        return self::$_instance;
    }

    public function run()
    {
        Route::run();
    }
}