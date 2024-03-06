<?php
/**
 * Database Connection
 */

class Database{
    private function connect(){
        $string = DBDRIVER.':host='.DBHOST.';dbname='.DBNAME;
        $conn = new PDO($string, DBUSER, DBPASS);

        if ( !$conn) {
            die("DB not connected");
        }

        return $conn;
    }

    public function run(string $query , array $data = array(), string $data_type = 'object' ):array|bool{
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