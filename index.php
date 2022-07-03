<?php
require __DIR__ . '/vendor/autoload.php';

use App\Lib\Config;
use App\Controller\UserController;
use App\Controller\InviteController;
// $LOG_PATH = Config::get('LOG_PATH', '');
// echo "[LOG_PATH]: $LOG_PATH";

use App\Lib\App;
use App\Lib\Router;
use App\Lib\Request;
use App\Lib\Response;
require "./bootstrap.php";

// $user = User::Create([    'name' => "Ahmed Khan",    'email' => "ahmed.khan@lbs.com",    'password' => password_hash("ahmedkhan",PASSWORD_BCRYPT), ]);

Router::get('/', function () {
    (new UserController())->getUser();
});

Router::get('/post/([0-9]*)', function (Request $req, Response $res) {
    $res->toJSON([
        'post' =>  ['id' => $req->params[0]],
        'status' => 'ok'
    ]);
});

Router::post('/user', function (Request $req, Response $res) {
    (new UserController())->createUser($req, $res);
    // $post = Posts::add($req->getJSON());
    // $res->status(201)->toJSON($post);
});

Router::post('/login', function (Request $req, Response $res) {
    (new UserController())->login($req, $res);
    // $post = Posts::add($req->getJSON());
    // $res->status(201)->toJSON($post);
});

Router::post('/invite', function (Request $req, Response $res) {
    (new InviteController())->createInvite($req, $res);
    // $post = Posts::add($req->getJSON());
    // $res->status(201)->toJSON($post);
});

Router::post('/calendar/([0-9]*)', function (Request $req, Response $res) {
    // print_r($req);
    (new InviteController())->updateInvite($req, $res);
    // $post = Posts::add($req->getJSON());
    // $res->status(201)->toJSON($post);
});