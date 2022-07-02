<?php
include('ModelBaseCase');

class User extends ModelBaseCase
{
    public function createUser($data) {
        $q = 'insert into users(email, password) values(?, ?)';
        $params = array(
            $data['email'] => PDO::PARAM_STR,
            $data['password'] => PDO::PARAM_STR
        );
        return $this->insert($q, $params);
    }
}