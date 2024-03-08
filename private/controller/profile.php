<?php 
/**
 * Profile Controller
 */
class Profile extends Controller{
    public function index( $user_id = '' ){
        if (!Auth::is_logged_in()) {
            $this->redirect('login');
        }
        if ($user_id == '') {
            $user = Auth::user();
        }else{
            $user = new User();
            $user = $user->where('user_id', $user_id);
            if (!$user) {
                $this->redirect('error');
            }else{
                $user = $user[0];
            }
        }
        $presentSchool = $this->findSchoolName($user->school_id);

        $tab = isset($_GET['tab']) ? $_GET['tab'] : 'info';
        $allClass = [];
        if ($tab == 'class') {
            if ($user->role == 'student') {
                $classes = new Class_details('students');
            }elseif ($user->role == 'lecturer') {
                $classes = new Class_details('lecturers');
            }else{
                $this->redirect('errors/403');
            }
            $classes = $classes->where('user_id', $user->user_id );
            if ($classes) {
                foreach ($classes as $class) {
                    $singleClass = new Classes();
                    $singleClass = $singleClass->where('class_id', $class->class_id );
                    $allClass = array_merge($allClass , $singleClass );
                }
            }
        }
        $this->view('profile',[
            'school'    => $presentSchool,
            'user'      => $user,
            'tab'       => $tab ,
            'classes'   => $allClass
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