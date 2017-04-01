<?php

/* User:lyt123; Date:2017/4/1; QQ:1067081452 */

class Response extends Base
{
    public static function redirect($url)
    {
        if (is_string($url)) {
            if (!headers_sent()) {
                header("Location:" . $url);
                exit();
            } else {
                $str = '<meta http-equiv="Refresh" contect="0;url=' . $url . '">';
                exit($str);
            }
        } else {
            //错误处理
        }
    }
}