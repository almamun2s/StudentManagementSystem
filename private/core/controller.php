<?php 

/**
 * Main Controller
 */
class Controller{
    public function view($view, $data = array()){
        extract($data);

        $pathOfViewFile = 'private/views/'.$view.'.view.php'; 
        if (file_exists($pathOfViewFile)) {
            return file_get_contents($pathOfViewFile);
        }else {
            return file_get_contents('private/views/404.view.php');
        }
    }
}