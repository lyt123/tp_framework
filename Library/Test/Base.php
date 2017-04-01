<?php
/* User:lyt123; Date:2017/3/22; QQ:1067081452 */
class Base {
    public function __call($name,$arguments) {
        if(true === C('debug')) {
            echo 'not exists method:';
            echo 'the name is :';
            var_dump($name);
            echo 'the arguments is :';
            var_dump($arguments);
        }
        throw new Exception('not exists method');
    }
}