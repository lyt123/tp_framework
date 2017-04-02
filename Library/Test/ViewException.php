<?php
/* User:lyt123; Date:2017/4/1; QQ:1067081452 */

class ViewException extends BaseException {
    const NOT_EXISTS_TEMPLATE = 1;
    public function __construct($code = 0) {
        switch($code) {
            case ViewException::NOT_EXISTS_TEMPLATE:
                $msg = 'the template file is not exists';
                break;
            default :
                $msg = 'unknown exception';
                break;
        }
        parent::__construct($msg,$code);
    }
}