<?php
require "vendor/autoload.php";
use Illuminate\Database\Capsule\Manager as Capsule;
$capsule = new Capsule;
$capsule->addConnection([
   "driver" => "mysql",
   "host" =>"127.0.0.1",
   "database" => "calendar",
   "username" => "root",
   "password" => "root",
   "port" => "8889"
]);
$capsule->setAsGlobal();
$capsule->bootEloquent();
