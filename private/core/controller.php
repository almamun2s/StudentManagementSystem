<?php 

/**
 * Main Controller
 */
class Controller{
    protected function view( string $view, array $data = array()){
        extract($data);
        
        if (file_exists('private/views/'.$view.'.view.php')) {
            require 'private/views/'.$view.'.view.php';
        }else {
            require 'private/views/404.view.php';
        }
    }

    protected function load_models($model){
        if (file_exists('private/models/'. strtolower($model).'.php')) {
            require_once 'private/models/'.strtolower($model).'.php';

            return $model = new $model();
        }
        return false;
    }

    protected function redirect(string $url_ext){
        header('location:' . ROOT . $url_ext);
        exit;
    }
}