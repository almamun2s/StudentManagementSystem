<?php 
/**
 * User Model
 */

class User extends Model{

    /**
     * These are the column name of table that are allowed for editing or adding data.
     *
     * @var array
     */
    protected $allowedColumn = [
        'fname', 
        'lname', 
        'email',
        'gender',
        'role',
        'password'
    ];

    /**
     * Before inserting data to table these function will be called
     *
     * @var array
     */
    protected $beforeInsert = [
        'make_user_id', 
        'make_school_id', 
        'make_hash_password',
        'make_date'
    ];

    /**
     * Validates data for inserting or updating to table
     *
     * @param array $data
     * @return boolean
     */
    public function validate(array $data){
        $this->errors = array();

        // Check first name 
        if ( empty($data['fname']) ) {
            $this->errors['fname'] = 'The First Name cannot be empty';
        }elseif ( !preg_match('/^[a-zA-Z]+$/', $data['fname'] ) ) {
            $this->errors['fname'] = 'Only letters are allowed';
        }

        // Check last name 
        if ( empty($data['lname']) ) {
            $this->errors['lname'] = 'The Last Name cannot be empty';
        }elseif ( !preg_match('/^[a-zA-Z]+$/', $data['lname'] ) ) {
            $this->errors['lname'] = 'Only letters are allowed';
        }
        
        // Check Email
        if ( empty($data['email'])) {
            $this->errors['email'] = 'Email cannot be empty';
        }elseif ( !filter_var( $data['email'] , FILTER_VALIDATE_EMAIL)) {
            $this->errors['email'] = 'Email is not valid';
        }elseif( $this->where('email', $data['email'])){
            $this->errors['email'] = 'This email is already exists';
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


    /**
     * Creates a user_id by using user's firstname and lastname
     *
     * @param array $data
     * @return array
     */
    public function make_user_id($data){
        $data['user_id'] = strtolower($data['fname'].'.'.$data['lname']);
        while ($this->where('user_id', $data['user_id']) ) {
            $data['user_id'] .= rand(10, 99);
        }
        return $data;
    }

    /**
     * keeps the logged in user's school_id to the table called users 
     *
     * @param array $data
     * @return array
     */
    public function make_school_id($data){
        if ( isset($_SESSION['user']->school_id )) {
            $data['school_id'] = $_SESSION['user']->school_id;
        }
        return $data;
    }

    /**
     * Making the password hash
     *
     * @param array $data
     * @return array
     */
    public function make_hash_password($data){
        
        $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT );
        return $data;
    }
    
    /**
     * Creates date for table called users
     *
     * @param array $date
     * @return array
     */
    public function make_date($date){
        $date['date'] = date('Y-m-d h:i:s');
        return $date;
    }

 }