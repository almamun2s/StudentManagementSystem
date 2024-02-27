<?php 

/**
 *  Main Model class 
 */
class Model extends Database{
    protected $table = 'users';

    public function where( string $column, string|int $value){
        $query = 'select * from '. $this->table .' where :colume = :value ';
        
        return $this->run($query, [
            'column'    => $column,
            'value'     => $value
        ]);
    }
}