<?php
/**
 * Classes model
 */

class Classes extends Model{

    /**
     * The Table name of DataBase for this model
     *
     * @var string
     */
    protected $table = 'class';


    /**
     * These are the column name of table that are allowed for editing or adding data.
     *
     * @var array
     */
    protected $allowedColumn = [
        'class_name', 
    ];


    /**
     * Before inserting data to table these function will be called
     *
     * @var array
     */
    protected $beforeInsert = [
        'make_user_id', 
        'make_school_id',
        'make_class_id',
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

        // Check Class name 
        if ( empty($data['class_name']) ) {
            $this->errors['class_name'] = 'Class Name cannot be empty';
        }elseif ( !preg_match('/^[a-zA-Z0-9 ]+$/', $data['class_name'] ) ) {
            $this->errors['class_name'] = 'Only letters and numbers are allowed';
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
     * keeps the logged in user's school_id to the table called class 
     *
     * @param array $data
     * @return array
     */
    public function make_school_id($data){
        $data['school_id'] = Auth::user()->school_id;
        return $data;
    }

    /**
     * Creates class_id for class table
     *
     * @param array $data
     * @return array
     */
    public function make_class_id($data){
        $data['class_id'] = random_string(60);
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
     * Gets information users who own the class
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