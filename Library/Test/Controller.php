<?php

/* User:lyt123; Date:2017/4/1; QQ:1067081452 */

class Controller extends base
{
    /**
     * Des :
     * use :
     * $this->_redirect(array(
     * 'a' => 'test',
     * 'c' => 'Test',
     * 'param1' => '1'
     * ));
     * Auth:lyt123
     */
    protected function _redirect(array $arr)
    {
        $controller = empty($_GET['c']) ? C('defaultController') : trim($_GET['c']); //设置了默认的控制器
        $action = empty($_GET['a']) ? C('defaultAction') : trim($_GET['a']); //设置了默认的Action
        array_key_exists('c', $arr) || $arr['c'] = $controller;
        array_key_exists('a', $arr) || $arr['a'] = $action;
        $str = './index.php?';
        foreach ($arr as $key => $val) {
            if (!is_int($key)) {
                $str .= ($key . '=' . $val . '&');
            }
        }
        $str = substr($str, 0, strlen($str) - 1);
//        dd($str);//output '/?action=index&controller=Index&param1=1'
        Response::redirect($str);
    }

    protected function _forward(Array $arr)
    {
        $controller = empty($_GET['c']) ? C('defaultController') : trim($_GET['c']); //设置了默认的控制器
        $action = empty($_GET['a']) ? C('defaultAction') : trim($_GET['a']); //设置了默认的Action
        if (array_key_exists('c', $arr)) {
            $controller = $arr['c'];
        }
        if (array_key_exists('a', $arr)) {
            $action = $arr['a'];
        }
        $controller .= 'Controller';
        if ($controller === get_class()) {
            if (method_exists($this, $action)) {
                $this->$action();
            } else {
                //时间有限，不写逻辑了
            }
        } else {
            if (class_exists($controller)) {
                $class = new $controller();
                if (method_exists($class, $action)) {
                    $class->$action();
                } else {
                    //时间有限，不写了
                }
            } else {
                //时间有限，不写了
            }
        }
    }
}