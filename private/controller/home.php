<?php 
/**
 * Home Controller
 */
class Home extends Controller{
    public function index(){

        $user = new User();
        
        $arr["fname"]   = "Jane";
        $arr["lname"]   = "Dane";
        // $arr["user_id"] = "john";
        $arr["gender"]  = "female";
        // $arr["school_id"]= "1";
        // $arr["role"]    = "student";

        // $user->update(5, $arr);
        // $user->delete(10);
        $data = $user->findAll();

        $this->view('home', ['row' => $data]);
    }
}