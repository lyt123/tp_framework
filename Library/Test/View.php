<?php
/* User:lyt123; Date:2017/4/1; QQ:1067081452 */
class View extends base
{
    private static $_data = array();
    public static function assign($arr) {
        foreach($arr as $key => $val) {
            if(!is_int($key)) {
                //过滤掉如array('test','test2')这种数据
                self::$_data[$key] = $val;
            }
        }
    }

    public static function display($file) {
        if(file_exists($file)) {
            extract(self::$_data);
            include $file;
        } else {
            throw new ViewException(ViewException::NOT_EXISTS_TEMPLATE);
        }
    }
}