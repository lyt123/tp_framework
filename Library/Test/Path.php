<?php

/* User:lyt123; Date:2017/4/1; QQ:1067081452 */

class Path extends Base
{
    private static $_base = '';
    private static $_controller = '';
    private static $_action = '';

    public static function setBasePath($base)
    {
        self::$_base = $base;
    }

    public static function setController($controller)
    {
        self::$_controller = $controller;
    }

    public static function setAction($action)
    {
        self::$_action = $action;
    }

    public static function getBasePath()
    {
        return self::$_base;
    }

    public static function getController()
    {
        return self::$_controller;
    }

    public static function getAction()
    {
        return self::$_action;
    }
}
