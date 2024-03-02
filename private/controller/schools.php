<?php 
/**
 * Schools Controller
 */
class Schools extends Controller{
    public function index(){

        $school = new School();
        $data   = $school->findAll();

        $this->view('schools', ['schools' => $data]);
    }
}