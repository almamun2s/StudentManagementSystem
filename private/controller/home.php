<?php 
/**
 * Home Controller
 */
class Home extends Controller{
    public function index(){
        $db = new Database();
        $data = $db->run("select * from users");

        $this->view('home', ['row' => $data]);
    }
}