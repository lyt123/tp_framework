<?php
/* User:lyt123; Date:2017/3/22; QQ:1067081452 */
function dd($data)
{
    var_dump($data);
    exit();
}

function ddd($data)
{
    var_dump($data);
}

function __autoload($className)
{
    $frameworkFileName = FRAMEWORK_PATH . '/' . $className . '.php';
    if (is_file($frameworkFileName)) {
        include $frameworkFileName;
    } else {
        //用户类文件
        $controllerFileName = MODULES_PATH . '/Controllers/' . $className . '.php';
        if (is_file($controllerFileName)) {
            include $controllerFileName;
        } else {
            $modelFileName = MODULES_PATH . '/Models/' . $className . '.php';
            if (is_file($modelFileName)) {
                include $modelFileName;
            } else {
                $helperFileName = MODULES_PATH . '/Helpers/' . $className . '.php';
                if (is_file($helperFileName)) {
                    include $helperFileName;
                } else {
                    throw new Exception("class not found");
                }
            }
        }
    }
}

function C($name = null, $val = null)
{
    static $_config = array();
    if (empty($name)) {
        return $_config;
    } elseif (is_string($name)) {
        if (empty($val)) {
            if (!strpos($name, '=>')) {
                //一维
                return isset($_config[$name]) ? $_config[$name] : null;
            } else {
                //目前只支持二维
                $name = explode('=>', $name);
                return isset($_config[$name[0]][$name[1]]) ? $_config[$name[0]][$name[1]] : null;
            }
        } else {
            if (!strpos($name, '=>')) {
                //直接设置
                $_config[$name] = $val;
            } else {
                //设置二维
                $name = explode('=>', $name);
                $_config[$name[0]][$name[1]] = $val;
            }
        }
    } elseif (is_array($name)) {
        foreach ($name as $key => $value) {
            $_config[$key] = $value;
        }
        return;
    } else {
        throw new Exception('参数类型出错');
        return;
    }
}

function myAddslashes($str)
{
    if (get_magic_quotes_gpc()) {
        return addslashes($str);
    }
}