<?php

/**
 * School model
 */

class Classes extends Model{

    protected $table = 'class';
    protected $allowedColumn = [
        'class_name', 
    ];
    protected $beforeInsert = [
        'make_user_id', 
        'make_school_id',
        'make_class_id',
        'make_date'
    ];
    protected $afterSelect = [
        'get_user'
    ];

    public function validate(array $data){
        $this->errors = array();

        // Check Class name 
        if ( empty($data['class_name']) ) {
            $this->errors['class_name'] = 'Class Name cannot be empty';
        }elseif ( !preg_match('/^[a-zA-Z]+$/', $data['class_name'] ) ) {
            $this->errors['class_name'] = 'Only letters are allowed';
        }

        if (count($this->errors) == 0 ) {
            return true;
        }
        return false;
    }


    public function make_user_id($data){

        $data['user_id'] = Auth::user()->user_id;
        return $data;
    }

    public function make_school_id($data){
        $data['school_id'] = Auth::user()->school_id;
        return $data;
    }

    public function make_class_id($data){
        $data['class_id'] = random_string(60);
        return $data;
    }
    
    public function make_date($date){
        $date['date'] = date('Y-m-d h:i:s');
        return $date;
    }

    public function get_user($data){


        $user = new User();

        foreach ($data as $key => $value) {
            $result = $user->where('user_id', $value->user_id);
            $data[$key]->user_id = $result[0];

        }

        return $data;
    }
}