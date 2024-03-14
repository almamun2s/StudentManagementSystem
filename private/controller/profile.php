<?php 
/**
 * Profile Controller
 */
class Profile extends Controller{
    public function index( $user_id = '' ){
        $tab = isset($_GET['tab']) ? $_GET['tab'] : 'info';
        if (!Auth::is_logged_in()) {
            // if user is not logged in 
            $this->redirect('login');
        }
        if ($user_id == '') {
            // If user visits his/her own profile
            $user = Auth::user();
        }elseif($user_id == Auth::user()->user_id ){
            // If user visits his/her own profile but with user_id 
            $this->redirect('profile?tab='. $tab);
        }else{
            // If user visits others profile
            $user = new User();
            $user = $user->where('user_id', $user_id);
            if (!$user) {
                // If user gives wrong user_id 
                $this->redirect('error');
            }else{
                $user = $user[0];
            }
        }
        $presentSchool = $this->findSchoolName($user->school_id);

        $allClass = [];
        if ($tab == 'class') {
            if ($user->role == 'student') {
                $classes = new Class_details('students');
            }else{
                $classes = new Class_details('lecturers');
            }

            $query = "select * from $classes->table where user_id = :user_id and disabled = 0 ";
            $classes =  $classes->run($query, ['user_id' => $user_id ]);
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

    /**
     * Profile edit function
     *
     * @param string $user_id
     */
    public function edit( $user_id = '' ){
        if (!Auth::is_logged_in()) {
            // if user is not logged in 
            $this->redirect('login');
        }

        if ($user_id == '') {
            $this->redirect('error');
        }else{
            // If user visits others profile
            $user = new User();
            $theUser = $user->where('user_id', $user_id);
            if (!$theUser) {
                // If user gives wrong user_id 
                $this->redirect('error');
            }
            $theUser = $theUser[0];
        }

        if ((!Auth::access('reception')) && (!Auth::is_owner($theUser))) {
            $this->redirect('errors');
        }
        if (($theUser->role == 'admin') ) {
            if ((!Auth::access('super')) && (!Auth::is_owner($theUser)) ) {
                $this->redirect('errors');
            }
        }
        if (($theUser->role  == 'super') && (!Auth::is_owner(($theUser)))) {
            $this->redirect('errors');
        }


        if (count($_POST) > 0 ) {
            if (trim($_POST['password']) == '' )  {
                unset($_POST['password']);
                unset($_POST['password2']);
            }
            if($user->validate($_POST, $theUser[0]->id )){
                if ($_FILES > 0 ) {
                    $allowedFileType = ['image/jpg', 'image/jpeg', 'image/png' ];
                    if (($_FILES['image']['error'] == 0) && (in_array($_FILES['image']['type'], $allowedFileType ))) {
                        $folder = 'assets/uploads/';
                        if (!file_exists($folder)) {
                            mkdir($folder, 0777, true );
                        }
                        $destination = $folder . $_FILES['image']['name'];
                        move_uploaded_file($_FILES['image']['tmp_name'], $destination );
                        $_POST['profile_pic'] = $_FILES['image']['name'];
                    }
                }

                if ( ($_POST['role'] == 'super') && Auth::user()->role != 'super' ) {
                    $_POST['role'] = 'admin';
                }
                $user->update($theUser[0]->id, $_POST );
                $this->redirect('profile/edit/'.$user_id);
            }
        }
        $errors= $user->errors;

        $this->view('profile/profile_edit', [
            'user'      => $theUser,
            'errors'    => $errors,

        ]);
    }
}