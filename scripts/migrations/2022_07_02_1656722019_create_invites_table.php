
<?php

include(__DIR__ ."/../../database.php");
// use PDOConfig;
class CreateInvitesTable {

private function connection() {

$connection = new PDOConfig();

if ($connection === false) {

echo 'ERROR: Could not connect. mysqli_connect_error()';

}

return $connection;

}
public function createTable() {

$table_name =   'invites'  ;
$sql = 'CREATE TABLE `invites` (

    id INT AUTO_INCREMENT PRIMARY KEY,
    invitee_id int NOT NULL,
    sender_id int NOT NULL,
    description text,
    active boolean default true,
    accepted boolean,
    event_time DATETIME,
    FOREIGN KEY (invitee_id) REFERENCES users(id)
    FOREIGN KEY (sender_id) REFERENCES users(id)

created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP)';

try {

$connection = $this->connection();

$statement = $connection->prepare($sql);

$statement->execute();

$connection = null;

return true;
} catch (\PDOException $e) {

echo $e->getMessage();

return false;
} 
}
public function dropTable() {

$table_name =   'invites'  ;
$sql = 'DROP TABLE IF EXISTS `invites`';

try {

$connection = $this->connection();

$statement = $connection->prepare($sql);

$statement->execute();

$connection = null;

return true;
} catch (\PDOException $e) {

echo $e->getMessage();

return false;
} 
}
}
?>
