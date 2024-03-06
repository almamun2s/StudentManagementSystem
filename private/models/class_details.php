<?php
/**
 * Class Details model
 */

 class Class_details extends Model{

    /**
     * The Table name of DataBase for this model
     *
     * @var string
     */
    protected $table;

    /**
     * These are the column name of table that are allowed for editing or adding data.
     *
     * @var array
     */
    protected $allowedColumn = [
        'user_id',
        'class_id'
    ];

    /**
     * Before inserting data to table these function will be called
     *
     * @var array
     */
    protected $beforeInsert = [
        'make_school_id',
        'make_date'
    ];

    /**
     * This is Class Details Model that intracts with some table
     *
     * @param string $tableExt write the extension of DataBase which starts with class_ 
     */
    public function __construct(string $tableExt){
        $this->table = 'class_'.$tableExt;
    }


    /**
     * keeps the logged in user's school_id to the table
     *
     * @param array $data
     * @return array
     */
    public function make_school_id($data){
        $data['school_id'] = Auth::user()->school_id;
        return $data;
    }

    /**
     * Creates date for table
     *
     * @param array $date
     * @return array
     */
    public function make_date($date){
        $date['date'] = date('Y-m-d h:i:s');
        return $date;
    }

 }