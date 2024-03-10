<?php 
/**
 * Schools Controller
 */
class Schools extends Controller{
    public function index(){
        if (!Auth::is_logged_in()) {
            $this->redirect('login');
        }
        if(!Auth::access('admin')){
            $this->redirect('errors/404');
        }
        $school = new School();
        $data   = $school->findAll();

        $this->view('schools', [
            'schools' => $data,
            'errors'    => []
        ]);
    }

    /**
     * Adding Schools
     */
    public function add(){
        if (!Auth::is_logged_in()) {
            $this->redirect('login');
        }
        if(!Auth::access('admin')){
            $this->redirect('errors/403');
        }
        $errors = array();

        if (count($_POST) > 0) {
            $school = new School();
            if ($school->validate($_POST)) {

                $arr['school_name']   = $_POST['school_name'];

                $school->insert($arr);
                $this->redirect('schools');
            }else{
                $errors = $school->errors;
                $data   = $school->findAll();
            }
        }

        $this->view('schools', [
            'schools'   => $data,
            'errors'    => $errors 
        ]);


    }


    /**
     * Editing school
     */
    public function edit(){
        if (!Auth::is_logged_in()) {
            $this->redirect('login');
        }
        if(!Auth::access('admin')){
            $this->redirect('errors/403');
        }
        $errors = array();

        if (count($_POST) > 0) {
            $school = new School();
            if ($school->validate($_POST)) {
                $arr['school_name']   = $_POST['school_name'];
                $school->update($_POST['id'], $arr);
                $this->redirect('schools');
            }else{
                $data   = $school->findAll();
                $errors = $school->errors;
            }
        }
        $this->view('schools', [
            'schools'   => $data,
            'errors'    => $errors 
        ]);
    }

    /**
     * Deleting school 
     */
    public function delete(){
        if (!Auth::is_logged_in()) {
            $this->redirect('login');
        }
        if(!Auth::access('admin')){
            $this->redirect('errors/403');
        }
        
        if (count($_POST) > 0) {
            $school = new School();

            $school->delete($_POST['id']);
            $this->redirect('schools');

        }
    }

    /**
     * Switching between schools for super admins
     */
    public function switch(){
        if (!Auth::is_logged_in()) {
            $this->redirect('login');
        }
        if(!Auth::access('admin')){
            $this->redirect('errors/403');
        }
        
        if (count($_POST) > 0) {
            $user = new User();

            $arr['school_id'] = $_POST['school_id'];

            $user->update(Auth::user()->id, $arr );
            $_SESSION['user']->school_id = $_POST['school_id'];

            $this->redirect('schools');

        }
    }


    /**
     * These methods are for classes functionality 
     */
    public function class(){
        if (!Auth::is_logged_in()) {
            $this->redirect('login');
        }
        $errors = array();

        $classes    = new Classes();
        $data       = $classes->where('school_id', Auth::user()->school_id );

        $this->view('class', [
            'classes'   => $data,
            'errors'    => $errors
        ]);    }


    /**
     * Adding class
     */
    public function classAdd(){
        if (!Auth::is_logged_in()) {
            $this->redirect('login');
        }
        if(!Auth::access('lecturer')){
            $this->redirect('errors/403');
        }
        $errors = array();

        if (count($_POST) > 0) {
            $class = new Classes();
            if ($class->validate($_POST)) {

                $arr['class_name']   = $_POST['class_name'];

                $class->insert($arr);
                $this->redirect('schools/class');
            }else{
                $data       = $class->where('school_id', Auth::user()->school_id );
                $errors = $class->errors;
            }
        }
        $this->view('class', [
            'classes'   => $data,
            'errors'    => $errors
        ]);
    }

