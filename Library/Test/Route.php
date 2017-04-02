<?php

/* User:lyt123; Date:2017/3/22; QQ:1067081452 */

class Route
{
    public static function run()
    {
        $controller = empty($_GET['c']) ? 'Index' : trim($_GET['c']); //设置了默认的控制器
        $action = empty($_GET['a']) ? 'index' : trim($_GET['a']); //设置了默认的Action
        $controllerBasePath = APP_PATH . '/UserApps/Modules/Controllers/';
        $controllerFilePath = $controllerBasePath . $controller . 'Controller.php';

        Path::setBasePath($_SERVER['HTTP_HOST'] . substr($_SERVER['REQUEST_URI'],0,strrpos($_SERVER['REQUEST_URI'],'/')));
        Path::setController($controller);
        Path::setAction($action);

        if (is_file($controllerFilePath)) {
            include $controllerFilePath;
            $controllerName = $controller . 'Controller';
            if (class_exists($controllerName)) {
                $controllerHandler = new $controllerName();
                if (method_exists($controllerHandler, $action)) {
                    $controllerHandler->$action();
                } /*else {
                    echo 'the method does not exists';
                }*/
            } else {
                echo 'the class does not exists';
            }
        } else {
            echo 'controller not exists';
        }
    }
}