<?php

/* User:lyt123; Date:2017/4/1; QQ:1067081452 */

class TestController extends Controller
{
    public function test()
    {
        $this->_assign(array(
            'arr' => array(
                'test', 'test2'
            ),
            'str' => 'it is a str'
        ));
        $this->_display('test');
    }
}