    /**
     * Editing class
     */
    public function classEdit(){
        if (!Auth::is_logged_in()) {
            $this->redirect('login');
        }
        $errors = array();

        if (count($_POST) > 0) {
            $class = new Classes();
            $class_id = $_POST['id'];
            $myClass = $class->where('class_id', $class_id);
            $myClass = $myClass[0];

            if (!Auth::owner($myClass)) {
                $this->redirect('errors/403');
            }

            if ($class->validate($_POST)) {
                $arr['class_name']   = $_POST['class_name'];
                $class->update($class_id, $arr);
                $this->redirect('schools/class');
            }else{
                $data   = $class->where('school_id', Auth::user()->school_id );
                $errors = $class->errors;
            }
            $this->view('class', [
                'classes'   => $data,
                'errors'    => $errors
            ]);
        }
    }

    /**
     * Delete class
     */
    public function classDelete(){
        if (!Auth::is_logged_in()) {
            $this->redirect('login');
        }
        $class = new Classes();
        $class_id = $_POST['id'];
        $myClass = $class->where('id', $class_id);
        $myClass = $myClass[0];

        if (!Auth::owner($myClass->user_id)) {
            $this->redirect('errors/403');
        }
        if (count($_POST) > 0) {
            $classes = new Classes();

            $classes->delete($class_id);
            $this->redirect('schools/class');

        }
    }

    /**
     * To view single class
     *
     * @param string $class_id
     */
    public function singleClass(string $class_id){
        if (!Auth::is_logged_in()) {
            $this->redirect('login');
        }
        // Check if the current class is belongs to current school
        $class    = new Classes();
        $data     = $class->where('school_id', Auth::user()->school_id );

        $haveClass = false;
        if ($data) {   
            foreach ($data as $singleClass ) {
                if ($singleClass->class_id == $class_id) {
                    $haveClass = true;
                    break;
                }
            }
        }
        if ($haveClass) {
            $class  = $class->where('class_id', $class_id);
            $class  = $class[0];

            $tab = isset($_GET['tab']) ? $_GET['tab'] : 'lecturers';
            $_GET['select'] = true;

            if ($tab == 'lecturers') {
                $class_details = new Class_details('lecturers');
                $query  = "select * from class_lecturers where class_id = :class_id and disabled = 0";
                $class_details = $class_details->run($query, ['class_id' => $class_id ]);


            }elseif ($tab == 'students') {
                $class_details = new Class_details('students');
                $query  = "select * from class_students where class_id = :class_id and disabled = 0";
                $class_details = $class_details->run($query, ['class_id' => $class_id ]);

            }

            $allUsers = [];
            $users = new User();
            if ($class_details) {   
                foreach ($class_details as $class_detail) {
                    $user = $users->where('user_id', $class_detail->user_id);
                    
                    $allUsers = array_merge($allUsers, $user);
                }
            }


            $this->view('singleClass', [
                'class' => $class,
                'user'  => $class->user_id,
                'tab'   => $tab,
                'users' => $allUsers
            ]);
        }else{
            $this->view('singleClass', [
                'class' => false,
            ]);
        }


    }

    /**
     * This function handles some AJAX request
     *
     */
    public function searchLecturers(){
        if (count($_POST) > 0) {
            $search         = trim($_POST['search']);
            $user_type      = $_POST['userType'];
            $_GET['select'] = true;

            if (!empty($search)) {
                
                if ($user_type == 'lecturer') {
                    $operator = '!=';
                }elseif ($user_type == 'student') {
                    $operator = '=';
                }else{
                    $this->redirect('errors/403');
                }
                $user = new User();
                $users = $user->run("select * from users where role $operator :role and school_id = :school_id and (fname like :fname  or lname like :lname)  limit 6", [ 'role' => 'student', 'school_id' => Auth::user()->school_id , 'fname' => '%'.$search.'%', 'lname' => '%'.$search.'%' ] );
                
                if($users){
                    echo '<h4 style="width:100%;text-align:center;">Click select lecturer to add in this class.</h4>';
                    foreach ($users as $user) {
                        echo '<div class="card m-2" style="max-width: 14rem;min-width: 14rem;">';
                        include view_path('includes/singleUser');
                        echo '</div>';
                    }
                }else{
                    echo '<h2>No lecturer found</h2>';
                }
            }else{
                echo '<h2>Please type something to search</h2>';
            }
        }else{
            echo 'Hello. No data faund by $_POST  ';
        }
    }
}