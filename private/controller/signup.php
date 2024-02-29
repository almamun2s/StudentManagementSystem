<?php 
/**
 * Signup Controller
 */
class Signup extends Controller{
    public function index(){

        $errors = array();

        if (count($_POST) > 0) {
            $user = new User();
            if ($user->validate($_POST)) {
                $this->redirect('login');                
            }else{
                $errors = $user->errors;
            }
        }
        // $this->redirect('');
        echo '<pre>';
        var_dump($errors);
        echo '</pre>';
    
        $this->view('signup', ['errors' => $errors ]);

    }
    // public function addUser(){

}