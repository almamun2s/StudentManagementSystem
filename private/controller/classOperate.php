<?php
/**
 * Class Operate Controller
 * This controller does not show anything. So I should not add the index() method here.
 */

 class ClassOperate extends Controller{

    /**
     * Inserts lecturers information to class_lecturers table
     *
     */
    public function selectLecturer(){
        if (!Auth::is_logged_in()) {
            $this->redirect('login');
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
                $class_details = new Class_details('lecturers');

                $arr['user_id']     = $user_id;
                $arr['class_id']    = $class_id;

                $checkLect  = $class_details->run('select * from class_lecturers where user_id = :user_id and class_id = :class_id ', $arr );

                if ( !$checkLect) {
                    $class_details->insert($arr);
                    $this->redirect('schools/singleClass/'.$class_id);
                }else {
                    die('403 User is already in the class ');
                }

            }else{
                die('403 Unauthorized access');
            }

        }
    }

    /**
     * Removes lecturers information to class_lecturers table
     *
     */
    public function removeLecturer(){
        $user_id    = $_POST['user_id'];
        $class_id   = $_POST['class_id'];

        $class_details = new Class_details('lecturers');
        $class_details->run('delete from class_lecturers where class_id = :class_id and user_id = :user_id', ['user_id' => $user_id, 'class_id' => $class_id ] );
        $this->redirect('schools/singleClass/'.$class_id);
    }
    
 }