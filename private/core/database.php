<?php
/**
 * Database Connection
 */

class Database{
    /**
     * Connection to Database
     *
     * @return PDO
     */
    private function connect(){
        $string = DBDRIVER.':host='.DBHOST.';dbname='.DBNAME;
        $conn = new PDO($string, DBUSER, DBPASS);

        if ( !$conn) {
            die("DB not connected");
        }

        return $conn;
    }

    /**
     * Runs any query to intract with DataBase
     *
     * @param string $query write the query properly to get proper result
     * @param array $data keep the data number is same as you given in the query placeholder 
     * @param string $data_type data type object and assoc array is availabe now 
     * @return array|boolean
     */
    public function run( $query , $data = array(), $data_type = 'object' ){
        $conn = $this->connect();
        $stmt = $conn->prepare($query);

        if ($stmt) {
            $check = $stmt->execute($data);

            if ($check) {
                if ($data_type == 'object') {
                    $data = $stmt->fetchAll(PDO::FETCH_OBJ);
                }else{
                    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
                }
                
                if (is_array($data) && (count($data) > 0)) {
                    return $data;
                }
            }
        }
        return false;
    }

}