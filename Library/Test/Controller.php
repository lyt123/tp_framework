<?php

/* User:lyt123; Date:2017/4/1; QQ:1067081452 */

class Controller extends base
{
    private $_token = '';

    public function __construct()
    {
        $this->_setToken();
    }

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
    protected function _redirect(Array $arr)
    {
        array_key_exists('c', $arr) || $arr['c'] = Path::getController();
        array_key_exists('a', $arr) || $arr['a'] = Path::getAction();
        $str = 'http://' . Path::getBasePath() . '/index.php?';
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
        $controller = Path::getController();
        $action = Path::getAction();
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

    protected function _assign(Array $arr)
    {
        View::assign($arr);
    }

    protected function _display($str)
    {
        if (is_string($str)) {
            $str = str_replace(array(
                '.', '#'
            ), array(
                '/', '.'
            ), $str);
            View::display(MODULES_PATH . '/views/' . $str . '.php');
        }
    }

    private function _setToken()
    {
        if (empty($_COOKIE['_csrfToken'])) {
            $token = substr(md5(time()), 0, mt_rand(10, 15));
            $this->_token = $token;
            setcookie('_csrfToken', $token, time() + 3600 * 24 * 7);
        } else {
            $this->_token = $_COOKIE['_csrfToken'];
        }
    }

    protected function _getToken()
    {
        //增加一个判断：假设用户访问A页面的时候得到token，这个token还有两秒就过期了，这个用户三秒之后点击这个含有token的链接到达B页面，B页面由于COOKIE中的token已经失效，所以重新产生一个token，然后再和传递的这个token比较，自然不匹配
        if(empty($_COOKIE['_csrfToken'])){
            $this->_setToken();
            return '';
        }
        return $this->_token;
    }
}