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

    public function insert(array $data){
        $keys       = array_keys($data);
        $columns    = implode( ', ', $keys);
        $values     = implode(', :', $keys);

        $query = "INSERT into $this->table ($columns)  values( :$values ) ";
        return $this->run($query, $data);
    }

    public function update( int $id, array $data){
        // $keys       = array_keys($data);
        
        $setData = '';
        foreach ($data as $key => $value) {
            $setData .= $key. " = :" .$key .', ';
        }
        $setData = trim($setData , ", ");
        $data['id'] = $id;

        $query = "UPDATE $this->table SET  $setData WHERE id = :id";

        return $this->run($query, $data);
    }
}