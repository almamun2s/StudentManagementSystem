<?php
/**
 * School model
 */

class Test extends Model{

    /**
     * These are the column name of table that are allowed for editing or adding data.
     *
     * @var array
     */
    protected $allowedColumn = [
        'test_title',
        'description',
        'disabled',
        'class_id'
    ];

    /**
     * Before inserting data to table these function will be called
     *
     * @var array
     */
    protected $beforeInsert = [
        'make_test_id',
        'make_user_id', 
        'make_school_id', 
        'make_date'
    ];

    /**
     * After Selecting data from table these function will be called
     *
     * @var array
     */
    protected $afterSelect = [
        'get_user'
    ];

    /**
     * Validates data for inserting or updating to table
     *
     * @param array $data
     * @return boolean
     */
    public function validate(array $data){
        $this->errors = array();

        // Check school name 
        if ( empty($data['test_title']) ) {
            $this->errors['test_title'] = 'School Name cannot be empty';
        }elseif ( !preg_match('/^[a-zA-Z0-9 ]+$/', $data['test_title'] ) ) {
            $this->errors['test_title'] = 'Only letters and numbers are allowed';
        }

        if (count($this->errors) == 0 ) {
            return true;
        }
        return false;
    }

    /**
     * Keeps the logged in user's user_id to the table called class 
     *
     * @param array $data
     * @return array
     */
    public function make_user_id($data){

        $data['user_id'] = Auth::user()->user_id;
        return $data;
    }

    /**
     * Creates test_id for tests
     *
     * @param array $data
     * @return array
     */
    public function make_test_id($data){
        $data['test_id'] = random_string(60);
        return $data;
    }

    /**
     * Creates school_id for school table
     *
     * @param array $data
     * @return array
     */
    public function make_school_id($data){
        $data['school_id'] = Auth::user()->school_id;
        return $data;
    }
    
    /**
     * Creates date for table called class
     *
     * @param array $date
     * @return array
     */
    public function make_date($date){
        $date['date'] = date('Y-m-d h:i:s');
        return $date;
    }

    /**
     * Gets information users who own the school
     *
     * @param array $data
     * @return array
     */
    public function get_user($data){

        $user = new User();

        foreach ($data as $key => $value) {
            $result = $user->where('user_id', $value->user_id);
            $data[$key]->user_id = $result[0];

        }

        return $data;
    }
}