<?php 
/**
 * Login Controller
 */
class Login extends Controller{
    public function index(){

        if (Auth::is_logged_in()) {
            $this->redirect('profile');
        }

        $errors = array();

        if (count($_POST) > 0) {
            $user = new User();

            if ($row = $user->where('email', $_POST['email'])) {
                if ( count($row) != 1 ) {
                    $errors['email'] = 'Something went wrong.';
                }else {
                    
                    $row = $row[0];

                    if (password_verify($_POST['password'] , $row->password )) {

                        Auth::authenticate($row);
                        $this->redirect('profile');
                    }
                }
            }
            
            $errors['email'] = 'Email or password is incorrect.';

        }
        $this->view('login' , ['errors' => $errors ]);
    }
}