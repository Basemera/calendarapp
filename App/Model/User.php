<?php namespace App\Model;
use PDO;
use App\Database\DatabaseConfig;

class User extends DatabaseConfig {
    // use \PDO;
    public function createUser($data) {
        $q = 'insert into users (email, password) values(?, ?)';

        $email = $data->email;
        $password = $this->hashPassword($data->password);
        $params = array(
            $email => PDO::PARAM_STR,
            $password => PDO::PARAM_STR
        );
        return $this->insert($q, $params);
    }

    private function hashPassword($password) {
        return password_hash($password, PASSWORD_DEFAULT);
    }

    public function login($data) {
        $q = 'select * from users where email = ?';
        if (is_array($data)) {
            $params = array(
                $data['email']=> PDO::PARAM_STR,
            );
            $password = $data['password'];
        } else {
            $params = array(
                $data->email=> PDO::PARAM_STR,
            );
            $password = $data->password;
        }
        
        $user = $this->select($q, $params);
        // print_r($user);
        if ($user) {
            $verifyPassword = password_verify($password, $user->password);
            if ($verifyPassword == TRUE) {
                return array('user_id'=>$user->id, 'email'=>$user->email);
            }
        }
        return FALSE;
    }
}