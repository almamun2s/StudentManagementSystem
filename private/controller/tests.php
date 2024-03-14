<?php
/**
 * Tests controller 
 */
class Tests extends Controller{
    // No index is needed for tests. Because it is already in schools controller 


    /**
     * Adding tests
     *
     */
    public function add(){
        if (!Auth::is_logged_in()) {
            $this->redirect('login');
        }
        if(!Auth::access('lecturer')){
            $this->redirect('errors/403');
        }
        $errors = array();

        if (count($_POST) > 0) {
            $test = new Test();
            if ($test->validate($_POST)) {

                $arr['test_title']  = $_POST['test_title'];
                $arr['description'] = $_POST['description'];
                $arr['class_id']    = $_POST['class_id'];

                $test->insert($arr);
                $this->redirect('schools/singleClass/'. $_POST['class_id']).'?tab=tests';
            }else{
                $errors = $test->errors;
            }
            
        }else{
            $this->redirect('errors/403');
        }

        $class    = new Classes();

        $class  = $class->where('class_id', $_POST['class_id']);
        $class  = $class[0];

        $tests = new Test();
        $tests = $tests->where('class_id', $class->class_id );

        $this->view('singleClass', [
            'class' => $class,
            'user'  => $class->user_id,
            'tab'   => 'tests',
            'tests' => $tests
        ]);
    }

}