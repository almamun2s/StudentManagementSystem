<?php 
/**
 * Home Controller
 */
class Home extends Controller{
    public function index(){
        // $db = new Database();
        // $data = $db->run("select * from users");
        // $user = $this->load_models('User');
        // $data = $user->where('user_id', 'ta' );

        $user = new User();
        
        $arr["fname"]   = "John";
        $arr["lname"]   = "Doe";
        $arr["user_id"] = "john";
        $arr["gender"]  = "male";
        $arr["school_id"]= "1";
        $arr["role"]    = "student";

        // $user->insert($arr);
        $data = $user->findAll();

        $this->view('home', ['row' => $data]);
    }
}