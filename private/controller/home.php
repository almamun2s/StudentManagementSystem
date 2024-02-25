<?php 
/**
 * Home Controller
 */
class Home extends Controller{
    public function index(){
        echo $this->view('home');
    }
}