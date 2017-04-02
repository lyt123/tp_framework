<?php

/* User:lyt123; Date:2017/3/22; QQ:1067081452 */

class IndexController extends Controller
{
    public function index()
    {
        $token = empty($_GET['token']) ? '' : $_GET['token'];

        if ($token === $this->_getToken()) {

            $model = new IndexModel();
            $var1 = $model->test();
            $this->_assign(array('var1' => $var1));
            $this->_display('index');
        }
    }

    public function test()
    {
        $token = empty($_GET['token']) ? '' : $_GET['token'];
        if ($token === $this->_getToken()) {
            //判定为正常
            $model = new IndexModel();
            $var1 = $model->test();
            $this->_assign(array('var1' => $var1));
            $this->_display('index');
        } else {
            $this->_redirect(array(//跳转到某一个控制器的某一个Action
                'token' => $this->_getToken(),
                'a' => 'index',
                'c' => 'Index'
            ));
        }
    }
}