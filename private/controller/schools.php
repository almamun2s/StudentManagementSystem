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

        $this->view('schools', ['schools' => $data]);
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
                echo '<pre>';
                var_dump($errors);
                echo '</pre>';
            }
        }

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
                $errors = $school->errors;
                echo '<pre>';
                var_dump($errors);
                echo '</pre>';
            }
        }
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
}