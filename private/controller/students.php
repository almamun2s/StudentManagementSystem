<?php 
/**
 * Students Controller
 */
class Students extends Controller{
    public function index($id = null){
        echo 'This is Students controller '. $id ;
    }
}