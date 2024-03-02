<?php

/**
 * School model
 */

class School extends Model{
    protected $allowedColumn = [
        'school_name', 
    ];
    protected $beforeInsert = [
        'make_user_id', 
        'make_school_id', 
        'make_date'
    ];

    public function validate(array $data){
        $this->errors = array();

        // Check first name 
        if ( empty($data['school_name']) ) {
            $this->errors['school_name'] = 'School Name cannot be empty';
        }elseif ( !preg_match('/^[a-zA-Z]+$/', $data['school_name'] ) ) {
            $this->errors['school_name'] = 'Only letters are allowed';
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
        $data['school_id'] = random_string(60);
        return $data;
    }
    
    public function make_date($date){
        $date['date'] = date('Y-m-d h:i:s');
        return $date;
    }

}