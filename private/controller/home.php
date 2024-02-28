<?php 
/**
 * Home Controller
 */
class Home extends Controller{
    public function index(){
        // $db = new Database();
        // $data = $db->run("select * from users");
        $user = $this->load_models('User');
        // $data = $user->where('user_id', 'ta' );
        $data = $user->findAll();

        $this->view('home', ['row' => $data]);
    }
}