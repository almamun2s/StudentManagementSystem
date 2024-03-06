<?php 
/**
 * Profile Controller
 */
class Profile extends Controller{
    public function index(){
        if (!Auth::is_logged_in()) {
            $this->redirect('login');
        }
        $presentSchool = $this->findSchoolName(Auth::user()->school_id);
        $this->view('profile',[
            'school' => $presentSchool,
            'user'  => Auth::user()
            ]
        );
    }

    /**
     * This function is for logging out a logged in users  
     */
    public function logout(){
        Auth::logout();
        $this->redirect('login');
    }

    /**
     * For visiting others profile through profile
     * @param string $user_id
     */

    public function visit( $user_id){
        if ($user_id == Auth::user()->user_id) {
            $this->redirect('profile');
        }
        $user = new User();
        $user = $user->where('user_id', $user_id);
        if ($user) {   
            $user = $user[0];
            $presentSchool = $this->findSchoolName($user->school_id);
        }else{
            $presentSchool = 'not needed';
        }

        $this->view('profile',[
            'user' => $user,
            'school' => $presentSchool
            ]
        );
    }

    /**
     * Finging the school name from DataBase 
     *
     * @param string|null $school_id
     * @return object|bool
     */
    private function findSchoolName(string|null $school_id){
        $presentSchool = (object)array();
        if ( $school_id != null ) {
            $school = new School();
            $presentSchool = $school->where('school_id', $school_id );
            
            return $presentSchool[0];
        }else {
            $presentSchool->school_name = 'Unknown';
            return $presentSchool;
        }
    }
}