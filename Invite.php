<?php 
// require "../bootstrap.php";
// require("../../bootstrap.php");
// require_once($_SERVER['DOCUMENT_ROOT'].'/bootstrap.php');
// require "../bootstrap.php";
// require "vendor/autoload.php";
require 'bootstrap.php';

use Illuminate\Database\Capsule\Manager as Capsule;
Capsule::schema()->create('invites', function ($table) {
       $table->increments('id');
       $table->integer('invitee_id')->unsigned();
       $table->integer('sender_id')->unsigned();

       $table->string('description');
       $table->boolean('active')->default(1);
       $table->boolean('accepted')->default(0);
       $table->datetime('event_time');

    //    $table->integer('user_id')->unsigned();
       $table->timestamps();
    //    $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
       $table->foreign('invitee_id')->references('id')->on('users')->onDelete('cascade');
       $table->foreign('sender_id')->references('id')->on('users')->onDelete('cascade');

   });