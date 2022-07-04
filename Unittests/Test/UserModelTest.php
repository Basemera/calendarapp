<?php
namespace Unittests\Test;
use App\Model\User;
use Unittests\Test\AppBaseTestCase;

class UserModelTest extends AppBaseTestCase {
    // use CreatesApplication;
    public function testCreateUser() {
        $user = new User();
        $data = array (
            "email" => "basp@gmail.com",
            "password" => User::hashPassword('password')
        );
        $user->Create($data);
        $this->assertEquals($user, array(
            "email" => "basp@gmail.com",
            "updated_at" => "2022-07-03T00:11:06.000000Z",
            "created_at" => "2022-07-03T00:11:06.000000Z",
            "id" => 1
        ));
    }
}