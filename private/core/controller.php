<?php 

/**
 * Main Controller
 */
class Controller{
    public function view($view, $data = array()){
        extract($data);
        
        $pathOfViewFile = 'private/views/'.$view.'.view.php'; 
        if (file_exists($pathOfViewFile)) {
            include $pathOfViewFile;
        }else {
            include 'private/views/404.view.php';
        }
    }
}