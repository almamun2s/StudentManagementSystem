<?php
/**
 * Class Operate Controller
 * This controller does not show anything. So I should not add the index() method here.
 */

 class ClassOperate extends Controller{

    /**
     * Inserts lecturers information to class_lecturers table
     * @param string $selectLecturerType
     */
    public function selectLecturer( $selectLecturerType ){
        if (!Auth::is_logged_in()) {
            $this->redirect('login');
        }
        if (!Auth::access('reception')) {
            $this->redirect('errors/403');
        }
        if ( count($_POST) > 0 ) {
            $user_id    = $_POST['user_id'];
            $class_id   = $_POST['class_id'];

            $user = new User();
            $user = $user->where('user_id', $user_id)[0];

            // // Check if the current user is belongs to current class
            $class    = new Classes();
            $data     = $class->where('school_id', $user->school_id );

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
                if ($selectLecturerType == 'lecturer') {
                    $class_details = new Class_details('lecturers');
                    $table_name = 'class_lecturers';
                    $tab = 'lecturers';
                }elseif ($selectLecturerType == 'student') {
                    $class_details = new Class_details('students');
                    $table_name = 'class_students';
                    $tab = 'students';
                }else{
                    die('Something went wrong in '. __FILE__ .' at line '. __LINE__ );
                }

                $arr['user_id']     = $user_id;
                $arr['class_id']    = $class_id;

                $checkLect  = $class_details->run("select * from  $table_name  where user_id = :user_id and class_id = :class_id ", $arr );

                if ( !$checkLect) {
                    $class_details->insert($arr);
                    $this->redirect('schools/singleClass/'.$class_id.'?tab='.$tab);
                }else {
                    $this->redirect('errors/403');
                }

            }else{
                $this->redirect('errors/403');
            }

        }
    }

    /**
     * Removes lecturers information to class_lecturers table
     * @param string $removeUserType
     */
    public function removeLecturer( $removeUserType ){
        if (!Auth::is_logged_in()) {
            $this->redirect('login');
        }
        if (!Auth::access('reception')) {
            $this->redirect('errors/403');
        }
        
        $user_id    = $_POST['user_id'];
        $class_id   = $_POST['class_id'];

        if ( $removeUserType == 'lecturer' ) {
            $class_details = new Class_details('lecturers');
            $table_name = 'class_lecturers';
            $tab = 'lecturers';
        }elseif( $removeUserType == 'student' ) {
            $class_details = new Class_details('students');
            $table_name = 'class_students';
            $tab = 'students';
        }else{
            $this->redirect('errors/403');
        }


        $class_details->run("delete from  $table_name  where class_id = :class_id and user_id = :user_id", ['user_id' => $user_id, 'class_id' => $class_id ] );
        $this->redirect('schools/singleClass/'.$class_id.'?tab='.$tab);
    }
    
 }