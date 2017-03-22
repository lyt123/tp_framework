<?php
/* User:lyt123; Date:2017/3/22; QQ:1067081452 */
class Config{
    const XML = 1;
    const INI = 2;
    const PHP = 3;
    public static function factory($which) {
        switch($which) {
            case Config::XML :
                return XmlConfig::parse(CONFIGS_PATH . '/config.xml');
                break;
            case Config::INI :
                return IniConfig::parse(CONFIGS_PATH . '/config.ini');
                break;
            case Config::PHP :
                //此处没有做文件是否存在的判定，你可以自己判定一下，我只是做一个例子
                return include CONFIGS_PATH . '/config.php';
                break;
            default :
                return array();
                break;
        }
    }
}