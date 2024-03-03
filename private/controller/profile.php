<?php 
/**
 * Profile Controller
 */
class Profile extends Controller{
    public function index(){
        if (!Auth::is_logged_in()) {
            $this->redirect('login');
        }
        $presentSchool = (object)array();
        if (Auth::user()->school_id != null ) {
            $school = new School();
            $presentSchool = $school->where('school_id', Auth::user()->school_id );
            
            $presentSchool = $presentSchool[0];
        }else {
            $presentSchool->school_name = 'Unknown';
        }

        $this->view('profile',
            ['school' => $presentSchool]
        );
    }

    public function logout(){
        Auth::logout();
        $this->redirect('login');
    }
}