<?php 
/**
 * User Model
 */

 class User extends Model{
    public function validate(array $data){
        $this->errors = array();

        // Check first name 
        if ( empty($data['fname']) ) {
            $this->errors['fname'] = 'The First Name cannot be empty';
        }elseif ( !preg_match('/^[a-zA-Z0-9]+$/', $data['fname'] ) ) {
            $this->errors['fname'] = 'Only letters and numbers are allowed';
        }

        // Check last name 
        if ( empty($data['lname']) ) {
            $this->errors['lname'] = 'The Last Name cannot be empty';
        }elseif ( !preg_match('/^[a-zA-Z0-9]+$/', $data['lname'] ) ) {
            $this->errors['lname'] = 'Only letters and numbers are allowed';
        }
        
        // Check Email
        if ( empty($data['email'])) {
            $this->errors['email'] = 'Email cannot be empty';
        }elseif ( !filter_var( $data['email'] , FILTER_VALIDATE_EMAIL)) {
            $this->errors['email'] = 'Email is not valid';
        }
        
        // Check Gender
        $gender = ['male', 'female'];
        if ( empty($data['gender'])) {
            $this->errors['gender'] = 'Please Select Gender';
        }elseif ( !in_array($data['gender'], $gender)) {
            $this->errors['gender'] = 'Gender is not valid';
        }
        
        // Check Role
        $role = ['student', 'reception', 'lecturer', 'admin', 'super'];
        if ( empty($data['role'])) {
            $this->errors['role'] = 'Please select Role';
        }elseif ( !in_array($data['role'], $role)) {
            $this->errors['role'] = 'Role is not valid';
        }

        // Check for Password
        if (empty($data['password'])) {
            $this->errors['password'] = 'Password cannot be empty';
        }elseif ( strlen($data['password']) < 8 ) {
            $this->errors['password'] = 'Password must at least 8 charactor';
        }elseif ( $data['password'] !== $data['password2'] ) {
            $this->errors['password'] = 'Password did not match';
        }

        if (count($this->errors) == 0 ) {
            return true;
        }
        return false;
    }
 }