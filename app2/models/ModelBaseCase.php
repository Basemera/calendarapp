<?php
require_once('../../config.php');

class ModelBaseCase extends PDOStatement {
    private $connection;

        public function __construct()
        {
        }

        private function connection() {
            $connection = new PDOConfig();
            if($connection === false){
                echo "ERROR: Could not connect. " . mysqli_connect_error();
            }
            return $connection;
        }

        public function insert($query = "" , $params = [])
        {
            try {
                $stmt = $this->executeStatement( $query , $params );
                $result = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);               
                $stmt->close();
    
                return $result;
            } catch(Exception $e) {
                throw New Exception( $e->getMessage() );
            }
            return false;
        }

        public function select($query = "" , $params = [])
        {
            try {
                $stmt = $this->executeStatement( $query , $params );
                $result = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);               
                $stmt->close();
    
                return $result;
            } catch(Exception $e) {
                throw New Exception( $e->getMessage() );
            }
            return false;
        }

        private function executeStatement($query = "" , $params = [])
        {
            try {
                $stmt = $this->connection->prepare( $query );
    
                if($stmt === false) {
                    throw New Exception("Unable to do prepared statement: " . $query);
                }
    
                if( $params ) {
                    foreach($params as $param => $param_validator) { 
                        # code...
                        $stmt->bind_param($param, $param_validator);
                    }
                    // $stmt->bind_param($params[0], $params[1]);
                }
    
                $stmt->execute();
    
                return $stmt;
            } catch(Exception $e) {
                throw New Exception( $e->getMessage() );
            }   
        }

        private function executeSelectStatement($query = "" , $params = [])
        {
            try {
                $stmt = $this->connection->prepare( $query );
    
                if($stmt === false) {
                    throw New Exception("Unable to do prepared statement: " . $query);
                }
    
                if( $params ) {
                    foreach($params as $param => $param_validator) { 
                        # code...
                        $stmt->bind_param($param, PDO::$param_validator);
                    }
                    // $stmt->bind_param($params[0], $params[1]);
                }
    
                $stmt->execute();
    
                return $stmt;
            } catch(Exception $e) {
                throw New Exception( $e->getMessage() );
            }   
        }
}


?>