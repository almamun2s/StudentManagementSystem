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
        
        $arr["fname"]   = "Jane";
        $arr["lname"]   = "Dane";
        // $arr["user_id"] = "john";
        $arr["gender"]  = "female";
        // $arr["school_id"]= "1";
        // $arr["role"]    = "student";

        $user->update(5, $arr);
        $data = $user->findAll();

        $this->view('home', ['row' => $data]);
    }
}