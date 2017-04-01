<?php

/* User:lyt123; Date:2017/4/1; QQ:1067081452 */

class Controller extends base
{
    /**
     * Des :
     * use :
        $this->_redirect(array(
            'a' => 'test',
            'c' => 'Test',
            'param1' => '1'
        ));
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
}