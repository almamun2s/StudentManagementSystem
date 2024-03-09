<?php
/**
 * Users Controller
 */

 class Users extends Controller{
    public function index(){
        if (!Auth::is_logged_in()) {
            $this->redirect('login');
        }
        if (!Auth::access('lecturer')) {
            $this->redirect('errors/404');
        }
        $user = new User();
        $query = 'select * from users where school_id = :school_id && role != :role order by id desc';
        $arr =  ['school_id' => Auth::user()->school_id, 'role' => 'student'];

        if (isset($_GET['find'])) {
            $find = '%'. $_GET['find'] . '%';
            $query = 'select * from users where school_id = :school_id && role != :role && ( fname like :find || lname like :find ) order by id desc';
            $arr =  ['school_id' => Auth::user()->school_id, 'role' => 'student', 'find' => $find ];
        }

        $data = $user->run( $query , $arr );

        $this->view('staffs', [
            'users' => $data,
            'mode'  => 'staff'
        ]);
    }

    // View for Students
    public function students(){
        if (!Auth::is_logged_in()) {
            $this->redirect('login');
        }
        if (!Auth::access('lecturer')) {
            $this->redirect('errors/404');
        }
        $user = new User();
        $query = 'select * from users where school_id = :school_id && role = :role order by id desc';
        $arr = ['school_id' => Auth::user()->school_id, 'role' => 'student'];

        if (isset($_GET['find'])) {
            $find = '%'. $_GET['find'] . '%';
            $query = 'select * from users where school_id = :school_id && role = :role && ( fname like :find || lname like :find ) order by id desc';
            $arr =  ['school_id' => Auth::user()->school_id, 'role' => 'student', 'find' => $find ];
        }

        $data = $user->run( $query , $arr );

        $this->view('staffs', [
            'users' => $data,
            'mode'  => 'student'
        ]);
    }
 }