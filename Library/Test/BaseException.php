<?php

/* User:lyt123; Date:2017/4/1; QQ:1067081452 */

class BaseException extends Exception
{
    protected function _outputErrorPage()
    {
        header("conten-type:text/html");
        echo file_get_contents(APP_PATH . '/error.html');
    }

    protected function _toLogFile($str)
    {
        file_put_contents(APP_PATH . '/log', $str, FILE_APPEND);
    }

    public function printStack()
    {
        if (true === C('debug')) {
            echo parent::getTraceAsString();
        } else {
            $this->_toLogFile(parent::getTraceAsString());
            $this->_outputErrorPage();
        }
    }

    public function __toString()
    {
        if (true !== C('debug')) {
            $this->_toLogFile(parent::getTraceAsString());
            $this->_outputErrorPage();
            exit();
        }
        return parent::__toString();
    }
}