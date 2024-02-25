<?php 
/**
 * Students Controller
 */
class Students extends Controller{
    public function index($id = null){
        echo $this->view('student');
    }
}