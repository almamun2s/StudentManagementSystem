<?php 
class App{
    /**
     * Default Controller
     *
     * @var string
     */
    protected $controller = 'home';

    /**
     * Default method
     *
     * @var string
     */
    protected $method = 'index';

    /**
     * Parameters in methods
     *
     * @var array
     */
    protected $params =  array();

    /**
     * App construct function
     */
    public function __construct(){
        $URL = $this->getURL();

        // Put the first item of the url as controller
        $controllerFile = 'private/controller/'. $URL[0].'.php';
        if (file_exists($controllerFile)) {
            $this->controller = $URL[0];
            unset($URL[0]);

            // Include the controller file 
            require_once "private/controller/$this->controller.php";
            $this->controller = new $this->controller;

        }else {
            header('location:'.ROOT.'errors');
            exit;
        }

        // Put the second item of the url as method of the controller
        if (isset($URL[1])) {
            if (method_exists($this->controller, $URL[1])) {
                $this->method = $URL[1];
                unset($URL[1]);
            }
        }

        $URL = array_values($URL);
        $this->params = $URL;

        // Call the method of controller
        call_user_func_array([$this->controller, $this->method], $this->params);

    }

    /**
     * This method will return the url through $_GET['url'].
     * The url is defined in .htaccess file
     *
     * @return mixed
     */
    protected function getURL(){

        $url = isset($_GET['url']) ? $_GET['url'] : 'home';
        return explode('/', filter_var(trim( $url , '/')), FILTER_SANITIZE_URL);
    }
}