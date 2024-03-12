<?php 
/**
 *  Main Model class 
 */
class Model extends Database{
    public $errors = array();

    /**
     * Checks if table was assinged. If not it will assign the table as Model then s example models.
     */
    public function __construct(){
        if ( !property_exists($this, 'table')) {
            $this->table = strtolower($this::class) . 's';
        }
    }

    /**
     * After Selecting Data these function will be execute
     *
     * @param array|boolean $data
     * @return array
     */
    private function afterSelectData($data){

        if (is_array($data)) {
            if ( property_exists($this, 'afterSelect' )) {
                foreach ($this->afterSelect as $func) {
                    $data = $this->$func($data);
                }
            }
        }
        return $data;
    }

    /**
     * Select data from DataBase using table column
     *
     * @param string $column make sure that your table has the column  
     * @param string|integer $value write the value you are looking for
     * @return array|boolean
     */
    public function where( $column, $value){

        $column = addslashes($column);
        $query = 'select * from '. $this->table .' where '.$column.' = :value ';
        $data = $this->run($query, [
            'value'     => $value
        ]);

        $this->afterSelectData($data);

        return $data;

    }

    /**
     * Selects all data from a specific table. Basically models table
     *
     * @param string $order order can be asc and desc
     * @return array|boolean
     */
    public function findAll( $order = 'asc'){

        $query = 'select * from '. $this->table . ' order by id ' . $order ;
        $data = $this->run($query);

        $this->afterSelectData($data);
        
        return $data;
    }

    /**
     * inserts data into a specific table. Basically models table
     *
     * @param array $data
     * @return object|array|boolean
     */
    public function insert($data){

        // Check for allowed column
        if ( property_exists($this, 'allowedColumn' )) {
            
            foreach ($data as $key => $column) {
                if ( !in_array($key, $this->allowedColumn )) {
                    // Remove the column if it is not allowed for editing
                    unset($data[$key]);
                }
            }
        }

        if ( property_exists($this, 'beforeInsert' )) {
            
            foreach ($this->beforeInsert as $func) {
                $data = $this->$func($data);
            }
        }

        $keys       = array_keys($data);
        $columns    = implode( ', ', $keys);
        $values     = implode(', :', $keys);

        $query = "INSERT into $this->table ($columns)  values( :$values ) ";
        return $this->run($query, $data);
    }

    /**
     * Updates models table by id.
     *
     * @param integer|string $id
     * @param array $data
     * @param string $columnName
     * @return array|boolean
     */
    public function update( $id, $data, $columnName = 'id' ){
        // Check for allowed column
        if ( property_exists($this, 'allowedColumn' )) {
    
            foreach ($data as $key => $column) {
                if ( !in_array($key, $this->allowedColumn )) {
                    // Remove the column if it is not allowed for editing
                    unset($data[$key]);
                }
            }
        }

        if ( property_exists($this, 'beforeUpdate' )) {
            
            foreach ($this->beforeUpdate as $func) {
                $data = $this->$func($data);
            }
        }

        $setData = '';
        foreach ($data as $key => $value) {
            $setData .= $key. " = :" .$key .', ';
        }
        $setData = trim($setData , ", ");
        $data[$columnName] = $id ;

        $query = "UPDATE $this->table SET  $setData WHERE $columnName = :$columnName ";

        return $this->run($query, $data);
    }

    /**
     * Deletes data from table
     *
     * @param integer $id
     * @return array|boolean
     */
    public function delete( $id){
        $query = "DELETE FROM $this->table WHERE id = :id";
        return $this->run($query, ['id' => $id]);
    }
}