
<?php
// require_once(__DIR__.'/database.php');
// require('../../database.php');
// include_once(__DIR__ ."/../../database.php");

// class CreateUsersTable {

// private function connection() {

// $connection = new PDOConfig();

// if ($connection === false) {

// echo 'ERROR: Could not connect. mysqli_connect_error()';

// }

// return $connection;

// }
// public function createTable() {

// $table_name =   'users'  ;
// $sql = 'CREATE TABLE `users` (

// id INT AUTO_INCREMENT PRIMARY KEY,
// email varchar(255) UNIQUE,
// password varchar(255),

// created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP)';

// try {

// $connection = $this->connection();

// $statement = $connection->prepare($sql);

// $statement->execute();

// $connection = null;

// return true;
// } catch (\PDOException $e) {

// echo $e->getMessage();

// return false;
// } 
// }
// public function dropTable() {

// $table_name =   'users'  ;
// $sql = 'DROP TABLE IF EXISTS `users`';

// try {

// $connection = $this->connection();

// $statement = $connection->prepare($sql);

// $statement->execute();

// $connection = null;

// return true;
// } catch (\PDOException $e) {

// echo $e->getMessage();

// return false;
// } 
// }
// }
?>
