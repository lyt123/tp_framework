<?php
/* User:lyt123; Date:2017/3/22; QQ:1067081452 */
class IndexController{
    public function index() {
        $modelPath = dirname(__FILE__) . '/../models/IndexModel.php';
        if(file_exists($modelPath)) {
            include $modelPath;
            $model = new IndexModel();
            $var1 =  $model->test();
            $viewPath = dirname(__FILE__) . '/../views/index.php';
            if(file_exists($viewPath)) {
                include $viewPath;
            } else {
                echo 'view does not exists';
            }
        } else {
            echo 'model does not exists';
        }
    }
}