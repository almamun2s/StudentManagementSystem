<?php 
/**
 * Signup Controller
 */
class Signup extends Controller{
    public function index(){

        if (Auth::is_logged_in()) {
            $this->redirect('profile');
        }
        $errors = array();

        if (count($_POST) > 0) {
            $user = new User();
            if ($user->validate($_POST)) {

                $arr['fname']   = $_POST['fname'];
                $arr['lname']   = $_POST['lname'];
                $arr['email']   = $_POST['email'];
                $arr['gender']  = $_POST['gender'];
                $arr['role']    = $_POST['role'];
                $arr['password']= $_POST['password'];
                $arr['date']    = date('Y-m-d h:i:s');

                $user->insert($arr);
                $this->redirect('login');
            }else{
                $errors = $user->errors;
            }
        }
    
        $this->view('signup', ['errors' => $errors ]);

    }
}