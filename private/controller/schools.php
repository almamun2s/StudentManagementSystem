<?php 
/**
 * Schools Controller
 */
class Schools extends Controller{
    public function index(){
        if (!Auth::is_logged_in()) {
            $this->redirect('login');
        }
        $school = new School();
        $data   = $school->findAll();

        $this->view('schools', [
            'schools' => $data,
            'errors'    => []
        ]);
    }

    public function add(){
        if (!Auth::is_logged_in()) {
            $this->redirect('login');
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


    public function edit(){
        if (!Auth::is_logged_in()) {
            $this->redirect('login');
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

    public function delete(){
        if (!Auth::is_logged_in()) {
            $this->redirect('login');
        }
        
        if (count($_POST) > 0) {
            $school = new School();

            $school->delete($_POST['id']);
            $this->redirect('schools');

        }
    }

    public function switch(){
        if (!Auth::is_logged_in()) {
            $this->redirect('login');
        }
        if (Auth::user()->role != 'super') {

            die('403 unauthorized access');

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


    public function classAdd(){
        if (!Auth::is_logged_in()) {
            $this->redirect('login');
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

    public function classEdit(){
        if (!Auth::is_logged_in()) {
            $this->redirect('login');
        }
        $errors = array();

        if (count($_POST) > 0) {
            $class = new Classes();
            if ($class->validate($_POST)) {
                $arr['class_name']   = $_POST['class_name'];
                $class->update($_POST['id'], $arr);
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

    public function classDelete(){
        if (!Auth::is_logged_in()) {
            $this->redirect('login');
        }
        
        if (count($_POST) > 0) {
            $classes = new Classes();

            $classes->delete($_POST['id']);
            $this->redirect('schools/class');

        }
    }


    public function singleClass(string $class_id){
        $class  = new Classes();
        $class  = $class->where('class_id', $class_id);
        $class  = $class[0];

        $tab = isset($_GET['tab']) ? $_GET['tab'] : 'lecturers';
        $this->view('singleClass', [
            'class' => $class,
            'user'  => $class->user_id,
            'tab'   => $tab
        ]);
    }
}