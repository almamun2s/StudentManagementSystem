<?php 
/**
 * Signup Controller
 */
class Signup extends Controller{
    public function index(){
        if (!Auth::access('reception')) {
            $this->redirect('errors/403');
        }

        $errors = array();

        if (count($_POST) > 0) {
            if ($_POST['role'] == 'admin') {
                if (!Auth::access('admin')) {
                    $this->redirect('errors/403');
                }
            }elseif( $_POST['role'] == 'super' ){
                if (!Auth::access('super')) {
                    $this->redirect('errors/403');
                }
            }
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
                if ($_POST['mode'] == 'student') {
                    $this->redirect('users/students');
                }
                $this->redirect('users'); 
            }else{
                $errors = $user->errors;
            }
        }
    
        $mode = isset($_GET['mode']) ? $_GET['mode'] : 'staff';
        $this->view('signup', [
            'errors'    => $errors,
            'mode'      => $mode
        ]);

    }
}