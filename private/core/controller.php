<?php 
/**
 * Main Controller
 */
class Controller{
    /**
     * This will require files to view 
     *
     * @param string $view
     * @param array $data
     */
    protected function view( $view, $data = array()){
        extract($data);
        
        if (file_exists('private/views/'.$view.'.view.php')) {
            require 'private/views/'.$view.'.view.php';
        }else {
            require 'private/views/404.view.php';
        }
    }

    /**
     * loads model for internal uses
     *
     * @param string $model
     * @return Model|boolean
     */
    protected function load_models($model){
        if (file_exists('private/models/'. strtolower($model).'.php')) {
            require_once 'private/models/'.strtolower($model).'.php';

            return $model = new $model();
        }
        return false;
    }

    /**
     * To redirect user to certain destination
     *
     * @param string $url_ext write the destination excluding main domain
     */
    protected function redirect( $url_ext){
        header('location:' . ROOT . $url_ext);
        exit;
    }
}