<?php
namespace Unittests\Test;
// use Illuminate\Foundation\Testing\TestCase;
// use PHPUnit\Framework\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Model\User;
// use Monolog\Test\TestCase as TestTestCase;

// use Monolog\Test\TestCase as TestTestCase;

// use Tests\TestCase;
use Unittests\Test\TestCase;
// use Monolog\Test\TestCase as TestTestCase;

class UserModelTest extends TestCase {
    // use CreatesApplication;
    public function testCreateUser() {
        $user = new User();
        $data = array (
            "email" => "basp@gmail.com",
            "password" => User::hashPassword('password')
        );
        $user->Create($data);
        print_r($user);
        $this->assertEquals($user, array(
            "email" => "basp@gmail.com",
            "updated_at" => "2022-07-03T00:11:06.000000Z",
            "created_at" => "2022-07-03T00:11:06.000000Z",
            "id" => 1
        ));
    }
}