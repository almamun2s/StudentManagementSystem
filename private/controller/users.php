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
        $data = $user->where('school_id', Auth::user()->school_id );

        $this->view('staffs', [
            'users' => $data
        ]);
    }
 }