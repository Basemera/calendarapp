<?php namespace App\Database;
// include_once(__DIR__ ."/../database.php");
require_once($_SERVER['DOCUMENT_ROOT'].'/database.php');
use PDOStatement;
// use PDOConfig;
use Exception;

// require_once('../../config.php');
// include_once("/../../database.php");
// include('../../database.php');

// include('/Users/phionabasemera/Documents/calendarapp/inviteapp/database.php');

class DatabaseConfig extends PDOStatement {
    private $connection;

        public function __construct()
        {
        }

        private function connection() {
            try {
                $this->connection = new \PDOConfig();
                $this->connection->setAttribute( \PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION );
    
                if($this->connection === false){
                    echo "ERROR: Could not connect. " . mysqli_connect_error();
                }
            } catch(\PDOException $e) {
                echo $e->getMessage();
                return $e->getMessage();
            }
            
            return $this->connection;
        }

        public function insert($query = "" , $params = [])
        {
            try {
                $stmt = $this->executeStatement($query, $params);
                // $result = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);               
                // $stmt->close();
                $this->connection = null;

    
                return $stmt;
            } catch(\Exception $e) {
                throw New Exception( $e->getMessage() );
            }
            return false;
        }

        public function select($query = "" , $params = [])
        {
            try {
                $stmt = $this->executeSelectStatement( $query , $params );
                // $result = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);               
                // $stmt->close();
                $this->connection = null;
                return $stmt;
            } catch(\Exception $e) {
                // throw New Exception( $e->getMessage() );
                return $e->getMessage();

            }
            return false;
        }

        private function executeStatement($query = "" , $params = [])
        {
            try {
                $stmt = $this->connection()->prepare( $query );
                
                if($stmt === false) {
                    throw New Exception("Unable to do prepared statement: " . $query);
                }
                if( $params ) {
                    $i = 1;
                    foreach($params as $param => $param_validator) { 
                        # code...
                        $stmt->bindValue($i, $param, $param_validator);
                        $i = $i + 1;
                    }
                }
            } catch(\Exception $e) {
                return $e->getMessage();
                // throw New Exception( "I failed here" );
            }
            try {
                $stmt->execute();

            } catch(\Exception $e) {
                return $e->getMessage();
                // throw New Exception( "I failed and also" );
            }
            return $this->connection->lastInsertId();

        }

        private function executeSelectStatement($query = "" , $params = [])
        {
            try {
                $stmt = $this->connection()->prepare( $query );
                
                if($stmt === false) {
                    throw New Exception("Unable to do prepared statement: " . $query);
                }
                if( $params ) {
                    $i = 1;
                    foreach($params as $param => $param_validator) { 
                        # code...
                        $stmt->bindValue($i, $param, $param_validator);
                        $i = $i + 1;
                    }
                }
                $stmt->execute();

                $res = $stmt->fetch(\PDO::FETCH_OBJ);
                return $res;
            } catch(\Exception $e) {
                return $e->getMessage();
            }
        }
}

?>