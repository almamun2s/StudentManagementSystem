<?php 
/**
 * Profile Controller
 */
class Profile extends Controller{
    public function index(){
        if (!Auth::is_logged_in()) {
            $this->redirect('login');
        }
        $this->view('profile');
    }

    public function logout(){
        Auth::logout();
        $this->redirect('login');
    }
}