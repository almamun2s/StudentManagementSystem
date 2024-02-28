<?php 

/**
 *  Main Model class 
 */
class Model extends Database{

    public function __construct(){
        if ( !property_exists($this, 'table')) {
            $this->table = strtolower($this::class) . 's';
        }
    }
    public function where( string $column, string|int $value){

        $column = addslashes($column);
        $query = 'select * from '. $this->table .' where '.$column.' = :value ';
        return $this->run($query, [
            'value'     => $value
        ]);
    }

    public function findAll(){

        $query = 'select * from '. $this->table;
        return $this->run($query);
    }
}