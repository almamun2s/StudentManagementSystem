<?php 
// namespace 
class App{


    protected $controller = 'home';
    protected $method = 'index';
    protected $params;
    public function __construct(){
        $URL = $this->getURL();

        $controllerFile = 'private/controller/'. $URL[0].'.php';
        if (file_exists($controllerFile)) {
            $this->controller = $URL[0];
        }

        require_once "private/controller/$this->controller.php";
        $this->controller = new $this->controller;
    }

    protected function getURL(){

        $url = isset($_GET['url']) ? $_GET['url'] : 'home';
        return explode('/', filter_var(trim( $url , '/')), FILTER_SANITIZE_URL);
    }
}