<?php 
/**
 * User Model
 */

 class User extends Model{
    public function validate(array $data){
        $this->errors = array();

        // Check first name 
        if ($data['fname'] == '') {
            $this->errors['fname'] = 'The First Name cannot be empty';
        }
        // Check last name 
        if ($data['lname'] == '') {
            $this->errors['lname'] = 'The Last Name cannot be empty';
        }

        if (count($this->errors) == 0 ) {
            return true;
        }
        return false;
    }
 }