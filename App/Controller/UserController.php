<?php namespace App\Controller;
use App\Model\User;
// require "App\Model\User.php";

class UserController {
    public function getUser() {

        echo "Helo World";
    }

    public function createUser($request, $response) {
        // print_r($request->getJSON());
        $data =  $request->getJSON(); 
        $user = new User();
        $password = User::hashPassword($data['password']);
        $data['password'] = $password;
        try {
            $res = $user->Create($data);

        } catch(\Exception $e) {
            $response->status(400)->toJSON($e->getMessage());
        }
        if (is_numeric($res)) {
            $reponseData = array(
                'email' => $data->email,
                'id' => $res
            );
            // print_r($data);
            $response->status(201)->toJSON($reponseData);
        } else {
            $response->status(400)->toJSON($res);
        }
        
    }

    public function login($request, $response) {
        $data =  $request->getJSON(); 
        $user = new User();
        try {
            $userData = $user->login($data);

        } catch(\Exception $e) {
            $response->status(400)->toJSON($e->getMessage());
        }
        if ($userData != False) {
            $response->status(400)->toJSON($userData);
        } else {
            $response->status(400)->toJSON($userData);
        }
        
        
    }
}