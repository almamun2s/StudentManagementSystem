<?php

/**
 * Users Controller
 */

 class Users extends Controller{
    public function index(){
        if (!Auth::is_logged_in()) {
            $this->redirect('login');
        }
        $user = new User();
        $data = $user->run('select * from users where school_id = :school_id && role != :role ', ['school_id' => Auth::user()->school_id, 'role' => 'student']);

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
        $user = new User();
        $data = $user->run('select * from users where school_id = :school_id && role = :role ', ['school_id' => Auth::user()->school_id, 'role' => 'student']);

        $this->view('staffs', [
            'users' => $data,
            'mode'  => 'student'
        ]);
    }
 }